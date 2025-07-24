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

                <!-- Barra de progreso -->
                <div class="form-section">
                    <div class="progress mb-3" style="height: 10px;">
                        <div class="progress-bar" role="progressbar" style="width: 0%" id="progressBar"></div>
                    </div>
                    <div class="d-flex justify-content-between">
                        <small class="text-muted">Datos Generales</small>
                        <small class="text-muted">Cuestionario</small>
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
                                <input type="text" class="form-control" name="nombre_completo" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Fecha de nacimiento <span class="required-field">*</span></label>
                                <input type="date" class="form-control" name="fecha_nacimiento" required>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <label class="form-label">Edad <span class="required-field">*</span></label>
                                <input type="number" class="form-control" name="edad" min="18" max="70" required>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="form-label">Sexo <span class="required-field">*</span></label>
                                <select class="form-select" name="sexo" required>
                                    <option value="">Seleccione...</option>
                                    <option value="M">Masculino</option>
                                    <option value="F">Femenino</option>
                                </select>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="form-label">Estado civil <span class="required-field">*</span></label>
                                <select class="form-select" name="estado_civil" required>
                                    <option value="">Seleccione...</option>
                                    <option value="Soltero(a)">Soltero(a)</option>
                                    <option value="Casado(a)">Casado(a)</option>
                                    <option value="Divorciado(a)">Divorciado(a)</option>
                                    <option value="Viudo(a)">Viudo(a)</option>
                                    <option value="Unión libre">Unión libre</option>
                                </select>
                            </div>
                        </div>

                        <div class="row">
                            <!-- <div class="col-md-6 mb-3">
                                <label class="form-label">Nacionalidad <span class="required-field">*</span></label>
                                <input type="text" class="form-control" name="nacionalidad" value="Mexicana" required>
                            </div> -->
                             <div class="col-md-4 mb-3">
                                <label class="form-label">Teléfono de contacto <span class="required-field">*</span></label>
                                <input type="tel" class="form-control" name="telefono" required>
                            </div>
                            <div class="col-md-8 mb-3">
                            <label class="form-label">Domicilio completo <span class="required-field">*</span></label>
                            <textarea class="form-control" name="domicilio" required></textarea>
                        </div>
                            <!-- <div class="col-md-6 mb-3">
                                <label class="form-label">CURP <span class="required-field">*</span></label>
                                <input type="text" class="form-control" name="curp" maxlength="18"  required>
                            </div> -->
                        </div>

                        <!-- <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">RFC <span class="required-field">*</span></label>
                                <input type="text" class="form-control" name="rfc" maxlength="13" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Número de seguro social (NSS)</label>
                                <input type="text" class="form-control" name="nss" maxlength="11">
                            </div>
                        </div> -->

                        <!-- <div class="row">
                           
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Correo electrónico <span class="required-field">*</span></label>
                                <input type="email" class="form-control" name="correo" required>
                            </div>
                        </div> -->

                        <!-- <div class="mb-3">
                            <label class="form-label">Domicilio completo <span class="required-field">*</span></label>
                            <textarea class="form-control" name="domicilio" rows="3" required></textarea>
                        </div> -->

                        <!-- <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">¿Cuenta con disponibilidad para cambio de residencia? <span class="required-field">*</span></label>
                                <select class="form-select" name="disponibilidad_residencia" required>
                                    <option value="">Seleccione...</option>
                                    <option value="Si">Sí</option>
                                    <option value="No">No</option>
                                    <option value="Depende">Depende de las condiciones</option>
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">¿Cuenta con disponibilidad para viajar? <span class="required-field">*</span></label>
                                <select class="form-select" name="disponibilidad_viajes" required>
                                    <option value="">Seleccione...</option>
                                    <option value="Si">Sí</option>
                                    <option value="No">No</option>
                                    <option value="Ocasionalmente">Ocasionalmente</option>
                                </select>
                            </div>
                        </div> -->

                        <div class="text-end">
                            <button type="button" class="btn btn-primary" onclick="nextSection(2)">
                                Siguiente <i class="fas fa-arrow-right"></i>
                            </button>
                        </div>
                    </div>

                    <!-- SECCIÓN 2: CUESTIONARIO INICIAL -->
                    <div class="form-section d-none" id="section2">
                        <h3 class="section-title"><i class="fas fa-clipboard-question"></i> Cuestionario Inicial</h3>
                        
                        <div class="mb-4">
                            <label class="form-label">¿Por qué le interesa esta vacante y qué le motiva a postularse? <span class="required-field">*</span></label>
                            <textarea class="form-control" name="pregunta_1" rows="4" required></textarea>
                        </div>

                        <div class="mb-4">
                            <label class="form-label">¿Qué metas profesionales tiene a corto y mediano plazo? <span class="required-field">*</span></label>
                            <textarea class="form-control" name="pregunta_2" rows="4" required></textarea>
                        </div>

                        <div class="mb-4">
                            <label class="form-label">Describa brevemente una situación en la que haya resuelto un problema importante en su trabajo anterior. <span class="required-field">*</span></label>
                            <textarea class="form-control" name="pregunta_3" rows="4" required></textarea>
                        </div>

                        <div class="mb-4">
                            <label class="form-label">¿Qué espera de la empresa y del equipo de trabajo? <span class="required-field">*</span></label>
                            <textarea class="form-control" name="pregunta_4" rows="4" required></textarea>
                        </div>

                        <div class="mb-4">
                            <label class="form-label">¿Qué considera que podría aportar a la empresa? <span class="required-field">*</span></label>
                            <textarea class="form-control" name="pregunta_5" rows="4" required></textarea>
                        </div>

                        <div class="mb-4">
                            <label class="form-label">¿Cuándo podría integrarse en caso de ser seleccionado? <span class="required-field">*</span></label>
                            <textarea class="form-control" name="pregunta_6" rows="3" required></textarea>
                        </div>

                        <div class="mb-4">
                            <label class="form-label">¿Ha tenido conflictos en empleos anteriores? ¿Cómo los resolvió? <span class="required-field">*</span></label>
                            <textarea class="form-control" name="pregunta_7" rows="4" required></textarea>
                        </div>

                        <div class="mb-4">
                            <label class="form-label">¿Tiene familiares o conocidos trabajando en la empresa? <span class="required-field">*</span></label>
                            <textarea class="form-control" name="pregunta_8" rows="3" required></textarea>
                        </div>

                        <div class="mb-4">
                            <label class="form-label">¿Ha trabajado anteriormente bajo presión o con objetivos de venta? (en caso de aplicar) <span class="required-field">*</span></label>
                            <textarea class="form-control" name="pregunta_9" rows="4" required></textarea>
                        </div>

                        <div class="mb-4">
                            <label class="form-label">¿Está dispuesto a firmar contrato de confidencialidad y/o de no competencia? <span class="required-field">*</span></label>
                            <select class="form-select" name="pregunta_10" required>
                                <option value="">Seleccione...</option>
                                <option value="Si">Sí</option>
                                <option value="No">No</option>
                                <option value="Necesito más información">Necesito más información</option>
                            </select>
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

                    <!-- SECCIÓN 3: SUBIDA DE DOCUMENTOS -->
                    <div class="form-section d-none" id="section3">
                        <h3 class="section-title"><i class="fas fa-file-upload"></i> Documentos Requeridos</h3>
                        
                        <div class="row">
                            <!-- CV Actualizado -->
                            <div class="col-md-6">
                                <div class="document-item">
                                    <div class="d-flex align-items-center mb-2">
                                        <i class="fas fa-file-pdf text-danger me-2"></i>
                                        <strong>CV actualizado <span class="required-field">*</span></strong>
                                    </div>
                                    <input type="file" class="form-control" name="cv" accept=".pdf,.doc,.docx" required>
                                </div>
                            </div>

                            <!-- Identificación oficial -->
                            <!-- <div class="col-md-6">
                                <div class="document-item">
                                    <div class="d-flex align-items-center mb-2">
                                        <i class="fas fa-id-card text-primary me-2"></i>
                                        <strong>Identificación oficial (INE/Pasaporte) <span class="required-field">*</span></strong>
                                    </div>
                                    <input type="file" class="form-control" name="identificacion" accept=".pdf,.jpg,.jpeg,.png">
                                </div>
                            </div> -->

                            <!-- CURP -->
                            <div class="col-md-6">
                                <div class="document-item">
                                    <div class="d-flex align-items-center mb-2">
                                        <i class="fas fa-file-alt text-info me-2"></i>
                                        <strong>CURP <span class="required-field">*</span></strong>
                                    </div>
                                    <input type="file" class="form-control" name="doc_curp" accept=".pdf,.jpg,.jpeg,.png">
                                </div>
                            </div>

                            <!-- RFC -->
                            <!-- <div class="col-md-6">
                                <div class="document-item">
                                    <div class="d-flex align-items-center mb-2">
                                        <i class="fas fa-file-invoice text-warning me-2"></i>
                                        <strong>RFC <span class="required-field">*</span></strong>
                                    </div>
                                    <input type="file" class="form-control" name="doc_rfc" accept=".pdf,.jpg,.jpeg,.png">
                                </div>
                            </div> -->

                            <!-- NSS -->
                            <!-- <div class="col-md-6">
                                <div class="document-item">
                                    <div class="d-flex align-items-center mb-2">
                                        <i class="fas fa-shield-alt text-success me-2"></i>
                                        <strong>Número de Seguro Social</strong>
                                    </div>
                                    <input type="file" class="form-control" name="doc_nss" accept=".pdf,.jpg,.jpeg,.png">
                                </div>
                            </div> -->

                            <!-- Comprobante de domicilio -->
                            <!-- <div class="col-md-6">
                                <div class="document-item">
                                    <div class="d-flex align-items-center mb-2">
                                        <i class="fas fa-home text-secondary me-2"></i>
                                        <strong>Comprobante de domicilio (máximo 3 meses) <span class="required-field">*</span></strong>
                                    </div>
                                    <input type="file" class="form-control" name="comprobante_domicilio" accept=".pdf,.jpg,.jpeg,.png">
                                </div>
                            </div> -->

                            <!-- Acta de nacimiento -->
                            <!-- <div class="col-md-6">
                                <div class="document-item">
                                    <div class="d-flex align-items-center mb-2">
                                        <i class="fas fa-certificate text-primary me-2"></i>
                                        <strong>Acta de nacimiento <span class="required-field">*</span></strong>
                                    </div>
                                    <input type="file" class="form-control" name="acta_nacimiento" accept=".pdf,.jpg,.jpeg,.png" >
                                </div>
                            </div> -->

                            <!-- Certificado o título -->
                            <!-- <div class="col-md-6">
                                <div class="document-item">
                                    <div class="d-flex align-items-center mb-2">
                                        <i class="fas fa-graduation-cap text-info me-2"></i>
                                        <strong>Certificado/título del último grado de estudios <span class="required-field">*</span></strong>
                                    </div>
                                    <input type="file" class="form-control" name="certificado_estudios" accept=".pdf,.jpg,.jpeg,.png" >
                                </div>
                            </div> -->

                            <!-- Cédula profesional -->
                            <!-- <div class="col-md-6">
                                <div class="document-item">
                                    <div class="d-flex align-items-center mb-2">
                                        <i class="fas fa-id-badge text-warning me-2"></i>
                                        <strong>Cédula profesional (si aplica)</strong>
                                    </div>
                                    <input type="file" class="form-control" name="cedula_profesional" accept=".pdf,.jpg,.jpeg,.png">
                                </div>
                            </div> -->

                            <!-- Antecedentes no penales -->
                            <!-- <div class="col-md-6">
                                <div class="document-item">
                                    <div class="d-flex align-items-center mb-2">
                                        <i class="fas fa-gavel text-danger me-2"></i>
                                        <strong>Carta de antecedentes no penales (opcional)</strong>
                                    </div>
                                    <input type="file" class="form-control" name="antecedentes_penales" accept=".pdf,.jpg,.jpeg,.png">
                                </div>
                            </div> -->

                            <!-- Cartas de recomendación -->
                            <!-- <div class="col-md-6">
                                <div class="document-item">
                                    <div class="d-flex align-items-center mb-2">
                                        <i class="fas fa-envelope text-success me-2"></i>
                                        <strong>Cartas de recomendación (opcional)</strong>
                                    </div>
                                    <input type="file" class="form-control" name="cartas_recomendacion" accept=".pdf,.jpg,.jpeg,.png" multiple>
                                </div>
                            </div> -->

                            <!-- Licencia de conducir -->
                            <!-- <div class="col-md-6">
                                <div class="document-item">
                                    <div class="d-flex align-items-center mb-2">
                                        <i class="fas fa-car text-secondary me-2"></i>
                                        <strong>Licencia de conducir (si aplica)</strong>
                                    </div>
                                    <input type="file" class="form-control" name="licencia_conducir" accept=".pdf,.jpg,.jpeg,.png">
                                </div>
                            </div>
                        </div> -->

                        <div class="d-flex justify-content-between mt-4">
                            <button type="button" class="btn btn-secondary" onclick="nextSection(2)">
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
    <script>
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
                if (!field.value.trim()) {
                    field.classList.add('is-invalid');
                    isValid = false;
                } else {
                    field.classList.remove('is-invalid');
                }
            });
            
            if (!isValid) {
                alert('Por favor complete todos los campos requeridos antes de continuar.');
            }
            
            return isValid;
        }
        
        function updateProgressBar() {
            const progress = (currentSection / 3) * 100;
            document.getElementById('progressBar').style.width = progress + '%';
        }
        
        // Validación en tiempo real
        document.addEventListener('DOMContentLoaded', function() {
            // Calcular edad automáticamente
            const fechaNacimiento = document.querySelector('input[name="fecha_nacimiento"]');
            const edad = document.querySelector('input[name="edad"]');
            
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
            
            // // Validación de CURP
            // const curpInput = document.querySelector('input[name="curp"]');
            // curpInput?.addEventListener('input', function() {
            //     this.value = this.value.toUpperCase();
            // });
            
            // // Validación de RFC
            // const rfcInput = document.querySelector('input[name="rfc"]');
            // rfcInput?.addEventListener('input', function() {
            //     this.value = this.value.toUpperCase();
            // });
        });
        
        // Envío del formulario - VERSIÓN SIMPLIFICADA
        document.getElementById('postulacionForm').addEventListener('submit', function(e) {
            e.preventDefault();
            
            if (!validateCurrentSection()) {
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
                        
                        // Volver a la primera sección
                        nextSection(1);
                        
                        // Ocultar formulario
                        $('#formularioPostulacion').hide();
                        
                        // Recargar vacantes
                        if (typeof cargarVacantesDisponibles === 'function') {
                            cargarVacantesDisponibles();
                        }
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