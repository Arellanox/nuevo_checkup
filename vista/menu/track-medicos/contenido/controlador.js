
var tablaMuestras, dataListaPaciente = { api: 1 }, selectListaMuestras;

var TablaDetallePacientesReportes, dataDetallePacientesReportes


// Validar permiso de modulo
if (validarVista('TRACKER_MEDICOS')) {
  contenidoSeguimientoMedicos()
}
async function contenidoSeguimientoMedicos() {
  await obtenerTitulo("Tracking de médicos");
  $.post("contenido/seg-medicos.php", function (html) {
    $("#body-js").html(html);
  }).done(function () {
    // DataTable
    $.getScript('contenido/js/seg-medicos-tabla.js')
    // Botones
    $.getScript('contenido/js/seg-medicos-botones.js')
  })
}
