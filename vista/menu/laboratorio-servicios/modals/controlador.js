$.post("modals/a_modals.php", function (html) {
  $("#modals-js").html(html);
  // Modal para agregar estudio
  $.getScript("modals/js/estu_agregar_estudio.js");
  // Modal para editar estudio
  $.getScript("modals/js/estu_editar_estudio.js");


  //Modal para agregar equipo
  $.getScript("modals/js/eq_agregar_equipo.js");
  // Modal para editar equipo
  $.getScript("modals/js/eq_editar_equipo.js");


  // Modal para vista de metodos
  $.getScript("modals/js/metodo_modal.js");
  // Datatable Metodo
  $.getScript("contenido/js/metodo-tabla.js");
  // Metodo botones
  $.getScript("contenido/js/metodo-botones.js");


  // Modal para vista de grupos de exameness
  $.getScript("modals/js/gp_agregar_grupo.js");
  $.getScript("modals/js/gp_editar_grupo.js");

});