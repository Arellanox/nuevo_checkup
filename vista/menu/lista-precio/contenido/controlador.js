obtenerContenidoPrecios("listaprecios.php");
function obtenerContenidoPrecios(tabla) {
  obtenerTitulo("ListaPrecios"); //Aqui mandar el nombre de la area
  $.post("contenido/" + tabla, function (html) {
    var idrow;
    $("#body-js").html(html);

    // Datatable
    $.getScript("contenido/js/precios-tabla.js");
    // Botones
    $.getScript("contenido/js/precio-botones.js");
  });
}




obtenerContenidoPaquetes("paquetes.php");
function obtenerContenidoPaquetes(tabla) {
  obtenerTitulo("Paquetes"); //Aqui mandar el nombre de la area
  $.post("contenido/" + tabla, function (html) {
    var idrow;
    $("#body-js").html(html);

    // Datatable
    $.getScript("contenido/js/paquete-tabla.js");
    // Botones
    $.getScript("contenido/js/paquete-botones.js");
  });
}
