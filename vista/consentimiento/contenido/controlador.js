// if (validarVista('')) {
//     hasLocation();
//     $(window).on("hashchange", function (e) {
//         hasLocation();
//     });
// }
$(window).on("hashchange", function (e) {
    hasLocation();
});
hasLocation();

async function ObtenerContenido() {
    await obtenerTitulo('Consetimiento paciente'); //Aqui mandar el nombre de la area
    $.post("contenido/contenido.php", function (html) {
        $("#body-js").html(html);
    }).done(function () {
        // Datatable
        $.getScript("contenido/js/paciente.js");
    });
}



function hasLocation() {
    var hash = window.location.hash.substring(1);
    $("a").removeClass("navlinkactive");
    $("nav li a[href='#" + hash + "']").addClass("navlinkactive");
    switch (hash) {
        case "":
            ObtenerContenido();
            break;
        default:
            window.location.hash = '';
            break;
    }
}