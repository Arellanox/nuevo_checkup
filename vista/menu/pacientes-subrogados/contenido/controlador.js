
obtenerContenidoCompletados()

let PacienteSub = false

function obtenerContenidoCompletados() {
  obtenerTitulo('Pacientes subrogados'); //Aqui mandar el nombre de la area
  $.post("contenido/v-pacientes.html", function (html) {
    $("#body-js").html(html);
  }).done(function () {
    $.getScript("contenido/js/v-pacientes.js");
  });
}


