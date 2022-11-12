$.post("modals/a_modals.php", function (html) {
  $("#modals-js").html(html);
  // Modal para agregar interpretacion
  $.getScript("modals/js/ar_subirprueba_area.js");
  // Modal para agregar capturas
  $.getScript("modals/js/ar_subircapturas_area.js");
  // Modal para agregar capturas
  $.getScript("modals/js/of_subir_oftalmo.js");
  // Modal para agregar capturas
  $.getScript("modals/js/ar_mostrar-capturas.js");
});
