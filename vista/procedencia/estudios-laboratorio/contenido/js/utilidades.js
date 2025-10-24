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

function restartPages(divPadre) {
    // Ocultar todas las páginas
    $(`#${divPadre} .page`).hide();

    // Mostrar la primera página sin animación
    $(`#${divPadre} .page`).first().show();
}

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


        // Previene el doble click
        // $prevButton.attr('disabled', isFirstPage ? true : false)
        // $nextButton.attr('disabled', isLastPage ? true : false)
    });
}
