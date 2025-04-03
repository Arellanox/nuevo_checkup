let tablaRecepcionPacientes, dataRecepcion = {api: 1};

async function cargarContenido() {
    await obtenerTitulo('Solicitud de Franquicia | Maquila');
    $.post("contenido/page.html", function (html) {
        $("#body-js").html(html);
    }).done(function () {
        $.getScript("contenido/js/botones.js");
        $.getScript("contenido/js/tabla.js");
    });
}

cargarContenido().then(() => {});
