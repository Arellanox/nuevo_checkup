
// if (validarVista('REGISTRO_TEMPERATURA')) {
//     hasLocation();
//     $(window).on("hashchange", function (e) {
//         hasLocation();
//     });
// }

hasLocation();
$(window).on("hashchange", function (e) {
    hasLocation();
});

// Variables Globales

async function ObtenerBody() {
    await obtenerTitulo('Valoracion Prequirurgica'); //Aqui mandar el nombre de la area
    $.post("contenido/contenido.php", function (html) {
        $("#body-js").html(html);
    }).done(async function () {

        // Datatable
        $.getScript("contenido/js/tablas.js");
    });
}


function hasLocation() {
    var hash = window.location.hash.substring(1);
    $("a").removeClass("navlinkactive");
    $("nav li a[href='#" + hash + "']").addClass("navlinkactive");
    switch (hash) {

        case '':
            ObtenerBody();
            break;
        default:
            // window.location.hash = '#';
            break;
    }
}