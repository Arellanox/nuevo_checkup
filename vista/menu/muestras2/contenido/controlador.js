
var tablaMuestras, dataListaPaciente = {}, selectListaMuestras;

if (validarVista('LABORATORIO_MUESTRA_2')) {
  contenidoMuestras()
}
async function contenidoMuestras() {
  await obtenerTitulo("Toma de muestras 2");
  $.post("contenido/muestras.php", function (html) {
    $("#body-js").html(html);
  }).done(function () {
    dataListaPaciente = 
    { 
      api: 1, 
      id_area: 6, 
      fecha_agenda: $('#fechaListadoAreaMaster').val(), 
      con_paquete: 0 
    };
    // DataTable
    $.getScript('contenido/js/muestras-tabla.js')
    // Botones
    $.getScript('contenido/js/muestras-botones.js')
  })
}