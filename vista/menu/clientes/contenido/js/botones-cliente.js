$("#btn-cliente-editar").click(function () {
  if (array_selected != null) {
    $("#ModalActualizarCliente").modal("show");
  } else {
    alertSelectTable('No ha seleccionado un cliente');
  }
});


$('#generar-codigoqr').click(function(){
  if (array_selected != null) {
    $.ajax({
      data: {api: 5, id_cliente: array_selected['ID_CLIENTE']},
      url: "../../../api/clientes_api.php",
      type: "POST",
      beforeSend: function(){
        alertMensaje('info', 'Espere un momento', 'Generando imagen...')
      },
      success: function (data) {
        data = jQuery.parseJSON(data);
        console.log(data);
        // if (mensajeAjax(data)) {
        //
        //   document.getElementById("formRegistrarEstudio").reset();
        //   $('##div-select-contenedores').empty();
        //   $("#ModalRegistrarEstudio").modal("hide");
        //   tablaServicio.ajax.reload();
        // }
        fileName = 'códigoQR_'+array_selected['NOMBRE_COMERCIAL'];
        console.log(data.url)
        Swal.fire({
          html: `<div><div class="d-flex justify-content-center"><img src="`+data.url+`" alt="" style="width:auto"></div>`+
                `<div class="d-flex justify-content-center"> <button type="button" class="btn btn-borrar" name="button" style="width: 50%" onClick="DownloadFromUrl('`+data.url+`', '`+fileName+`')"> <i class="bi bi-image"></i> Descargar</button>`+
                '</div></div>',
          showCloseButton: true,
          showConfirmButton: false,
        })
      },
    });
  } else {
    alertSelectTable('No ha seleccionado un cliente');
  }
})
