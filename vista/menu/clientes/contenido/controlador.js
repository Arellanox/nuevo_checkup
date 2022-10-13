

hasLocation();
$(window).on("hashchange", function (e) {
  hasLocation();
});

var datacontactos ={api:2,id_cliente:1};
var tablaContacto;
var selectContacto;

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
    // Datatable
    $.getScript("contenido/js/contactos-tabla.js");
    // Botones
    $.getScript("contenido/js/botones-cliente.js");
    // Botones
    $.getScript("contenido/js/botones-contactos.js");
  });
}
