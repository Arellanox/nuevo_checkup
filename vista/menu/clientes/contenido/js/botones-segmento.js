$("#btn-segmentos-agregar").click(function () {
  if (array_selected != null) {
    $("#ModalRegistrarSegmentos").modal("show");
  } else {
    alertSelectTable();
  }
});

$("#btn-segmentos-editar").click(function () {
  if (array_selected != null) {
    $("#ModalEditarSegmentos").modal("show");
  } else {
    alertSelectTable();
  }
});

$("#btn-segmentos-relacion").click(function () {
  if (array_selected != null) {
  } else {
    alertSelectTable();
  }
});

$("#btn-segmentos-eliminiar").click(function () {
  if (array_selected != null) {
    Swal.fire({
      title: "¿Está seguro que desea eliminar este Segmento?",
      text: "Verifique las Relaciones y los Subgementos antes de Continuar!",
      icon: "warning",
      showCancelButton: true,
      cancelButtonColor: "#3085d6",
      confirmButtonColor: "#d33",
      confirmButtonText: "ELIMINAR",
      cancelButtonText: "Cancelar",
    }).then((result) => {});
  } else {
    alertSelectTable();
  }
});

