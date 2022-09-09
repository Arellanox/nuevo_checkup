$("#btn-aceptar").click(function(){
  if (array_selected !=null) {
    $("#modalPacienteAceptar").modal('show');
  }else{
    alertSelectTable();
  }
})

$("#btn-rechazar").click(function(){
  if (array_selected !=null) {
    $("#modalPacienteRechazar").modal('show');
  }else{
    alertSelectTable();
  }
})

$("#btn-editar").click(function(){
  if (array_selected !=null) {
    $("#ModalEditarPaciente").modal('show');
  }else{
    alertSelectTable();
  }
})

$("#btn-perfil").click(function(){
  if (array_selected !=null) {
    $("#modalPacientePerfil").modal('show');
  }else{
    alertSelectTable();
  }
})
