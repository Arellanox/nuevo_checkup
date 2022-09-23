<<<<<<< Updated upstream
$.post("modals/a_modals.php", function(html){
   $("#modals-js").html(html);
   // Modal para agregar estudio
   $.getScript('modals/js/estu_agregar_estudio.js');
   // Modal para editar estudio
   $.getScript('modals/js/estu_editar_estudio.js');


   // Modal para editar equipo
   $.getScript('modals/js/eq_editar_equipo.js');
   // Modal para vista de metodos
   $.getScript('modals/js/metodo_modal.js');

=======
$.post("modals/a_modals.php", function (html) {
  $("#modals-js").html(html);
  // Modal para metodos
  $.getScript("modals/js/estu_agregar_estudio.js");
  // Modal para metodos
  $.getScript("modals/js/estu_editar_estudio.js");
  // Modal para metodos
  $.getScript("modals/js/metodo_modal.js");
  // Modal para metodos
  $.getScript("modals/js/eq_agregar_equipo.js");
  // Modal para metodos
  $.getScript("modals/js/eq_editar_equipo.js");
>>>>>>> Stashed changes
});
