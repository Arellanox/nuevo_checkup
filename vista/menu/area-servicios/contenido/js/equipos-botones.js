$("#btn-equipo-editar").click(function () {
  if (array_selected != null) {
    $("#ModalEditarEquipo").modal("show");
  } else {
    alertSelectTable();
  }
});
