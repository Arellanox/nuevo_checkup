// obtenerContenido o cambiar
obtenerContenido("contenido.html");

function obtenerContenido(tabla) {
  $.post("contenido/" + tabla, function (html) {
    $("#body-js").html(html);

  });
}