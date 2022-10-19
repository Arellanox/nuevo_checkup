$.post("modals/a_modals.php", function (html) {
  $("#modals-js").html(html);
  // Modal para agregar interpretacion
  $.getScript("modals/js/ar_subirprueba_area.js");
});
