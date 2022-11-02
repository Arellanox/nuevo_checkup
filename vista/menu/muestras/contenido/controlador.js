
var tablaMuestras, dataListaPaciente = {}, selectListaMuestras;


contenidoMuestras()
function contenidoMuestras(){
  obtenerTitulo("Toma de muestras");
  $.post("contenido/muestras.php", function(html){
     $("#body-js").html(html);
  }).done(function(){
    dataListaPaciente = {api:1,  area_id: 6};
    // DataTable
    $.getScript('contenido/js/muestras-tabla.js')
    // Botones
    $.getScript('contenido/js/muestras-botones.js')
  })
}
