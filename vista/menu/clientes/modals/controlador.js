//Menu predeterminado
$.post("modals/a_modals.php", function (html) {
  $("#modals-js").html(html);
  //$.getScript('modals/js/p_rechazar.js');
  // Modal para rechazar
  // $.getScript('modals/js/subir-perfil.js');
}).done(function () {
  // Modal para Actualizar Cliente
  $.getScript('modals/js/cl_editar_cliente.js');
  // Moda para agregar clientes
  $.getScript('modals/js/cl_agregar_cliente.js');
  //Modal de descuento de cliente
  $.getScript('modals/js/modal_descueto_cliente.js');



  // Modal para agregar contacto
  $.getScript('modals/js/cl_agregar_contacto.js');
  // Modal para Actualizar Contacto
  $.getScript('modals/js/cl_editar_contacto.js');


  //Modal para Registrar Segmentos
  $.getScript('modals/js/sg_agregar_segmento.js');

  //Modal para Actualizar Segmentos
  $.getScript('modals/js/sg_editar_segmento.js');
});
