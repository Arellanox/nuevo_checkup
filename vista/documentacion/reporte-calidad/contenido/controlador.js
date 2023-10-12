obtenerContenidoEstudios()

function obtenerContenidoEstudios() {
    obtenerTitulo("Calidad estudios"); //Aqui mandar el nombre de la area
    $.post("contenido/calidad-reporte.html", function (html) {
        $("#body-js").html(html);
    }).done(function () {
        $.getScript("contenido/js/tabla.js");
    });
}