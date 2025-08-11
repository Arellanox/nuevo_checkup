// obtenerContenido o cambiar
obtenerContenido();

function obtenerContenido() {
    $.post("contenido/presentacion.php", function (html) {
        $("#body-js").html(html);
    });
}