<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Propuesta - Bimo</title>
    
    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
    <style>
        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        .propuesta-container {
            background: white;
            border-radius: 15px;
            box-shadow: 0 20px 40px rgba(0,0,0,0.1);
            overflow: hidden;
            margin-top: 30px;
            margin-bottom: 30px;
        }
        
        .header-propuesta {
            background: linear-gradient(45deg, #2c3e50, #34495e);
            color: white;
            padding: 30px;
            text-align: center;
        }
        
        .logo-container {
            margin-bottom: 20px;
        }
        
        .logo-container i {
            font-size: 3rem;
            color: #3498db;
        }
        
        .content-propuesta {
            padding: 40px;
        }
        
        .info-card {
            background: #f8f9fa;
            border-left: 4px solid #3498db;
            padding: 20px;
            margin-bottom: 20px;
            border-radius: 0 8px 8px 0;
        }
        
        .salary-highlight {
            background: linear-gradient(45deg, #27ae60, #2ecc71);
            color: white;
            padding: 25px;
            border-radius: 10px;
            text-align: center;
            margin: 30px 0;
            box-shadow: 0 10px 20px rgba(46, 204, 113, 0.3);
        }
        
        .salary-amount {
            font-size: 2.5rem;
            font-weight: bold;
            margin-bottom: 10px;
        }
        
        .btn-action {
            padding: 15px 30px;
            font-size: 1.1rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 1px;
            border-radius: 50px;
            border: none;
            transition: all 0.3s ease;
            margin: 10px;
            min-width: 200px;
        }
        
        .btn-aceptar {
            background: linear-gradient(45deg, #27ae60, #2ecc71);
            color: white;
            box-shadow: 0 8px 20px rgba(46, 204, 113, 0.4);
        }
        
        .btn-aceptar:hover {
            transform: translateY(-3px);
            box-shadow: 0 12px 25px rgba(46, 204, 113, 0.6);
        }
        
        .btn-rechazar {
            background: linear-gradient(45deg, #e74c3c, #c0392b);
            color: white;
            box-shadow: 0 8px 20px rgba(231, 76, 60, 0.4);
        }
        
        .btn-rechazar:hover {
            transform: translateY(-3px);
            box-shadow: 0 12px 25px rgba(231, 76, 60, 0.6);
        }
        
        .status-badge {
            display: inline-block;
            padding: 8px 16px;
            border-radius: 20px;
            font-size: 0.9rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        
        .status-pendiente {
            background: linear-gradient(45deg, #f39c12, #e67e22);
            color: white;
        }
        
        .status-aceptada {
            background: linear-gradient(45deg, #27ae60, #2ecc71);
            color: white;
        }
        
        .status-rechazada {
            background: linear-gradient(45deg, #e74c3c, #c0392b);
            color: white;
        }
        
        .loading {
            text-align: center;
            padding: 50px;
        }
        
        .spinner-border {
            width: 3rem;
            height: 3rem;
        }
        
        .detail-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 12px 0;
            border-bottom: 1px solid #eee;
        }
        
        .detail-row:last-child {
            border-bottom: none;
        }
        
        .detail-label {
            font-weight: 600;
            color: #34495e;
        }
        
        .detail-value {
            color: #2c3e50;
            text-align: right;
            flex: 1;
            margin-left: 20px;
        }
        
        .footer-propuesta {
            background: #f8f9fa;
            padding: 20px;
            text-align: center;
            color: #7f8c8d;
            font-size: 0.9rem;
        }
        
        @media (max-width: 768px) {
            .content-propuesta {
                padding: 20px;
            }
            
            .btn-action {
                width: 100%;
                margin: 5px 0;
            }
            
            .salary-amount {
                font-size: 2rem;
            }
        }
        
        .fade-in {
            animation: fadeIn 0.8s ease-in;
        }
        
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(30px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8 col-md-10">
                
                <!-- Loading State -->
                <div id="loadingState" class="propuesta-container fade-in">
                    <div class="loading">
                        <div class="spinner-border text-primary" role="status"></div>
                        <h5 class="mt-3">Cargando propuesta salarial...</h5>
                        <p class="text-muted">Por favor espere un momento</p>
                    </div>
                </div>
                
                <!-- Error State -->
                <div id="errorState" class="propuesta-container fade-in" style="display: none;">
                    <div class="header-propuesta">
                        <div class="logo-container">
                            <i class="fas fa-exclamation-triangle"></i>
                        </div>
                        <h2>Error al cargar propuesta</h2>
                    </div>
                    <div class="content-propuesta text-center">
                        <div class="alert alert-danger" role="alert">
                            <h5>No se pudo cargar la información</h5>
                            <p id="errorMessage">El enlace puede haber expirado o no ser válido.</p>
                        </div>
                        <button class="btn btn-primary" onclick="location.reload()">
                            <i class="fas fa-redo"></i> Intentar nuevamente
                        </button>
                    </div>
                </div>
                
                <!-- Success State -->
                <div id="successState" class="propuesta-container fade-in" style="display: none;">
                    <div class="header-propuesta">
                        <div class="logo-container">
                            <i class="fas fa-hospital"></i>
                        </div>
                        <h2>Propuesta Salarial</h2>
                        <p class="mb-0">BIMO - Recursos Humanos</p>
                    </div>
                    
                    <div class="content-propuesta">
                        <!-- Información del candidato -->
                        <div class="info-card">
                            <h5><i class="fas fa-user text-primary"></i> Información del Candidato</h5>
                            <div class="detail-row">
                                <span class="detail-label">Nombre:</span>
                                <span class="detail-value" id="nombreCandidato">-</span>
                            </div>
                            <div class="detail-row">
                                <span class="detail-label">Número de Candidato:</span>
                                <span class="detail-value" id="numeroCandidato">-</span>
                            </div>
                            <div class="detail-row">
                                <span class="detail-label">Estado:</span>
                                <span class="detail-value" id="estadoPropuesta">-</span>
                            </div>
                        </div>
                        
                        <!-- Información de la vacante -->
                        <div class="info-card">
                            <h5><i class="fas fa-briefcase text-primary"></i> Información de la Vacante</h5>
                            <div class="detail-row">
                                <span class="detail-label">Puesto:</span>
                                <span class="detail-value" id="puestoNombre">-</span>
                            </div>
                            <div class="detail-row">
                                <span class="detail-label">Departamento:</span>
                                <span class="detail-value" id="departamentoNombre">-</span>
                            </div>
                            <div class="detail-row">
                                <span class="detail-label">Tipo de Contrato:</span>
                                <span class="detail-value" id="tipoContrato">-</span>
                            </div>
                            <div class="detail-row">
                                <span class="detail-label">Tipo de Jornada:</span>
                                <span class="detail-value" id="tipoJornada">-</span>
                            </div>
                            <div class="detail-row" style="display: none;">
                                <span class="detail-label">Días de Trabajo:</span>
                                <span class="detail-value" id="diasTrabajo">-</span>
                            </div>
                            
                        </div>
                        
                        <!-- Propuesta salarial -->
                        <div class="salary-highlight">
                            <div class="salary-amount" id="salarioOfertado">$0.00</div>
                            <p class="mb-0">Salario Mensual Ofertado</p>
                        </div>
                        
                        <!-- Detalles adicionales -->
                        <div class="info-card">
                            <h5><i class="fas fa-file-contract text-primary"></i> Detalles de la Propuesta</h5>
                            <div class="detail-row">
                                <span class="detail-label">Fecha de Inicio:</span>
                                <span class="detail-value" id="fechaInicio">-</span>
                            </div>
                            <div class="detail-row" style="display: none;">
                                <span class="detail-label">Días Personalizados:</span>
                                <span class="detail-value" id="diasPersonalizados">-</span>
                            </div>
                            <div class="detail-row">
                                <span class="detail-label">Horario:</span>
                                <span class="detail-value" id="horarioTrabajo">-</span>
                            </div>
                        </div>
                        
                        <!-- Condiciones especiales -->
                        <div id="condicionesContainer" class="info-card" style="display: none;">
                            <h5><i class="fas fa-star text-primary"></i> Condiciones Especiales</h5>
                            <p id="condicionesEspeciales" class="mb-0">-</p>
                        </div>
                        
                        <!-- Botones de acción -->
                        <div id="botonesAccion" class="text-center mt-4">
                            <button id="btnAceptar" class="btn btn-aceptar btn-action">
                                <i class="fas fa-check"></i> Aceptar Propuesta
                            </button>
                            <button id="btnRechazar" class="btn btn-rechazar btn-action">
                                <i class="fas fa-times"></i> Rechazar Propuesta
                            </button>
                        </div>
                        
                        <!-- Mensaje cuando ya no puede responder -->
                        <div id="noResponder" class="text-center mt-4" style="display: none;">
                            <div class="alert alert-info">
                                <h5><i class="fas fa-info-circle"></i> Esta propuesta no está disponible</h5>
                                <p class="mb-0">El estado de su candidatura ha cambiado o el tiempo para responder ha expirado.</p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="footer-propuesta">
                        <p class="mb-1"><strong>Centro Diágnostico Biomolecular S.A de C.V</strong></p>
                        <p class="mb-0">Departamento de Recursos Humanos</p>
                        <small>Este es un mensaje automático. Si tiene dudas, comuníquese con RH.</small>
                    </div>
                </div>
                
            </div>
        </div>
    </div>
    
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        let candidatoData = null;
        
        // Obtener parámetros de la URL
        function getURLParameter(name) {
            const urlParams = new URLSearchParams(window.location.search);
            return urlParams.get(name);
        }
        
        // Formatear moneda
        function formatCurrency(amount) {
            return new Intl.NumberFormat('es-MX', {
                style: 'currency',
                currency: 'MXN',
                minimumFractionDigits: 2
            }).format(amount);
        }
        
        // Formatear fecha
        function formatDate(dateString) {
            if (!dateString) return '-';
            const date = new Date(dateString);
            return date.toLocaleDateString('es-MX', {
                year: 'numeric',
                month: 'long',
                day: 'numeric'
            });
        }
        
        // Cargar datos del candidato
        async function cargarPropuesta() {
            const idCandidato = getURLParameter('id');
            
            if (!idCandidato) {
                mostrarError('ID de candidato no proporcionado en la URL');
                return;
            }
            
            try {
                const formData = new FormData();
                formData.append('api', '37');
                formData.append('id_candidato', idCandidato);
                
                // ⚠️ CAMBIO: Ruta relativa desde la carpeta de recursos humanos
                const response = await fetch('../../../api/recursos_humanos_api.php', {
                    method: 'POST',
                    body: formData
                });
                
                if (!response.ok) {
                    throw new Error(`HTTP error! status: ${response.status}`);
                }
                
                const data = await response.json();
                console.log('Respuesta del servidor:', data);
                
                // Verificar si hay datos
                let candidato = null;
                
                if (data.response && data.response.data && Array.isArray(data.response.data) && data.response.data.length > 0) {
                    candidato = data.response.data[0];
                } else if (data.data && Array.isArray(data.data) && data.data.length > 0) {
                    candidato = data.data[0];
                } else if (data.response && data.response.code === 1 && data.response.data) {
                    candidato = data.response.data;
                }
                
                if (candidato && candidato.id_candidato) {
                    candidatoData = candidato;
                    mostrarPropuesta(candidato);
                } else {
                    mostrarError('No se encontró información para este candidato');
                }
                
            } catch (error) {
                console.error('Error:', error);
                mostrarError('Error al cargar la propuesta: ' + error.message);
            }
        }
        
        // Mostrar la propuesta
        function mostrarPropuesta(candidato) {
            // Ocultar loading y error
            document.getElementById('loadingState').style.display = 'none';
            document.getElementById('errorState').style.display = 'none';
            
            // Llenar datos
            document.getElementById('nombreCandidato').textContent = candidato.nombre_completo || '-';
            document.getElementById('numeroCandidato').textContent = candidato.numero_candidato || '-';
            document.getElementById('puestoNombre').textContent = candidato.puesto_nombre || '-';
            document.getElementById('departamentoNombre').textContent = candidato.departamento_nombre || '-';
            document.getElementById('tipoContrato').textContent = candidato.tipo_contrato || '-';
            document.getElementById('tipoJornada').textContent = candidato.tipo_jornada || '-';
            document.getElementById('salarioOfertado').textContent = candidato.salario_ofertado ? formatCurrency(candidato.salario_ofertado) : '$0.00';
            document.getElementById('fechaInicio').textContent = formatDate(candidato.fecha_inicio_propuesta);
            
            // Horario de trabajo
            let horario = '-';
            if (candidato.hora_inicio && candidato.hora_fin) {
                horario = `${candidato.hora_inicio} - ${candidato.hora_fin}`;
                if (candidato.dias_trabajo == 'otro') {
                    horario += ` (${candidato.dias_personalizados || 'Personalizado'})`;
                } else {
                    horario += ` (${candidato.dias_trabajo})`;
                }
            }
            document.getElementById('horarioTrabajo').textContent = horario;
            document.getElementById('diasTrabajo').textContent = candidato.dias_trabajo || '-';
            document.getElementById('diasPersonalizados').textContent = candidato.dias_personalizados || '-';
            
            // Estado de la propuesta
            const estadoBadge = document.getElementById('estadoPropuesta');
            estadoBadge.innerHTML = `<span class="status-badge status-${getStatusClass(candidato.estado_candidato)}">${candidato.estado_propuesta_texto}</span>`;
            
            // Condiciones especiales
            if (candidato.condiciones_especiales && candidato.condiciones_especiales.trim() !== '') {
                document.getElementById('condicionesEspeciales').textContent = candidato.condiciones_especiales;
                document.getElementById('condicionesContainer').style.display = 'block';
            }
            
            // Mostrar/ocultar botones según si puede responder
            if (candidato.puede_responder == 1) {
                document.getElementById('botonesAccion').style.display = 'block';
                document.getElementById('noResponder').style.display = 'none';
            } else {
                document.getElementById('botonesAccion').style.display = 'none';
                document.getElementById('noResponder').style.display = 'block';
            }
            
            // Mostrar el contenido
            document.getElementById('successState').style.display = 'block';
        }
        
        // Obtener clase CSS para el estado
        function getStatusClass(estado) {
            switch (estado) {
                case 'en_espera': return 'pendiente';
                case 'en_proceso': return 'aceptada';
                case 'preseleccionado': return 'rechazada';
                case 'rechazado': return 'rechazada';
                default: return 'pendiente';
            }
        }
        
        // Mostrar error
        function mostrarError(mensaje) {
            document.getElementById('loadingState').style.display = 'none';
            document.getElementById('successState').style.display = 'none';
            document.getElementById('errorMessage').textContent = mensaje;
            document.getElementById('errorState').style.display = 'block';
        }
        
        // Aceptar propuesta
        async function aceptarPropuesta() {
            const result = await Swal.fire({
                title: '¿Aceptar propuesta?',
                text: '¿Está seguro de aceptar esta propuesta salarial?',
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#27ae60',
                cancelButtonColor: '#95a5a6',
                confirmButtonText: 'Sí, aceptar',
                cancelButtonText: 'Cancelar'
            });
            
            if (result.isConfirmed) {
                await responderPropuesta('aceptar');
            }
        }
        
        // Rechazar propuesta
        async function rechazarPropuesta() {
            const result = await Swal.fire({
                title: 'Rechazar propuesta',
                html: `
                    <p>¿Está seguro de rechazar esta propuesta salarial?</p>
                    <div class="mb-3">
                        <label for="motivoRechazo" class="form-label">Motivo del rechazo:</label>
                        <select class="form-select" id="motivoRechazo">
                            <option value="">Seleccione un motivo</option>
                            <option value="salario_insuficiente">Salario insuficiente</option>
                            <option value="horario_incompatible">Horario incompatible</option>
                            <option value="ubicacion_distante">Ubicación muy distante</option>
                            <option value="condiciones_inadecuadas">Condiciones inadecuadas</option>
                            <option value="otra_oferta">Acepté otra oferta laboral</option>
                            <option value="situacion_personal">Situación personal</option>
                            <option value="otro">Otro motivo</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="comentarios" class="form-label">Comentarios adicionales (opcional):</label>
                        <textarea class="form-control" id="comentarios" rows="3" placeholder="Agregar comentarios..."></textarea>
                    </div>
                `,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#e74c3c',
                cancelButtonColor: '#95a5a6',
                confirmButtonText: 'Sí, rechazar',
                cancelButtonText: 'Cancelar',
                preConfirm: () => {
                    const motivo = document.getElementById('motivoRechazo').value;
                    const comentarios = document.getElementById('comentarios').value;
                    
                    if (!motivo) {
                        Swal.showValidationMessage('Debe seleccionar un motivo de rechazo');
                        return false;
                    }
                    
                    return { motivo, comentarios };
                }
            });
            
            if (result.isConfirmed) {
                await responderPropuesta('rechazar', result.value.motivo, result.value.comentarios);
            }
        }
        
// Responder a la propuesta (CORREGIDA PARA VALIDAR CODE 2)
async function responderPropuesta(accion, motivo = null, comentarios = null) {
    try {
        // Mostrar loading
        Swal.fire({
            title: 'Procesando respuesta...',
            text: 'Por favor espere',
            allowOutsideClick: false,
            showConfirmButton: false,
            willOpen: () => {
                Swal.showLoading();
            }
        });
        
        const formData = new FormData();
        formData.append('api', '35'); // Usar el case para cambiar estado
        formData.append('id_candidato', candidatoData.id_candidato);
        
        if (accion === 'aceptar') {
            formData.append('estado_candidato', 'en_proceso');
            formData.append('motivo_cambio', 'Propuesta salarial aceptada por el candidato');
            formData.append('comentarios_rh', 'El candidato aceptó la propuesta salarial desde la landing page');
        } else {
            formData.append('estado_candidato', 'declinado');
            formData.append('motivo_cambio', `Propuesta rechazada: ${motivo}`);
            formData.append('comentarios_rh', 'El candidato rechazó la propuesta salarial desde la landing page');
            formData.append('comentarios_candidato', comentarios || `Motivo de rechazo: ${motivo}`);
        }
        
        // ⚠️ CAMBIO: Ruta relativa desde la carpeta de recursos humanos
        const response = await fetch('../../../api/recursos_humanos_api.php', {
            method: 'POST',
            body: formData
        });
        
        if (!response.ok) {
            throw new Error(`HTTP error! status: ${response.status}`);
        }
        
        const data = await response.json();
        console.log('Respuesta completa:', data);
        
        // ⚠️ VALIDACIÓN MEJORADA: Verificar diferentes estructuras de respuesta
        let exito = false;
        let mensaje = '';
        
        // 1. Verificar estructura: data.response.code (con code 1 o 2)
        if (data.response && (data.response.code === 1 || data.response.code === 2)) {
            if (data.response.message === 'SUCCESS' || data.response.msj === 'SUCCESS') {
                exito = true;
                mensaje = 'Operación exitosa';
                console.log('✅ Éxito detectado: data.response.code =', data.response.code);
            }
        }
        // 2. Verificar estructura: data.code (con code 1 o 2)
        else if (data.code === 1 || data.code === 2) {
            if (data.message === 'SUCCESS' || data.msj === 'SUCCESS') {
                exito = true;
                mensaje = 'Operación exitosa';
                console.log('✅ Éxito detectado: data.code =', data.code);
            }
        }
        // 3. Verificar estructura: data.response.data[0].RESULT (stored procedure)
        else if (data.response && data.response.data && Array.isArray(data.response.data) && data.response.data.length > 0) {
            const resultado = data.response.data[0];
            if (resultado.RESULT === 'SUCCESS') {
                exito = true;
                mensaje = resultado.MESSAGE || 'Operación exitosa';
                console.log('✅ Éxito detectado: resultado.RESULT =', resultado.RESULT);
            } else if (resultado.ERROR) {
                exito = false;
                mensaje = resultado.ERROR;
                console.log('❌ Error detectado: resultado.ERROR =', resultado.ERROR);
            }
        }
        // 4. Verificar estructura directa: data.RESULT
        else if (data.RESULT === 'SUCCESS') {
            exito = true;
            mensaje = data.MESSAGE || 'Operación exitosa';
            console.log('✅ Éxito detectado: data.RESULT =', data.RESULT);
        }
        // 5. Si no se encontró ninguna estructura conocida
        else {
            console.warn('⚠️ Estructura de respuesta no reconocida:', data);
            exito = false;
            mensaje = 'Estructura de respuesta no reconocida';
        }
        
        console.log('🔍 Resultado final de validación:', { exito, mensaje });
        
        if (exito) {
            await Swal.fire({
                title: '¡Respuesta enviada!',
                text: accion === 'aceptar' ? 
                      'Su aceptación ha sido registrada. Pronto nos pondremos en contacto con usted.' :
                      'Su rechazo ha sido registrado. Gracias por su tiempo.',
                icon: 'success',
                confirmButtonColor: '#27ae60'
            });
            
            // Recargar datos
            await cargarPropuesta();
        } else {
            console.error('❌ Operación no exitosa:', mensaje);
            throw new Error(mensaje || 'Error al procesar la respuesta');
        }
        
    } catch (error) {
        console.error('🚨 Error en responderPropuesta:', error);
        await Swal.fire({
            title: 'Error',
            text: 'No se pudo procesar su respuesta. Intente nuevamente.',
            icon: 'error',
            confirmButtonColor: '#e74c3c'
        });
    }
}

// Event listeners
document.addEventListener('DOMContentLoaded', function() {
    // Cargar propuesta al iniciar
    cargarPropuesta();

            // Botones de acción
            document.getElementById('btnAceptar').addEventListener('click', aceptarPropuesta);
            document.getElementById('btnRechazar').addEventListener('click', rechazarPropuesta);
        });
    </script>
</body>
</html>
