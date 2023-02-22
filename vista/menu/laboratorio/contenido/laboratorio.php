<div class="col-12 loader" id="loader" style="">
  <div class="preloader" id="preloader"> </div>
</div>
<div class="row">
  <div class="col-4 col-lg-3 col-xxl-3" style="margin-right: -5px !important;">
    <div class="card mt-3 p-3" id="lista-pacientes">
      <h4>Lista de pacientes</h4>
      <div class="text-center">
        <label for="inputBuscarTableListaNuevos">Buscar:</label>
        <input type="text" class="form-control input-color" style="display: unset !important;width:auto !important" name="inputBuscarTableListaNuevos" value="" style="width:80%" autocomplete="off" id="BuscarTablaListaLaboratorio" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Filtra la lista de pacientes">
      </div>
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
    <div class="card mt-3 p-4">
      <h4>Estudios anteriores</h4>
      <div class="accordion" id="accordionResultadosAnteriores">
      </div>
    </div>
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
          <!-- <p class="mt-3">BIOMETRIA HEMATICA</p> -->
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
<a href="#" class="btn-flotante" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"><i class="bi bi-question-diamond"></i></a>


<div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel">
  <div class="d-flex flex-column flex-shrink-0 p-3 text-white bg-navbar" style="width: 100%;height:100%">
    <div class="offcanvas-header">
      <div class="d-flex align-items-center mb-md-0 me-md-auto text-white text-decoration-none">
        <img src="https://www.bimo-lab.com/archivos/sistema/LogoConFondoAppAndroid.png" style="height: 36px;margin-right: 20px;" />
        <span class="fs-4" style="font-family: 'Shantell Sans', cursive;">¡Buenos dias!</span>
      </div>
      <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <hr>
    <span class="fs-4 text-center" style="font-family: 'Shantell Sans', cursive;">Feliz Cumpleaños Aurora <i class="bi bi-balloon-heart-fill"></i></span>
    <hr>
    <div class="" style="font-size: 15px; margin-bottom: 40px; font-family: 'Shantell Sans', cursive;">
      La area que mas amas te desea un gran y feliz cumpleaños <i class="bi bi-heart-fill"></i>, muchas felicidades
      te deseamos otro año juntos sin más f̡̢̧̛̀́̕͘à̡̢̧̛́̕͘l̡̢̛̀́̕͘l̡̢̛̀́̕͘à̡̢̛́̕͘s̡̛̀́̕͘ è̛́̕͘ǹ̛́̕͘ è̛́̕l̛̀́̕ s̛̀̕ì̛̕s̛̕t̛̕e̕m̕a̕ que debas soportar :)
    </div>


    <iframe width="100%" height="35.2%" src="https://www.youtube-nocookie.com/embed/6k8cpUkKK4c?controls=0" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
  </div>
</div>




<style>
  .btn-flotante {

    color: #ffffff;
    /* Color del texto */
    border-radius: 5px;
    /* Borde del boton */
    letter-spacing: 2px;
    /* Espacio entre letras */
    background-color: #E91E63;
    /* Color de fondo */
    padding: 7px 10px 7px 10px;
    /* Relleno del boton */
    position: fixed;
    bottom: 40px;
    right: 40px;
    transition: all 300ms ease 0ms;
    box-shadow: 0px 8px 15px rgba(0, 0, 0, 0.1);
    z-index: 99;
  }

  .btn-flotante:hover {
    background-color: #2c2fa5;
    /* Color de fondo al pasar el cursor */
    box-shadow: 0px 15px 20px rgba(0, 0, 0, 0.3);
    transform: translateY(-7px);
  }

  @media only screen and (max-width: 600px) {
    .btn-flotante {
      font-size: 14px;
      padding: 7px 10px 7px 10px;
      bottom: 20px;
      right: 20px;
    }
  }
</style>