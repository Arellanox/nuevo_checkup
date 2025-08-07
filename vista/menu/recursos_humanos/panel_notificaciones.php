<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Control - RH Bimo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        .notification-card {
            border-left: 4px solid #007bff;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            transition: all 0.3s ease;
        }
        
        .notification-card:hover {
            box-shadow: 0 4px 8px rgba(0,0,0,0.15);
            transform: translateY(-2px);
        }
        
        .generator-card {
            border-left: 4px solid #28a745;
        }
        
        .info-card {
            border-left: 4px solid #17a2b8;
        }
        
        .quick-action-btn {
            transition: all 0.3s ease;
        }
        
        .quick-action-btn:hover {
            transform: scale(1.05);
        }
        
        .badge-status {
            font-size: 0.8rem;
            padding: 0.4rem 0.8rem;
        }
        
        .candidate-quick-info {
            background: linear-gradient(135deg, #f8f9fa, #e9ecef);
            border-radius: 8px;
            padding: 15px;
            margin: 10px 0;
        }
    </style>
</head>
<body class="bg-light">
    <div class="container-fluid mt-4">
        <div class="row">
            <div class="col-12">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h2><i class="fas fa-bell text-primary"></i> Panel de Notificaciones y Herramientas</h2>
                    <!-- <span class="badge bg-secondary">Recursos Humanos</span> -->
                </div>
            </div>
        </div>
        
        <div class="row">
            <!-- Generador de Enlaces de Propuesta -->
            <div class="col-lg-8 col-md-12 mb-4">
                <div class="card notification-card generator-card">
                    <div class="card-header bg-success text-white">
                        <h4 class="mb-0"><i class="fas fa-link"></i> Generador de Enlaces de Propuesta Salarial</h4>
                        <small>Herramienta para generar enlaces de propuesta para candidatos</small>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="col-md-6 mb-3">
                                    <label for="idCandidato" class="form-label">
                                        <i class="fas fa-user"></i> Número de Candidato
                                    </label>
                                    <div class="input-group">
                                        <span class="input-group-text">#</span>
                                        <input type="number" class="form-control" id="idCandidato" min="1" placeholder="Ingrese el número del candidato">
                                        <button class="btn btn-primary" onclick="generarEnlace()">
                                            <i class="fas fa-magic"></i> Generar
                                        </button>
                                    </div>
                                    <div class="form-text">
                                        <i class="fas fa-info-circle"></i> Solo se generan enlaces para candidatos en estado "en_espera"
                                    </div>
                                </div>
                                
                                <div id="resultadoEnlace" class="mt-3" style="display: none;">
                                    <div class="alert alert-success">
                                        <h6><i class="fas fa-check-circle"></i> Enlace generado exitosamente:</h6>
                                        <div class="input-group mb-2">
                                            <input type="text" class="form-control form-control-sm" id="enlaceGenerado" readonly>
                                            <button class="btn btn-outline-secondary btn-sm" onclick="copiarEnlace()" title="Copiar enlace">
                                                <i class="fas fa-copy"></i>
                                            </button>
                                            <a id="abrirEnlace" class="btn btn-success btn-sm" target="_blank" title="Abrir en nueva pestaña">
                                                <i class="fas fa-external-link-alt"></i>
                                            </a>
                                        </div>
                                        <small class="text-muted">
                                            <i class="fas fa-clock"></i> Este enlace permite al candidato ver y responder a su propuesta salarial
                                        </small>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- <div class="col-md-4">
                                <h6><i class="fas fa-users"></i> Candidatos de Ejemplo</h6>
                                <div class="d-grid gap-2">
                                    <button class="btn btn-outline-primary btn-sm quick-action-btn" onclick="setearID(1)">
                                        <i class="fas fa-user"></i> Candidato #1
                                    </button>
                                    <button class="btn btn-outline-primary btn-sm quick-action-btn" onclick="setearID(2)">
                                        <i class="fas fa-user"></i> Candidato #2
                                    </button>
                                    <button class="btn btn-outline-primary btn-sm quick-action-btn" onclick="setearID(3)">
                                        <i class="fas fa-user"></i> Candidato #3
                                    </button>
                                    <button class="btn btn-outline-primary btn-sm quick-action-btn" onclick="setearID(5)">
                                        <i class="fas fa-user"></i> Candidato #5
                                    </button>
                                </div>
                            </div> -->
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Información del Sistema -->
            <div class="col-lg-4 col-md-12 mb-4">
                <div class="card notification-card info-card">
                    <div class="card-header bg-info text-white">
                        <h5 class="mb-0"><i class="fas fa-info-circle"></i> Información del Sistema</h5>
                    </div>
                    <div class="card-body">
                        <h6><i class="fas fa-cogs"></i> Especificaciones Técnicas</h6>
                        <ul class="list-unstyled small">
                            <li><strong>URL base:</strong> <code>../../../propuesta_salarial.php</code></li>
                            <li><strong>Estado requerido:</strong> <span class="badge bg-warning">en_espera</span></li>
                        </ul>
                        
                        <hr>
                        
                        <h6><i class="fas fa-route"></i> Flujo de Propuesta</h6>
                        <div class="candidate-quick-info">
                            <div class="d-flex align-items-center mb-2">
                                <span class="badge bg-info me-2">1</span>
                                <small>Candidato <strong>preseleccionado</strong></small>
                            </div>
                            <div class="d-flex align-items-center mb-2">
                                <span class="badge bg-warning me-2">2</span>
                                <small>RH envía propuesta → <strong>en_espera</strong></small>
                            </div>
                            <div class="d-flex align-items-center mb-2">
                                <span class="badge bg-primary me-2">3.1</span>
                                <small>Candidato acepta → <strong>en_proceso</strong></small>
                            </div>
                            <div class="d-flex align-items-center">
                                <span class="badge bg-danger me-2">3.2</span>
                                <small>Candidato rechaza → <strong>declinado</strong></small>
                            </div>
                            <div class="d-flex align-items-center">
                                <span class="badge bg-success me-2">4</span>
                                <small>RH Almacena carta propuesta firmada → <strong>finalista</strong></small>
                            </div>
                        </div>
                        
                        <div class="mt-3">
                            <button class="btn btn-outline-info btn-sm w-100" onclick="verificarCandidato()">
                                <i class="fas fa-search"></i> Comprobar Estado de Candidato
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Historial de Enlaces Generados -->
        <div class="row">
            <div class="col-12">
                <div class="card notification-card">
                    <div class="card-header">
                        <h5 class="mb-0"><i class="fas fa-history"></i> Historial de Enlaces Generados</h5>
                    </div>
                    <div class="card-body">
                        <div id="historialEnlaces" class="table-responsive">
                            <table class="table table-sm">
                                <thead>
                                    <tr>
                                        <th>Número Candidato</th>
                                        <th>Enlace</th>
                                        <th>Fecha/Hora</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody id="historialBody">
                                    <tr>
                                        <td colspan="4" class="text-center text-muted">
                                            <i class="fas fa-inbox"></i> No hay enlaces generados en esta sesión
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Toast Container -->
    <div class="toast-container position-fixed bottom-0 end-0 p-3">
        <div id="toastNotification" class="toast" role="alert">
            <div class="toast-header">
                <i class="fas fa-bell text-primary me-2"></i>
                <strong class="me-auto">Notificación</strong>
                <button type="button" class="btn-close" data-bs-dismiss="toast"></button>
            </div>
            <div class="toast-body" id="toastMessage">
                Mensaje aquí
            </div>
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        let historialEnlaces = [];
        
        function setearID(id) {
            document.getElementById('idCandidato').value = id;
            mostrarToast(`ID de candidato establecido: ${id}`, 'info');
        }
        
        function generarEnlace() {
            const idCandidato = document.getElementById('idCandidato').value;
            
            if (!idCandidato || idCandidato < 1) {
                mostrarToast('Por favor ingrese un ID de candidato válido', 'error');
                return;
            }
            
            // Mostrar loading mientras verifica el estado
            mostrarToast('Verificando estado del candidato...', 'info');
            
            // Verificar estado del candidato antes de generar enlace
            const formData = new FormData();
            formData.append('api', '37');
            formData.append('id_candidato', idCandidato);
            
            fetch('../../../api/recursos_humanos_api.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                console.log('Verificación de candidato:', data);
                
                let candidato = null;
                if (data.response && data.response.data && Array.isArray(data.response.data) && data.response.data.length > 0) {
                    candidato = data.response.data[0];
                }
                
                if (!candidato) {
                    mostrarToast(`No se encontró el candidato #${idCandidato}`, 'error');
                    return;
                }
                
                const estado = candidato.estado_candidato;
                const nombre = candidato.nombre_completo;
                
                // Validar que el candidato esté en estado "en_espera"
                if (estado !== 'en_espera') {
                    let mensaje = `<strong>${nombre}</strong><br>`;
                    mensaje += `Estado actual: <span class="badge bg-${getStatusColor(estado)}">${estado}</span><br>`;
                    mensaje += `<small><i class="fas fa-exclamation-triangle"></i> Solo se pueden generar enlaces para candidatos en estado "en_espera"</small>`;
                    
                    mostrarToast(mensaje, 'error', 5000);
                    
                    // Ocultar resultado si estaba visible
                    document.getElementById('resultadoEnlace').style.display = 'none';
                    return;
                }
                
                // Si llegamos aquí, el candidato está en estado válido
                // Generar enlace relativo a la estructura actual
                const baseUrl = window.location.origin + window.location.pathname.replace('vista/menu/recursos_humanos/panel_notificaciones.php', 'vista/menu/recursos_humanos/');
                const enlace = baseUrl + 'propuesta_salarial.php?id=' + idCandidato;
                
                document.getElementById('enlaceGenerado').value = enlace;
                document.getElementById('abrirEnlace').href = enlace;
                document.getElementById('resultadoEnlace').style.display = 'block';
                
                // Agregar al historial
                agregarAlHistorial(idCandidato, enlace);
                
                mostrarToast(`Enlace generado para <strong>${nombre}</strong>`, 'success', 4000);
            })
            .catch(error => {
                console.error('Error:', error);
                mostrarToast('Error al verificar el estado del candidato', 'error');
            });
        }
        
        function copiarEnlace() {
            const enlace = document.getElementById('enlaceGenerado');
            enlace.select();
            enlace.setSelectionRange(0, 99999);
            
            try {
                document.execCommand('copy');
                mostrarToast('Enlace copiado al portapapeles', 'success');
                
                // Efecto visual en el botón
                const btn = event.target.closest('button');
                const iconOriginal = btn.innerHTML;
                btn.innerHTML = '<i class="fas fa-check"></i>';
                btn.classList.remove('btn-outline-secondary');
                btn.classList.add('btn-success');
                
                setTimeout(() => {
                    btn.innerHTML = iconOriginal;
                    btn.classList.remove('btn-success');
                    btn.classList.add('btn-outline-secondary');
                }, 1500);
            } catch (err) {
                mostrarToast('No se pudo copiar automáticamente', 'error');
            }
        }
        
        function agregarAlHistorial(idCandidato, enlace) {
            const ahora = new Date();
            const fechaHora = ahora.toLocaleString('es-MX');
            
            historialEnlaces.unshift({
                id: idCandidato,
                enlace: enlace,
                fecha: fechaHora,
                timestamp: ahora.getTime()
            });
            
            // Mantener solo los últimos 10
            if (historialEnlaces.length > 10) {
                historialEnlaces = historialEnlaces.slice(0, 10);
            }
            
            actualizarHistorial();
        }
        
        function actualizarHistorial() {
            const tbody = document.getElementById('historialBody');
            
            if (historialEnlaces.length === 0) {
                tbody.innerHTML = `
                    <tr>
                        <td colspan="4" class="text-center text-muted">
                            <i class="fas fa-inbox"></i> No hay enlaces generados en esta sesión
                        </td>
                    </tr>
                `;
                return;
            }
            
            tbody.innerHTML = historialEnlaces.map(item => `
                <tr>
                    <td><span class="badge bg-primary">#${item.id}</span></td>
                    <td>
                        <small class="text-truncate d-block" style="max-width: 300px;" title="${item.enlace}">
                            ${item.enlace}
                        </small>
                    </td>
                    <td><small>${item.fecha}</small></td>
                    <td>
                        <button class="btn btn-outline-secondary btn-sm me-1" onclick="copiarTexto('${item.enlace}')" title="Copiar">
                            <i class="fas fa-copy"></i>
                        </button>
                        <a href="${item.enlace}" target="_blank" class="btn btn-outline-success btn-sm" title="Abrir">
                            <i class="fas fa-external-link-alt"></i>
                        </a>
                    </td>
                </tr>
            `).join('');
        }
        
        function copiarTexto(texto) {
            navigator.clipboard.writeText(texto).then(() => {
                mostrarToast('Enlace copiado', 'success');
            }).catch(() => {
                mostrarToast('Error al copiar', 'error');
            });
        }
        
        function verificarCandidato() {
            const idCandidato = document.getElementById('idCandidato').value;
            
            if (!idCandidato) {
                mostrarToast('Primero ingrese un ID de candidato', 'warning');
                return;
            }
            
            // Hacer petición para verificar estado del candidato
            const formData = new FormData();
            formData.append('api', '37');
            formData.append('id_candidato', idCandidato);
            
            fetch('../../../api/recursos_humanos_api.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                console.log('Verificación de candidato:', data);
                
                let candidato = null;
                if (data.response && data.response.data && Array.isArray(data.response.data) && data.response.data.length > 0) {
                    candidato = data.response.data[0];
                }
                
                if (candidato) {
                    const estado = candidato.estado_candidato;
                    const nombre = candidato.nombre_completo;
                    const puedeResponder = candidato.puede_responder == 1;
                    
                    let mensaje = `<strong>${nombre}</strong><br>`;
                    mensaje += `Estado: <span class="badge bg-${getStatusColor(estado)}">${estado}</span><br>`;
                    mensaje += `Puede responder: ${puedeResponder ? '<span class="text-white">Sí</span>' : '<span class="text-danger">No</span>'}`;
                    
                    mostrarToast(mensaje, puedeResponder ? 'success' : 'warning', 5000);
                } else {
                    mostrarToast(`No se encontró el candidato #${idCandidato}`, 'error');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                mostrarToast('Error al verificar candidato', 'error');
            });
        }
        
        function getStatusColor(estado) {
            switch (estado) {
                case 'en_espera': return 'warning';
                case 'en_proceso': return 'info';
                case 'preseleccionado': return 'secondary';
                case 'finalista': return 'primary';
                case 'contratado': return 'success';
                case 'rechazado': return 'danger';
                case 'declinado': return 'danger';
                default: return 'secondary';
            }
        }
        
        function mostrarToast(mensaje, tipo = 'info', duracion = 3000) {
            const toast = document.getElementById('toastNotification');
            const toastMessage = document.getElementById('toastMessage');
            
            // Configurar colores según tipo
            const colores = {
                'success': 'text-bg-success',
                'error': 'text-bg-danger',
                'warning': 'text-bg-warning',
                'info': 'text-bg-info'
            };
            
            // Limpiar clases anteriores
            toast.classList.remove('text-bg-success', 'text-bg-danger', 'text-bg-warning', 'text-bg-info');
            toast.classList.add(colores[tipo] || 'text-bg-info');
            
            toastMessage.innerHTML = mensaje;
            
            const bsToast = new bootstrap.Toast(toast, {
                delay: duracion
            });
            bsToast.show();
        }
        
        // Auto-cargar página
        document.addEventListener('DOMContentLoaded', function() {
            mostrarToast('Panel de notificaciones cargado correctamente', 'success');
        });
        
        // Manejar Enter en el input
        document.getElementById('idCandidato').addEventListener('keypress', function(e) {
            if (e.key === 'Enter') {
                generarEnlace();
            }
        });
    </script>
</body>
</html>