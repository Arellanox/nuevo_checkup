//Menu predeterminado
$.post("modals/a_modals.php", function(html){
   $("#modals-js").html(html);


   // Modal para Actualizar Cliente
   $.getScript('modals/js/cl_editar_cliente.js');
   // Modal para Actualizar Contacto
   $.getScript('modals/js/cl_editar_contacto.js');

   // Moda para agregar clientes
   $.getScript('modals/js/cl_agregar_cliente.js');
   // Modal para agregar contacto
   $.getScript('modals/js/cl_agregar_contacto.js');

   //$.getScript('modals/js/p_rechazar.js');
   // Modal para rechazar
  // $.getScript('modals/js/subir-perfil.js');
});
