<div class="col-12 loader" id="loader">
  <div class="preloader" id="preloader"> </div>
</div>

<!-- tabs para movil -->
<div id="tab-button"></div>

<!-- style="max-height: 60vh" -->
<div class="row overflow-auto">
  <div class="col-12 col-xl-3 tab-first" id="tab-paciente" style="margin-right: -5px !important;">
    <div class="rounded p-3 shadow mt-2 mb-4 bg-white" id="lista-pacientes">
      <h5>Lista de pacientes</h5>

      <!-- Control de turnos -->
      <div id="turnos_panel"></div>

      <table class="table display responsive" id="TablaMuestras" style="width: 100%">
        <thead class="">
          <tr>
            <th class="all">#</th>
            <th class="all">Nombre</th>
            <th class="min-tablet">Folio</th>
            <th class="tablet">Compañia</th>
            <th class="tablet">Edad</th>
          </tr>
        </thead>
        <tbody>
        </tbody>
      </table>
    </div>
  </div>

  <div class="col-12 col-xl-3 tab-second" id="tab-informacion" style="margin-right: -5px !important;  display:none !important">
    <div class="rounded p-3 shadow my-2 bg-white" id="panel-informacion"> </div>

  </div>
  <div class="col-12 col-xl-6 tab-second" id="tab-reporte" style="margin-right: -5px !important;  display:none !important">
    <div class="rounded p-3 shadow my-2 mb-4 bg-white">
      <div class="row">
        <div class="col-12 col-lg-7">
          <h4>Estudios y contenedores</h4>
          <p class="none-p">Lista de los estudios y contenedores del pacientes</p>
        </div>
        <div class="col-12 col-lg-5 d-flex justify-content-center align-items-center">
          <button type="submit" data-attribute="guardar" class="btn btn-hover" id="muestra-tomado" style="margin-bottom:4px">
            <i class="bi bi-droplet-fill"></i> Muestra tomada
          </button>
        </div>
      </div>
      <div class="row mt-3">
        <div class="col-12">
          <h5>Estudios:</h5>
          <ul class="list-group" id="lista-estudios-paciente" style="max-width: 100%;">

          </ul>
          <div id="lista-estudios-paciente-div"></div>
        </div>
      </div>
    </div>
  </div>

  <!-- Tercera Columna visual -->
  <div id="reload-selectable">

  </div>
</div>

<style>
    #lista-estudios-paciente-div {
        max-height: 70vh; overflow-y: scroll ; margin-bottom:10px;
    }
</style>