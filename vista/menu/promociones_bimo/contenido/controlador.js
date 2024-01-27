
var tablaMuestras, dataListaPaciente = {}, selectListaMuestras;

if (validarVista('PROMOCIONALES_BIMO')) {
  promocionales_content()
}
async function promocionales_content() {
  await obtenerTitulo("Promocionales bimo");
  $.post("contenido/admin_promociones.php", function (html) {
    $("#body-js").html(html);
  }).done(function () {
    // Botones
    $.getScript('contenido/js/promociones-botones.js')
  })
}
