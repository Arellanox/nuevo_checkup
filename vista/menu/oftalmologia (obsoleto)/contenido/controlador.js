var tablaContenido, areaActiva = 1;
var dataListaPaciente = {};
var selectListaLab;

if (sessionVista('OFTALMOLOGIA') == true) {
  obtenerContenidoOftal()
}else{
  window.location.href = http + servidor + '/nuevo_checkup/vista/login/';
}

function obtenerContenidoOftal(){
  obtenerTitulo('Resultados de Oftalmología'); //Aqui mandar el nombre de la area
  $.post("contenido/contenido.php", function(html){
     $("#body-js").html(html);
  }).done(function(){
    // Datatable
    $.getScript("contenido/js/vista-tabla.js")
    // Botones
    $.getScript("contenido/js/oftalmo-botones.js");
    dataListaPaciente = {api:5, area_id: 3, fecha_busqueda: $('#fechaListadoAreaMaster').val()};
  });
}

function sessionVista(areaVista) {
  let vista = session.vista;
  return vista[areaVista] == 1 ? true:false;
}
