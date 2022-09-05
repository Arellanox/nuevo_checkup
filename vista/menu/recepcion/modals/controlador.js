$.post("modals/m_recepcion.php", function(html){
   $("#modals-js").html(html);
   // Modal para aceptar
   $.getScript('modals/js/p_aceptar.js');
   // Modal para rechazar
   $.getScript('modals/js/p_rechazar.js');
   // Modal para rechazar
   $.getScript('modals/js/subir-perfil.js');
});
