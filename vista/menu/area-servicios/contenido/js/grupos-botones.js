$("#btn-grupo-editar").click(function () {
  if (array_selected != null) {
    $("#ModalEditarGrupo").modal("show");
  } else {
    alertSelectTable();
  }
});
