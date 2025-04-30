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
        dataType: 'json',
        success: function (data) {
          // data = jQuery.parseJSON(data);
          console.log(data);
          if (mensajeAjax(data)) {
            let session = data.response['session'];
            const queryString = window.location.search;
            const urlParams = new URLSearchParams(queryString);
            const page = urlParams.get('page')

            if (page) {
              $(location).attr('href', page);
            } else {
              // console.log(data.response.data)


              switch (session['cargo']) {
                case '10': case 10:
                  $(location).attr('href', `${http}${servidor}/${appname}/vista/menu/recepcion/`);
                  return true;

                case '18': case 18:
                  $(location).attr('href', `${http}${servidor}/${appname}/vista/procedencia/pacientes/#UJAT`);
                  return true;

                case '19': case 19:
                  $(location).attr('href', `${http}${servidor}/${appname}/vista/menu/consultorio/`);
                  return true;

                case '21': case 21:
                  $(location).attr('href', `${http}${servidor}/${appname}/vista/procedencia/estudios-laboratorio/`); // Pronto por procedencia

                  return true;

                  break;

                // medicos
                case '1':

                  if (ifnull(session.vista, false, ["MEDICOS_TRATANTES"])) {
                    $(location).attr('href', `${http}${servidor}/${appname}/vista/menu/medicos_tratantes/#PACIENTES`);
                  } else {
                    $(location).attr('href', `${http}${servidor}/${appname}/vista/menu/principal/`);
                  }

                  break;


                default:



                  $(location).attr('href', `${http}${servidor}/${appname}/vista/menu/principal/`);
                  console.warn(session);
                  return false;
                // break;
              }
            }

          } else {
            $(this).find('button :submit').prop('disabled', false)
            if (data.response.msj == 'Oops! Tu contraseña es incorrecta.') {
              $('#formIniciarSesion input[name="pass"]').addClass('is-invalid')
            } else {
              $('#formIniciarSesion input').addClass('is-invalid')

            }
          }
        },
        error: function (jqXHR, exception, data) {
          alertErrorAJAX(jqXHR, exception, data)
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


    $('#formulario').click(function () {
      $('#modalSubirInterpretacion').modal('show')
    })


  });



}