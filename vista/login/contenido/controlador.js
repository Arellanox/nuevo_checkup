// obtenerContenido o cambiar
obtenerContenido("login.php");

function obtenerContenido(tabla) {
  $.post("contenido/" + tabla, function (html) {
    $("#body-js").html(html);


    $("#formIniciarSesion").submit(function (event) {
      event.preventDefault();
      $(this).find('button :submit').prop('disabled', true)
      /*DATOS Y VALIDACION DEL REGISTRO*/
      var form = document.getElementById("formIniciarSesion");
      var formData = new FormData(form);
      formData.set('api', 1);
      $.ajax({
        data: formData,
        url: "../../api/login_api.php",
        type: "POST",
        processData: false,
        contentType: false,
        beforeSend: function () {
          alertMensaje('info', 'Espere un momento', 'Validando datos...');
        },
        success: function (data) {
          data = jQuery.parseJSON(data);
          console.log(data);
          if (mensajeAjax(data)) {
            const queryString = window.location.search;
            const urlParams = new URLSearchParams(queryString);
            const page = urlParams.get('page')
            if (page) {
              $(location).attr('href', page);
            } else {
              $(location).attr('href', http + servidor + '/nuevo_checkup/vista/menu/principal/');
            }
          } else {
            $(this).find('button :submit').prop('disabled', false)
          }
        },
      });
    })

    $('#cambiar-contraseña').click(function () {
      alertMensajeFormConfirm({
        title: 'Validemos su identidad con su correo',
        // text: 'Ingrese su correo para '
      }, 'login_api', 3, 'correo', function () {
        alertMensaje('info', 'Correo enviado', 'Si el correo existe, podrás restablecer la contraseña siguiendo los pasos del correo')
      })
    })
  });
}