//Menu predeterminado
hasLocation();
$(window).on("hashchange", function (e) {
  hasLocation();
});



function obtenerContenidoSegmentos(titulo) {
  obtenerTitulo(titulo); //Aqui mandar el nombre de la area
  $.post("contenido/segmentos.php", function (html) {
    var idrow;
    $("#body-js").html(html);
    // Datatable
    $.getScript("contenido/js/segmentos-tabla.js");
    // Botones
    $.getScript("contenido/js/botones-segmento.js");
  });
}

function hasLocation() {
  var hash = window.location.hash.substring(1);
  $("a").removeClass("navlinkactive");
  $("nav li a[href='#" + hash + "']").addClass("navlinkactive");
  switch (hash) {
    case "Clientes":

      obtenerContenidoCliente("Clientes");

    break;
    case "Segmentos":
      obtenerContenidoSegmentos("Segmentos");
      break;
    default:
      obtenerContenidoCliente("Clientes");
      break;
  }
}

function obtenerContenidoCliente(titulo) {
  obtenerTitulo(titulo); //Aqui mandar el nombre de la area
  $.post("contenido/clientes.php", function (html) {
    var idrow;
    $("#body-js").html(html);
    // Datatable
    $.getScript("contenido/js/cliente-tabla.js");
    // Botones
    $.getScript("contenido/js/cliente-botones.js");
  });
}