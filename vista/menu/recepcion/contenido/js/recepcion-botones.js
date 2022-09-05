$("#btn-aceptar").click(function(){
  if (array_paciente !=null) {
    $("#modalPacienteAceptar").modal('show');
  }else{
    alertSelectTable();
  }
})

$("#btn-rechazar").click(function(){
  if (array_paciente !=null) {
    $("#modalPacienteRechazar").modal('show');
  }else{
    alertSelectTable();
  }
})

$("#btn-editar").click(function(){
  if (array_paciente !=null) {
    $("#ModalEditarPaciente").modal('show');
  }else{
    alertSelectTable();
  }
})

$("#btn-perfil").click(function(){
  if (array_paciente !=null) {
    $("#modalPacientePerfil").modal('show');
  }else{
    alertSelectTable();
  }
})
