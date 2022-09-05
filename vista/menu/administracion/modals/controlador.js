$.post("modals/a_modals.php", function(html){
   $("#modals-js").html(html);
   // Modal para registrar usuario
   $.getScript('modals/js/user_agregar_usuario.js');
   // Modal para registrar usuario
   $.getScript('modals/js/user_editar_usuario.js');
});
