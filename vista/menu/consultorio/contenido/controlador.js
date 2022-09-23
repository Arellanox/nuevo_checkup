

obtenerContenidoConsulta()

function obtenerContenidoConsulta(titulo) {
  // obtenerTitulo(titulo); //Aqui mandar el nombre de la area
  $.post("contenido/consultorio_consulta.php", function (html) {
    var idrow;
    $("#body-js").html(html);
    // Datatable
    // $.getScript("contenido/js/estudio-tabla.js");
    // Botones
    // $.getScript("contenido/js/estudio-botones.js");
  });
}
