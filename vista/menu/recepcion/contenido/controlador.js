const apiByFranquisiario = isFranquisiario ? -1 : 1;

let tablaRecepcionPacientes, dataRecepcion = {api: apiByFranquisiario};
let TablaReportesNoEnviados, dataReporteNoEnviados = {api: 2, enviado: 0};

let estudiosLab = [], estudiosLabBio = [], estudiosRX = [], estudiosUltra = [], estudiosOtros = [];
let hash = '';

validaciones()

console.log(apiByFranquisiario)

$.getScript("contenido/js/recepcion-botones.js");
obtenerTitulo('Recepción | Espera');
obtenerPanelInformacion(0, 0, 0)
notificacionReportesNoEnviados(null).then(r => {}) //Notificacion de reportes faltantes
detectCoincidence('#medico-aceptar-paciente').then(r => {})

function validaciones(){
  //Validacion de usuario
  switch (session['cargo']) {
    case '18': case 18:
      $(location).attr('href', `${http}${servidor}/${appname}/vista/procedencia/pacientes/#UJAT`);
      destroySession();
      break;
  }

  if (validarVista('RECEPCIÓN')) {
    hasLocation()
    $(window).on("hashchange", function (e) { hasLocation(); });
  }
}

function hasLocation() {
  hash = window.location.hash.substring(1);
  $("a").removeClass("navlinkactive");
  $("nav li a[href='#" + hash + "']").addClass("navlinkactive");

  switch (hash) {
    case "rechazados":
      obtenerContenidoRechazados();
      dataRecepcion = { api: apiByFranquisiario, estado: 0 };
      break;
    case "ingresados":
      obtenerContenidoAceptados();
      dataRecepcion = { api: apiByFranquisiario, estado: 1 };
      break;
    case "pendientes":
      obtenerContenidoEspera();
      dataRecepcion = { api: apiByFranquisiario };
      break;

    case 'pacientes':
      obtenerContenidoTodosPacientes();
      break;
    default:
      window.location.hash = 'pendientes';
      break;
  }
}

function obtenerContenidoEspera() {
  $('#titulo_area').html('Recepción | Espera');
  $.post("contenido/recepcion.html", function (html) { $("#body-js").html(html); })
      .done(function () { $.getScript("contenido/js/recepcion-tabla.js"); });
}

function obtenerContenidoAceptados() {
  $('#titulo_area').html('Recepción | Aceptados');
  $.post("contenido/recepcion-ingresados.html", function (html) { $("#body-js").html(html); })
      .done(function () { $.getScript("contenido/js/recepcion-aceptados-tabla.js"); });
}

function obtenerContenidoRechazados() {
  $('#titulo_area').html('Recepción | Rechazados');
  $.post("contenido/recepcion-rechazados.html", function (html) { $("#body-js").html(html); })
      .done(function () { $.getScript("contenido/js/recepcion-tabla.js"); });
}

function obtenerContenidoTodosPacientes() {
  $('#titulo_area').html('Pacientes registrados');
  $.post("contenido/pacientes/pacientes.html", function (html) { $("#body-js").html(html); })
      .done(function () { $.getScript("contenido/pacientes/js/pacientes.js"); });
}

async function notificacionReportesNoEnviados(count) {
  let span = '#numReportes';
  let btn = '#btn-modalNotificacionesReportes';

  return new Promise((resolve) => {
    ajaxAwait({ api: 1 }, 'correos_api', { callbackAfter: true }, false, function (data) {
      // resolve(data);
      const noti = ifnull(data.response.data, false, { 0: 'NOTIFICACION' });
      // Verificamos si existe una nueva notificacion
      if (noti > 0 && noti !== count) {
        $(span).fadeIn('fast');
        $(span).html(noti)
        $(btn).addClass('animated-button');
      } else if (noti !== count) {
        $(span).fadeOut(0);
        $(btn).removeClass('animated-button')
      }

      resolve(1);
    });
  });
}

/*function recepciónPaciente(estatus, id) {
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
}*/