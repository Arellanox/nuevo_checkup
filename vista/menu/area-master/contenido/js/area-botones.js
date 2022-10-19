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
