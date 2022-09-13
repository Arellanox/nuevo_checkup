$("#btn-servicio-editar").click(function(){
  if (array_selected !=null) {
    $("#modalEditarServicio").modal('show');
  }else{
    alertSelectTable();
  }
})

$("#btn-servicio-relacion").click(function(){
  if (array_selected !=null) {
    $("#modalRelacionServicio").modal('show');
  }else{
    alertSelectTable();
  }
})
