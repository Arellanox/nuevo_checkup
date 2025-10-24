<div class="col-12 loader" id="loader">
  <div class="preloader" id="preloader"> </div>
</div>


<div class="row">
  <!-- <div class="col-12 col-xl-3 info-detalle">
    <div class="rounded p-3 shadow-sm my-2 tab-second" id="tab-informacion-espera" style="display:none !important">
      <div id="panel-informacion"></div>
    </div>
  </div> -->

  <div class="col-12 col-xl-12" id="tab-paciente-espera">
    <div class="px-4">
      <!-- Iconos -->
      <div class="row d-flex justify-content-center">
        <div class="col-6 col-lg-auto">
          <div class="rounded p-3 shadow-sm my-2 card_franquicias btn-agregar_paciente bg-white" data-bs-type="1">
            <div class="d-flex align-items-center card_botones_menu">
              <!-- Icono -->
              <img src="../../../css/icons/franquicias/ciencia/icon_2.svg" alt="Icono" class="me-3 icon_btn"
                style="width: 40px; height: 40px;">
              <!-- Título con span -->
              <h5 class="card-title mb-0"><span>Nuevo Paciente</span></h5>

            </div>
          </div>
        </div>

        <div class="col-6 col-lg-auto">
          <div class="rounded p-3 shadow-sm my-2 card_franquicias btn-agregar_paciente bg-white" data-bs-type="2">
            <div class="d-flex align-items-center card_botones_menu">
              <!-- Icono -->
              <img src="../../../css/icons/franquicias/ciencia/icon_3.svg" alt="Icono" class="me-3 icon_btn"
                style="width: 40px; height: 40px;">
              <!-- Título con span -->
              <h5 class="card-title mb-0"><span>Nueva Solicitud</span></h5>

            </div>
          </div>
        </div>

        <div class="col-6 col-lg-auto">
          <div class="rounded p-3 shadow-sm my-2 card_franquicias bg-white" id="btn-envio_muestras">
            <div class="d-flex align-items-center card_botones_menu">
              <!-- Icono -->
              <img src="../../../css/icons/franquicias/ciencia/icon_1.svg" alt="Icono" class="me-3 icon_btn"
                style="width: 40px; height: 40px;">
              <!-- Título con span -->
              <h5 class="card-title mb-0"><span>Envío de Muestras</span></h5>

            </div>
          </div>
        </div>

        <div class="col-6 col-lg-auto">
          <div class="rounded p-3 shadow-sm my-2 card_franquicias bg-white" id="btn-muestras_enviadas">
            <div class="d-flex align-items-center card_botones_menu">
              <!-- Icono -->
              <img src="../../../css/icons/franquicias/ciencia/icon_4.svg" alt="Icono" class="me-3 icon_btn"
                style="width: 40px; height: 40px;">
              <!-- Título con span -->
              <h5 class="card-title mb-0"><span>Lotes Enviados</span></h5>

            </div>
          </div>
        </div>


      </div>

      <div class="rounded p-3 shadow-sm my-2 table-responsive bg-white">
          <!--
            <div class="text-center" style="margin-top:4px;">
                <button type="button" class="btn btn-hover me-2" style="margin-bottom:4px" id="btn-aceptar"
                   data-bs-toggle="tooltip" data-bs-placement="top" title="Carga una solicitud de estudios">
                   <i class="bi bi-check"></i> Aceptar paciente
                 </button>
                 <button type="button" class="btn btn-hover me-2" style="margin-bottom:4px" id="btn-rechazar"
                   data-bs-toggle="tooltip" data-bs-placement="top" title="Rechaza/Elimina este registro">
                   <i class="bi bi-x"></i> Rechazar paciente
                 </button>
                <button type="button" class="btn btn-hover me-2" style="margin-bottom:4px; display: none;"
                  data-bs-toggle="modal" style="display: none;" data-bs-target="#ModalBeneficiario" id="buttonBeneficiario"
                  data-bs-toggle="tooltip" data-bs-placement="top" title="Agregué información de pacientes de la UJAT">
                  <i class="bi bi-save"></i> Beneficiario
                </button>
            </div>
        -->
          <table class="table table-hover display responsive" id="tablaPacientes" style="width: 100%;">

          </table>
      </div>

    </div>
  </div>
</div>


<style>
  .drop-zone {
    width: 100%;
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


  @media (max-width: 500px) {
    .icon_btn {
      height: 25px !important;
      width: 25px !important;
    }

    .card_botones_menu span {
      font-size: 20px !important;
    }
  }
</style>