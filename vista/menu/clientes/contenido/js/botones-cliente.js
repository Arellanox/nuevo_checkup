$("#btn-cliente-editar").click(function () {
  if (array_selected != null) {
    $("#ModalActualizarCliente").modal("show");
  } else {
    alertSelectTable();
  }
});


$("#btn-contacto-editar").click(function () {
  if (array_selected != null) {
    $("#ModalActualizarContacto").modal("show");
  } else {
    alertSelectTable();
  }
});


