hasLocation();
$(window).on("hashchange", function (e) {
  hasLocation();
});


function obtenerContenidoPrecios() {
  obtenerTitulo("Lista de precios"); //Aqui mandar el nombre de la area
  $.post("contenido/listaprecios.php", function (html) {
    var idrow;
    $("#body-js").html(html);

    // Datatable
    $.getScript("contenido/js/precios-tabla.js");
    // Botones
    $.getScript("contenido/js/precio-botones.js");
  });
}


function obtenerContenidoPaquetes(tabla) {
  obtenerTitulo("Paquetes de clientes"); //Aqui mandar el nombre de la area
  $.post("contenido/paquetes.php", function (html) {
    var idrow;
    $("#body-js").html(html);

  }).done(function () {
       // Datatable
    $.getScript("contenido/js/paquete-tabla.js");
    // Botones
    $.getScript("contenido/js/paquete-botones.js");
    //Formulario
    $.getScript("contenido/js/paquete-completar.js");
  }
  );

}

function hasLocation() {
  var hash = window.location.hash.substring(1);
  $("a").removeClass("navlinkactive");
  $("nav li a[href='#" + hash + "']").addClass("navlinkactive");
  switch (hash) {
    case "PreciosEstudios":
      obtenerContenidoPrecios();
      break;
    case "PaquetesClientes":
      obtenerContenidoPaquetes();
      break;
    default:
      obtenerContenidoPrecios();
      break;
  }
}
