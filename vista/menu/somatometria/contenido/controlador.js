// ObtenerTabla o cambiar
obtenerContenidoMeso();
function obtenerContenidoMeso(){
  obtenerTitulo('Somatometría'); //Aqui mandar el nombre de la area
  $.post("contenido/mesometria.php", function(html){
    var idrow;
     $("#body-js").html(html);
     loader('Out')
  }).done(function(){
    // Datatable
    // $.getScript("contenido/js/recepcion-tabla.js");
    // Botones
    $.getScript("contenido/js/somatometria-botones.js");
  });
}
obtenerPanelInformacion(3, "pacientes_api", 'paciente');




function cargarDatosPaciente(){

}
