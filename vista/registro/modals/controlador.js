$.post("modals/registro.php", function(html){
   $("#modals-js").html(html);
}).done(function(){
  // Script de información
  $.getScript(http + servidor + "/nuevo_checkup/vista/include/modal/js/registrar-paciente.js");
  // Script de pruebas
  $.getScript(http + servidor + "/nuevo_checkup/vista/include/modal/js/registrar-agenda.js");
  // $.getScript('modals/js/consultar-prueba.js')
});
