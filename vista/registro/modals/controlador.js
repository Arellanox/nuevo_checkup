$.post("modals/registro.php", function(html){
   $("#modals-js").html(html);
}).done(function(){
  // Script de información
  $.getScript('modals/js/registrar-info.js');
  // Script de pruebas
  // $.getScript('modals/js/registrar-prueba.js');
  // Script de resultados
  $.getScript(http + servidor + "/nuevo_checkup/vista/include/modal/js/registrar-agenda.js");
  // $.getScript('modals/js/consultar-prueba.js')
});
