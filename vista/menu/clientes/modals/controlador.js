//Menu predeterminado
$.post("modals/a_modals.php", function(html){
   $("#modals-js").html(html);
   // Modal para crear Paquete
   //$.getScript('modals/js/pa_crearPaquete.js');
   // Modal para rechazar
   //$.getScript('modals/js/p_rechazar.js');
   // Modal para rechazar
  // $.getScript('modals/js/subir-perfil.js');
});

