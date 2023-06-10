<div class="col-12 loader" id="loader">
  <div class="preloader" id="preloader"> </div>
</div>

<!-- tabs para movil -->
<div id="tab-button"></div>

<!-- <ul class="nav nav-tabs mt-2 tab-page-table" style="display:none">
  <li class="nav-item">
    <a class="nav-link active" id="tab-btn-paciente" onclick="preventDefault();" style="cursor: pointer">Pacientes</a>
  </li>
  <li class="nav-item">
    <a class="nav-link disabled tab-select" id="tab-btn-informacion" onclick="preventDefault();" style="cursor: pointer">Información</a>
  </li>
  <li class="nav-item">
    <a class="nav-link disabled tab-select" id="tab-btn-reporte" onclick="preventDefault();" style="cursor: pointer">Reporte</a>
  </li>
</ul> -->

<!-- style="max-height: 60vh" -->
<div class="row overflow-auto">
  <div class="col-12 col-xl-3 tab-column" id="tab-paciente" style="margin-right: -5px !important;">
    <div class="card mt-3 p-3" id="lista-pacientes">
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

  <div class="col-12 col-xl-3 tab-column informacion-muestras" id="tab-informacion" style="margin-right: -5px !important;  display:none !important">
    <div class="card mt-3" id="panel-informacion"> </div>
    <!-- <div class="card m-3 p-4">
      <h4>Estudios anteriores</h4>
      <div class="accordion" id="accordionResultadosAnteriores">
      </div>
    </div> -->
  </div>
  <div class="col-12 col-xl-6 tab-column informacion-muestras" id="tab-reporte" style="margin-right: -5px !important;  display:none !important">
    <div class="card mt-3 p-3">
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
          <ul class="list-group overflow-auto" id="lista-estudios-paciente" style="max-width: 100%; max-height: 70vh;margin-bottom:10px;">
            <!-- <li class="list-group-item">
              GRUPO DE EXAMEN - SERVICIO
              <br>
              <i class="bi bi-arrow-return-right"></i> MUESTRA - CONTENEDOR
            </li> -->
          </ul>
        </div>
      </div>
    </div>
  </div>

  <div class="col-12 col-xl-9 d-flex justify-content-center align-items-center" id='loaderDivmuestras' style="max-height: 75vh; display:none">
    <div class="preloader" id="loader-muestras"></div>
  </div>
</div>

<script>
  autoHeightDiv('#vista-valoracion', 157);
</script>