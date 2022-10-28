// obtenerContenido o cambiar
obtenerContenido("registro.php");
function obtenerContenido(tabla){
  $.post("contenido/"+tabla, function(html){
     $("#body-js").html(html);
  });
}
