// Abrir el model de formulario
$('#btn-interpretacionPrequi').on('click', function () {

    $('#MostrarCapturaPrequirurjico').modal('show');
})

// Obtener el reporte previo
$('#btn-ver-reporte').click(function () {
    area_nombre = ''
    api = encodeURIComponent(window.btoa(area_nombre));
    turno = encodeURIComponent(window.btoa(dataSelect.array['turno']));
    area = encodeURIComponent(window.btoa(areaActiva));


    window.open(`${http}${servidor}/${appname}/visualizar_reporte/?api=${api}&turno=${turno}&area=${area}`, "_blank");
})







// Enviar interpretacion a back
$(`#formInterpretacion`).submit(function (e) {
    e.preventDefault();

    alertMensajeConfirm({
        tittle: '¿Estás seguro de guardar la interpretacion',
        text: 'Los cambios previos serán reemplazados al guardar',
        icon: 'question'
    }, function () {
        ajaxAwaitFormData({
            api: 2,
        }, 'prequirurgico_api', 'formInterpretacion', { callbackAfter: true }, false, () => {
            alert(1);
        })
    }, 1)
})














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


$(document).on('click', '.control-pagina-interpretacion', function (event) {
    event.preventDefault();
    event.stopPropagation();
    const $btn = $(this);
    const action = $btn.attr('target');
    const $visiblePage = $('.page:visible');
    console.log($visiblePage)
    switch (action) {
        case 'back':
            const $prevPage = $visiblePage.prev('.page');
            console.log($visiblePage.prev('.page'))
            if ($prevPage.length) {
                updatePage($prevPage, action);
            }
            break;
        case 'next':
            const $nextPage = $visiblePage.next('.page');
            console.log($visiblePage.next('.page'))
            if ($nextPage.length) {
                updatePage($nextPage, action);
            }
            break;
        default:
            break;
    }
});


$('#MostrarCapturaPrequirurjico').on('shown.bs.modal', function () {
    const hammertime = new Hammer(document.querySelector('#MostrarCapturaPrequirurjico .modal-body'));

    hammertime.on('swipeleft', function () {
        const $visiblePage = $('.page:visible');
        const $nextPage = $visiblePage.next('.page');
        if ($nextPage.length) {
            updatePage($nextPage, 'next');
        }
    });

    hammertime.on('swiperight', function () {
        const $visiblePage = $('.page:visible');
        const $prevPage = $visiblePage.prev('.page');
        if ($prevPage.length) {
            updatePage($prevPage, 'back');
        }
    });


});




// Inicializamos mostrando la primera página
// updatePage($('.page').first());
function restartPages() {
    // Ocultar todas las páginas
    $('.page').hide();

    // Mostrar la primera página sin animación
    $('.page').first().show();
}

// Llamar a esta función para reiniciar
restartPages();
