<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Postulación de Vacante - Testing</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>

         body {
    background-color: #f8f9fa;
    font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
  }

  .modal-content {
    border-radius: 15px;
    overflow: hidden;
  }

  .bg-gradient-primary {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
  }

  .bg-gradient-success {
    background: linear-gradient(135deg, #43e97b 0%, #38f9d7 100%);
  }

  .bg-gradient-info {
    background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
  }

  .bg-gradient-warning {
    background: linear-gradient(135deg, #e9d643 0%, #fee140 100%);
  }

  .bg-gradient-secondary {
    background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
  }

  .bg-gradient-dark {
    background: linear-gradient(135deg, #a8edea 0%, #fed6e3 100%);
  }

  .btn-gradient-primary {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    border: none;
    color: white;
    transition: all 0.3s ease;
  }

  .btn-gradient-primary:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 15px rgba(102, 126, 234, 0.3);
    color: white;
  }

  .btn-gradient-success {
    background: linear-gradient(135deg, #43e97b 0%, #38f9d7 100%);
    border: none;
    color: white;
    transition: all 0.3s ease;
  }

  .btn-gradient-success:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 15px rgba(67, 233, 123, 0.3);
    color: white;
  }

  .btn-gradient-info {
    background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
    border: none;
    color: white;
    transition: all 0.3s ease;
  }

  .btn-gradient-info:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 15px rgba(79, 172, 254, 0.3);
    color: white;
  }

  .btn-gradient-secondary {
    background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
    border: none;
    color: white;
    transition: all 0.3s ease;
  }

  .btn-gradient-secondary:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 15px rgba(240, 147, 251, 0.3);
    color: white;
  }

  .nav-tabs .nav-link {
    border: none;
    color: #495057;
    font-weight: 500;
    transition: all 0.3s ease;
    margin-right: 10px;
  }

  .nav-tabs .nav-link.active {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    border-radius: 10px 10px 0 0;
    transform: translateY(-2px);
    box-shadow: 0 4px 8px rgba(102, 126, 234, 0.3);
  }

  .nav-tabs .nav-link:hover:not(.active) {
    background-color: #f8f9fa;
    color: #667eea;
    transform: translateY(-1px);
  }
  .table th {
    border-top: none;
    color: #495057;
    background-color: #f8f9fa;
  }

  .table-hover tbody tr:hover {
    background-color: rgba(102, 126, 234, 0.1);
    transform: translateY(-1px);
    transition: all 0.3s ease;
  }

  .form-control,
  .form-select {
    transition: all 0.3s ease;
  }

  .form-control:focus,
  .form-select:focus {
    border-color: #667eea;
    box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
    transform: translateY(-1px);
  }

  .btn-outline-secondary {
    transition: all 0.3s ease;
  }

  .btn-outline-secondary:hover {
    transform: translateY(-1px);
    box-shadow: 0 4px 8px rgba(108, 117, 125, 0.3);
  }

  .rounded-pill {
    border-radius: 50rem !important;
  }

  .shadow-lg {
    box-shadow: 0 1rem 3rem rgba(0, 0, 0, 0.175) !important;
  }

  .fw-bold {
    font-weight: 700 !important;
  }

  @keyframes fadeIn {
    from {
      opacity: 0;
      transform: translateY(10px);
    }
    to {
      opacity: 1;
      transform: translateY(0);
    }
  }

  .modal.fade .modal-dialog {
    transition: transform 0.3s ease-out;
  }

  .modal.show .modal-dialog {
    animation: fadeIn 0.3s ease-in;
  }

  .tab-content {
    border-radius: 0 10px 10px 10px;
  }

  /* Estilos específicos para el modal de detalles */
  #detallesPuestoModal .modal-content {
    border-radius: 15px;
    overflow: hidden;
  }

  #detallesPuestoModal .card {
    border-radius: 12px;
    transition: all 0.3s ease;
  }

  #detallesPuestoModal .card:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
  }

  #detallesPuestoModal .card-header {
    border-radius: 12px 12px 0 0;
    padding: 15px 20px;
  }

  #detallesPuestoModal .card-body {
    padding: 20px;
  }

  #detallesPuestoModal .form-control-plaintext {
    border-radius: 8px;
    transition: all 0.3s ease;
  }

  #detallesPuestoModal .form-control-plaintext:hover {
    transform: translateY(-1px);
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
  }

  #detallesPuestoModal .modal-header {
    border-radius: 15px 15px 0 0;
    padding: 20px 25px;
  }

  #detallesPuestoModal .modal-footer {
    border-radius: 0 0 15px 15px;
    padding: 20px 25px;
  }

  #detallesPuestoModal .badge {
    border-radius: 20px;
    font-size: 0.875rem;
    padding: 0.5rem 1rem;
    font-weight: 600;
  }

  #detallesPuestoModal .form-label {
    font-size: 0.95rem;
    margin-bottom: 8px;
    letter-spacing: 0.5px;
  }

  /* Prevenir clics múltiples en botones */
  .btn-ver-detalles-puesto.processing {
    opacity: 0.6;
    pointer-events: none;
  }
        .form-section {
            background: white;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            margin-bottom: 30px;
            padding: 30px;
        }
        .section-title {
            color: #2c3e50;
            border-bottom: 3px solid #3498db;
            padding-bottom: 10px;
            margin-bottom: 25px;
        }
        .file-upload-area {
            border: 2px dashed #3498db;
            border-radius: 10px;
            padding: 20px;
            text-align: center;
            transition: all 0.3s ease;
            cursor: pointer;
        }
        .file-upload-area:hover {
            background-color: #f8f9fa;
            border-color: #2980b9;
        }
        .document-item {
            background: #f8f9fa;
            border-radius: 8px;
            padding: 15px;
            margin-bottom: 15px;
            border-left: 4px solid #3498db;
        }
        .required-field {
            color: #e74c3c;
        }
        .btn-primary {
            background: linear-gradient(45deg, #3498db, #2980b9);
            border: none;
            padding: 12px 30px;
            border-radius: 25px;
        }
        .progress-bar {
            background: linear-gradient(45deg, #3498db, #2980b9);
        }
        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            padding: 20px 0;
        }
        
        /* Estilos para el canvas de firma */
        #signatureCanvas {
            border: 2px solid #3498db;
            border-radius: 8px;
            cursor: crosshair;
            display: block;
            touch-action: none;
            background-color: #fff;
            width: 100%;
            max-width: 953px;
            height: 200px;
        }
        
        #signatureCanvas.is-valid {
            border-color: #28a745;
        }
        
        #signatureCanvas.is-invalid {
            border-color: #dc3545;
        }
        
        .signature-container {
            position: relative;
            text-align: center;
            background-color: #f8f9fa;
            padding: 20px;
            border-radius: 10px;
        }
        
        .signature-controls {
            margin-top: 15px;
        }
        
        .signature-controls button {
            margin: 0 5px;
        }
        
        .signature-placeholder {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            color: #999;
            font-style: italic;
            pointer-events: none;
            font-size: 16px;
            font-weight: 500;
        }
        
        .signature-status {
            margin-top: 10px;
            font-size: 14px;
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Sección de Vacantes Disponibles -->
        <div class="row justify-content-center mb-4">
            <div class="col-lg-10">
                <div class="form-section">
                    <h3 class="section-title"><i class="fas fa-search"></i> Vacantes Disponibles</h3>
                    <div id="vacantesDisponibles">
                        <div class="text-center">
                            <div class="spinner-border text-primary" role="status">
                                <span class="visually-hidden">Cargando vacantes...</span>
                            </div>
                            <p class="mt-2">Cargando vacantes disponibles...</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row justify-content-center" id="formularioPostulacion" style="display: none;">
            <div class="col-lg-10">
                <div class="text-center mb-4">
                    <h1 class="text-white mb-3"><i class="fas fa-briefcase"></i> Postulación de Vacante</h1>
                    <p class="text-white-50">Complete todos los campos para enviar su postulación</p>
                    <div class="alert alert-info">
                        <strong>Vacante seleccionada:</strong> <span id="vacanteSeleccionada">-</span>
                    </div>
                </div>

                <!-- Barra de progreso actualizada para 4 secciones -->
                <div class="form-section">
                    <div class="progress mb-3" style="height: 10px;">
                        <div class="progress-bar" role="progressbar" style="width: 0%" id="progressBar"></div>
                    </div>
                    <div class="d-flex justify-content-between">
                        <small class="text-muted">Datos Generales</small>
                        <small class="text-muted">Información de Salud</small>
                        <small class="text-muted">Antecedentes Laborales</small>
                        <small class="text-muted">Documentos</small>
                    </div>
                </div>

                <form id="postulacionForm" enctype="multipart/form-data">
                    <!-- SECCIÓN 1: DATOS GENERALES -->
                    <div class="form-section" id="section1">
                        <h3 class="section-title"><i class="fas fa-user"></i> Datos Generales</h3>
                        
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Nombre completo <span class="required-field">*</span></label>
                                <input type="text" class="form-control" name="s_1_pregunta_1" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Apodo</label>
                                <input type="text" class="form-control" name="s_1_pregunta_2" placeholder="Opcional">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <label class="form-label">Lugar de nacimiento <span class="required-field">*</span></label>
                                <input type="text" class="form-control" name="s_1_pregunta_3" required>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="form-label">Fecha de nacimiento <span class="required-field">*</span></label>
                                <input type="date" class="form-control" name="s_1_pregunta_4" required>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="form-label">Edad <span class="required-field">*</span></label>
                                <input type="number" class="form-control" name="s_1_pregunta_5" min="18" max="70" required>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <label class="form-label">Correo Electrónico <span class="required-field">*</span></label>
                                <input type="email" class="form-control" name="s_1_pregunta_6" required>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="form-label">Teléfono <span class="required-field">*</span></label>
                                <input type="tel" class="form-control" name="s_1_pregunta_7" required>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="form-label">CURP <span class="required-field">*</span></label>
                                <input type="text" class="form-control" name="s_1_pregunta_8" maxlength="18" required>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <label class="form-label">Domicilio completo <span class="required-field">*</span></label>
                                <textarea class="form-control" name="s_1_pregunta_9" rows="2" required></textarea>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Grado Máximo de estudios <span class="required-field">*</span></label>
                                <input type="text" class="form-control" name="s_1_pregunta_10" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Idiomas</label>
                                <input type="text" class="form-control" name="s_1_pregunta_11" placeholder="Opcional">
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Institución donde realizó su último grado de estudios <span class="required-field">*</span></label>
                                <input type="text" class="form-control" name="s_1_pregunta_12" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Profesión <span class="required-field">*</span></label>
                                <input type="text" class="form-control" name="s_1_pregunta_13" required>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <label class="form-label">Estado civil <span class="required-field">*</span></label>
                                <select class="form-select" name="s_1_select_1" required>
                                    <option value="">Seleccione...</option>
                                    <option value="Soltero(a)">Soltero(a)</option>
                                    <option value="Casado(a)">Casado(a)</option>
                                    <option value="Divorciado(a)">Divorciado(a)</option>
                                    <option value="Viudo(a)">Viudo(a)</option>
                                    <option value="Unión libre">Unión libre</option>
                                </select>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="form-label">Sexo <span class="required-field">*</span></label>
                                <select class="form-select" name="s_1_select_2" required>
                                    <option value="">Seleccione...</option>
                                    <option value="M">Masculino</option>
                                    <option value="F">Femenino</option>
                                </select>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="form-label">Hijos <span class="required-field">*</span></label>
                                <select class="form-select" name="s_1_select_3" required>
                                    <option value="">Seleccione...</option>
                                    <option value="Si">Sí</option>
                                    <option value="No">No</option>
                                </select>
                            </div>
                        </div>

                        <div class="row" style="display: none;" id="conyugeSection">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Nombre cónyuge</label>
                                <input type="text" class="form-control" name="s_1_pregunta_14" placeholder="En caso de que aplique">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Ocupación cónyuge</label>
                                <input type="text" class="form-control" name="s_1_pregunta_15" placeholder="En caso de que aplique">
                            </div>
                        </div>

                        <div class="row"  style="display: none;" id="hijosSection">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Nombre hijos</label>
                                <input type="text" class="form-control" name="s_1_pregunta_16" placeholder="En caso de que aplique">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Edad hijos</label>
                                <input type="text" class="form-control" name="s_1_pregunta_17" placeholder="En caso de que aplique">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <label class="form-label">¿Con quién vive? <span class="required-field">*</span></label>
                                <input type="text" class="form-control" name="s_1_pregunta_18" required>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <label class="form-label">Ocupación de padres</label>
                                <input type="text" class="form-control" name="s_1_pregunta_19" placeholder="Opcional">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <label class="form-label">Ocupación de hermanos</label>
                                <input type="text" class="form-control" name="s_1_pregunta_20" placeholder="Opcional">
                            </div>
                        </div>

                        <div class="text-end">
                            <button type="button" class="btn btn-primary" onclick="nextSection(2)">
                                Siguiente <i class="fas fa-arrow-right"></i>
                            </button>
                        </div>
                    </div>

                    <!-- SECCIÓN 2: INFORMACIÓN GENERAL DE LA SALUD -->
                    <div class="form-section d-none" id="section2">
                        <h3 class="section-title"><i class="fas fa-heartbeat"></i> Información General de la Salud</h3>

                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <label class="form-label">Condición general de salud <span class="required-field">*</span></label>
                                <select class="form-select" name="s_2_select_1" required>
                                    <option value="">Seleccione...</option>
                                    <option value="excelente">Excelente</option>
                                    <option value="buena">Buena</option>
                                    <option value="mala">Mala</option>
                                </select>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="form-label">Peso <span class="required-field">*</span></label>
                                <input type="number" class="form-control" name="s_2_pregunta_1" placeholder="kg" required>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="form-label">Estatura <span class="required-field">*</span></label>
                                <input type="number" class="form-control" name="s_2_pregunta_2" placeholder="cm" required>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <label class="form-label">Enfermedad más grave que haya padecido <span class="required-field">*</span></label>
                                <input type="text" class="form-control" name="s_2_pregunta_3" required>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label"><strong>Indicaciones: Marque los padecimientos que apliquen para usted.</strong></label>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="padecimientos[]" value="Diabetes" id="chkDiabetes">
                                    <label class="form-check-label" for="chkDiabetes">Diabetes</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="padecimientos[]" value="Desmayos" id="chkDesmayos">
                                    <label class="form-check-label" for="chkDesmayos">Desmayos</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="padecimientos[]" value="Problemas auditivos" id="chkAuditivos">
                                    <label class="form-check-label" for="chkAuditivos">Problemas auditivos</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="padecimientos[]" value="Heridas en la cabeza" id="chkHeridasCabeza">
                                    <label class="form-check-label" for="chkHeridasCabeza">Heridas en la cabeza</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="padecimientos[]" value="Problemas cardiacos" id="chkCardiacos">
                                    <label class="form-check-label" for="chkCardiacos">Problemas cardiacos</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="padecimientos[]" value="Problemas Neuronales" id="chkNeuronales">
                                    <label class="form-check-label" for="chkNeuronales">Problemas Neuronales (Convulsiones, epilepsias, etc.)</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="padecimientos[]" value="Hospitalizaciones" id="chkHospitalizaciones">
                                    <label class="form-check-label" for="chkHospitalizaciones">Hospitalizaciones (Cirugías, transfusiones)</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="padecimientos[]" value="Tratamiento psicológico/psiquiátrico" id="chkPsicologico">
                                    <label class="form-check-label" for="chkPsicologico">Tratamiento psicológico/psiquiátrico, control de peso (efectos)</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="padecimientos[]" value="Ataques de ansiedad/panico" id="chkAnsiedad">
                                    <label class="form-check-label" for="chkAnsiedad">Ataques de ansiedad/pánico</label>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">&nbsp;</label>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="padecimientos[]" value="Enfermedades Respiratorias" id="chkRespiratorias">
                                    <label class="form-check-label" for="chkRespiratorias">Enfermedades Respiratorias</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="padecimientos[]" value="Alergías" id="chkAlergias">
                                    <label class="form-check-label" for="chkAlergias">Alergías</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="padecimientos[]" value="Presión Alta/Baja" id="chkPresion">
                                    <label class="form-check-label" for="chkPresion">Presión Alta/Baja</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="padecimientos[]" value="Embarazos" id="chkEmbarazos">
                                    <label class="form-check-label" for="chkEmbarazos">Embarazos</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="padecimientos[]" value="Úlceras" id="chkUlceras">
                                    <label class="form-check-label" for="chkUlceras">Úlceras</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="padecimientos[]" value="Apoyo de Grupos" id="chkGrupos">
                                    <label class="form-check-label" for="chkGrupos">Apoyo de Grupos (AA, DA, NA, RD)</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="padecimientos[]" value="Tatuajes/Perforaciones" id="chkTatuajes">
                                    <label class="form-check-label" for="chkTatuajes">Tatuajes/Perforaciones</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="padecimientos[]" value="Dispuesto a examen médico" id="chkExamenMedico">
                                    <label class="form-check-label" for="chkExamenMedico">¿Está dispuesto a realizarse un exámen médico?</label>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <label class="form-label">En las últimas 36 horas ¿Qué medicamentos y/o sustancias ha tomado?</label>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Por prescripción médica</label>
                                <input type="text" class="form-control" name="s_2_pregunta_4">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Último consumo de alcohol</label>
                                <input type="text" class="form-control" name="s_2_pregunta_5">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Sin prescripción médica</label>
                                <input type="text" class="form-control" name="s_2_pregunta_6">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Último consumo de drogas</label>
                                <input type="text" class="form-control" name="s_2_pregunta_7">
                            </div>
                            <div class="col-md-12 mb-3">
                                <label class="form-label">¿Algo que no le haya preguntado y que considere importante mencionar?</label>
                                <textarea class="form-control" name="s_2_pregunta_8" rows="3" placeholder="Opcional"></textarea>
                            </div>
                        </div>

                        <div class="d-flex justify-content-between">
                            <button type="button" class="btn btn-secondary" onclick="nextSection(1)">
                                <i class="fas fa-arrow-left"></i> Anterior
                            </button>
                            <button type="button" class="btn btn-primary" onclick="nextSection(3)">
                                Siguiente <i class="fas fa-arrow-right"></i>
                            </button>
                        </div>
                    </div>

                    <!-- SECCIÓN 3: ANTECEDENTES LABORALES -->
                    <div class="form-section d-none" id="section3">
                        <h3 class="section-title"><i class="fas fa-briefcase"></i> Antecedentes Laborales</h3>
                        
                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <label class="form-label">¿Cómo se enteró de esta vacante? <span class="required-field">*</span></label>
                                <input type="text" class="form-control" name="s_3_pregunta_1" required>
                            </div>
                            <div class="col-md-12 mb-3">
                                <label class="form-label">¿Por qué le interesa esta vacante? <span class="required-field">*</span></label>
                                <textarea class="form-control" name="s_3_pregunta_2" rows="3" required></textarea>
                            </div>
                            <div class="col-md-12 mb-3">
                                <label class="form-label">¿Cómo ve su vida en 5 años? <span class="required-field">*</span></label>
                                <textarea class="form-control" name="s_3_pregunta_3" rows="3" required></textarea>
                            </div>
                        </div>

                        <div class="mt-4">
                            <h4 class="mb-3"><i class="fas fa-history"></i> Historial Laboral</h4>
                            
                            <!-- Encabezados de la tabla -->
                            <div class="row fw-bold text-center border-bottom pb-2 mb-3 bg-light rounded p-2">
                                <div class="col-md-2">Empresa</div>
                                <div class="col-md-2">Puesto</div>
                                <div class="col-md-1">Sueldo</div>
                                <div class="col-md-3">Principales Actividades</div>
                                <div class="col-md-2">Motivo de Separación</div>
                                <div class="col-md-2">Referencias</div>
                            </div>

                            <!-- Filas del historial laboral -->
                            <div class="row mb-2">
                                <div class="col-md-2">
                                    <input type="text" class="form-control form-control-sm" name="empresa[]" placeholder="Empresa 1">
                                </div>
                                <div class="col-md-2">
                                    <input type="text" class="form-control form-control-sm" name="puesto[]" placeholder="Puesto">
                                </div>
                                <div class="col-md-1">
                                    <input type="text" class="form-control form-control-sm" name="sueldo[]" placeholder="$">
                                </div>
                                <div class="col-md-3">
                                    <input type="text" class="form-control form-control-sm" name="actividades[]" placeholder="Actividades principales">
                                </div>
                                <div class="col-md-2">
                                    <input type="text" class="form-control form-control-sm" name="separacion[]" placeholder="Motivo">
                                </div>
                                <div class="col-md-2">
                                    <input type="text" class="form-control form-control-sm" name="referencias[]" placeholder="Referencia">
                                </div>
                            </div>

                            <div class="row mb-2">
                                <div class="col-md-2">
                                    <input type="text" class="form-control form-control-sm" name="empresa[]" placeholder="Empresa 2">
                                </div>
                                <div class="col-md-2">
                                    <input type="text" class="form-control form-control-sm" name="puesto[]" placeholder="Puesto">
                                </div>
                                <div class="col-md-1">
                                    <input type="text" class="form-control form-control-sm" name="sueldo[]" placeholder="$">
                                </div>
                                <div class="col-md-3">
                                    <input type="text" class="form-control form-control-sm" name="actividades[]" placeholder="Actividades principales">
                                </div>
                                <div class="col-md-2">
                                    <input type="text" class="form-control form-control-sm" name="separacion[]" placeholder="Motivo">
                                </div>
                                <div class="col-md-2">
                                    <input type="text" class="form-control form-control-sm" name="referencias[]" placeholder="Referencia">
                                </div>
                            </div>

                            <div class="row mb-2">
                                <div class="col-md-2">
                                    <input type="text" class="form-control form-control-sm" name="empresa[]" placeholder="Empresa 3">
                                </div>
                                <div class="col-md-2">
                                    <input type="text" class="form-control form-control-sm" name="puesto[]" placeholder="Puesto">
                                </div>
                                <div class="col-md-1">
                                    <input type="text" class="form-control form-control-sm" name="sueldo[]" placeholder="$">
                                </div>
                                <div class="col-md-3">
                                    <input type="text" class="form-control form-control-sm" name="actividades[]" placeholder="Actividades principales">
                                </div>
                                <div class="col-md-2">
                                    <input type="text" class="form-control form-control-sm" name="separacion[]" placeholder="Motivo">
                                </div>
                                <div class="col-md-2">
                                    <input type="text" class="form-control form-control-sm" name="referencias[]" placeholder="Referencia">
                                </div>
                            </div>

                            <div class="row mb-2">
                                <div class="col-md-2">
                                    <input type="text" class="form-control form-control-sm" name="empresa[]" placeholder="Empresa 4">
                                </div>
                                <div class="col-md-2">
                                    <input type="text" class="form-control form-control-sm" name="puesto[]" placeholder="Puesto">
                                </div>
                                <div class="col-md-1">
                                    <input type="text" class="form-control form-control-sm" name="sueldo[]" placeholder="$">
                                </div>
                                <div class="col-md-3">
                                    <input type="text" class="form-control form-control-sm" name="actividades[]" placeholder="Actividades principales">
                                </div>
                                <div class="col-md-2">
                                    <input type="text" class="form-control form-control-sm" name="separacion[]" placeholder="Motivo">
                                </div>
                                <div class="col-md-2">
                                    <input type="text" class="form-control form-control-sm" name="referencias[]" placeholder="Referencia">
                                </div>
                            </div>

                            <div class="row mb-2">
                                <div class="col-md-2">
                                    <input type="text" class="form-control form-control-sm" name="empresa[]" placeholder="Empresa 5">
                                </div>
                                <div class="col-md-2">
                                    <input type="text" class="form-control form-control-sm" name="puesto[]" placeholder="Puesto">
                                </div>
                                <div class="col-md-1">
                                    <input type="text" class="form-control form-control-sm" name="sueldo[]" placeholder="$">
                                </div>
                                <div class="col-md-3">
                                    <input type="text" class="form-control form-control-sm" name="actividades[]" placeholder="Actividades principales">
                                </div>
                                <div class="col-md-2">
                                    <input type="text" class="form-control form-control-sm" name="separacion[]" placeholder="Motivo">
                                </div>
                                <div class="col-md-2">
                                    <input type="text" class="form-control form-control-sm" name="referencias[]" placeholder="Referencia">
                                </div>
                            </div>

                            <div class="row mb-2">
                                <div class="col-md-2">
                                    <input type="text" class="form-control form-control-sm" name="empresa[]" placeholder="Empresa 6">
                                </div>
                                <div class="col-md-2">
                                    <input type="text" class="form-control form-control-sm" name="puesto[]" placeholder="Puesto">
                                </div>
                                <div class="col-md-1">
                                    <input type="text" class="form-control form-control-sm" name="sueldo[]" placeholder="$">
                                </div>
                                <div class="col-md-3">
                                    <input type="text" class="form-control form-control-sm" name="actividades[]" placeholder="Actividades principales">
                                </div>
                                <div class="col-md-2">
                                    <input type="text" class="form-control form-control-sm" name="separacion[]" placeholder="Motivo">
                                </div>
                                <div class="col-md-2">
                                    <input type="text" class="form-control form-control-sm" name="referencias[]" placeholder="Referencia">
                                </div>
                            </div>
                        </div>

                        <div class="d-flex justify-content-between mt-4">
                            <button type="button" class="btn btn-secondary" onclick="nextSection(2)">
                                <i class="fas fa-arrow-left"></i> Anterior
                            </button>
                            <button type="button" class="btn btn-primary" onclick="nextSection(4)">
                                Siguiente <i class="fas fa-arrow-right"></i>
                            </button>
                        </div>
                    </div>

                    <!-- SECCIÓN 4: DOCUMENTOS -->
                    <div class="form-section d-none" id="section4">
                        <h3 class="section-title"><i class="fas fa-file-upload"></i> Documentos Requeridos</h3>
                        
                        <div class="alert alert-info">
                            <i class="fas fa-info-circle me-2"></i>
                            <strong>Instrucciones:</strong> Por favor adjunte los documentos solicitados en formato PDF, JPG o PNG. 
                            Los archivos no deben exceder 5MB cada uno.
                        </div>

                        <div class="row">
                            <!-- CV Actualizado -->
                            <div class="col-md-6 mb-4">
                                <div class="document-item">
                                    <div class="d-flex align-items-center mb-2">
                                        <i class="fas fa-file-pdf text-danger me-2 fs-4"></i>
                                        <div>
                                            <strong>CV Actualizado <span class="required-field">*</span></strong>
                                            <br><small class="text-muted">Formato: PDF, DOC, DOCX - Máximo 5MB</small>
                                        </div>
                                    </div>
                                    <input type="file" class="form-control" name="cv" accept=".pdf,.doc,.docx" required>
                                    <div class="invalid-feedback">
                                        Por favor seleccione su CV actualizado.
                                    </div>
                                </div>
                            </div>

                            <!-- CURP -->
                            <div class="col-md-6 mb-4">
                                <div class="document-item">
                                    <div class="d-flex align-items-center mb-2">
                                        <i class="fas fa-file-alt text-info me-2 fs-4"></i>
                                        <div>
                                            <strong>CURP <span class="required-field">*</span></strong>
                                            <br><small class="text-muted">Formato: PDF, JPG, PNG - Máximo 5MB</small>
                                        </div>
                                    </div>
                                    <input type="file" class="form-control" name="doc_curp" accept=".pdf,.jpg,.jpeg,.png" required>
                                    <div class="invalid-feedback">
                                        Por favor adjunte su CURP.
                                    </div>
                                </div>
                            </div>

                            <!-- Firma Digital -->
                            <div class="col-md-12 mb-4">
                                <div class="document-item">
                                    <div class="d-flex align-items-center mb-3">
                                        <i class="fas fa-signature text-success me-2 fs-4"></i>
                                        <div>
                                            <strong>Firma Digital <span class="required-field">*</span></strong>
                                            <br><small class="text-muted">Firme en el cuadro utilizando su mouse, dedo o stylus</small>
                                        </div>
                                    </div>
                                    <div class="signature-container">
                                        <canvas id="signatureCanvas" width="953" height="200"></canvas>
                                        <div class="signature-placeholder" id="signaturePlaceholder">
                                            Haga clic y arrastre para firmar aquí
                                        </div>
                                        <input type="hidden" name="firma_digital" id="firmaDigitalInput" required>
                                        <div class="invalid-feedback" id="firmaError">
                                            Por favor proporcione su firma digital.
                                        </div>
                                        <div class="signature-status" id="signatureStatus">
                                            <span class="text-muted">Estado: <span id="statusText">Sin firmar</span></span>
                                        </div>
                                    </div>
                                    <div class="signature-controls">
                                        <button type="button" class="btn btn-outline-danger btn-sm" id="clearSignature">
                                            <i class="fas fa-eraser"></i> Limpiar Firma
                                        </button>
                                        <!-- <button type="button" class="btn btn-outline-info btn-sm" id="previewSignature">
                                            <i class="fas fa-eye"></i> Vista Previa
                                        </button> -->
                                        <button type="button" class="btn btn-outline-success btn-sm" id="testSignature">
                                            <i class="fas fa-check"></i> Verificar Firma
                                        </button>
                                        </button>
                                    </div>
                                </div>
                            </div>
                           

                  

                            <!-- Identificación Oficial -->
                            <!-- <div class="col-md-6 mb-4">
                                <div class="document-item">
                                    <div class="d-flex align-items-center mb-2">
                                        <i class="fas fa-id-card text-primary me-2 fs-4"></i>
                                        <div>
                                            <strong>Identificación Oficial</strong>
                                            <br><small class="text-muted">INE, Pasaporte o Cédula - Formato: PDF, JPG, PNG</small>
                                        </div>
                                    </div>
                                    <input type="file" class="form-control" name="identificacion" accept=".pdf,.jpg,.jpeg,.png">
                                </div>
                            </div> -->

                            <!-- Comprobante de Domicilio -->
                            <!-- <div class="col-md-6 mb-4">
                                <div class="document-item">
                                    <div class="d-flex align-items-center mb-2">
                                        <i class="fas fa-home text-secondary me-2 fs-4"></i>
                                        <div>
                                            <strong>Comprobante de Domicilio</strong>
                                            <br><small class="text-muted">Reciente (máximo 3 meses) - Formato: PDF, JPG, PNG</small>
                                        </div>
                                    </div>
                                    <input type="file" class="form-control" name="comprobante_domicilio" accept=".pdf,.jpg,.jpeg,.png">
                                </div>
                            </div> -->

                            <!-- Acta de Nacimiento -->
                            <!-- <div class="col-md-6 mb-4">
                                <div class="document-item">
                                    <div class="d-flex align-items-center mb-2">
                                        <i class="fas fa-certificate text-primary me-2 fs-4"></i>
                                        <div>
                                            <strong>Acta de Nacimiento</strong>
                                            <br><small class="text-muted">Formato: PDF, JPG, PNG - Máximo 5MB</small>
                                        </div>
                                    </div>
                                    <input type="file" class="form-control" name="acta_nacimiento" accept=".pdf,.jpg,.jpeg,.png">
                                </div>
                            </div> -->

                            <!-- Certificado o Título -->
                            <!-- <div class="col-md-6 mb-4">
                                <div class="document-item">
                                    <div class="d-flex align-items-center mb-2">
                                        <i class="fas fa-graduation-cap text-info me-2 fs-4"></i>
                                        <div>
                                            <strong>Certificado/Título del Último Grado de Estudios</strong>
                                            <br><small class="text-muted">Formato: PDF, JPG, PNG - Máximo 5MB</small>
                                        </div>
                                    </div>
                                    <input type="file" class="form-control" name="certificado_estudios" accept=".pdf,.jpg,.jpeg,.png">
                                </div>
                            </div> -->

                            <!-- Cédula Profesional -->
                            <!-- <div class="col-md-6 mb-4">
                                <div class="document-item">
                                    <div class="d-flex align-items-center mb-2">
                                        <i class="fas fa-id-badge text-warning me-2 fs-4"></i>
                                        <div>
                                            <strong>Cédula Profesional (si aplica)</strong>
                                            <br><small class="text-muted">Formato: PDF, JPG, PNG - Máximo 5MB</small>
                                        </div>
                                    </div>
                                    <input type="file" class="form-control" name="cedula_profesional" accept=".pdf,.jpg,.jpeg,.png">
                                </div>
                            </div> -->

                            <!-- Antecedentes No Penales -->
                            <!-- <div class="col-md-6 mb-4">
                                <div class="document-item">
                                    <div class="d-flex align-items-center mb-2">
                                        <i class="fas fa-gavel text-danger me-2 fs-4"></i>
                                        <div>
                                            <strong>Carta de Antecedentes No Penales (opcional)</strong>
                                            <br><small class="text-muted">Formato: PDF, JPG, PNG - Máximo 5MB</small>
                                        </div>
                                    </div>
                                    <input type="file" class="form-control" name="antecedentes_penales" accept=".pdf,.jpg,.jpeg,.png">
                                </div>
                            </div> -->

                            <!-- Cartas de Recomendación -->
                            <!-- <div class="col-md-6 mb-4">
                                <div class="document-item">
                                    <div class="d-flex align-items-center mb-2">
                                        <i class="fas fa-envelope text-success me-2 fs-4"></i>
                                        <div>
                                            <strong>Cartas de Recomendación (opcional)</strong>
                                            <br><small class="text-muted">Formato: PDF, JPG, PNG - Máximo 5MB</small>
                                        </div>
                                    </div>
                                    <input type="file" class="form-control" name="cartas_recomendacion" accept=".pdf,.jpg,.jpeg,.png" multiple>
                                </div>
                            </div> -->

                            <!-- Licencia de Conducir -->
                            <!-- <div class="col-md-6 mb-4">
                                <div class="document-item">
                                    <div class="d-flex align-items-center mb-2">
                                        <i class="fas fa-car text-secondary me-2 fs-4"></i>
                                        <div>
                                            <strong>Licencia de Conducir (si aplica)</strong>
                                            <br><small class="text-muted">Formato: PDF, JPG, PNG - Máximo 5MB</small>
                                        </div>
                                    </div>
                                    <input type="file" class="form-control" name="licencia_conducir" accept=".pdf,.jpg,.jpeg,.png">
                                </div>
                            </div> -->
                        </div>

                        <div class="d-flex justify-content-between mt-4">
                            <button type="button" class="btn btn-secondary" onclick="nextSection(3)">
                                <i class="fas fa-arrow-left"></i> Anterior
                            </button>
                            <button type="submit" class="btn btn-success btn-lg">
                                <i class="fas fa-paper-plane"></i> Enviar Postulación
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/signature_pad@4.1.6/dist/signature_pad.umd.min.js"></script>

    <script>

        // Variables globales
  
        let signaturePad; // Variable para el pad de firma
        
        // Inicializar Signature Pad
        function initializeSignaturePad() {
            const canvas = document.getElementById('signatureCanvas');
            const placeholder = document.getElementById('signaturePlaceholder');
            const hiddenInput = document.getElementById('firmaDigitalInput');
            const statusText = document.getElementById('statusText');
            
            if (!canvas) {
                console.error('Canvas de firma no encontrado');
                return;
            }
            
            if (!hiddenInput) {
                console.error('Input hidden de firma no encontrado');
                return;
            }
            
            if (!statusText) {
                console.error('StatusText no encontrado');
                return;
            }
            
            console.log('Inicializando Signature Pad...');
            console.log('Canvas:', canvas);
            console.log('Hidden Input:', hiddenInput);
            console.log('Status Text:', statusText);
            
            // Función para actualizar el estado visual (definida primero)
            function updateSignatureStatus(text, type) {
                if (statusText) {
                    statusText.textContent = text;
                    statusText.className = `text-${type}`;
                    console.log('Estado actualizado:', text, type);
                } else {
                    console.error('StatusText no disponible para actualizar');
                }
            }
            
            // Configurar el canvas con tamaño fijo para evitar problemas de escala
            const rect = canvas.getBoundingClientRect();
            const ratio = Math.max(1, window.devicePixelRatio || 1);
            
            // Establecer el tamaño del canvas en el contexto de dibujo
            canvas.width = 953 * ratio;
            canvas.height = 200 * ratio;
            
            // Escalar el contexto para que coincida con el ratio de dispositivo
            const context = canvas.getContext('2d');
            context.scale(ratio, ratio);
            
            // Establecer el tamaño CSS del canvas
            canvas.style.width = '953px';
            canvas.style.height = '200px';
            
            signaturePad = new SignaturePad(canvas, {
                backgroundColor: 'rgba(255, 255, 255, 1)',
                penColor: 'rgb(0, 0, 0)',
                minWidth: 1,
                maxWidth: 3,
                throttle: 16,
                minDistance: 5,
                onBegin: function() {
                    console.log('Comenzando a firmar...');
                    if (placeholder) placeholder.style.display = 'none';
                    updateSignatureStatus('Firmando...', 'warning');
                },
                onEnd: function() {
                    console.log('Firma terminada, procesando...');
                    
                    // Pequeño delay para asegurar que el canvas esté listo
                    setTimeout(function() {
                        if (!signaturePad.isEmpty()) {
                            try {
                                // Guardar la firma como base64 en el input hidden
                                const dataURL = signaturePad.toDataURL('image/png');
                                hiddenInput.value = dataURL;
                                
                                console.log('Firma guardada exitosamente');
                                console.log('- Longitud:', dataURL.length);
                                console.log('- Primeros 50 chars:', dataURL.substring(0, 50));
                                console.log('- Input value asignado:', hiddenInput.value.length > 0 ? 'SÍ' : 'NO');
                                
                                // Remover validación de error si existe
                                canvas.classList.remove('is-invalid');
                                canvas.classList.add('is-valid');
                                const errorElement = document.getElementById('firmaError');
                                if (errorElement) errorElement.style.display = 'none';
                                
                                // Actualizar estado
                                updateSignatureStatus('Firmado ✓', 'success');
                                
                                // Trigger evento personalizado para notificar que la firma cambió
                                const event = new CustomEvent('signatureChange', { 
                                    detail: { 
                                        signed: true, 
                                        dataURL: dataURL 
                                    } 
                                });
                                document.dispatchEvent(event);
                                
                            } catch (error) {
                                console.error('Error al procesar la firma:', error);
                                updateSignatureStatus('Error al procesar', 'danger');
                            }
                        } else {
                            console.log('Canvas vacío después de onEnd');
                            updateSignatureStatus('Sin firmar', 'muted');
                        }
                    }, 100); // 100ms delay
                }
            });
            
            // Limpiar firma
            document.getElementById('clearSignature').addEventListener('click', function() {
                console.log('Limpiando firma...');
                signaturePad.clear();
                if (placeholder) placeholder.style.display = 'block';
                hiddenInput.value = '';
                canvas.classList.remove('is-valid', 'is-invalid');
                const errorElement = document.getElementById('firmaError');
                if (errorElement) errorElement.style.display = 'none';
                updateSignatureStatus('Sin firmar', 'muted');
                
                // Trigger evento personalizado
                const event = new CustomEvent('signatureChange', { 
                    detail: { 
                        signed: false, 
                        dataURL: null 
                    } 
                });
                document.dispatchEvent(event);
            });
            
            // // Vista previa de la firma
            // document.getElementById('previewSignature').addEventListener('click', function() {
            //     if (signaturePad.isEmpty()) {
            //         alert('No hay firma para mostrar. Por favor firme primero.');
            //         return;
            //     }
                
            //     const dataURL = signaturePad.toDataURL('image/png');
            //     const newWindow = window.open('', '_blank');
            //     newWindow.document.write(`
            //         <html>
            //             <head><title>Vista Previa de Firma</title></head>
            //             <body style="text-align: center; padding: 20px;">
            //                 <h3>Vista Previa de la Firma Digital</h3>
            //                 <img src="${dataURL}" style="border: 1px solid #ccc; max-width: 100%; background: white;">
            //                 <br><br>
            //                 <p><strong>Tamaño:</strong> ${dataURL.length} caracteres</p>
            //                 <button onclick="window.close()">Cerrar</button>
            //             </body>
            //         </html>
            //     `);
            // });
            
            // Verificar firma (nuevo botón)
            document.getElementById('testSignature').addEventListener('click', function() {
                console.log('=== VERIFICACIÓN DE FIRMA ===');
                console.log('SignaturePad existe:', !!signaturePad);
                console.log('SignaturePad isEmpty:', signaturePad ? signaturePad.isEmpty() : 'N/A');
                console.log('Hidden input existe:', !!hiddenInput);
                console.log('Hidden input value length:', hiddenInput ? hiddenInput.value.length : 'N/A');
                console.log('Hidden input value preview:', hiddenInput && hiddenInput.value ? hiddenInput.value.substring(0, 50) + '...' : 'vacío');
                
                // Si el pad no está vacío pero el input sí, intentar forzar la actualización
                if (signaturePad && !signaturePad.isEmpty() && (!hiddenInput.value || hiddenInput.value.length === 0)) {
                    console.log('Forzando actualización del input...');
                    try {
                        const dataURL = signaturePad.toDataURL('image/png');
                        hiddenInput.value = dataURL;
                        console.log('Input actualizado forzadamente, nueva longitud:', hiddenInput.value.length);
                    } catch (error) {
                        console.error('Error al forzar actualización:', error);
                    }
                }
                
                // Validaciones
                if (!signaturePad) {
                    alert('❌ SignaturePad no inicializado');
                    updateSignatureStatus('Error: No inicializado', 'danger');
                } else if (signaturePad.isEmpty()) {
                    alert('❌ El canvas está vacío. Por favor firme primero.');
                    updateSignatureStatus('Error: Canvas vacío', 'danger');
                } else if (!hiddenInput || !hiddenInput.value || hiddenInput.value.length < 100) {
                    alert('❌ El input hidden está vacío o corrupto.\n\nLongitud actual: ' + (hiddenInput ? hiddenInput.value.length : 0) + '\n\nIntente limpiar y firmar nuevamente.');
                    updateSignatureStatus('Error: Datos corruptos', 'danger');
                } else {
                    alert('✅ Firma válida y capturada correctamente!\n\n' +
                          'Longitud: ' + hiddenInput.value.length + ' caracteres\n' +
                          'Formato: ' + (hiddenInput.value.startsWith('data:image/png;base64,') ? 'PNG Base64 ✓' : 'Formato incorrecto') + '\n' +
                          'Estado: Lista para envío');
                    updateSignatureStatus('Verificado ✓', 'success');
                }
                
                console.log('=== FIN VERIFICACIÓN ===');
            });
            
            console.log('Signature Pad inicializado correctamente');
        }
        $(document).on('change', 'select[name="s_1_select_1"]', function()
        {
            if ($(this).val() === 'Casado(a)') {
                $('#conyugeSection').show();
            } else {
                $('#conyugeSection').hide();
            }
        });

        // Mostrar sección hijos si tiene hijos
        $(document).on('change', 'select[name="s_1_select_3"]', function()
        {
            if ($(this).val() === 'Si') {
                $('#hijosSection').show();
            } else {
                $('#hijosSection').hide();
            }
        });



        let currentSection = 1;
        let vacanteSeleccionadaId = null;
        
        // Cargar vacantes al iniciar la página
        $(document).ready(function() {
            cargarVacantesDisponibles();
        });
        
        // Función para cargar vacantes disponibles (ACTUALIZADA)
        function cargarVacantesDisponibles() {
            $.ajax({
                url: '../../../api/recursos_humanos_api.php',
                type: 'POST',
                dataType: 'json',
                data: {
                    api: 28,
                    estado: ['publicada_normal', 'publicada_editada'], // Estados que se consideran activos
                    tipo_publicacion: ['externa', 'ambas'] // Solo vacantes externas (no internas)
                },
                success: function(response) {
                    console.log('Respuesta completa de vacantes:', response);
                    
                    // Manejar la estructura de respuesta del returnApi
                    let datos = [];
                    if (response.response && response.response.data) {
                        datos = response.response.data;
                    } else if (response.data) {
                        datos = response.data;
                    }
                    
                    console.log('Datos de vacantes procesados:', datos);
                    
                    if (datos && datos.length > 0) {
                        mostrarVacantes(datos);
                    } else {
                        console.log('No se encontraron vacantes o datos vacíos');
                        mostrarSinVacantes();
                    }
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.error('Error cargando vacantes:', textStatus, errorThrown);
                    console.error('Respuesta del servidor:', jqXHR.responseText);
                    mostrarErrorVacantes();
                }
            });
        }
        
        // Función para mostrar las vacantes
        function mostrarVacantes(vacantes) {
            let html = '<div class="row">';
            
            vacantes.forEach(function(vacante) {
                // Calcular días restantes
                let fechaLimite = new Date(vacante.fecha_limite_publicacion);
                let hoy = new Date();
                let diasRestantes = Math.ceil((fechaLimite - hoy) / (1000 * 60 * 60 * 24));
                
                let badgeColor = diasRestantes > 7 ? 'success' : diasRestantes > 3 ? 'warning' : 'danger';
                let urgenciaTexto = vacante.prioridad === 'urgente' ? '<span class="badge bg-danger ms-2">Urgente</span>' : '';
                
                html += `
                    <div class="col-md-6 mb-3">
                        <div class="card h-100 shadow-sm vacante-card" style="cursor: pointer;" 
                             onclick="seleccionarVacante('${vacante.id_publicacion}', '${vacante.titulo_vacante}', '${vacante.puesto_nombre}')">
                            <div class="card-header bg-gradient-primary text-white">
                                <h5 class="card-title mb-0">
                                    ${vacante.titulo_vacante || vacante.puesto_nombre}
                                    ${urgenciaTexto}
                                </h5>
                            </div>
                            <div class="card-body">
                                <p class="card-text">
                                    <strong>Área:</strong> ${vacante.departamento_nombre}<br>
                                    <strong>Tipo:</strong> <span class="badge bg-info">${vacante.tipo_publicacion}</span><br>
                                    <strong>Publicada:</strong> ${new Date(vacante.fecha_inicio_publicacion).toLocaleDateString('es-MX')}<br>
                                    <strong>Vencimiento:</strong> ${new Date(vacante.fecha_limite_publicacion).toLocaleDateString('es-MX')}
                                </p>
                                ${vacante.descripcion_adicional ? `<p class="text-muted small">${vacante.descripcion_adicional}</p>` : ''}
                            </div>
                            <div class="card-footer bg-light border-0">
                                <small class="text-muted">
                                    <i class="fas fa-clock"></i> 
                                    <span class="badge bg-${badgeColor}">${diasRestantes > 0 ? diasRestantes + ' días restantes' : 'Vencida'}</span>
                                </small>
                            </div>
                        </div>
                    </div>
                `;
            });
            
            html += '</div>';
            
            if (vacantes.length === 0) {
                html = '<div class="text-center text-muted"><i class="fas fa-inbox fa-3x mb-3"></i><p>No hay vacantes disponibles en este momento.</p></div>';
            }
            
            $('#vacantesDisponibles').html(html);
        }
        
        // Función para mostrar cuando no hay vacantes
        function mostrarSinVacantes() {
            $('#vacantesDisponibles').html(`
                <div class="text-center text-muted">
                    <i class="fas fa-inbox fa-3x mb-3"></i>
                    <h5>No hay vacantes disponibles</h5>
                    <p>En este momento no tenemos vacantes publicadas. Te invitamos a revisar más tarde.</p>
                </div>
            `);
        }
        
        // Función para mostrar error al cargar vacantes
        function mostrarErrorVacantes() {
            $('#vacantesDisponibles').html(`
                <div class="text-center text-danger">
                    <i class="fas fa-exclamation-triangle fa-3x mb-3"></i>
                    <h5>Error al cargar vacantes</h5>
                    <p>Hubo un problema al cargar las vacantes disponibles.</p>
                    <button class="btn btn-primary" onclick="cargarVacantesDisponibles()">
                        <i class="fas fa-redo"></i> Intentar de nuevo
                    </button>
                </div>
            `);
        }
        
        // Función para seleccionar una vacante
        function seleccionarVacante(idPublicacion, tituloVacante, puestoNombre) {
            vacanteSeleccionadaId = idPublicacion;
            
            // Marcar vacante seleccionada visualmente
            $('.vacante-card').removeClass('border-primary');
            $(event.currentTarget).addClass('border-primary border-3');
            
            // Actualizar información de vacante seleccionada
            $('#vacanteSeleccionada').text(tituloVacante || puestoNombre);
            
            // Mostrar formulario de postulación
            $('#formularioPostulacion').slideDown();
            
            // Agregar campo oculto con ID de publicación
            if (!$('#id_publicacion').length) {
                $('#postulacionForm').append(`<input type="hidden" id="id_publicacion" name="id_publicacion" value="${idPublicacion}">`);
            } else {
                $('#id_publicacion').val(idPublicacion);
            }
            
            // Scroll suave hacia el formulario
            $('html, body').animate({
                scrollTop: $('#formularioPostulacion').offset().top - 100
            }, 800);
        }
        
        function nextSection(section) {
            // Validar sección actual antes de avanzar
            if (section > currentSection && !validateCurrentSection()) {
                return;
            }
            
            // Ocultar sección actual
            document.getElementById('section' + currentSection).classList.add('d-none');
            
            // Mostrar nueva sección
            document.getElementById('section' + section).classList.remove('d-none');
            
            // Actualizar sección actual
            currentSection = section;
            
            // Actualizar barra de progreso
            updateProgressBar();
            
            // Scroll al inicio de la nueva sección
            document.getElementById('section' + section).scrollIntoView({ behavior: 'smooth' });
        }
        
        function validateCurrentSection() {
            const section = document.getElementById('section' + currentSection);
            const requiredFields = section.querySelectorAll('[required]');
            let isValid = true;
            
            requiredFields.forEach(field => {
                field.classList.remove('is-invalid', 'is-valid'); // Limpiar estados anteriores
                
                if (field.type === 'checkbox') {
                    // Para checkboxes, verificar si al menos uno está marcado en grupos
                    return; // Los checkboxes no son requeridos individualmente
                }
                
                if (field.name === 'firma_digital') {
                    // Validación especial para la firma digital
                    console.log('=== VALIDACIÓN FIRMA DIGITAL ===');
                    console.log('Field value length:', field.value ? field.value.length : 0);
                    console.log('SignaturePad exists:', !!signaturePad);
                    console.log('SignaturePad isEmpty:', signaturePad ? signaturePad.isEmpty() : 'N/A');
                    
                    // Si el SignaturePad no está vacío pero el field sí, intentar actualizar
                    if (signaturePad && !signaturePad.isEmpty() && (!field.value || field.value.length < 100)) {
                        console.log('Intentando recuperar firma del canvas...');
                        try {
                            const dataURL = signaturePad.toDataURL('image/png');
                            field.value = dataURL;
                            console.log('Firma recuperada, nueva longitud:', field.value.length);
                        } catch (error) {
                            console.error('Error al recuperar firma:', error);
                        }
                    }
                    
                    // Validar después de la posible recuperación
                    const isValidSignature = field.value && 
                                           field.value.length > 100 && 
                                           field.value.startsWith('data:image/png;base64,') &&
                                           signaturePad && 
                                           !signaturePad.isEmpty();
                    
                    if (!isValidSignature) {
                        const canvas = document.getElementById('signatureCanvas');
                        canvas.classList.add('is-invalid');
                        document.getElementById('firmaError').style.display = 'block';
                        console.log('Firma inválida - Razones:');
                        console.log('- Field value exists:', !!field.value);
                        console.log('- Field value length > 100:', field.value && field.value.length > 100);
                        console.log('- Starts with PNG header:', field.value && field.value.startsWith('data:image/png;base64,'));
                        console.log('- SignaturePad not empty:', signaturePad && !signaturePad.isEmpty());
                        isValid = false;
                    } else {
                        const canvas = document.getElementById('signatureCanvas');
                        canvas.classList.remove('is-invalid');
                        canvas.classList.add('is-valid');
                        document.getElementById('firmaError').style.display = 'none';
                        console.log('Firma válida ✓');
                    }
                    console.log('=== FIN VALIDACIÓN FIRMA ===');
                    return;
                }
                
                if (!field.value || !field.value.trim()) {
                    field.classList.add('is-invalid');
                    isValid = false;
                } else {
                    field.classList.add('is-valid');
                }
            });
            
            // Validación adicional para firma digital si estamos en la sección 4
            if (currentSection === 4) {
                const firmaInput = document.getElementById('firmaDigitalInput');
                
                console.log('=== VALIDACIÓN ADICIONAL SECCIÓN 4 ===');
                console.log('- signaturePad existe:', !!signaturePad);
                console.log('- signaturePad.isEmpty():', signaturePad ? signaturePad.isEmpty() : 'N/A');
                console.log('- firmaInput exists:', !!firmaInput);
                console.log('- firmaInput.value length:', firmaInput ? firmaInput.value.length : 'N/A');
                
                // Intentar recuperar la firma si es necesario
                if (signaturePad && !signaturePad.isEmpty() && firmaInput && (!firmaInput.value || firmaInput.value.length < 100)) {
                    console.log('Intentando recuperar firma en validación adicional...');
                    try {
                        const dataURL = signaturePad.toDataURL('image/png');
                        firmaInput.value = dataURL;
                        console.log('Firma recuperada en validación adicional, longitud:', firmaInput.value.length);
                    } catch (error) {
                        console.error('Error al recuperar firma en validación adicional:', error);
                    }
                }
                
                // Validar después de la posible recuperación
                const hasValidSignature = signaturePad && 
                                        !signaturePad.isEmpty() && 
                                        firmaInput && 
                                        firmaInput.value && 
                                        firmaInput.value.length > 100 &&
                                        firmaInput.value.startsWith('data:image/png;base64,');
                
                if (!hasValidSignature) {
                    const canvas = document.getElementById('signatureCanvas');
                    canvas.classList.add('is-invalid');
                    document.getElementById('firmaError').style.display = 'block';
                    console.log('Error en validación adicional - Detalles:');
                    console.log('- SignaturePad not empty:', signaturePad && !signaturePad.isEmpty());
                    console.log('- Input has value:', firmaInput && !!firmaInput.value);
                    console.log('- Value length > 100:', firmaInput && firmaInput.value && firmaInput.value.length > 100);
                    console.log('- Valid PNG header:', firmaInput && firmaInput.value && firmaInput.value.startsWith('data:image/png;base64,'));
                    isValid = false;
                }
                console.log('=== FIN VALIDACIÓN ADICIONAL ===');
            }
            
            if (!isValid) {
                alert('Por favor complete todos los campos requeridos antes de continuar.');
            }
            
            return isValid;
        }
        
        function updateProgressBar() {
            const progress = (currentSection / 4) * 100;
            document.getElementById('progressBar').style.width = progress + '%';
        }
        
        // Validación en tiempo real - ACTUALIZADO CON NUEVOS NOMBRES
        document.addEventListener('DOMContentLoaded', function() {
            // Inicializar Signature Pad
            setTimeout(function() {
                initializeSignaturePad();
            }, 500); // Delay para asegurar que todos los elementos estén disponibles
            
            // Listener para cambios en la firma
            document.addEventListener('signatureChange', function(event) {
                console.log('Evento signatureChange recibido:', event.detail);
                const firmaInput = document.getElementById('firmaDigitalInput');
                if (firmaInput && event.detail.signed && event.detail.dataURL) {
                    // Asegurar que el input tenga el valor correcto
                    if (firmaInput.value !== event.detail.dataURL) {
                        firmaInput.value = event.detail.dataURL;
                        console.log('Input actualizado via evento, longitud:', firmaInput.value.length);
                    }
                }
            });
            
            // Calcular edad automáticamente - ACTUALIZADO
            const fechaNacimiento = document.querySelector('input[name="s_1_pregunta_4"]'); // Fecha de nacimiento
            const edad = document.querySelector('input[name="s_1_pregunta_5"]'); // Edad
            
            fechaNacimiento?.addEventListener('change', function() {
                if (this.value) {
                    const today = new Date();
                    const birthDate = new Date(this.value);
                    let age = today.getFullYear() - birthDate.getFullYear();
                    const month = today.getMonth() - birthDate.getMonth();
                    
                    if (month < 0 || (month === 0 && today.getDate() < birthDate.getDate())) {
                        age--;
                    }
                    
                    edad.value = age;
                }
            });
            
            // Validación de CURP - ACTUALIZADO
            const curpInput = document.querySelector('input[name="s_1_pregunta_8"]'); // CURP
            curpInput?.addEventListener('input', function() {
                this.value = this.value.toUpperCase();
                
                // Validación básica de formato CURP (18 caracteres)
                if (this.value.length === 18) {
                    const curpRegex = /^[A-Z]{4}\d{6}[HM][A-Z]{5}[A-Z0-9]\d$/;
                    if (curpRegex.test(this.value)) {
                        this.classList.remove('is-invalid');
                        this.classList.add('is-valid');
                    } else {
                        this.classList.remove('is-valid');
                        this.classList.add('is-invalid');
                    }
                } else {
                    this.classList.remove('is-valid', 'is-invalid');
                }
            });
            
            // Validación de email - ACTUALIZADO
            const emailInput = document.querySelector('input[name="s_1_pregunta_6"]'); // Email
            emailInput?.addEventListener('input', function() {
                const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                if (emailRegex.test(this.value)) {
                    this.classList.remove('is-invalid');
                    this.classList.add('is-valid');
                } else if (this.value.length > 0) {
                    this.classList.remove('is-valid');
                    this.classList.add('is-invalid');
                } else {
                    this.classList.remove('is-valid', 'is-invalid');
                }
            });
            
            // Validación de teléfono - ACTUALIZADO
            const telefonoInput = document.querySelector('input[name="s_1_pregunta_7"]'); // Teléfono
            telefonoInput?.addEventListener('input', function() {
                // Solo números, espacios, guiones y paréntesis
                this.value = this.value.replace(/[^0-9\s\-\(\)]/g, '');
                
                // Validar longitud mínima
                if (this.value.replace(/[^0-9]/g, '').length >= 10) {
                    this.classList.remove('is-invalid');
                    this.classList.add('is-valid');
                } else if (this.value.length > 0) {
                    this.classList.remove('is-valid');
                    this.classList.add('is-invalid');
                } else {
                    this.classList.remove('is-valid', 'is-invalid');
                }
            });
            
            // Validación de campos numéricos de salud
            const pesoInput = document.querySelector('input[name="s_2_pregunta_1"]'); // Peso
            const estaturaInput = document.querySelector('input[name="s_2_pregunta_2"]'); // Estatura
            
            pesoInput?.addEventListener('input', function() {
                const peso = parseFloat(this.value);
                if (peso >= 30 && peso <= 300) {
                    this.classList.remove('is-invalid');
                    this.classList.add('is-valid');
                } else if (this.value.length > 0) {
                    this.classList.remove('is-valid');
                    this.classList.add('is-invalid');
                } else {
                    this.classList.remove('is-valid', 'is-invalid');
                }
            });
            
            estaturaInput?.addEventListener('input', function() {
                const estatura = parseFloat(this.value);
                if (estatura >= 120 && estatura <= 250) {
                    this.classList.remove('is-invalid');
                    this.classList.add('is-valid');
                } else if (this.value.length > 0) {
                    this.classList.remove('is-valid');
                    this.classList.add('is-invalid');
                } else {
                    this.classList.remove('is-valid', 'is-invalid');
                }
            });
            
            // Validación de edad
            edad?.addEventListener('input', function() {
                const edadValue = parseInt(this.value);
                if (edadValue >= 18 && edadValue <= 70) {
                    this.classList.remove('is-invalid');
                    this.classList.add('is-valid');
                } else if (this.value.length > 0) {
                    this.classList.remove('is-valid');
                    this.classList.add('is-invalid');
                } else {
                    this.classList.remove('is-valid', 'is-invalid');
                }
            });
            
            // Validación de archivos
            const fileInputs = document.querySelectorAll('input[type="file"]');
            fileInputs.forEach(input => {
                input.addEventListener('change', function() {
                    const file = this.files[0];
                    if (file) {
                        // Verificar tamaño (5MB = 5 * 1024 * 1024 bytes)
                        if (file.size > 5 * 1024 * 1024) {
                            alert('El archivo es demasiado grande. El tamaño máximo es 5MB.');
                            this.value = '';
                            this.classList.add('is-invalid');
                            return;
                        }
                        
                        // Verificar tipo de archivo
                        const allowedTypes = this.accept.split(',').map(type => type.trim());
                        const fileExtension = '.' + file.name.split('.').pop().toLowerCase();
                        
                        if (allowedTypes.includes(fileExtension) || allowedTypes.some(type => file.type.match(type.replace('*', '.*')))) {
                            this.classList.remove('is-invalid');
                            this.classList.add('is-valid');
                        } else {
                            alert('Tipo de archivo no permitido. Revise los formatos aceptados.');
                            this.value = '';
                            this.classList.add('is-invalid');
                        }
                    }
                });
            });
        });
        
        // Envío del formulario - VERSIÓN ACTUALIZADA
        document.getElementById('postulacionForm').addEventListener('submit', function(e) {
            e.preventDefault();
            
            if (!validateCurrentSection()) {
                return;
            }
            
            // Validar que se haya seleccionado una vacante
            if (!vacanteSeleccionadaId) {
                alert('Por favor seleccione una vacante antes de enviar la postulación.');
                return;
            }
            
            // Mostrar loading
            const submitBtn = document.querySelector('button[type="submit"]');
            const originalText = submitBtn.innerHTML;
            submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Enviando...';
            submitBtn.disabled = true;
            
            // Preparar datos del formulario
            const formData = new FormData(this);
            formData.append('api', '30');
            
            // Agregar ID de vacante si no está presente
            if (!formData.has('id_publicacion')) {
                formData.append('id_publicacion', vacanteSeleccionadaId);
            }
            
            // Debug: Mostrar datos que se envían
            console.log('=== DEBUG FORMULARIO ===');
            console.log('Datos del formulario que se envían:');
            for (let pair of formData.entries()) {
                if (pair[0] === 'firma_digital') {
                    console.log(pair[0] + ': [BASE64 DATA - Length: ' + pair[1].length + ']');
                    console.log('Primeros 100 caracteres:', pair[1].substring(0, 100));
                } else {
                    console.log(pair[0] + ': ' + pair[1]);
                }
            }
            console.log('========================');
            
            // Enviar formulario
            fetch('../../../api/recursos_humanos_api.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.text())
            .then(responseText => {
                console.log('Respuesta cruda de la API:', responseText);
                
                try {
                    const data = JSON.parse(responseText);
                    console.log('Respuesta parseada de la API:', data);
                    
                    // Manejar tanto formato directo como con wrapper "response"
                    let responseData = data;
                    if (data.response) {
                        responseData = data.response;
                    }
                    
                    // Aceptar tanto code: 1 como code: 2 (tu sistema usa 2 para SUCCESS)
                    if (responseData.code === 1 || responseData.code === 2) {
                        // Mostrar mensaje de éxito
                        const mensaje = responseData.message || responseData.msj || 'Postulación enviada exitosamente';
                        alert('¡Éxito!\n\n' + mensaje);
                        
                        // Limpiar formulario
                        document.getElementById('postulacionForm').reset();
                        
                        // Limpiar clases de validación
                        document.querySelectorAll('.is-valid, .is-invalid').forEach(el => {
                            el.classList.remove('is-valid', 'is-invalid');
                        });
                        
                        // Ocultar secciones condicionales
                        $('#conyugeSection').hide();
                        $('#hijosSection').hide();
                        
                        // Volver a la primera sección
                        currentSection = 1;
                        document.querySelectorAll('[id^="section"]').forEach(section => {
                            section.classList.add('d-none');
                        });
                        document.getElementById('section1').classList.remove('d-none');
                        updateProgressBar();
                        
                        // Ocultar formulario
                        $('#formularioPostulacion').hide();
                        
                        // Limpiar selección de vacante
                        vacanteSeleccionadaId = null;
                        $('.vacante-card').removeClass('border-primary border-3');
                        $('#vacanteSeleccionada').text('-');
                        
                        // Recargar vacantes
                        cargarVacantesDisponibles();
                        
                        // Scroll hacia arriba
                        $('html, body').animate({scrollTop: 0}, 800);
                        
                    } else {
                        // Error
                        const errorMsg = responseData.message || responseData.msj || 'Error desconocido';
                        alert('Error al enviar la postulación:\n\n' + errorMsg);
                        console.error('Error de API:', responseData);
                    }
                } catch (parseError) {
                    console.error('Error al parsear JSON:', parseError);
                    console.error('Respuesta recibida:', responseText);
                    alert('Error en la respuesta del servidor. Revise la consola para más detalles.');
                }
            })
            .catch(error => {
                console.error('Error de conexión:', error);
                alert('Error de conexión. Por favor intente nuevamente.');
            })
            .finally(() => {
                submitBtn.innerHTML = originalText;
                submitBtn.disabled = false;
            });
        });
    </script>
</body>
</html>