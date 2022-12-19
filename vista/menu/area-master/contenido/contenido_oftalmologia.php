<!-- <div class="col-12 loader" id="loader" style="">
  <div class="preloader" id="preloader"> </div>
</div> -->
<div class="row">
  <div class="card col-12 col-lg-3 pt-4">
    <div class="" id="panel-informacion">

    </div>
    <div class="" id="panel-resultadosMaster">
      <!-- <p class="none-p">Aqui irán sus resultados para poder visualizarlos</p> -->
    </div>
  </div>
  <div class="card col-12 col-lg-9" style="margin-bottom:5px">
    <div class="text-center" style="margin-top:4px;zoom:95%;margin-bottom:5px;">
      <button type="button" class="btn btn-hover me-2" style="margin-bottom:4px" id="btn-analisis-pdf">
        <i class="bi bi-clipboard2-plus"></i> Subir interpretación
      </button>
      <button type="button" class="btn btn-hover me-2" style="margin-bottom:4px" id="btn-capturas-pdf">
        <i class="bi bi-clipboard2-plus"></i> Guardar capturas
      </button>
      <button type="button" class="btn btn-hover me-2" style="margin-bottom:4px" id="btn-analisis-oftalmo">
        <i class="bi bi-clipboard2-plus"></i> Subir resultados 2
      </button>
    </div>
    <table class="table table-hover display responsive tableContenido" id="TablaContenidoResultados" style="width: 100%">
      <thead class="" style="width: 100%">
        <tr>
          <th scope="col d-flex justify-content-center" class="all">#</th>
          <th scope="col d-flex justify-content-center" class="all">Nombre</th>
          <th scope="col d-flex justify-content-center" class="min-tablet">Prefolio</th>
          <th scope="col d-flex justify-content-center" class="min-tablet">Procedencia</th>
          <th scope="col d-flex justify-content-center" class="min-tablet">Edad</th>
          <th scope="col d-flex justify-content-center" class="min-tablet">Sexo</th>
        </tr>
      </thead>
      <tbody>
      </tbody>
    </table>
  </div>
</div>


<div class="col-12 loader" id="loader">
  <div class="preloader" id="preloader"> </div>
</div>
<div class="row">
  <div class="col-3 col-lg-3" style="margin-right: -5px !important;">
    <div class="card mt-3 p-3" id="lista-pacientes">
      <h4>Lista de pacientes</h4>
      <div class="text-center">
        <label for="inputBuscarTableListaNuevos">Buscar:</label>
        <input type="text" class="form-control input-color" style="display: unset !important;width:auto !important" name="inputBuscarTableListaNuevos" value="" style="width:80%" autocomplete="off" id="BuscarTablaListaMuestras">
      </div>
      <table class="table table-hover display responsive tableContenido" id="TablaContenidoResultados" style="width: 100%">
        <thead class="" style="width: 100%">
          <tr>
            <th scope="col d-flex justify-content-center" class="all">#</th>
            <th scope="col d-flex justify-content-center" class="all">Nombre</th>
            <th scope="col d-flex justify-content-center" class="min-tablet">Prefolio</th>
            <th scope="col d-flex justify-content-center" class="min-tablet">Procedencia</th>
            <th scope="col d-flex justify-content-center" class="min-tablet">Edad</th>
            <th scope="col d-flex justify-content-center" class="min-tablet">Sexo</th>
          </tr>
        </thead>
        <tbody>
        </tbody>
      </table>
    </div>
  </div>
  <div class="col-3 col-lg-3 informacion-muestras" style="margin-right: -5px !important;display:none">
    <div class="card m-3" id="panel-informacion"> </div>
    <!-- <div class="card m-3 p-4">
      <h4>Estudios anteriores</h4>
      <div class="accordion" id="accordionResultadosAnteriores">
      </div>
    </div> -->
  </div>
  <div class="col-lg-6 informacion-muestras" style="margin-right: -5px !important;display:none">
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
          <button type="submit" data-attribute="confirmar" class="btn btn-hover" id="omitir-paciente" style="margin-bottom:4px">
            <i class="bi bi-clipboard-x"></i> Saltar paciente
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
  <div class="col-9 d-flex justify-content-center align-items-center" id='loaderDivmuestras' style="max-height: 75vh; display:none">
    <div class="preloader" id="loader-muestras"></div>
  </div>
</div>