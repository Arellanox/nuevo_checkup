// $('#btn-analisis-pdf').on('click',function(){
//   if (selectListaLab == null){

//   }
// })


$("#btn-analisis-pdf").click(function () {

  if (selectListaLab != null) {
    $("#ModalSubirInterpretacion").modal("show");
  } else {
    alertSelectTable();
  }
});

$('#btn-capturas-pdf').click(function(){
  if (selectListaLab != null) {
    $("#ModalSubirCapturas").modal("show");
  } else {
    alertSelectTable();
  }
})
