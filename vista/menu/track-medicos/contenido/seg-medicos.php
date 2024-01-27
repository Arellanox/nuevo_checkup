<div class="col-12 loader" id="loader">
  <div class="preloader" id="preloader"> </div>
</div>

<!-- tabs para movil -->
<div id="tab-button"></div>

<!-- style="max-height: 60vh" -->
<div class="row overflow-auto">
  <div class="col-12 col-xl-3 tab-first" id="tab-paciente" style="margin-right: -5px !important;">
    <div class="rounded p-3 shadow my-2" id="lista-pacientes">
      <h5>Médicos disponibles</h5>
      <table class="table display responsive" id="TablaMedicos" style="width: 100%">
      </table>
    </div>
  </div>

  <div class="col-12 col-xl-3 tab-second" id="tab-informacion" style="margin-right: -5px !important;  display:none !important">
    <div class="rounded p-3 shadow my-2" id="panel-informacion">
      <!-- Detalle del medico, información de ellos -->
    </div>
  </div>
  <div class="col-12 col-xl-6 tab-second" id="tab-reporte" style="margin-right: -5px !important;  display:none !important">
    <div class="rounded p-3 shadow my-2">
      <div class="row">
        <div class="col-12 col-lg-7">
          <h4>Estudios y contenedores</h4>
          <p class="none-p">Lista de los estudios y contenedores del pacientes</p>
        </div>
      </div>
      <div class="row mt-3">
        <div class="col-12">
          <h5>Estudios:</h5>
          <table class="table display responsive" id="tablaPacientesMedicos" style="width: 100%">
          </table>
        </div>
      </div>
    </div>
  </div>


  <!-- Tercera Columna visual -->
  <div id="reload-selectable">

  </div>
</div>