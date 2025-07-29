

var turno;

var tablaSignos, dataListaPaciente = {}, selectListaSignos;

// ObtenerTabla o cambiar

if (validarVista('SOMATOMETRIA')) {
  obtenerContenidoSoma();
}

async function obtenerContenidoSoma() {
  await obtenerTitulo('Somatometría | Signos Vitales');
  $.post("contenido/somatometria.html", function (html) {
    $("#body-js").html(html);
  }).done(function () {
    dataListaPaciente = {
      api: 5,
      area_id: 2,
      fecha_busqueda: $('#fechaListadoAreaMaster').val() ?? dataListaPaciente['fecha_busqueda'],
      fecha_busqueda_final: $('#fechaFinalListadoAreaMaster').val() ?? dataListaPaciente['fecha_busqueda_final']
    };
    $.getScript("contenido/js/somatometria-botones.js");// Botones
    $.getScript("contenido/js/somatometria-tabla.js");// Botones
  });
}




async function cargarDatosPaciente(turno, id) {
  //Mandar area y luego el callback;
  await obtenerPanelInformacion(id, "pacientes_api", 'paciente');

  loader('Out')
}
