async function contenidoBibliotecaMedica() {
  await obtenerTitulo("Biblioteca médica");

  $.post("contenido/biblioteca-medica.html", function (html) {
    $("#body-js").html(html);
  }).done(function () {
    $.getScript("contenido/js/reporte-tabla.js");
  });
}

contenidoBibliotecaMedica();
