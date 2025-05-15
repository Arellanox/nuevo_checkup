// obtenerContenido o cambiar
obtenerContenido("certificado.php");

function obtenerContenido(tabla) {
    $.post("contenido/" + tabla, async function (html) {
        $("#body-js").html(html);
        $.getScript("contenido/js/certificado.js")
    });
}