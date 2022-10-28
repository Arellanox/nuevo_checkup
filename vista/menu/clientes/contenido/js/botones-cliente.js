$("#btn-cliente-editar").click(function () {
  if (array_selected != null) {
    $("#ModalActualizarCliente").modal("show");
  } else {
    alertSelectTable('No ha seleccionado un cliente');
  }
});


$("#btn-contacto-editar").click(function () {
  if (selectContacto != null) {
    $("#ModalActualizarContacto").modal("show");
  } else {
    alertSelectTable('No ha seleccionado un contacto');
  }
});


$("#btn-contacto-agregar").click(function () {
  if (array_selected != null) {
    $("#ModalAgregarContacto").modal("show");
  } else {
    alertSelectTable('No ha seleccionado un cliente');
  }
});

$('#generar-codigoqr').click(function(){
  if (array_selected != null) {
    $.ajax({
      data: array_selected['ID_CLIENTE'],
      url: "../../../api/clientes_api.php",
      type: "POST",
      beforeSend: function(){
        alertMensaje('info', 'Espere un momento', 'Generando imagen...')
      },
      success: function (data) {
        data = jQuery.parseJSON(data);
        // if (mensajeAjax(data)) {
        //
        //   document.getElementById("formRegistrarEstudio").reset();
        //   $('##div-select-contenedores').empty();
        //   $("#ModalRegistrarEstudio").modal("hide");
        //   tablaServicio.ajax.reload();
        // }
        data.response.msj = 'http://localhost/nuevo_checkup/api/archivos/temp/qr/clientes/QR_file_ID.png';
        fileName = 'códigoQR_'+array_selected['NOMBRE_COMERCIAL'];
        Swal.fire({
          // icon: icon,
          // title: title,
          // text: text,
          html: '<div><div class="d-flex justify-content-center"><img src="http://localhost/nuevo_checkup/api/archivos/temp/qr/clientes/QR_file_ID.png" alt="" style="width:50%"></div>'+
                `<div class="d-flex justify-content-center"> <button type="button" class="btn btn-borrar" name="button" style="width: 50%" onClick="DownloadFromUrl('`+data.response.msj+`', '`+fileName+`')"> <i class="bi bi-image"></i> Descargar</button>`+
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
