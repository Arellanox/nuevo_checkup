$.post("modals/a_modals.php", function (html) {
  $("#modals-js").html(html);
}).done(() => {
  // Modal para agregar capturas
  $.getScript("modals/js/ar_subircapturas_area.js");
  // Modal para agregar capturas
  $.getScript("modals/js/ar_mostrar-capturas.js");


  //ELectro 
  $.getScript("modals/js/electro_mostrar_carpeta.js")

  //Nutricion inbody
  $.getScript('modals/js/nutri_inbody_capturas.js');

  //Modal para agregar imagenes en audiometria
  $.getScript(`${http}${servidor}/${appname}/vista/include/funciones/carga_oidos/js/captura_oidos.js`).done();

  //Captura de tablas de equipos
  $.getScript('modals/js/audio_captura_tabla_eq.js');
  // $.getScript(`${http}${servidor}/${appname}/vista/include/funciones/carga_oidos/js/captura_reporte_equipo.js`).done();

});