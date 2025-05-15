

// ObtenerTabla o cambiar
// obtenerContenidoRecepcion();
var tablaRecepcionPacientes, dataRecepcion = { api: 1 };
var TablaReportesNoEnviados, dataReporteNoEnviados = { api: 2, enviado: 0 }

var estudiosLab = [], estudiosLabBio = [], estudiosRX = [], estudiosUltra = [], estudiosOtros = [];
var hash, btn_alerta_reporte;


//Validacion de usuario
switch (session['cargo']) {
  case '18': case 18:
    $(location).attr('href', `${http}${servidor}/${appname}/vista/procedencia/pacientes/#UJAT`);
    destroySession();
    break;
}

if (validarVista('RECEPCIÓN')) {
  hasLocation()
  $(window).on("hashchange", function (e) {
    hasLocation();
  });
}

//Notificacion de reportes faltantes
//animated-button
notificacionReportesNoEnviados(null)
detectCoincidence('#medico-aceptar-paciente')


async function notificacionReportesNoEnviados(count) {
  let span = '#numReportes';
  let btn = '#btn-modalNotificacionesReportes';

  return new Promise((resolve) => {
    ajaxAwait({ api: 1 }, 'correos_api', { callbackAfter: true }, false, function (data) {
      // resolve(data);
      const noti = ifnull(data.response.data, false, { 0: 'NOTIFICACION' });
      // Verificamos si existe una nueva notificacion
      if (noti > 0 && noti != count) {
        $(span).fadeIn('fast');
        $(span).html(noti)
        $(btn).addClass('animated-button');

        // try { TablaReportesNoEnviados.ajax.reload(); } catch (error) { }

      } else if (noti != count) {
        //Borramos si no existe
        $(span).fadeOut(0);
        $(btn).removeClass('animated-button')

        // try { TablaReportesNoEnviados.ajax.reload(); } catch (error) { }
      }

      resolve(1);
    });
  });

}

// Botones
$.getScript("contenido/js/recepcion-botones.js");

function obtenerContenidoEspera() {
  $('#titulo_area').html('Recepción | Espera'); //Aqui mandar el nombre de la area
  $.post("contenido/recepcion.html", function (html) {
    $("#body-js").html(html);
  }).done(function () {
    // Datatable
    $.getScript("contenido/js/recepcion-tabla.js");
  });
}

function obtenerContenidoAceptados() {
  $('#titulo_area').html('Recepción | Aceptados'); //Aqui mandar el nombre de la area
  $.post("contenido/recepcion-ingresados.html", function (html) {
    $("#body-js").html(html);
    dataRecepcion = { api: 1, estado: 1 };
  }).done(function () {
    // Datatable
    $.getScript("contenido/js/recepcion-aceptados-tabla.js");
  });
}

function obtenerContenidoRechazados() {
  $('#titulo_area').html('Recepción | Rechazados'); //Aqui mandar el nombre de la area
  $.post("contenido/recepcion-rechazados.html", function (html) {
    $("#body-js").html(html);
    dataRecepcion = { api: 1, estado: 0 };
  }).done(function () {
    // Datatable
    $.getScript("contenido/js/recepcion-tabla.js");
  });
}

function obtenerContenidoTodosPacientes() {
  $('#titulo_area').html('Pacientes registrados'); //Aqui mandar el nombre de la area
  $.post("contenido/pacientes/pacientes.html", function (html) {
    $("#body-js").html(html);
  }).done(function () {
    // Datatable
    $.getScript("contenido/pacientes/js/pacientes.js");
  });
}


hash = ''
obtenerTitulo('Recepción | Espera');
function hasLocation() {
  hash = window.location.hash.substring(1);
  $("a").removeClass("navlinkactive");
  $("nav li a[href='#" + hash + "']").addClass("navlinkactive");
  switch (hash) {
    case "rechazados":
      obtenerContenidoRechazados();
      break;
    case "ingresados":
      obtenerContenidoAceptados();
      break;
    case "pendientes":
      obtenerContenidoEspera();
      dataRecepcion = { api: 1 };
      break;

    case 'pacientes':
      obtenerContenidoTodosPacientes();
      break;
    default:
      window.location.hash = 'pendientes';
      break;
  }
}

function recepciónPaciente(estatus, id) {
  Swal.fire({
    title: '¿Estás seguro de ' + estatus + ' este paciente?',
    text: "",
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Aceptar',
    cancelButtonText: 'Cancelar'
  }).then((result) => {
    if (result.isConfirmed) {
      switch (estatus) {
        case 'aceptar':
          Swal.fire({
            icon: 'success',
            title: 'Aceptado!',
            text: 'El pase del paciente se está generando...'
          })
          // Ajax para generar TURNO y generar pase
          break;
        case 'rechazar':
          Swal.fire(
            'Rechazado!',
            'El paciente ha sido rechazado.',
            'error'
          )
          // Ajax para cancelar registro del paciente
          break;
        default:

      }
    }
  })
}

obtenerPanelInformacion(0, 0, 0)

//Detener animacionde boton de los reportes no entregados

//filtrar tabla de pacientes aceptados
