$.post("modals/a_modals.php", function(html){
   $("#modals-js").html(html);
   // Modal para metodos
   $.getScript('modals/js/estu_agregar_estudio.js');
   // Modal para metodos
   $.getScript('modals/js/estu_editar_estudio.js');
   // Modal para metodos
   $.getScript('modals/js/metodo_modal.js');

});
