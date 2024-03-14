
obtenerContenidoCompletados()


function obtenerContenidoCompletados() {
  obtenerTitulo('Pacientes subrogados | Bimo'); //Aqui mandar el nombre de la area
  $.post("contenido/v-pacientes.html", function (html) {
    $("#body-js").html(html);
  });
}


