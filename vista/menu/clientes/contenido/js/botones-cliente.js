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
      success: function (data) {
        data = jQuery.parseJSON(data);
        if (mensajeAjax(data)) {
          Toast.fire({
            icon: "success",
            title: "¡Estudio registrado!",
            timer: 2000,
          });
          document.getElementById("formRegistrarEstudio").reset();
          $('##div-select-contenedores').empty();
          $("#ModalRegistrarEstudio").modal("hide");
          tablaServicio.ajax.reload();
        }
      },
    });
  } else {
    alertSelectTable('No ha seleccionado un cliente');
  }
})
