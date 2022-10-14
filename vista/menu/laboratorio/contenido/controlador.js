
var tablaListaPaciente, dataListaPaciente = {api:2, fecha: $('#fechaListadoLaboratorio').val()};
obtenerContenidoLaboratorio();
function obtenerContenidoLaboratorio(){
  obtenerTitulo("Resultados de laboratorio"); //Aqui mandar el nombre de la area
  $.post("contenido/laboratorio.php", function(html){
     $("#body-js").html(html);
  }).done(function(){
    // DataTable
    $.getScript('contenido/js/lista-tabla.js')
    // Botones
    $.getScript('contenido/js/laboratorio-botones.js')
  });
}
