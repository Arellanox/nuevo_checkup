
$("#btn-estudio-editar").click(function () {
  if (array_selected != null) {
    getDataFirst(1, array_selected['ID_SERVICIO'])
  } else {
    alertSelectTable();
  }
})

$("#btn-estudio-editar-info").click(function () {
  // getatrribute
  getDataFirst(1, 1)
})


$('#btn-agregar-estudio').click(function () {
  modalEdit = false;
  getDataFirst();
})
