
var tablaListaPaciente, dataListaPaciente = { api: 5, fecha_busqueda: $('#fechaListadoLaboratorio').val(), area_id: 12 };
var idsEstudiosa, selectListaLab;

if (validarVista('LABORATORIO')) {
  obtenerContenidoLaboratorio();
}

async function obtenerContenidoLaboratorio() {
  await obtenerTitulo("Laboratorio Biomolecular");
  $.post("contenido/laboratorio.php", function (html) {
    $("#body-js").html(html);
  }).done(function () {
    dataListaPaciente = { api: 5, fecha_busqueda: $('#fechaListadoLaboratorio').val(), area_id: 12 }
    // DataTable
    $.getScript('contenido/js/lista-tabla.js')
    // Botones
    $.getScript('contenido/js/laboratorio-botones.js')
  });
}
