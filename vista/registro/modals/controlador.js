$.post("modals/registro.php", function(html){
   $("#modals-js").html(html);

   // Script de información
   $.getScript('modals/js/registrar-info.js')
   // Script de pruebas
   $.getScript('modals/js/registrar-prueba.js')
   // Script de resultados
   $.getScript('modals/js/consultar-prueba.js')

});
