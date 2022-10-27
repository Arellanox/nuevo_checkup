
var tablaMuestras, dataListaPaciente = {api:5, fecha_busqueda: $('#fechaListadoLaboratorio').val(), area_id: 6};


contenidoMuestras()
function contenidoMuestras(){
  obtenerTitulo("Toma de muestras");
  $.post("contenido/muestras.php", function(html){
     $("#body-js").html(html);
  }).done(function(){
    // DataTable
    $.getScript('contenido/js/muestras-tabla.js')
    // Botones
    $.getScript('contenido/js/muestras-botones.js')
  })
}
