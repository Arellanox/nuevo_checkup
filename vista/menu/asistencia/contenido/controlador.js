if (validarVista('ASISTENCIA')) {
    hasLocation();
    $(window).on("hashchange", function (e) {
        hasLocation();
    });
}

let dataReporteAsistencia = {
    api: 10, bimer_id: 0,
}, select_data;

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
var dataAsistencia, usuarioSelected = false; // var para rellenar la tabla principal

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
