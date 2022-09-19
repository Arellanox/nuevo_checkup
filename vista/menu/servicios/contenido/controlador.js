//Menu predeterminado
hasLocation();
$(window).on("hashchange", function (e) {
  hasLocation();
});

function obtenerContenidoEstudios(titulo){
  obtenerTitulo(titulo); //Aqui mandar el nombre de la area
  $.post("contenido/estudios.php", function (html) {
    var idrow;
    $("#body-js").html(html);
    // Datatable
    $.getScript("contenido/js/estudio-tabla.js");
    $.getScript("contenido/js/precios-tabla.js");
    // Botones
    $.getScript("contenido/js/estudio-botones.js");
  });
}

function hasLocation() {
  var hash = window.location.hash.substring(1);
  $('a').removeClass('navlinkactive');
  $("nav li a[href='#" + hash + "']").addClass('navlinkactive');
  switch (hash) {
    case "Estudios":
      obtenerContenidoEstudios("Estudio");
      break;
    default:
      obtenerContenidoEstudios("Estudio");
      break;
  }
}
