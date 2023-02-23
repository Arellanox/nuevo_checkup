$("#btn-estudio-editar").click(function(){
  if (array_selected !=null) {
    $("#modalEditarEstudio").modal('show');
  }else{
    alertSelectTable();
  }
})
