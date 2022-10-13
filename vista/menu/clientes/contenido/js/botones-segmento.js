$("#btn-segmentos-agregar").click(function () {

  if (array_selected != null) {
    $("#ModalRegistrarSegmentos").modal("show");
  } else {
    alertSelectTable('No ha seleccionado un cliente');
  }
});

$("#btn-segmentos-editar").click(function () {
  if (selectSegmento != null) {
    $("#ModalEditarSegmentos").modal("show");
  } else {
    alertSelectTable('No ha seleccionado un segmento');
  }
});

$("#btn-segmentos-relacion").click(function () {
  alert('aijshdihj')
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
    alertSelectTable('No ha seleccionado un cliente');
  }
});
