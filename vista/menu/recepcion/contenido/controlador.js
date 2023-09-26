

// ObtenerTabla o cambiar
// obtenerContenidoRecepcion();
var tablaRecepcionPacientes, dataRecepcion = { api: 1 };
var TablaReportesNoEnviados, dataReporteNoEnviados = { api: 2, enviaod: 0 }

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
function notificacionReportesNoEnviados() {
  ajaxAwait({ api: 1 }, 'correos_api', { callbackAfter: true }, false, function (data) {
    btn_alerta_reporte = data.response.data[0]['NOTIFICACION']

    //Comprueba si hay notificaciones
    if (btn_alerta_reporte > 0) {
      //Si hay notificaciones
      $('#numReportes').html(btn_alerta_reporte) // <- le muestras cuantas notificaciones hay
      $('#btn-modalNotificacionesReportes').addClass('animated-button'); //<- y se agrega una clase que hace que baile como macarebna

    } else { //<- en caso que no haya se remueven las clasesm tanto para vibrar como para que se vea el numero de reportes faltantes
      $('#numReportes').removeClass()
      $('#numReportes').html(''); // <- Se puso esto ya que el span quedaba como 1 por alguna razon
      $('#btn-modalNotificacionesReportes').removeClass('animated-button');
      $('#btn-modalNotificacionesReportes').addClass('animated-button-normal');
    }
  })
}


// Botones
$.getScript("contenido/js/recepcion-botones.js");

function obtenerContenidoEspera() {
  obtenerTitulo('Recepción | Espera'); //Aqui mandar el nombre de la area
  $.post("contenido/recepcion.html", function (html) {
    $("#body-js").html(html);
  }).done(function () {
    // Datatable
    $.getScript("contenido/js/recepcion-tabla.js");
    notificacionReportesNoEnviados() //<- Se agrega para que se pueda ver en todos los estados en recepcion
  });
}

function obtenerContenidoAceptados() {
  obtenerTitulo('Recepción | Aceptados'); //Aqui mandar el nombre de la area
  $.post("contenido/recepcion-ingresados.html", function (html) {
    $("#body-js").html(html);
    dataRecepcion = { api: 1, estado: 1 };
  }).done(function () {
    // Datatable
    $.getScript("contenido/js/recepcion-aceptados-tabla.js");
    notificacionReportesNoEnviados() //<- Se agrega para que se pueda ver en todos los estados en recepcion
  });
}

function obtenerContenidoRechazados() {
  obtenerTitulo('Recepción | Rechazados'); //Aqui mandar el nombre de la area
  $.post("contenido/recepcion-rechazados.html", function (html) {
    $("#body-js").html(html);
    dataRecepcion = { api: 1, estado: 0 };
  }).done(function () {
    // Datatable
    $.getScript("contenido/js/recepcion-tabla.js");
    notificacionReportesNoEnviados() //<- Se agrega para que se pueda ver en todos los estados en recepcion
  });
}



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
            'El paciente a sido rechazado.',
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