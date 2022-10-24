$.post("modals/m_recepcion.php", function(html){
   $("#modals-js").html(html);
}).done(function(){
  // Modal para aceptar
  $.getScript('modals/js/p_aceptar.js');
  // Modal para rechazar
  $.getScript('modals/js/p_rechazar.js');
  // Modal para rechazar
  $.getScript('modals/js/subir-perfil.js');
  // Modal para registar una agenda
  $.getScript(http + servidor + "/nuevo_checkup/vista/include/modal/js/registrar-agenda.js");
});
