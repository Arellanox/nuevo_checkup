<?php
session_start();
?>

<style>
  .btn-container {
    display: flex !important;
    justify-content: center !important;
    margin-bottom: 20px !important;
  }

  .btn-container a {
    margin: -3px 15px 6px -11px !important;
    font-size: 13px !important;
  }

  .drop-zone {
    width: 392px;
    height: 85px;
    border: 2px dashed rgb(0 79 90 / 17%);
    text-align: center;
    padding: 12px;
    margin-bottom: 20px;
    border-radius: 10px;
    margin-left: 8px;
  }

  .drop-zone.hover_dropDrag {
    border-color: #00bbb9 !important;
    background-color: #c6cacc !important;
  }
</style>

<div class="col-12 loader" id="loader">
  <div class="preloader" id="preloader"> </div>
</div>
<div class="row mt-2">
  <div class="col-12 col-lg-4">
    <div class="row">
      <div class="col-auto">
        <div class="info-detalle rounded p-3 shadow-sm my-2" id="panel-informacion"> <!-- Informacion del paciente --></div>
      </div>
      <div class="col-auto">
        <div class="rounded p-3 shadow-sm my-2 mt-2" id="signos-vitales"> <!-- Signos vitales --> </div>
      </div>
      <div class="col-auto">
        <div id="crear-notas" class="rounded p-3 shadow-sm my-2 d-flex flex-column">
          <h4 class="m-3">Bloc de Notas</h4>
          <hr class="dropdown-divider m-2">
          <textarea name="name" rows="10" cols="90" class="form-textarea-content" placeholder="Escriba aqui sus notas" id="nota-historial-paciente"></textarea>
          <div class="d-flex justify-content-end p-2">
            <button type="button" class="btn btn-confirmar m-1" id="agregar-nota-historial">
              <i class="bi bi-plus"></i> Agregar
            </button>
          </div>
        </div>
      </div>
      <div class="col-auto">
        <div id="notas-historial"> <!-- Notas --> </div>
      </div>
    </div>


  </div>
  <div class="col-12 col-lg-4" style="margin-bottom:10px;">

    <div class="rounded p-3 shadow-sm my-2 mt-2" id="listado-resultados"></div>
    <div class="rounded p-3 shadow-sm my-2 mt-2 p-2" id="consultorio-conclusiones">
      <h4>Conclusiones</h4>
    </div>


    <!-- Agregar certificado medico -->
    <div class="rounded p-3 shadow-sm my-2 mt-2 p-3 medico-coordinador">

      <?php if ($_SESSION['permisos']['certificadoMedica'] == 1) : ?>
        <h4>Certificado médico del paciente</h4>
        <form id="subirResultadosCertificadoMedico" class="d-flex flex-column align-items-center">
          <div id="dropCertificadoMedico" class="drop-zone mx-2">
            <label for=file-certificado-medico" style="cursor: pointer;" class="label-certificado-medico">Sube tu
              archivo
              arrastrándolo
              aquí</label>

            <input type="file" id="certificado-medico" name="certificado-medico[]" style="display: none;">
            <br>
            <div class="spinner-border text-primary carga-certificado-medico" role="status" style="display: none;">
              <span class="visually-hidden">Loading...</span>
            </div>
          </div>
        </form>
      <?php endif; ?>

      <!-- Agregar certificado POE -->
      <?php if ($_SESSION['permisos']['certificadoPoe'] == 1) : ?>
        <h4>Certificado POE</h4>
        <form id="subirResultadosCertificadoPOE" class="d-flex flex-column align-items-center">
          <div id="dropCertificadoPOE" class="drop-zone mx-2">
            <label for=file-certificado-POE" style="cursor: pointer;" class="label-certificado-POE">Sube tu
              archivo
              arrastrándolo
              aquí</label>

            <input type="file" id="certificado-POE" name="certificado-POE[]" style="display: none;">
            <br>
            <div class="spinner-border text-primary carga-certificado-POE" role="status" style="display: none;">
              <span class="visually-hidden">Loading...</span>
            </div>
          </div>
        </form>
      <?php endif; ?>

      <!-- 
        <h4>Certificado POE</h4>
        <form id="subirResultadosCertificadoPOE">
          <div id="dropCertificadoPOE" class="drop-zone">
            <label for="file-certificado-poe[]" style="cursor: pointer;" class="label-certificado-poe">Sube tu
              archivo
              arrastrándolo
              aquí</label>

            <input type="file" id="certificado-poe" name="certificado-poe[]" style="display: none;">
            <br>
            <div class="spinner-border text-primary carga-certificado-poe" role="status" style="display: none;">
              <span class="visually-hidden">Loading...</span>
            </div>
          </div> -->
      <!-- <div class="d-flex justify-content-center">

          <div class="input-file-contenedor col-11">
            <label for="certificado-medico[]" class="form-label">Cargar Capturas</label>

            <label for="certificado-medico[]" class="input-file-label">
              <i class="bi bi-box-arrow-up"></i> Seleccione archivo(s)
            </label>
            <input type="file" name="certificado-medico[]" id="certificado-medico[]" accept=".pdf" required
              class="input-file">
          </div>
        </div> -->
      <!-- <input type="file" class="form-control input-form mt-3" name="certificado-medico[]"
                                      accept=".pdf" id="certificado-medico"> -->

      <!-- <div class="col-12 text-end">
        <button type="button" class="btn btn-hover mt-2" id="btn-subir-certificado-medico" style="font-size: 16px;">
          <i class="bi bi-file-earmark-pdf"></i> Guardar
        </button>
      </div> -->

      <!-- <button type="button" class="btn btn-borrar btnResultados" data-bs-placement="top"
            id="recuperarPDfCerticicadoMedico" style="margin: 20px 17px 20px 17px !important;font-size: 16px;">
            <i class="bi bi-file-earmark-pdf"></i> Vista previa
          </button> -->
    </div>

    <!-- Audiometría -->
    <!-- <div >
      <h4>Audiometría</h4>
      <button type="button" class="btn btn-hover me-2" style="margin: 15px 60px 10px 60px !important;font-size: 21px;"
        data-bs-toggle="modal" data-bs-target="#modalCapturaOidos">
        <i class="bi bi-ear"></i> Captura de Oidos
      </button>
    </div> -->

  </div>
  <?php if (
    $_SESSION['permisos']['histoClinico'] == 1
    || $_SESSION['permisos']['consulMedica'] == 1
    || $_SESSION['permisos']['fastCheckup'] == 1
    || $_SESSION['permisos']['historialClinicoMedico'] == 1
  ) : ?>
    <div class="col-12 col-lg-4">
      <div class="rounded p-3 shadow-sm my-2">

        <?php if ($_SESSION['permisos']['histoClinico'] == 1) : ?>
          <div id="btn-ir-consulta" class="medico-coordinador">
            <button type="button" class="btn btn-hover me-2" style="margin: 15px 60px 10px 60px !important;font-size: 21px;" data-bs-toggle="modal" data-bs-target="#modalMotivoConsulta">
              <i class="bi bi-person-plus-fill"></i> Iniciar Historia Clínica
            </button>
          </div>
        <?php endif; ?>

        <?php if ($_SESSION['permisos']['consulMedica'] == 1) : ?>
          <div id="btn-ir-consulta-medica">
            <button type="button" class="btn btn-hover me-2" style="margin: 15px 60px 10px 60px !important;font-size: 21px;" data-bs-toggle="modal" data-bs-target="#modalMotivoConsultaMedica">
              <i class="bi bi-person-plus-fill"></i> Iniciar Consulta Médica
            </button>
          </div>
        <?php endif; ?>

        <div id="btn-pdf" class="btn-container">
          <a href="#" class="btn btn-borrar btnResultados" style="display: none;" id="btn-ver-receta-consultorio2" data-bs-toggle="tooltip" data-bs-placement="top" title="La vista previa de la recetauna vez guardada">
            <i class="bi bi-file-earmark-pdf"></i> Receta
          </a>
          <a href="#" class="btn btn-borrar btnResultados" style="display: none;" id="btn-ver-solicitud-estudios-consultorio2" data-bs-toggle="tooltip" data-bs-placement="top" title="La vista previa de las solicitud de estudios una vez guardada">
            <i class="bi bi-file-earmark-pdf"></i> Solicitud de estudios
          </a>
        </div>

        <?php if ($_SESSION['permisos']['fastCheckup'] == 1) : ?>
          <div class="medico-coordinador">
            <button type="button" class="btn btn-hover me-2" style="margin: 15px 60px 10px 60px !important;font-size: 21px;" id="btn-ir-consulta-rapida">
              <i class="bi bi-clipboard-pulse"></i> Fast-Checkup
            </button>
          </div>
        <?php endif; ?>

        <?php if ($_SESSION['permisos']['historialClinicoMedico'] == 1) : ?>
          <div class="card m-3 medico-coordinador">
            <h4 class="m-3">Historial de Historia Clínica</h4>
            <!-- <hr class="dropdown-divider"> -->
            <div id="historial-consultas-paciente"> <!-- Valoracion medica --> </div>
          </div>
          <div class="card m-3">
            <h4 class="m-3">Historial de Consulta médica</h4>
            <!-- <hr class="dropdown-divider"> -->
            <div id="historial-consultas-medicas"> <!-- Consulta medica --> </div>
          </div>
        <?php endif; ?>
      </div>

    </div>
  <?php endif; ?>
</div>