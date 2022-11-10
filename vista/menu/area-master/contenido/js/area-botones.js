// $('#btn-analisis-pdf').on('click',function(){
//   if (selectPacienteArea == null){

//   }
// })


$("#btn-analisis-pdf").click(function () {
  if (selectPacienteArea != null) {
    // $("#ModalSubirInterpretacion").modal("show");
    chooseEstudio(selectEstudio.array)
  } else {
    alertSelectTable();
  }
});

$('#btn-capturas-pdf').click(function(){
  if (selectPacienteArea != null) {
    $("#ModalSubirCapturas").modal("show");
  } else {
    alertSelectTable();
  }
})

function chooseEstudio(row){
  let html = '';
  console.log(row)
  for (var i = 0; i < row.length; i++) {
      html += '<button class="btn btn-cancelar" onClick = "estudioSeleccionado('+row[i]['ID_SERVICIO']+')" type="button">'+row[i]['SERVICIO']+'</button>';
  }

  Swal.fire({
    html: '<h4>Seleccione el servicio a guardar</h4>'+
      '<div class="d-grid gap-2">'+ html + '</div>',
    showCloseButton: true,
    showConfirmButton: false,
  });
}

function estudioSeleccionado(id){
  selectEstudio.selectID = id;
  Swal.close();
  console.log(selectEstudio.selectID)
  $("#ModalSubirInterpretacion").modal("show");
}

function botonesResultados(estilo){
  switch (estilo) {
    case 'desactivar':

    break;
    case 'activar':

    break;
    default:

  }
}
