<div class="col-12 loader" id="loader" style="">
  <div class="preloader" id="preloader"> </div>
</div>
<div class="row">
  <div class="col-3 col-lg-3" style="margin-right: -5px !important;">
    <div class="card mt-3 p-3" id="lista-pacientes">
      <h4>Lista de pacientes</h4>
      <div class="text-center">
        <label for="inputBuscarTableListaNuevos">Buscar:</label>
        <input type="text" class="form-control input-color" style="display: unset !important;width:auto !important" name="inputBuscarTableListaNuevos" value="" style="width:80%" id="BuscarTablaListaLaboratorio">
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
        <div class="accordion-item bg-acordion">
          <h2 class="accordion-header" id="collap-historial-estudios2">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-estudio2-Target" aria-expanded="false" aria-controls="accordionEstudios">
              <div class="row">
                <div class="col-12">
                  <i class="bi bi-calendar3"></i> &nbsp;&nbsp;&nbsp; Fecha: <strong>xx/xx/2000</strong> <strong>12:00</strong>
                </div>
                <div class="col-12">
                  <i class="bi bi-box-seam"></i> &nbsp;&nbsp;&nbsp; Cargado: <strong>@Usuario que confirmó</strong>
                </div>
              </div>
            </button>
          </h2>
          <div id="collapse-estudio2-Target" class="accordion-collapse collapse" aria-labelledby="collap-historial-estudios2">
            <div class="accordion-body">
              <div class="row">
                <div class="col-6 text-end info-detalle">
                  <p>Estudio 1:</p>
                </div>
                <div class="col-6">*Resultado*</div>
                <div class="col-6 text-end info-detalle">
                  <p>Estudio 2:</p>
                </div>
                <div class="col-6">*Resultado*</div>
                <div class="col-6 text-end info-detalle">
                  <p>Estudio 3:</p>
                </div>
                <div class="col-6">
                  <a href="#">*Resultado*</a>
                </div>
                <div class="col-6 text-end info-detalle">
                  <p>Estudio 4:</p>
                </div>
                <div class="col-6">*Resultado*</div>
                <div class="col-6 text-end info-detalle">
                  <p>Estudio 5:</p>
                </div>
                <div class="col-6">*Resultado*</div>
              </div>
            </div>
          </div>
        </div>
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
          <button type="button" class="btn btn-hover" style="margin-bottom:4px" data-bs-toggle="modal" data-bs-target="#ModalRegistrarCliente">
            <i class="bi bi-clipboard2-pulse"></i> Guardar
          </button>
          <button type="button" class="btn btn-hover" style="margin-bottom:4px" data-bs-toggle="modal" data-bs-target="#ModalRegistrarCliente">
            <i class="bi bi-clipboard2-pulse"></i> Confirmar
          </button>
        </div>
      </div>
      <ul class="list-group m-4 overflow-auto hover-list info-detalle" style="max-width: 100%; max-height: 70vh;margin-bottom:10px;">
        <li class="list-group-item" id="formulario-estudios-pacientes">
          <div class="row d-flex align-items-center">
            <div class="col-auto col-lg-6">
              <p><i class="bi bi-box-arrow-in-right" style=""></i> Estudio</p>
            </div>
            <div class="col-auto col-lg-6 d-flex justify-content-end align-items-center">
              <input type="text" class="form-control input-form" name="estudio1" placeholder="'Medida del estudio'" required>
            </div>
          </div>
        </li>
      </ul>
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
