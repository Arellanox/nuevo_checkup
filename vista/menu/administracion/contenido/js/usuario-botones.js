$("#btn-usuario-vista").click(function(){
  if (array_paciente !=null) {
    $("#modalEditarVistaUsuario").modal('show');
  }else{
    alertSelectTable();
  }
})

$("#btn-usuario-permisos").click(function(){
  if (array_paciente !=null) {
    $("#modalEditarPermisosUsuario").modal('show');
  }else{
    alertSelectTable();
  }
})

$("#btn-usuario-editar").click(function(){
  if (array_paciente !=null) {
    $("#ModalEditarRegistroUsuario").modal('show');
  }else{
    alertSelectTable();
  }
})

$("#btn-usuario-estado").click(function(){
  if (array_paciente !=null) {
    $("#modalEditarEstadoUsuario").modal('show');
  }else{
    alertSelectTable();
  }
})
