$.post("modals/a_modals.php", function (html) {
  $("#modals-js").html(html);
}).done(function () {
  // Modal para agregar estudio
  $.getScript("modals/js/estu_agregar_estudio.js");
  $.getScript("modals/js/gp_rellenar_estudio.js");
  $.getScript("modals/js/modal_referencia.js");
  $.getScript(`${http}${servidor}/${appname}/vista/include/funciones/laboratorio-consultar_reporte/js/consultar_mostrar_reporte.js`)

  getAreaUnValor('metodos', 'metodo', 'laboratorio_metodos_api', 'ID_METODO', '#MODAL_METODOS_VISTA')

  getAreaUnValor('maquila', 'maquila', 'laboratorio_maquila_api', 'ID_LABORATORIO', '#MODAL_MAQUILA_VISTA')


});
