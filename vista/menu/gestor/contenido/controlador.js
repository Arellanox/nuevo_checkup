

obtenerContenido();

async function obtenerContenido() {
    await obtenerTitulo('Gestor de bases');
    $.post("contenido/layout.html", function (html) {
        $("#body-js").html(html);
    }).done(function () {
        // Botones
        $.getScript("contenido/js/botones.js");
        // // Botones
        // $.getScript("contenido/js/somatometria-tabla.js");
    });
}


