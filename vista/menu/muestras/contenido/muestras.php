<div class="row">
  <div class="col-3 col-lg-3" style="margin-right: -5px !important;">
    <div class="card mt-3 p-3" id="lista-pacientes">
      <h4>Lista de pacientes</h4>
      <div class="text-center">
        <label for="inputBuscarTableListaNuevos">Buscar:</label>
        <input type="text" class="form-control input-color" style="display: unset !important;width:auto !important" name="inputBuscarTableListaNuevos" value="" style="width:80%" autocomplete="off" id="BuscarTablaListaMuestras">
      </div>
      <table class="table display responsive" id="TablaMuestras" style="width: 100%">
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
          <?php for ($i=0; $i < 10; $i++) {
            ?>
            <tr>
                <td>EJEMPLO</td>
                <td>EJEMPLO</td>
                <td>EJEMPLO</td>
                <td>EJEMPLO</td>
                <td>EJEMPLO</td>
            </tr>
            <?php
          } ?>
        </tbody>
      </table>
    </div>
  </div>
  <div class="col-3 col-lg-3 informacion-labo" style="margin-right: -5px !important;">
    <div class="card m-3" id="panel-informacion"> </div>
    <!-- <div class="card m-3 p-4">
      <h4>Estudios anteriores</h4>
      <div class="accordion" id="accordionResultadosAnteriores">
      </div>
    </div> -->
  </div>
  <div class="col-lg-6 informacion-labo" style="margin-right: -5px !important;">
    <div class="card mt-3 p-3">
      <div class="row">
        <div class="col-12 col-lg-7">
          <h4>Estudios y contenedores</h4>
          <p class="none-p">Lista de los estudios y contenedores del pacientes</p>
        </div>
        <div class="col-12 col-lg-5 d-flex justify-content-center align-items-center">
          <button type="submit" data-attribute="guardar" class="btn btn-hover subir-resultado-lab" style="margin-bottom:4px">
            <i class="bi bi-droplet-fill"></i> Muestra tomada
          </button>
          <button type="submit" data-attribute="confirmar" class="btn btn-hover subir-resultado-lab" style="margin-bottom:4px">
            <i class="bi bi-clipboard-x"></i> Saltar paciente
          </button>
        </div>
      </div>
      <div class="row mt-3">
        <div class="col-6">
          <h5>Estudios:</h5>
          <ul class="list-group" id="lista-estudios-paciente">
            <li class="list-group-item">An item</li>
            <li class="list-group-item">A second item</li>
            <li class="list-group-item">A third item</li>
            <li class="list-group-item">A fourth item</li>
            <li class="list-group-item">And a fifth one</li>
          </ul>
        </div>
        <div class="col-6">
          <h5>Muestras:</h5>
          <ul class="list-group" id="lista-contenedores-paciente">
            <li class="list-group-item">An item</li>
            <li class="list-group-item">A second item</li>
            <li class="list-group-item">A third item</li>
            <li class="list-group-item">A fourth item</li>
            <li class="list-group-item">And a fifth one</li>
          </ul>
        </div>
      </div>
    </div>
  </div>
  <div class="col-9 d-flex justify-content-center align-items-center" id='loaderDivLab' style="max-height: 75vh; display:none">
    <div class="preloader" id="loader-Lab"></div>
  </div>
</div>
<style media="screen">
  #TablaMuestras_filter{
    display: none
  }
</style>
