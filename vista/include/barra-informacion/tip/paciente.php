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
    <div id="div-mostrar-comentario">
      <div class="col-12 text-center fw-bold text-decoration-underline pantone-3165-color" id="info-paci-diagnostico">
      </div>
      <div class="text-center info-detalle">
        <p>Comentario:
          <button 
            class="btn btn-sm btn-link p-0"
            id="btn-editar-comentario2"
            data-bs-toggle="tooltip"
            title="Editar comentario">
            <i class="bi bi-pencil-square"></i>
          </button>
        </p>
       
      </div>
      <div class="col-12 text-center fw-bold text-decoration-underline pantone-3165-color" id="info-paci-comentario">
        Sin comentarios...
      </div>
    </div>
    <!-- EDITAR COMENTARIO -->
    <div id="div-editar-comentario" style="display: none;">
      <p>Estás editando el comentario...</p>
      <input type="text" class="input-form" name="modificarComent" id="modificarComent">
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

<script>
  $("#btn-editar-comentario2").on("click", function(){
    var comentarioOld = $("#info-paci-comentario").html();
    $("#div-editar-comentario").fadeIn(400);
    $("#div-mostrar-comentario").fadeOut(400);
    $("#modificarComent").val(comentarioOld);
  })

  // Detectamos el Enter en el cuadro de texto.
  $("#modificarComent").on("keypress", function(e) {
        if (e.which == 13) { // 13 es el código de la tecla Enter
            var nuevoComentario = $(this).val();
            alertMensajeConfirm({
                title: '¿Confirma que quiere modificar el comentario?',
                text: '¡El cambio se reflejará en todas la áreas!',
                icon: 'warning',
                confirmButtonText: 'Sí, estoy seguro'
            }, function () {
                //envio de datos (factura y tipo de pago_datos)
                let dataJson = {
                    api: 26, 
                    id_turno: array_selected['ID_TURNO'],
                    comentario:nuevoComentario
                }

                ajaxAwait(dataJson, "recepcion_api", {callbackAfter: true}, false, (data) => {
                  // logica de negocios para el cambio/actualizacion de comentario
                  if(data.response.code == 1){
                     alertToast("Comentario actualizado!", 'success', 5000)
                    // ocultamos el panel de edicion y mostramos el panel de informacion de comentario
                    $("#div-editar-comentario").fadeOut(400);
                    $("#div-mostrar-comentario").fadeIn(400);
                    $("#info-paci-comentario").html(nuevoComentario);
                  } else {
                    alertToast('Imposible editar comentario', 'error', 5000)
                  }


                 
                
                })

            }, 1)
        }
  });
</script>