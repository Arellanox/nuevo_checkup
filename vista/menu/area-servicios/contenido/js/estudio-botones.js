

$(document).on('click', '#btn-estudio-editar', function (event) {
  if (array_selected != null) {
    $('#btn-estudio-editar').prop('disabled', true);
    getDataFirst(array_selected)
  } else {
    alertSelectTable();
  }
})


$(document).on('click', '#btn-agregar-estudio', function (event) {
  $('#btn-agregar-estudio').prop('disabled', true);
  // $('#contenido-form-estudios').html(htmlBodyFormEstudios)
  getDataFirst();
  // 
})

