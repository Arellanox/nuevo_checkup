$("#btn-cliente-editar").click(function () {
  if (array_selected != null) {
    $("#ModalActualizarCliente").modal("show");
  } else {
    alertSelectTable();
  }
});


$("#btn-contacto-editar").click(function () {
  if (selectContacto != null) {
    $("#ModalActualizarContacto").modal("show");
  } else {
    alertSelectTable();
  }
});

$("#btn-contacto-agregar").click(function () {
    if (array_selected != null) {
    $("#ModalAgregarContacto").modal("show");
  } else {
    alertSelectTable();
  }

});
