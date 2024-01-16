
var tablaMuestras, dataListaPaciente = {}, selectListaMuestras;

if (validarVista('LABORATORIO_MUESTRA_1')) {
  contenidoMuestras()
}
async function contenidoMuestras() {
  await obtenerTitulo("Promocionales bimo");
  $.post("contenido/admin_promociones.php", function (html) {
    $("#body-js").html(html);
  }).done(function () {
    // Botones
    $.getScript('contenido/js/promociones-botones.js')
  })
}
