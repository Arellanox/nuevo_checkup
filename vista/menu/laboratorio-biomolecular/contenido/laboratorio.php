<div class="col-12 loader" id="loader">
  <div class="preloader" id="preloader"> </div>
</div>
<div class="row">
  <div class="col-4 col-lg-3 col-xxl-3" style="margin-right: -5px !important;">
    <div class="card mt-3 p-3" id="lista-pacientes">
      <h4>Lista de pacientes</h4>

      <div class="text-center mt-2">
        <div class="input-group flex-nowrap">
          <input type="search" class="form-control input-color" aria-controls="TablaEstatusTurnos" style="display: unset !important; margin-left: 0px !important" name="inputBuscarTableListaNuevos" placeholder="Filtrar coincidencias" id="BuscarTablaListaLaboratorio" data-bs-toggle="tooltip" data-bs-placement="top" title="Filtra la lista por coincidencias">
          <span class="input-group-text" id="addon-wrapping" data-bs-toggle="tooltip" data-bs-placement="top" title="Una vez confirmado el reporte, el registro se dibujará en verde">
            <i class="bi bi-info-circle"></i>
          </span>

        </div>
      </div>
      <!-- <div class="text-center">
        <label for="inputBuscarTableListaNuevos">Buscar:</label>
        <input type="text" class="form-control input-color" style="display: unset !important;width:auto !important" name="inputBuscarTableListaNuevos" value="" style="width:80%" autocomplete="off" id="BuscarTablaListaLaboratorio" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Filtra la lista de pacientes">
      </div> -->
      <table class="table display responsive" id="TablaLaboratorio" style="width: 100%; zoom: 90%">
        <thead class="">
          <tr>
            <th scope="col d-flex justify-content-center" class="all">#</th>
            <th scope="col d-flex justify-content-center" class="all">Nombre</th>
            <th scope="col d-flex justify-content-center" class="min-tablet">Prefolio</th>
            <th scope="col d-flex justify-content-center" class="none">Cliente</th>
            <th scope="col d-flex justify-content-center" class="none">Segmento</th>
            <th scope="col d-flex justify-content-center" class="none">Turno</th>
            <th scope="col d-flex justify-content-center" class="none">Sexo</th>
            <th scope="col d-flex justify-content-center" class="none">Expendiente</th>
          </tr>
        </thead>
        <tbody>
        </tbody>
      </table>
    </div>
  </div>
  <div class="col-4 col-lg-4 col-xxl-4 informacion-labo" style="margin-right: -5px !important;display:none">
    <div class="card mt-3" id="panel-informacion"> </div>
    <!-- <div class="card mt-3 p-4">
      <h4>Estudios anteriores</h4>
      <div class="accordion" id="accordionResultadosAnteriores">
      </div>
    </div> -->
  </div>
  <div class="col-lg-5 col-xxl-5 informacion-labo" style="margin-right: -5px !important;display:none">
    <div class="card mt-3 p-3">
      <div class="row">
        <div class="col-12 col-lg-6">
          <h4>Formulario de resultados</h4>
          <p class="none-p">Estudios cargados del paciente </p>
        </div>
        <div class="col-12 col-lg-6 d-flex justify-content-end align-items-start">
          <button type="button" data-attribute="guardar" class="btn btn-hover subir-resultado-lab" style="margin-bottom:4px" data-bs-toggle="tooltip" data-bs-placement="top" title="Guarde su progreso">
            <i class="bi bi-clipboard2-pulse"></i> Guardar
          </button>
          <button type="button" data-attribute="confirmar" class="btn btn-confirmar subir-resultado-lab" style="margin-bottom:4px" data-bs-toggle="tooltip" data-bs-placement="top" title="Reporte como N/A para ocultar el reporte : )">
            <i class="bi bi-clipboard2-pulse"></i> Confirmar
          </button>
          <button type="submit" form="formAnalisisLaboratorio" data-attribute="confirmar" id="btnConfirmarResultados" class="btn btn-hover" style="margin-bottom:4px; display: none;" disabled="">
            <i class="bi bi-clipboard2-pulse"></i> submit
          </button>
        </div>
      </div>
      <form class="" id="formAnalisisLaboratorio">

        <div id="formulario-estudios" class="overflow-auto" style="max-width: 100%; margin-bottom:10px;">

        </div>
      </form>
    </div>
  </div>
  <script>
    autoHeightDiv($('#formulario-estudios'), 223);
    autoHeightDiv($('#'), 117);
  </script>
  <style media="screen">
    #TablaLaboratorio_filter {
      display: none
    }

    li:first-child {
      border-top-left-radius: 10px !important;
      border-top-right-radius: 10px !important;
    }

    li:last-child {
      border-bottom-left-radius: 10px !important;
      border-bottom-right-radius: 10px !important;
    }
  </style>
  <div class="col-4 col-lg-8 col-xxl-9 d-flex justify-content-center align-items-center" id='loaderDivLab' style="max-height: 75vh; display:none">
    <div class="preloader" id="loader-Lab"></div>
  </div>
</div>