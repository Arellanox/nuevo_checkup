$('#fechaListadoAreaMaster').change(function(){
  alert('cambio')
  dataListaPaciente = {api:5, fecha_busqueda: $('#fechaListadoAreaMaster').val(), area_id: areaActiva}
  tablaContenido.ajax.reload()
})


$("#btn-analisis-pdf").click(function () {
  if (selectPacienteArea != null) {
    // $("#ModalSubirInterpretacion").modal("show");
    chooseEstudio(selectEstudio.array, '#ModalSubirInterpretacion', 1)
  } else {
    alertSelectTable();
  }
});

$('#btn-capturas-pdf').click(function(){
  if (selectPacienteArea != null) {
    // $("#ModalSubirCapturas").modal("show");
    chooseEstudio(selectEstudio.array, '#ModalSubirCapturas', 2)
  } else {
    alertSelectTable();
  }
})

$('#btn-analisis-oftalmo').click(function(){
  if (selectPacienteArea != null) {

    $("#ModalSubirInterpretacionOftalmologia").modal("show");
  } else {
    alertSelectTable();
  }
})

function chooseEstudio(row, modal, tip){
  let html = '';
  console.log(row)
  switch (tip) {
    case 1:
        for (var i = 0; i < row.length; i++) {
          if (row[i]['INTERPRETACION'] == null) {
            html += `<button class="btn btn-cancelar" onClick = "estudioSeleccionado(`+row[i]['ID_SERVICIO']+`, '`+modal+`')" type="button">`+row[i]['SERVICIO']+`</button>`;
          }
        }
        if (html) {
          Swal.fire({
            html: '<h4>Seleccione el estudio a guardar</h4>'+
              '<div class="d-grid gap-2">'+ html + '</div>',
            showCloseButton: true,
            showConfirmButton: false,
          });
        }else{
          alertSelectTable('Este paciente ya no tiene sus interpretaciones')
        }
      break;
    case 2:
        for (var i = 0; i < row.length; i++) {
          if (row[i]['IMG'] == null) {
            html += `<button class="btn btn-cancelar" onClick = "estudioSeleccionado(`+row[i]['ID_SERVICIO']+`, '`+modal+`')" type="button">`+row[i]['SERVICIO']+`</button>`;
          }
        }
        if (html) {
          Swal.fire({
            html: '<h4>Seleccione el estudio a capturar</h4>'+
              '<div class="d-grid gap-2">'+ html + '</div>',
            showCloseButton: true,
            showConfirmButton: false,
          });
        }else{
          alertSelectTable('Este paciente ya no tiene sus capturass')
        }
      break;
    default:

  }

}

function estudioSeleccionado(id, modal){
  selectEstudio.selectID = id;
  Swal.close();
  console.log(selectEstudio.selectID)
  $(modal).modal("show");
}
