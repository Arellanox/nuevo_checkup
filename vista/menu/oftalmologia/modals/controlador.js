$.post("modals/a_modals.php", function (html) {
  $("#modals-js").html(html);
  // Modal para agregar interpretacion
  $.getScript("modals/js/of_subir_olfatmo.js");
});
