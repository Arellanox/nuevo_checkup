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

function obtenerContenidoGrupos(titulo){
  obtenerTitulo(titulo); //Aqui mandar el nombre de la area
  $.post("contenido/grupos.php", function (html) {
    var idrow;
    $("#body-js").html(html);
    // Datatable
    $.getScript("contenido/js/grupo-tabla.js");
    // Botones
    $.getScript("contenido/js/grupo-botones.js");
  });
}

function obtenerContenidoEquipos(titulo){
  obtenerTitulo(titulo); //Aqui mandar el nombre de la area
  $.post("contenido/equipos.php", function (html) {
    var idrow;
    $("#body-js").html(html);
    // Datatable
    $.getScript("contenido/js/equipos-tabla.js");
    // Botones
    $.getScript("contenido/js/equipos-botones.js");
  });
}





function hasLocation() {
  var hash = window.location.hash.substring(1);
  $('a').removeClass('navlinkactive');
  $("nav li a[href='#" + hash + "']").addClass('navlinkactive');
  switch (hash) {
    case "Estudios":
      obtenerContenidoEstudios("Estudios");
      break;
    case "Grupos":
      obtenerContenidoGrupos("Grupos");
      break;
    case "Equipos":
      obtenerContenidoEquipos("Equipos");
      break;
    default:
      obtenerContenidoEstudios("Estudios");
      break;
  }
}
