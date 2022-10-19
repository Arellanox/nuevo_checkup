//Menu predeterminado
hasLocation();
$(window).on("hashchange", function (e) {
  hasLocation();
});


function obtenerContenidoVista(titulo) {
  obtenerTitulo(titulo); //Aqui mandar el nombre de la area
  $.post("contenido/contenido.php", function (html) {
    var idrow;
    $("#body-js").html(html);
    // // Datatable
     $.getScript("contenido/js/vista-tabla.js");
    // // Botones
    // $.getScript("contenido/js/estudio-botones.js");
  });
}
