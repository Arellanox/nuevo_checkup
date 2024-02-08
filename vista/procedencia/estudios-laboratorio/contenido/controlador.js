hasLocation();
$(window).on("hashchange", function (e) {
    hasLocation();
});

// Variables globales
let tablaPacientesFaltantes_inicio = false, form_type = 1;
let TablaListaLotes



obtenerContenido()
// var datapacientes = { api: 1 }
function obtenerContenido() {
    obtenerTitulo('Principal | Maquila'); //Aqui mandar el nombre de la area
    $.post("contenido/pacientes_empresas.html", function (html) {
        $("#body-js").html(html);
    }).done(function () {
        // Datatable
        $.getScript("contenido/js/franq-tabla.js");
        // Botones
        $.getScript("contenido/js/franq-botones.js");

        // Filtros
    });
}

// |----------------------------- Funciones Globales -------------------------|

// Cambia la pagina a siguiente por estatus (1, 0), y que elementos
function combinePages(divPadre, estatus) {
    const $visiblePage = $(`#${divPadre} .page:visible`);
    // 1 para next, 0 para prev
    const $nextPage = estatus ? $visiblePage.next('.page') : $visiblePage.prev('.page');
    const next_page = estatus ? 'next' : 'back'
    if ($nextPage.length) {
        updatePage($nextPage, next_page); // Muestra la siguiente pagina
    } else {
        restartPages(); // No existe y veremos la primera pagina
    }
}

// |-------------------------------------------------------------------------|



function hasLocation() {
    var hash = window.location.hash.substring(1);
    $("a").removeClass("navlinkactive");
    $("nav li a[href='#" + hash + "']").addClass("navlinkactive");
    switch (hash) {
        case "HNSG":
            obtenerContenido();
            // Config por empresa
            // ------------ por id de empresa cada usuario para permisos y personalizacion
            break;
        default:
            // window.location.hash = '#UJAT';
            break;
    }
}


