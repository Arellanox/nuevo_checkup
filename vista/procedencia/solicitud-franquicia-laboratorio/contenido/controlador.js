let tablaPacientesFaltantes_inicio = false, form_type = 1;
let tablaRecepcionPacientes, dataRecepcion = {api: 1};
let TablaListaLotes, turno;

async function cargarContenido() {
    await obtenerTitulo('Solicitud de Franquicia | Maquila');

    $.post("contenido/page.html", function (html) {
        $("#body-js").html(html);
    }).done(function () {
        $.getScript("contenido/js/tabla.js");
        $.getScript("contenido/js/botones.js");
    });
}

cargarContenido();

// |-------------------------------------------------------------------------|
let isAnimating = false;

function combinePages(divPadre, estatus) {
    const $visiblePage = $(`#${divPadre} .page:visible`);

    const $nextPage = estatus ? $visiblePage.next('.page') : $visiblePage.prev('.page');
    const next_page = estatus ? 'next' : 'back'
    if ($nextPage.length) {
        updatePage($nextPage, next_page);
    } else restartPages(divPadre);
}

function restartPages(divPadre) {
    $(`#${divPadre} .page`).hide();
    $(`#${divPadre} .page`).first().show();
}

function updatePage($newPage, direction) {
    const $currentVisiblePage = $('.page:visible');

    $newPage.is('.page:last') ? $('.pagination-interpretacion').fadeIn(400) : $('.pagination-interpretacion').hide();


    if (!direction) {
        $newPage.show();
        $currentVisiblePage.hide();
        return;
    }

    if (isAnimating) return;

    isAnimating = true;

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
    });
}
// |-------------------------------------------------------------------------|