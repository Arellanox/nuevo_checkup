$('#fechaListadoAreaMaster').change(function(){
  alert('cambio')
  dataListaPaciente = {api:5, fecha_busqueda: $('#fechaListadoAreaMaster').val(), area_id: areaActiva}
  tablaContenido.ajax.reload()
})


$("#btn-analisis-pdf").click(function () {
  if (selectPacienteArea != null) {
    // $("#ModalSubirInterpretacion").modal("show");
    chooseEstudio(selectEstudio.array, '#ModalSubirInterpretacion')
  } else {
    alertSelectTable();
  }
});

$('#btn-capturas-pdf').click(function(){
  if (selectPacienteArea != null) {
    // $("#ModalSubirCapturas").modal("show");
    chooseEstudio(selectEstudio.array, '#ModalSubirCapturas')
  } else {
    alertSelectTable();
  }
})

function chooseEstudio(row, modal){
  let html = '';
  console.log(row)
  for (var i = 0; i < row.length; i++) {
      html += `<button class="btn btn-cancelar" onClick = "estudioSeleccionado(`+row[i]['ID_SERVICIO']+`, '`+modal+`')" type="button">`+row[i]['SERVICIO']+`</button>`;
  }

  Swal.fire({
    html: '<h4>Seleccione el servicio a guardar</h4>'+
      '<div class="d-grid gap-2">'+ html + '</div>',
    showCloseButton: true,
    showConfirmButton: false,
  });
}

function estudioSeleccionado(id, modal){
  selectEstudio.selectID = id;
  Swal.close();
  console.log(selectEstudio.selectID)
  $(modal).modal("show");
}

function botonesResultados(estilo){
  switch (estilo) {
    case 'desactivar':
      $('#btn-analisis-pdf').prop('disabled', true)
      $('#btn-capturas-pdf').prop('disabled', true)
    break;
    case 'activar':
      $('#btn-analisis-pdf').prop('disabled', false)
      $('#btn-capturas-pdf').prop('disabled', false)
    break;
    default:

  }
}
