$("#btn-estudio-editar").click(function(){
  if (array_selected !=null) {
    $("#modalEditarServicio").modal('show');
  }else{
    alertSelectTable();
  }
})
