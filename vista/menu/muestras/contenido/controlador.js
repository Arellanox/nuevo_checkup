
var tablaMuestras, dataListaPaciente = {}, selectListaMuestras;

if (validarVista('LABORATORIO_MUESTRA_1')) {
  contenidoMuestras()
}
async function contenidoMuestras() {
  await obtenerTitulo("Toma de muestras");
  $.post("contenido/muestras.php", function (html) {
    $("#body-js").html(html);
  }).done(function () {
    dataListaPaciente = {
      api: 1,
      id_area: 6,
      fecha_agenda: $('#fechaListadoAreaMaster').val(),
      fecha_agenda_final: $('#fechaFinalListadoAreaMaster').val(),
      con_paquete: 0
    };

    $.getScript('contenido/js/muestras-tabla.js') // DataTable
    $.getScript('contenido/js/muestras-botones.js') // Botones
  })
}
