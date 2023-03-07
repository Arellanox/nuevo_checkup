$("#btn-aceptar").click(function () {
  if (array_selected != null) {
    $("#modalPacienteAceptar").modal('show');
  } else {
    alertSelectTable();
  }
})

$("#btn-rechazar").click(function () {
  if (array_selected != null) {
    $("#modalPacienteRechazar").modal('show');
  } else {
    alertSelectTable();
  }
})

$("#btn-editar").click(function () {
  if (array_selected != null) {
    $("#ModalEditarPaciente").modal('show');
  } else {
    alertSelectTable();
  }
})

$("#btn-perfil").click(function () {
  if (array_selected != null) {
    $("#modalPacientePerfil").modal('show');
  } else {
    alertSelectTable();
  }
})

$("#btn-pendiente").click(function () {
  if (array_selected != null) {
    Swal.fire({
      title: '¿Está Seguro de regresar al paciente en espera?',
      text: "¡Sus estudios anteriores no se cargarán!",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Si, colocarlo en espera',
      cancelButtonText: "Cancelar"
    }).then((result) => {
      if (result.isConfirmed) {
        // Esto va dentro del AJAX
        $.ajax({
          data: {
            id_turno: array_selected['ID_TURNO'],
            api: 2,
            // estado: null
          },
          url: "../../../api/recepcion_api.php",
          type: "POST",
          success: function (data) {
            data = jQuery.parseJSON(data);
            if (mensajeAjax(data)) {
              alertMensaje('info', '¡Paciente en espera!', 'El paciente se cargó en espera.');
              try {
                tablaRecepcionPacientes.ajax.reload();
              } catch (e) {

              }
              try {
                tablaRecepcionPacientesIngrersados.ajax.reload();
              } catch (e) {

              }
            }
          }
        });
      }
    })
  } else {
    alertSelectTable('No ha seleccionado ningún paciente', 'error')
  }
})

$("#btn-reagendar").click(function () {
  if (array_selected != null) {
    $("#modalPacienteReagendar").modal('show');
  } else {
    alertSelectTable('No ha seleccionado ningún paciente', 'error')
  }
})

$('#btn-correo-particular').click(function () {
  if (array_selected != null) {
    Swal.fire({
      title: '¿Desea enviar todos sus resultados y capturas?',
      text: "¡Se usará el correo registro del paciente!",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Aceptar y enviar',
      cancelButtonText: "Cancelar"
    }).then((result) => {
      if (result.isConfirmed) {
        // Esto va dentro del AJAX
        $.ajax({
          data: {
            id_turno: array_selected['ID_TURNO'],
            api: 4,
            // estado: null
          },
          url: "../../../api/recepcion_api.php",
          type: "POST",
          success: function (data) {
            data = jQuery.parseJSON(data);
            if (mensajeAjax(data)) {
              alertMensaje('info', '¡Correo enviado!', 'Si el correo es correcto le llegará.');
            }
          }
        });
      }
    })
  } else {
    alertSelectTable('No ha seleccionado ningún paciente', 'error')
  }
})