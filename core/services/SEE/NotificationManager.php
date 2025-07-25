<?php $user_id = $_SESSION['id']; ?>

<script>
    // Sistema híbrido SSE + Polling con reconexión automática
    class NotificationManager {
        constructor(userId, baseUrl) {
            this.userId = userId;
            this.baseUrl = baseUrl;
            this.ultimoId = 0;
            this.sonidoHabilitado = false;
            this.notificationsIds = [];
            this.isInitialized = false;

            // Configuración SSE
            this.eventSource = null;
            this.sseEnabled = true;
            this.reconnectAttempts = 0;
            this.maxReconnectAttempts = 5;
            this.reconnectDelay = 1000;
            this.connectionTimeout = 10000; // 10 segundos timeout

            // Configuración Polling (fallback)
            this.pollingInterval = null;
            this.pollingDelay = 5000; // 5 segundos iniciales
            this.maxPollingDelay = 30000; // 30 segundos máximo
            this.currentPollingDelay = this.pollingDelay;

            // Estado de la conexión
            this.isConnected = false;
            this.lastActivity = Date.now();
            this.connectionMode = 'SSE'; // 'SSE' o 'POLLING'

            // Configuración de heartbeat
            this.heartbeatInterval = null;
            this.heartbeatTimeout = 60000; // 1 minuto
            this.lastHeartbeat = Date.now();

            this.audioNotificacion = new Audio(`${baseUrl}/core/assets/notification.mp3`);
            this.init();
        }

        init() {
            this.mostrarEstadoConexion('Conectando...');
            this.configurarEventos();
            this.cargarNotificacionesIniciales();
            this.intentarConexionSSE();
            this.iniciarMonitoreoConexion();
        }

        // === MANEJO DE CONEXIÓN SSE ===
        intentarConexionSSE() {
            if (!this.sseEnabled) {
                this.cambiarAPolling();
                return;
            }

            const serverUrl = `${this.baseUrl}/core/services/SEE/ServerSentEvents.php?user_id=${this.userId}&ultimo_id=${this.ultimoId}&timestamp=${Date.now()}`;

            try {
                this.eventSource = new EventSource(serverUrl);
                this.configurarEventosSSE();
                this.iniciarTimeoutConexion();
            } catch (error) {
                console.error('❗Error creando EventSource:', error);
                this.manejarErrorSSE();
            }
        }

        configurarEventosSSE() {
            this.eventSource.onopen = () => {
                console.log('🚀 Conexión SSE establecida');
                this.onConexionEstablecida('SSE');
            };

            this.eventSource.onmessage = (event) => {
                this.onMensajeSSE(event);
            };

            this.eventSource.addEventListener('notification', (event) => {
                console.log('📣 Evento notification recibida');
                this.manejarNotificacion(JSON.parse(event.data));
            });

            this.eventSource.addEventListener('heartbeat', (event) => {
                this.onHeartbeatRecibido(JSON.parse(event.data));
            });

            this.eventSource.addEventListener('connected', (event) => {
                console.log('🔔 Confirmación de conexión SSE recibida');
                this.onConexionEstablecida('SSE');
            });

            this.eventSource.addEventListener('error', (event) => {
                console.log('❗Error event SSE recibido');
                this.manejarErrorSSE();
            });

            this.eventSource.onerror = (error) => {
                console.error('❗Error en SSE:', error);
                this.manejarErrorSSE();
            };
        }

        iniciarTimeoutConexion() {
            // Timeout para conexión SSE
            setTimeout(() => {
                if (!this.isConnected && this.eventSource) {
                    console.log('🕛 Timeout de conexión SSE');
                    this.manejarErrorSSE();
                }
            }, this.connectionTimeout);
        }

        onMensajeSSE(event) {
            try {
                const data = JSON.parse(event.data);
                this.manejarNotificacion(data);
            } catch (error) {
                console.error('❗Error procesando mensaje SSE:', error);
            }
        }

        onHeartbeatRecibido(data) {
            this.lastHeartbeat = Date.now();
            this.lastActivity = Date.now();
            console.log('💓 Heartbeat recibido:', data.timestamp);
        }

        onConexionEstablecida(modo) {
            this.isConnected = true;
            this.connectionMode = modo;
            this.reconnectAttempts = 0;
            this.lastActivity = Date.now();
            this.mostrarEstadoConexion(`Conectado vía ${modo}`);

            // Detener polling si estaba activo
            if (this.pollingInterval) {
                clearInterval(this.pollingInterval);
                this.pollingInterval = null;
            }

            // Iniciar heartbeat monitoring
            this.iniciarHeartbeatMonitoring();
        }

        manejarErrorSSE() {
            this.isConnected = false;

            if (this.eventSource) {
                this.eventSource.close();
                this.eventSource = null;
            }

            this.detenerHeartbeatMonitoring();

            if (this.reconnectAttempts < this.maxReconnectAttempts) {
                this.intentarReconexionSSE();
            } else {
                console.log('🕛 Máximo de intentos SSE alcanzado, cambiando a polling');
                this.cambiarAPolling();
            }
        }

        intentarReconexionSSE() {
            this.reconnectAttempts++;
            const delay = this.reconnectDelay * Math.pow(2, this.reconnectAttempts - 1);

            console.log(`🕛 Reintentando SSE en ${delay}ms (intento ${this.reconnectAttempts})`);
            this.mostrarEstadoConexion(`Reconectando... (${this.reconnectAttempts}/${this.maxReconnectAttempts})`);

            setTimeout(() => {
                if (!this.isConnected) {
                    this.intentarConexionSSE();
                }
            }, delay);
        }

        // === SISTEMA DE POLLING (FALLBACK) ===
        cambiarAPolling() {
            console.log('🔄 Cambiando a modo polling');
            this.connectionMode = 'POLLING';
            this.sseEnabled = false;
            this.currentPollingDelay = this.pollingDelay;
            this.iniciarPolling();
        }

        iniciarPolling() {
            if (this.pollingInterval) {
                clearInterval(this.pollingInterval);
            }

            this.mostrarEstadoConexion('Conectado vía Polling');
            this.isConnected = true;

            // Primera consulta inmediata
            this.consultarNotificaciones();

            // Configurar intervalo
            this.pollingInterval = setInterval(() => {
                this.consultarNotificaciones();
            }, this.currentPollingDelay);
        }

        async consultarNotificaciones() {
            try {
                const response = await fetch(`${this.baseUrl}/api/notificaciones_api.php`, {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify({
                        api: 1,
                        user_id: this.userId,
                        ultimo_id: this.ultimoId
                    })
                });

                if (!response.ok) {
                    throw new Error(`❗Error HTTP ${response.status}`);
                }

                const data = await response.json();
                this.manejarNotificacion(data);
                this.lastActivity = Date.now();

                // Ajustar intervalo basado en actividad
                this.ajustarIntervaloPolling(data?.response?.data[0]?.length > 0);
            } catch (error) {
                console.error('❗Error en polling:', error);
                this.manejarErrorPolling();
            }
        }

        ajustarIntervaloPolling(hayActividad) {
            if (hayActividad) {
                // Hay actividad, mantener intervalo rápido
                this.currentPollingDelay = this.pollingDelay;
            } else {
                // No hay actividad, incrementar intervalo gradualmente
                this.currentPollingDelay = Math.min(
                    this.currentPollingDelay * 1.2,
                    this.maxPollingDelay
                );
            }

            // Reiniciar intervalo con nueva frecuencia
            if (this.pollingInterval) {
                clearInterval(this.pollingInterval);
                this.pollingInterval = setInterval(() => {
                    this.consultarNotificaciones();
                }, this.currentPollingDelay);
            }
        }

        manejarErrorPolling() {
            console.log('🕛 Error en polling, reintentando...');
            this.mostrarEstadoConexion('Error de conexión, reintentando...');

            // Incrementar intervalo en caso de error
            this.currentPollingDelay = Math.min(this.currentPollingDelay * 2, this.maxPollingDelay);

            setTimeout(() => {
                if (this.connectionMode === 'POLLING') {
                    this.consultarNotificaciones();
                }
            }, this.currentPollingDelay);
        }

        // === MONITOREO DE CONEXIÓN ===
        iniciarMonitoreoConexion() {
            setInterval(() => {
                this.verificarEstadoConexion();
            }, 30000); // Verificar cada 30 segundos
        }

        verificarEstadoConexion() {
            const ahora = Date.now();
            const tiempoSinActividad = ahora - this.lastActivity;

            if (tiempoSinActividad > 120000) { // 2 minutos sin actividad
                console.log('🕛 Conexión parece inactiva, reiniciando...');
                this.reiniciarConexion();
            }
        }

        iniciarHeartbeatMonitoring() {
            this.detenerHeartbeatMonitoring();

            this.heartbeatInterval = setInterval(() => {
                const ahora = Date.now();
                const tiempoSinHeartbeat = ahora - this.lastHeartbeat;

                if (tiempoSinHeartbeat > this.heartbeatTimeout * 2) {
                    console.log('🕛 Heartbeat perdido, reiniciando conexión');
                    this.reiniciarConexion();
                }
            }, this.heartbeatTimeout);
        }

        detenerHeartbeatMonitoring() {
            if (this.heartbeatInterval) {
                clearInterval(this.heartbeatInterval);
                this.heartbeatInterval = null;
            }
        }

        reiniciarConexion() {
            console.log('🔄 Reiniciando conexión...');
            this.isConnected = false;
            this.detenerConexiones();

            // Resetear contadores
            this.reconnectAttempts = 0;
            this.sseEnabled = true;

            // Reintentrar SSE primero
            setTimeout(() => {
                this.intentarConexionSSE();
            }, 1000);
        }

        detenerConexiones() {
            if (this.eventSource) {
                this.eventSource.close();
                this.eventSource = null;
            }

            if (this.pollingInterval) {
                clearInterval(this.pollingInterval);
                this.pollingInterval = null;
            }

            this.detenerHeartbeatMonitoring();
        }

        // === CONFIGURACIÓN DE EVENTOS ===
        configurarEventos() {
            // Habilitar sonido con primera interacción
            document.addEventListener("click", () => this.habilitarSonidoNotificaciones(), { once: true });

            // Manejar visibilidad de la página
            document.addEventListener('visibilitychange', () => {
                if (document.hidden) {
                    console.log('🛸 Página oculta, pausando conexiones');
                    this.pausarConexiones();
                } else {
                    console.log('🛸 Página visible, reanudando conexiones');
                    this.reanudarConexiones();
                }
            });

            // Manejar cierre de ventana
            window.addEventListener('beforeunload', () => {
                this.destruir();
            });
        }

        pausarConexiones() {
            // No cerrar SSE, solo reducir polling
            if (this.connectionMode === 'POLLING') {
                this.currentPollingDelay = this.maxPollingDelay;
            }
        }

        reanudarConexiones() {
            if (!this.isConnected) {
                this.reiniciarConexion();
            } else if (this.connectionMode === 'POLLING') {
                this.currentPollingDelay = this.pollingDelay;
            }
        }

        // === MANEJO DE NOTIFICACIONES ===
        async cargarNotificacionesIniciales() {
            try {
                const response = await fetch(`${this.baseUrl}/api/notificaciones_api.php`, {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify({
                        api: 1,
                        user_id: this.userId
                    })
                });

                const data = await response.json();
                const notificaciones = data?.response?.data[0] || [];

                this.actualizarNotificaciones(notificaciones);
                this.mostrarConteoNotificaciones(notificaciones.length);
                this.obtenerNotificacionesIds(notificaciones);

                if (notificaciones.length > 0) {
                    this.ultimoId = Math.max(...notificaciones.map(n => Number(n.ID_NOTIFICACION)));
                }
            } catch (error) {
                console.error('🚨 Error cargando notificaciones iniciales:', error);
            }
        }

        manejarNotificacion(data) {
            try {
                const notificaciones = data?.response?.data || [];

                if (Array.isArray(notificaciones) && notificaciones.length > 0) {
                    const nuevoUltimoId = Math.max(...notificaciones.map(n => Number(n.ID_NOTIFICACION)));

                    if (nuevoUltimoId > this.ultimoId) {
                        // Solo reproducir sonido para notificaciones nuevas
                        const notificacionesNuevas = notificaciones.filter(n => Number(n.ID_NOTIFICACION) > this.ultimoId);

                        if (notificacionesNuevas.length > 0) {
                            console.log(`📢 ${notificacionesNuevas.length} notificaciones nuevas`);
                            this.reproducirSonidoNotificaciones();

                            if (this.isInitialized) {
                                this.mostrarNotificacionTemporalmente(notificacionesNuevas[0]);
                            } else this.isInitialized = true;

                        }

                        this.actualizarNotificaciones(notificaciones);
                        this.obtenerNotificacionesIds(notificaciones);
                        this.mostrarConteoNotificaciones(notificaciones.length);
                        this.manejarVibracionCapana(true);
                        this.ultimoId = nuevoUltimoId;
                    }
                } else {
                    this.mostrarConteoNotificaciones(0);
                    this.manejarVibracionCapana(false);
                    console.log('📢 Manjear Notificaciones: No hay notificaciones nuevas');
                }
            } catch (error) {
                console.error('🚨 Error procesando notificación:', error);
            }
        }

        // === INTERFAZ DE USUARIO ===
        mostrarEstadoConexion(mensaje) {
            const statusElement = document.querySelector('.connection-status');
            if (statusElement) {
                statusElement.textContent = mensaje;
                statusElement.className = `connection-status ${this.isConnected ? 'connected' : 'disconnected'}`;
            }
            console.log(`📡 ${mensaje}`);
        }

        mostrarNotificacionTemporalmente(notificacion) {
            const toast = document.createElement('div');
            toast.className = 'notification-toast';

            const iniciales = notificacion.REMITENTE_NOMBRE
                .split(' ')
                .map(word => word.charAt(0))
                .join('')
                .substring(0, 2);

            toast.innerHTML = `
                <div class="toast-content">
                    <div class="toast-header">
                        <div class="avatar">${iniciales}</div>
                        <div class="sender-info">
                            <div class="sender-name">${notificacion.REMITENTE_NOMBRE}</div>
                            <div class="timestamp">${notificacion.FECHA_SOLICITADO}</div>
                        </div>
                        <button class="close-btn" onclick="notificationManager.cerrarNotificacion(this)">×</button>
                    </div>
                    <div class="message">${notificacion.MENSAJE}</div>
                    <div class="toast-actions">
                        <a href="${notificacion.VINCULO}" class="action-btn primary">Abrir</a>
                        <button class="action-btn secondary" onclick="notificationManager.marcarNotificacion([${notificacion.ID_NOTIFICACION}])">
                            Marcar como leído
                        </button>
                    </div>
                </div>
                <div class="progress-bar"></div>
            `;

            document.body.appendChild(toast);

            setTimeout(() => toast.classList.add('show'), 100);

            setTimeout(() => {
                toast.classList.remove('show');
                setTimeout(() => {
                    if (document.body.contains(toast)) {
                        document.body.removeChild(toast);
                    }
                }, 300);
            }, 5000);
        }

        cerrarNotificacion(element) {
            const toast = element.closest ? element.closest('.notification-toast') : element;
            toast.classList.remove('show');

            setTimeout(() => {
                if (document.body.contains(toast)) {
                    document.body.removeChild(toast);
                }
            }, 400);
        }

        // === MÉTODOS PÚBLICOS ===
        async marcarNotificaciones(idsNotificaciones, callback = null) {
            try {
                console.log(`📨 Marcando notificaciones`);

                const response = await fetch(`${this.baseUrl}/api/notificaciones_api.php`, {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify({
                        api: 2,
                        ids: idsNotificaciones,
                        user_id: this.userId
                    })
                });

                const result = await response.json();

                if (result.response.data) {
                    this.actualizarNotificacionesDespuesMarcado(idsNotificaciones);
                    if (callback) callback();
                    this.mostrarToast('Notificación marcada exitosamente.', 'success');
                } else {
                    this.mostrarToast('Error al marcar notificación.', 'error');
                }
            } catch (error) {
                console.error('🚨 Error marcando notificaciones:', error);
                this.mostrarToast('Error de conexión.', 'error');
            }
        }

        actualizarNotificacionesDespuesMarcado(idsNotificaciones) {
            idsNotificaciones.forEach(id => {
                const notificationElement = document.querySelector(`[data-notification-id="${id}"]`);
                if (notificationElement) {
                    notificationElement.remove();
                }
            });

            this.notificationsIds = this.notificationsIds.filter(id => !idsNotificaciones.includes(id));
            this.mostrarConteoNotificaciones(this.notificationsIds.length);

            if (this.notificationsIds.length === 0) {
                this.manejarVibracionCapana(false);
            }
        }

        // === MÉTODOS AUXILIARES ===
        manejarVibracionCapana(activar) {
            const bell = document.querySelector(".bi-bell-fill");
            if (bell) {
                bell.classList.toggle("vibrating", activar);
            }
        }

        mostrarConteoNotificaciones(count) {
            const bell = document.querySelector(".notification-bell-display");
            if (bell) {
                bell.classList.toggle('hidden', count === 0);
                if (count > 0) {
                    bell.textContent = count;
                }
            }
        }

        reproducirSonidoNotificaciones() {
            if (this.sonidoHabilitado) {
                this.audioNotificacion.play().catch(error =>
                    console.log("❗Error al reproducir sonido:", error)
                );
            }
        }

        habilitarSonidoNotificaciones() {
            if (!this.sonidoHabilitado) {
                this.audioNotificacion.play().then(() => {
                    this.audioNotificacion.pause();
                    this.audioNotificacion.currentTime = 0;
                    this.sonidoHabilitado = true;
                    console.log('🔊 Sonido de notificaciones habilitado');
                }).catch(error => console.log("❗No se pudo activar el sonido:", error));
            }
        }

        actualizarNotificaciones(notificaciones) {
            const notificationBody = document.querySelector("#notifications-content div.body");
            console.log('🔁 Actualizando notificaciones');
            if (notificationBody) {
                notificationBody.innerHTML = this.generarHTMLNotificaciones(notificaciones);
            }
        }

        obtenerNotificacionesIds(notificaciones) {
            this.notificationsIds = notificaciones.map(notificacion => Number(notificacion.ID_NOTIFICACION));
        }

        marcarNotificacionAndRedirigir(notificacionId) {
            this.marcarNotificaciones([notificacionId], () => {
                window.location.href = notificaciones[notificacionId].VINCULO;
            })
        }

        generarHTMLNotificaciones(notificaciones) {
            return notificaciones.map(notification => `
                <a href="${notification.VINCULO}"
                   data-notification-id="${notification.ID_NOTIFICACION}"
                   onclick="notificationManager.marcarNotificacionAndRedirigir(${notification.ID_NOTIFICACION});"
                   class="notification-item">
                    <p class="date">${notification.FECHA_SOLICITADO}</p>
                    <p class="message">${notification.MENSAJE}</p>
                    <p class="author">${notification.REMITENTE_NOMBRE}</p>
                </a>
            `).join("");
        }

        mostrarToast(mensaje, tipo) {
            alertToast(mensaje, tipo, 4000);
        }

        // === MÉTODOS PÚBLICOS PARA COMPATIBILIDAD ===
        marcarNotificacion(ids) {
            this.marcarNotificaciones(ids);
        }

        limpiarBandejaNotificaciones() {
            this.marcarNotificaciones(this.notificationsIds);
        }

        getEstadoConexion() {
            return {
                isConnected: this.isConnected,
                connectionMode: this.connectionMode,
                reconnectAttempts: this.reconnectAttempts,
                lastActivity: this.lastActivity,
                ultimoId: this.ultimoId
            };
        }

        destruir() {
            console.log('🛑 Destruyendo NotificationManager');
            this.detenerConexiones();
        }
    }

    // Inicialización global
    let notificationManager;

    $(document).ready( function() {
        const userId = <?= $user_id ?>;
        const baseUrl = '<?= $current_url ?>';

        if (userId && baseUrl) {
            console.log('🔔 Notification Manager');
            notificationManager = new NotificationManager(userId, baseUrl);

            // Agregar estado de conexión si existe el elemento
            const statusContainer = document.querySelector("#notifications-content .body");
            if (statusContainer) {
                console.log('🔔 Agregando estado de conexión');
                statusContainer.innerHTML = '<div class="not-found">Iniciando...</div>';
            }
        } else {
            console.error('❗USER_ID y BASE_URL deben estar definidos');
        }
    });

    // Funciones globales para compatibilidad
    function onLimpiarBandejaNotificaciones() {
        notificationManager?.limpiarBandejaNotificaciones();
    }

    function onMarcarNotificacion(id) {
        notificationManager?.marcarNotificacion(id);
    }

    function getNotificationStatus() {
        return notificationManager?.getEstadoConexion();
    }
</script>

<style>
    .notification-toast {
        position: fixed;
        right: 20px;
        top: 20px;
        background: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 12px;
        padding: 0;
        min-width: 320px;
        max-width: 400px;
        transform: translateX(400px);
        transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        z-index: 1000;
        opacity: 0;
        box-shadow:
                0 20px 25px -5px rgba(0, 0, 0, 0.1),
                0 10px 10px -5px rgba(0, 0, 0, 0.04);
        overflow: hidden;
    }

    .notification-toast.show {
        opacity: 1;
        transform: translateX(0);
    }

    .notification-toast::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
        background: #004e59;
        border-radius: 12px 12px 0 0;
    }

    @keyframes gradientShift {
        0% { background-position: 0% 50%; }
        50% { background-position: 100% 50%; }
        100% { background-position: 0% 50%; }
    }

    .toast-content {
        padding: 20px;
        position: relative;
    }

    .toast-header {
        display: flex;
        align-items: center;
        margin-bottom: 12px;
    }

    .avatar {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        background: #004e59;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-weight: 600;
        font-size: 16px;
        margin-right: 12px;
        box-shadow: 0 4px 12px rgba(0, 78, 89, 0.2);
    }

    .sender-info {
        flex-grow: 1;

    }

    .sender-name {
        font-weight: 600;
        font-size: 16px;
        color: #1e293b;
        margin: 0;
        line-height: 1.2;
    }

    .timestamp {
        font-size: 12px;
        color: #64748b;
        font-weight: 500;
        margin-top: 2px;
    }

    .close-btn {
        background: none;
        border: none;
        color: #64748b;
        cursor: pointer;
        font-size: 18px;
        padding: 4px;
        border-radius: 50%;
        width: 24px;
        height: 24px;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.2s ease;
        margin-left: 8px;
    }

    .close-btn:hover {
        background: #f1f5f9;
        color: #374151;
    }

    .toast-content .message {
        font-size: 14px;
        color: #475569;
        line-height: 1.5;
        margin: 0;
        padding: 10px 16px;
        background: #f8fafc;
        border-radius: 12px;
        border: 1px solid #e2e8f0;
        position: relative;
    }

    .toast-content .message::before {
        content: '';
        position: absolute;
        left: 4px;
        top: -1px;
        width: 3px;
        height: 100%;
        background: #004e59;
        border-radius: 2px;
    }

    .toast-actions {
        display: flex;
        gap: 8px;
        margin-top: 16px;
    }

    .action-btn {
        padding: 8px 16px;
        border: none;
        border-radius: 8px;
        font-size: 13px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.2s ease;
        flex: 1;
    }

    .action-btn.primary {
        background: #004e59;
        color: white;
    }

    .action-btn.primary:hover {
        background: #003d47;
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(0, 78, 89, 0.2);
    }

    .action-btn.secondary {
        background: #f1f5f9;
        color: #475569;
        border: 1px solid #e2e8f0;
    }

    .action-btn.secondary:hover {
        background: #e2e8f0;
    }

    .progress-bar {
        position: absolute;
        bottom: 0;
        left: 0;
        height: 3px;
        background: #004e59;
        border-radius: 0 0 12px 12px;
        animation: progressBar 5s linear forwards;
    }

    @keyframes progressBar {
        from { width: 100%; }
        to { width: 0%; }
    }

    .notification-icon {
        position: absolute;
        top: -8px;
        right: -8px;
        width: 24px;
        height: 24px;
        background: #004e59;
        border-radius: 50%;
        border: 3px solid white;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 12px;
        font-weight: 600;
        box-shadow: 0 4px 12px rgba(0, 78, 89, 0.2);
    }

    @keyframes pulse {
        0% { transform: scale(1); }
        50% { transform: scale(1.1); }
        100% { transform: scale(1); }
    }

    /* Responsive */
    @media (max-width: 480px) {
        .notification-toast {
            right: 10px;
            left: 10px;
            min-width: auto;
            max-width: none;
            transform: translateY(-100px);
        }

        .notification-toast.show {
            transform: translateY(0);
        }
    }
</style>