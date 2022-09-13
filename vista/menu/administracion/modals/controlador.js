$.post("modals/a_modals.php", function(html){
   $("#modals-js").html(html);
   // Modal para registrar usuario
   $.getScript('modals/js/user_agregar_usuario.js');
   // Modal para registrar usuario
   $.getScript('modals/js/user_editar_usuario.js');
   // Modal para editar areas
   $.getScript('modals/js/user_editar_areas.js');
   // Modal para editar permisos
   $.getScript('modals/js/user_editar_permisos.js');
   // Modal para registrar cargo
   $.getScript('modals/js/cargo_crear.js');
});
