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
        restartPages(divPadre); // No existe y veremos la primera pagina
    }
}
// Inicializamos mostrando la primera página
// updatePage($('.page').first());
function restartPages(divPadre) {
    // Ocultar todas las páginas
    $(`#${divPadre} .page`).hide();

    // Mostrar la primera página sin animación
    $(`#${divPadre} .page`).first().show();
}

// Movilidad de tablet o paginacion
let isAnimating = false;
function updatePage($newPage, direction) {
    const $currentVisiblePage = $('.page:visible');
    const $prevButton = $('button.control-pagina-interpretacion[target="back"]')
    const $nextButton = $('button.control-pagina-interpretacion[target="next"]')

    //     // Verificar si es la última página
    if ($newPage.is('.page:last')) {
        $('.pagination-interpretacion').fadeIn(400);
    } else {
        $('.pagination-interpretacion').hide();
    }
    // });
    if (!direction) {
        $newPage.show();
        $currentVisiblePage.hide();
        return;
    }

    if (isAnimating) return;  // Si una animación está en curso, no hacemos nada

    isAnimating = true;  // Establecer el semáforo a verdadero

    if (direction === 'next') {
        $currentVisiblePage.addClass('animate__animated animate__slideOutLeft');
        $newPage.show().addClass('animate__animated animate__slideInRight');
    } else if (direction === 'back') {
        $currentVisiblePage.addClass('animate__animated animate__slideOutRight');
        $newPage.show().addClass('animate__animated animate__slideInLeft');
    }

    $currentVisiblePage.one('animationend', function () {
        $currentVisiblePage.removeClass('animate__animated animate__slideOutLeft animate__slideOutRight').hide();
    });

    $newPage.one('animationend', function () {
        $newPage.removeClass('animate__animated animate__slideInRight animate__slideInLeft');
        isAnimating = false;

        // Determinar la página actual y ajustar la visibilidad de los botones
        const isFirstPage = $newPage.is($('.page').first());
        const isLastPage = $newPage.is($('.page').last());


        $prevButton.attr('disabled', isFirstPage ? true : false)
        $nextButton.attr('disabled', isLastPage ? true : false)
    });
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


