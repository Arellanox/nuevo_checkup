$.post("modals/a_modals.php", function (html) {
  $("#modals-js").html(html);
}).done(function () {
  // Modal para agregar estudio
  $.getScript("modals/js/estu_agregar_estudio.js");


  //Modal para agregar equipo
  $.getScript("modals/js/eq_agregar_equipo.js");
  // Modal para editar equipo
  $.getScript("modals/js/eq_editar_equipo.js");


});
