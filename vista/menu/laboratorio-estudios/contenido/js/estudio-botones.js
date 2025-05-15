$("#btn-estudio-editar-info").click(function () {
  getDataFirst(1, 1)
})

$(document).on('click', '#btn-agregar-estudio', function (event) {
  event.preventDefault();
  modalEdit = false;
  getDataFirst();
})