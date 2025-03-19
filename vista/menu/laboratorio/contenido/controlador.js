var areaActiva;
var tablaListaPaciente, dataListaPaciente;
var idsEstudiosa, selectListaLab;
var totalNotificacionesDisponibles = 0;

async function obtenerContenidoLaboratorio(titulo) {
  await obtenerTitulo(titulo);

  $.post("contenido/laboratorio.php", function (html) {
    $("#body-js").html(html);
  }).done(function () {
    dataListaPaciente = { api: 5, fecha_busqueda: $('#fechaListadoLaboratorio').val(), area_id: areaActiva };
    // DataTable
    $.getScript('contenido/js/lista-tabla.js')
    // Botones
    $.getScript('contenido/js/laboratorio-botones.js')
    // notificacion estudios pendientes
    ajaxAwait({
      api: 7
    }, 'laboratorio_servicios_api', { callbackAfter: true }, false, function (data) {
        if(data.response.data?.length > 0){
          $('#badge-maquila-icon').removeClass('hidden');
          $('#estudios-pendientes-notificacion').text(data.response.data?.length);
          totalNotificacionesDisponibles += data.response.data?.length;
        }else {
          $('#badge-maquila-icon').addClass('hidden');
        }
    });

    ajaxAwait({
      api: 2, MOSTRAR_OCULTOS: 1
    }, 'laboratorio_estudios_maquila_api', { callbackAfter: true }, false, function (data) {
      if(data.response.data?.length > 0){
        $('#badge-maquila-icon').removeClass('hidden');
        $('#maquilas-pendientes-notificacion').text(data.response.data?.length);
        totalNotificacionesDisponibles += data.response.data?.length;
      } else {
        $('#badge-maquila-icon').addClass('hidden');
      }

      if(totalNotificacionesDisponibles > 0){
        $('#base-pendientes-notificacion').removeClass('hidden');
        $('#base-pendientes-notificacion').text(totalNotificacionesDisponibles);
      }else {
        $('#base-pendientes-notificacion').addClass('hidden');
      }
    });
  });
}


hasLocation()

$(window).on("hashchange", function (e) { hasLocation(); });

function hasLocation() {
  var hash = window.location.hash.substring(1);
  $("a").removeClass("navlinkactive");
  $("nav li a[href='#" + hash + "']").addClass("navlinkactive");
  if (validarVista(hash)) {
    switch (hash) {
      case "LABORATORIO":
        areaActiva = 6;
        obtenerContenidoLaboratorio('Resultados de Laboratorio Clinico');
        break;
      case "LABORATORIO_MOLECULAR":
        areaActiva = 12;
        obtenerContenidoLaboratorio("Resultados de Laboratorio Biomolecular");
        break;
      default: avisoArea(); break;
    }
  }
}