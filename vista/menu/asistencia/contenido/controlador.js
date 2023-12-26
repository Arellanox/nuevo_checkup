async function obtenerVistaAsistencia() {
    obtenerTitulo("Asistencia");
    $.post("contenido/contenido.php", function (html) {
        $("#body-js").html(html);
    }).done(async function () {
        // DataTable
        $.getScript('contenido/js/asistencia-tabla.js')
    });
}


// Variables globales locales

$(window).on("hashchange", function (e) {
    hasLocation();
});

hasLocation();

function hasLocation() {
    var hash = window.location.hash.substring(1);
    $("a").removeClass("navlinkactive");
    $("nav li a[href='#" + hash + "']").addClass("navlinkactive");

    switch (hash) {
        case "":
            obtenerVistaAsistencia();
            break;
        default:
            break;
    }

}
