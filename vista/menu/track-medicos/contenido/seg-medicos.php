<div class="col-12 loader" id="loader">
  <div class="preloader" id="preloader"> </div>
</div>

<!-- tabs para movil -->
<div id="tab-button"></div>

<!-- style="max-height: 60vh" -->
<div class="row overflow-auto">
  <div class="col-12 col-md-4 tab-first" id="tab-paciente" style="margin-right: -5px !important;">
    <div class="rounded p-3 shadow my-2" id="lista-pacientes">
      <h5>Médicos disponibles</h5>
      <table class="table display responsive" id="TablaMedicos" style="width: 100%">
      </table>
    </div>
  </div>

  <div class="col-12 col-md-5 tab-second" id="tab-reporte" style="margin-right: -5px !important;  display:none !important;">
    <div class="rounded p-3 shadow my-2">
      <div class="m-2">
        <div class="row">
          <div class="col-12 info-detalle">
            <p id="nombre-medico">--</p>
            <p class="none-p">Correo: <strong id="correo-medico"></strong></p>
            <p class="none-p">Enviados: <strong id="enviados-medico"></strong></p>
          </div>
          <div class="col-12">
            <table class="table display responsive" id="tablaPacientesMedicos" style="width: 100%">
            </table>
          </div>
        </div>
      </div>
    </div>

  </div>
  <div class="col-12 col-md-3 tab-second overflow-auto" id="tab-informacion" style="margin-right: -5px !important;  display:none !important;max-height: 84vh;">
    <div class="rounded p-3 shadow my-2">
      <div id="panel-informacion"></div>
      <div class="panel-index" id="panel-muestras-estudios"></div>
    </div>
  </div>


  <!-- Tercera Columna visual -->
  <div id="reload-selectable">

  </div>
</div>

<style>
  .panel-index .collapse_estudio {
    background: rgb(000, 078, 89) !important;
  }

  .panel-index h4 {
    color: white !important;
  }
</style>