
var tablaMuestras, dataListaPaciente = {}, selectListaMuestras;

// Permiso para entrar
if (validarVista('LABORATORIO_MUESTRA_1')) {
  contenidoRecepcionMuestras()
}
async function contenidoRecepcionMuestras() {
  await obtenerTitulo("Recepción de muestras");
  $.post("contenido/recepcion.php", function (html) {
    $("#body-js").html(html);
  }).done(function () {
    dataListaPaciente = {
      api: 1,
      id_area: 6,
      fecha_agenda: $('#fechaListadoAreaMaster').val(),
      fecha_agenda_final: $('#fechaFinalListadoAreaMaster').val()
    };

    $.getScript('contenido/js/muestras-tabla.js')// DataTable
    $.getScript('contenido/js/muestras-botones.js')// Botones
  })
}
