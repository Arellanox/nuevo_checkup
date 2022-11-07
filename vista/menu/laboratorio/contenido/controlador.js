
var tablaListaPaciente, dataListaPaciente = {api:5, fecha_busqueda: $('#fechaListadoLaboratorio').val(), area_id: 6};
var idsEstudiosa, selectListaLab;
obtenerContenidoLaboratorio();
function obtenerContenidoLaboratorio(){
  obtenerTitulo("Resultados de laboratorio", function(rest){
    $.post("contenido/laboratorio.php", function(html){
       $("#body-js").html(html);
    }).done(function(){
      dataListaPaciente = {api:5, fecha_busqueda: $('#fechaListadoLaboratorio').val(), area_id: 6}
      // DataTable
      $.getScript('contenido/js/lista-tabla.js')
      // Botones
      $.getScript('contenido/js/laboratorio-botones.js')
    });
  });
}
