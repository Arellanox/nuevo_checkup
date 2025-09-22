<div class="row">
  <div class="col-3">
    <img src="https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460_960_720.png" alt="perfil"
      class="imagen-perfil">
  </div>
  <div class="col-9 info-detalle">
    <p id="nombre-persona"></p>
    <p class="none-p"> <strong id="edad-persona" class="none-p"></strong> | <strong id="nacimiento-persona"
        class="none-p"></strong> </p>
    <p>Paquete: <strong class="none-p" id="info-paquete_cargado"></strong></p>
    <p class="categoria_paciente">categoría: <strong class="none-p" id="info-categoria_cargado"></strong></p>
    <p class="vendedor">Vendedor: <strong class="none-p" id="info-vendedor"></strong></p>

  </div>
</div>
<div class="row mt-3">
  <div class="col-6  text-end info-detalle">
    <p>Procedencia:</p>
  </div>
  <div class="col-6" id="info-paci-procedencia"></div>
  <div class="col-6 text-end info-detalle">
    <p>Alergias:</p>
  </div>
  <div class="col-6 fw-bold text-danger text-decoration-underline" id="info-paci-alergias"></div>
  <div class="col-6 text-end info-detalle">
    <p>Turno:</p>
  </div>
  <div class="col-6" id="info-paci-turno"></div>
  <div class="col-6 text-end info-detalle">
    <p>Sexo:</p>
  </div>
  <div class="col-6" id="info-paci-sexo"></div>

  <div class="col-12 text-center info-detalle">
    <p>Diagnóstico:</p>
  </div>
  <div class="col-12 text-center  fw-bold text-decoration-underline pantone-3165-color" id="info-paci-diagnostico">
  </div>

  <div class="col-12 text-center info-detalle">
    <p>Comentario recepción:</p>
  </div>
  <div class="col-12 text-center fw-bold text-decoration-underline pantone-3165-color" id="info-paci-comentario"></div>

  <div class="col-12 text-center info-detalle" id="info-paci-comentario-tecnico-text" style="display: none">
     <p>Comentario Tecnico:</p>
  </div>
  <div class="col-12 text-center fw-bold text-decoration-underline pantone-3165-color" id="info-paci-comentario-tecnico-content" style="display: none">
      <div id="info-paci-comentario-tecnico-text--text">

      </div>
      <?php
        session_start();
        if($_SESSION['permisos']["RepImRX"] == 1):
      ?>
        <div style="width: 100%">
            <textarea class="form-control" id="comentarioTecnicoText" style="width: 100%; margin-bottom: 10px; margin-top: 10px"></textarea>
            <button class="btn btn-confirmar" id="guardarComentarioTecnico" style="width: 100%; margin-bottom: 10px; ">Guardar</button>
        </div>
      <?php endif; ?>
  </div>

  <div class="col-12 text-center info-detalle">
    <p>Órdenes Médicas</p>
  </div>
  <div class="col-12">
    <div class="row text-center mt-2" id="contenedor-btn-ordenes-medicas">

    </div>
  </div>
</div>
<div class="row mt-2 d-flex justify-content-center">
  <a class="btn btn-hover" style="width:95%" data-bs-toggle="collapse" data-bs-target="#barra-informacion"
    aria-expanded="false">
    Más información <i class="bi bi-arrow-down-short"></i>
  </a>
  <div class="collapse row" id="barra-informacion">
    <div class="col-4 text-end info-detalle">
      <p>CURP:</p>
    </div>
    <div class="col-8" id="info-paci-curp"></div>
    <div class="col-4 text-end info-detalle">
      <p>NACIONALIDAD:</p>
    </div>
    <div class="col-8" id="info-paci-naciondalidad"></div>
    <div class="col-4 text-end info-detalle">
      <p>Teléfono:</p>
    </div>
    <div class="col-8" id="info-paci-telefono"></div>
    <div class="col-4 text-end info-detalle">
      <p>Correo:</p>
    </div>
    <div class="col-8">
      <a href="#" id="info-paci-correo"></a>
    </div>
    <div class="col-4 text-end info-detalle">
      <p>Prefolio:</p>
    </div>
    <div class="col-8" id="info-paci-prefolio"></div>
    <div class="col-5 text-end info-detalle">
      <p>Directorio:</p>
    </div>
    <div class="col-7" id="info-paci-directorio"></div>
  </div>
</div>