// ObtenerTabla o cambiar
obtenerContenidoMeso();
function obtenerContenidoMeso(tabla){
  obtenerTitulo('Mesometría'); //Aqui mandar el nombre de la area
  $.post("contenido/mesometria.php", function(html){
    var idrow;
     $("#body-js").html(html);
     loader('Out')
     // Datatable
     // $.getScript("contenido/js/recepcion-tabla.js");
     // Botones
     // $.getScript("contenido/js/recepcion-botones.js");
  });
}
obtenerPanelInformacion(2, "pacientes_api", 'paciente')
