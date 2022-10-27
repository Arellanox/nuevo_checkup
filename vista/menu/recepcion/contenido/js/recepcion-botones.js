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

$("#btn-pendiente").click(function(){
  if (array_selected !=null) {
    Swal.fire({
      title: '¿Está Seguro de Regresar al Paciente a Espera?',
      text: "¡Confirme si Esta de acuerdo con esta accion",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Si, Colocarlo en Espera',
      cancelButtonText: "Cancelar"
    }).then((result) => {
      if (result.isConfirmed) {
        formData = new FormData();
        formData.set('id_turno', array_selected['ID_TURNO']);
        formData.set('estado', 1)
        formData.set('api', 2);
        // Esto va dentro del AJAX
        $.ajax({
          
          data: formData,

          url: "../../../api/recepcion_api.php",
          type: "POST",
          processData: false,
          contentType: false,
          success: function(data) {
            data = jQuery.parseJSON(data);
            if (mensajeAjax(data)) {
              // Mensaje
              {
                   alertSelectTable('EL Paciente esta en Espera', 'success')
                 }
            }
          }
        });
      }
    })
  }
})



