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
    <p class="categoria_paciente">Categoría: <strong class="none-p" id="info-categoria_cargado"></strong></p>
    <p class="vendedor">Vendedor: <strong class="none-p" id="info-vendedor"></strong></p>
    <p class="vendedor">Medico tratante: <strong class="none-p" id="info-medico-tratante"></strong></p>
  </div>
</div>
<div class="row mt-3">
  <div class="col-5 text-end info-detalle">
    <p>Procedencia:</p>
  </div>
  <div class="col-7" id="info-paci-procedencia"></div>
  <div class="col-5 text-end info-detalle">
    <p>Entregar por:</p>
  </div>
  <div class="col-7" id="info-paci-metodo-entrega"></div>
  <div class="col-5 text-end info-detalle">
    <p>Alergias:</p>
  </div>
  <div class="col-7 fw-bold text-danger text-decoration-underline" id="info-paci-alergias"></div>
  <div class="col-5 text-end info-detalle">
    <p>CURP:</p>
  </div>
  <div class="col-7" id="info-paci-curp"></div>
  <div class="col-5 text-end info-detalle">
    <p>Nacionalidad:</p>
  </div>
  <div class="col-12" id="info-paci-naciondalidad"></div>
  <div class="col-5 text-end info-detalle">
    <p>Teléfono:</p>
  </div>
  <div class="col-7" id="info-paci-telefono"></div>
  <div class="col-5 text-end info-detalle">
      <p>Teléfono 2:</p>
  </div>
  <div class="col-7" id="info-paci-telefono-2"></div>
  <div class="col-5 text-end info-detalle">
    <p>Correo:</p>
  </div>
  <div class="col-12">
    <a href="#" id="info-paci-correo"></a>
  </div>
  <div class="col-5 text-end info-detalle">
      <p>Correo 2:</p>
  </div>
  <div class="col-12">
      <a href="#" id="info-paci-correo-2"></a>
  </div>
  <div class="col-5 text-end info-detalle">
    <p>Sexo:</p>
  </div>
  <div class="col-7" id="info-paci-sexo"></div>
  <div class="col-5 text-end info-detalle">
    <p>Turno:</p>
  </div>
  <div class="col-7" id="info-paci-turno"></div>
  <div class="col-5 text-end info-detalle">
    <p>Prefolio:</p>
  </div>
  <div class="col-7" id="info-paci-prefolio"></div>
</div>
<div class="row d-flex justify-content-center categoria_paciente " style="display: none !important;">
  <div class="col-10">
    <input type="text" class="form-control input-form text-center" id="categoria_paciente_input"
      placeholder="¡Escriba la categoría del paciente!">
  </div>
  <div class="col-11 d-flex justify-content-end align-items-start">
    <button type="button" id="paciente_categoria" class="btn btn-confirmar" style="margin-bottom:4px"
      data-bs-toggle="tooltip" data-bs-placement="top"
      data-bs-original-title="Guarda su categoría para reportar en todos los reportes">
      <i class="bi bi-clipboard2-pulse"></i> Guardar
    </button>
  </div>
</div>
<div class="row mt-2 d-flex justify-content-center">
  <a class="btn btn-hover" style="width:95%" data-bs-toggle="collapse" data-bs-target="#barra-informacion"
    aria-expanded="false">
    Más información <i class="bi bi-arrow-down-short"></i>
  </a>
  <div class="collapse row" id="barra-informacion">
    <div class="text-center info-detalle">
      <p>Directorio:</p>
    </div>
    <div class="col-12 text-center" id="info-paci-directorio"></div>
    <div class="text-center info-detalle">
      <p>Diagnóstico:</p>
    </div>
    <div class="col-12 text-center fw-bold text-decoration-underline pantone-3165-color" id="info-paci-diagnostico">
    </div>
    <div class="text-center info-detalle">
      <p>Comentario:</p>
    </div>
    <div class="col-12 text-center fw-bold text-decoration-underline pantone-3165-color" id="info-paci-comentario">
    </div>
    <div class="col-6 text-center info-detalle">
      <p>Aceptado:</p>
    </div>
    <div class="col-6 text-center info-detalle">
      <p>Reagendado:</p>
    </div>
    <div class="col-6 text-center" id="info-paci-recepcion"></div>
    <div class="col-6 text-center" id="info-paci-reagenda"></div>
  </div>
</div>