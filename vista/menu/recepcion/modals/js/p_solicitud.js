//Enviar solicitud
$("#formEnviarCorreoIngreso").submit(function (event) {
  event.preventDefault();
  /*DATOS Y VALIDACION DEL REGISTRO*/
  Swal.fire({
    title: '¿Está seguro de enviar crear la solicitud de ingreso a este correo?',
    text: "No se podrán deshacer cambios",
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
          api: 1, //Prueba
          correo: $('#inputURLSolicitudCorreo').val()
        },
        url: "../../../api/preregistro_correo_token_api.php", //URL prueba
        type: "POST",
        beforeSend: function () {
          document.getElementById("btn-rechazar-paciente").disabled = true;
        },
        success: function (data) {
          data = jQuery.parseJSON(data);
          if (mensajeAjax(data)) {
            alertMensaje('info', '¡Solicitud enviada!', 'Se ha enviado el token de acceso para registrarse.');
            document.getElementById("btn-rechazar-paciente").disabled = false;
            $("#modalSolicitudIngresoParticulares").modal("hide");
            tablaRecepcionPacientesIngrersados.ajax.reload();
          }
        }
      });
    }
  })
  event.preventDefault();
});