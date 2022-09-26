//Menu predeterminado
hasLocation();
$(window).on("hashchange", function (e) {
  hasLocation();
});

// Variable de seleccion de metodo
var array_metodo;
var idMetodo = null;

function obtenerContenidoPaquetes() {
  obtenerTitulo("Paquetes"); //Aqui mandar el nombre de la area
  $.post("contenido/paquetes.php", function (html) {
    var idrow;
    $("#body-js").html(html);
    // Datatable
    $.getScript("contenido/js/estudio-tabla.js");
    // Botones
    $.getScript("contenido/js/estudio-botones.js");
  });
}

function obtenerContenidoPrecios() {
  obtenerTitulo("Lista de precios"); //Aqui mandar el nombre de la area
  $.post("contenido/precios.php", function (html) {
    var idrow;
    $("#body-js").html(html);
    // Datatable
    $.getScript("contenido/js/grupos-tabla.js");
    // Botones
    $.getScript("contenido/js/grupos-botones.js");
  });
}

function hasLocation() {
  var hash = window.location.hash.substring(1);
  $("a").removeClass("navlinkactive");
  $("nav li a[href='#" + hash + "']").addClass("navlinkactive");
  switch (hash) {
    case "Paquetes":
      obtenerContenidoPaquetes();
      break;
    case "ListaPrecios":
      obtenerContenidoPrecios();
      break;
    default:
      obtenerContenidoPrecios();
      break;
  }
}
