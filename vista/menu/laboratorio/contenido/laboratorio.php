<div class="col-12 loader" id="loader" style="">
  <div class="preloader" id="preloader"> </div>
</div>
<div class="row">
  <div class="col-3 col-lg-3" style="margin-right: -5px !important;">
    <div class="card mt-3 p-3" id="lista-pacientes">
      <h4>Lista de pacientes</h4>
      <div class="text-center">
        <label for="inputBuscarTableListaNuevos">Buscar:</label>
        <input type="text" class="form-control input-color" style="display: unset !important;width:auto !important" name="inputBuscarTableListaNuevos" value="" style="width:80%" autocomplete="off" id="BuscarTablaListaLaboratorio">
      </div>
      <table class="table display responsive" id="TablaLaboratorio" style="width: 100%">
        <thead class="">
          <tr>
            <th scope="col d-flex justify-content-center" class="all">#</th>
            <th scope="col d-flex justify-content-center" class="all">Nombre</th>
            <th scope="col d-flex justify-content-center" class="min-tablet">Folio</th>
            <th scope="col d-flex justify-content-center" class="none">Compañia</th>
            <th scope="col d-flex justify-content-center" class="none">Edad</th>
          </tr>
        </thead>
        <tbody>
        </tbody>
      </table>
    </div>
  </div>
  <div class="col-3 col-lg-3 informacion-labo" style="margin-right: -5px !important;display:none">
    <div class="card m-3" id="panel-informacion"> </div>
    <div class="card m-3 p-4">
      <h4>Estudios anteriores</h4>
      <div class="accordion" id="accordionResultadosAnteriores">
      </div>
    </div>
  </div>
  <div class="col-lg-6 informacion-labo" style="margin-right: -5px !important;display:none">
    <div class="card mt-3 p-3">
      <div class="row">
        <div class="col-12 col-lg-7">
          <h4>Formulario de resultados</h4>
          <p class="none-p">Estudios a subir</p>
        </div>
        <div class="col-12 col-lg-5 d-flex justify-content-center align-items-center">
          <button type="submit" form="formAnalisisLaboratorio" data-attribute="guardar" class="btn btn-hover subir-resultado-lab" style="margin-bottom:4px" >
            <i class="bi bi-clipboard2-pulse"></i> Guardar
          </button>
          <button type="submit" form="formAnalisisLaboratorio" data-attribute="confirmar" class="btn btn-hover subir-resultado-lab" style="margin-bottom:4px">
            <i class="bi bi-clipboard2-pulse"></i> Confirmar
          </button>
        </div>
      </div>
      <form class="" id="formAnalisisLaboratorio">
        <ul class="list-group m-4 overflow-auto hover-list info-detalle" style="max-width: 100%; max-height: 70vh;margin-bottom:10px;" id="list-group-form-resultado-laboro">

        </ul>
      </form>
    </div>
  </div>
  <style media="screen">
    #TablaLaboratorio_filter{
      display: none
    }
  </style>
  <div class="col-9 d-flex justify-content-center align-items-center" id='loaderDivLab' style="max-height: 75vh; display:none">
    <div class="preloader" id="loader-Lab"></div>
  </div>
</div>
