$.post("modals/a_modals.php", function (html) {
  $("#modals-js").html(html);


  // $.getScript('modals/js/modal_consulta.js')
  // Modal para crear consulta
  $.getScript('modals/js/motivo-consulta.js');

  // Modal para crear consulta medica
  $.getScript('modals/js/motivo-consulta-medica.js');

  //Modal para agregar imagenes en audiometria
  // $.getScript(`${http}${servidor}/${appname}/vista/include/funciones/carga_oidos/js/captura_oidos.js`).done();

  //Modal para certificado medico
  // $.getScript('modals/js/certificado-medico.js');
});
