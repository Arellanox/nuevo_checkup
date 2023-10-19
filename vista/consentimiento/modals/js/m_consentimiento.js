$(document).on("click", "#btn-mostrar-formato-consentimiento", function () {
    MostrarReportePDF();
})

// Function para mostrar en el modal el visualizador de reporte, obvio con el reporte seleccionado xd
function MostrarReportePDF() {
    const RUTA = "null";
    const NOMBRE = "null";

    if (RUTA === null) {
        alertMsj({
            title: '¡No se pudo obtener su reporte!', text: 'Hubo un problema al obtener su reporte, por favor de contactar al soporte de bimo',
            icon: 'error', allowOutsideClick: true, showCancelButton: false, showConfirmButton: true
        })
        $("#consentimiento_paciente_modal").modal("hide");
        return false;
    } else {
        getNewView(RUTA, NOMBRE)
        $("#consentimiento_paciente_modal").modal("show");
    }

}

// Función que se ejecuta cuando se realiza una acción para obtener un nuevo PDF
function getNewView(url, filename) {
    // Destruir la instancia existente de AdobeDC.View
    // Crear una instancia inicial de AdobeDC.View
    let adobeDCView = new AdobeDC.View({ clientId: "cd0a5ec82af74d85b589bbb7f1175ce3", divId: "adobe-dc-view" });

    var nuevaURL = url;

    // Agregar un parámetro único a la URL para evitar la caché del navegador
    nuevaURL += "?timestamp=" + Date.now();

    // Cargar y mostrar el nuevo PDF en el visor
    adobeDCView.previewFile({
        content: { location: { url: nuevaURL } },
        metaData: { fileName: filename }
    });
}





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
        $currentVisiblePage.addClass('animate_animated animate_slideOutLeft');
        $newPage.show().addClass('animate_animated animate_slideInRight');
    } else if (direction === 'back') {
        $currentVisiblePage.addClass('animate_animated animate_slideOutRight');
        $newPage.show().addClass('animate_animated animate_slideInLeft');
    }

    $currentVisiblePage.one('animationend', function () {
        $currentVisiblePage.removeClass('animate_animated animateslideOutLeft animate_slideOutRight').hide();
    });

    $newPage.one('animationend', function () {
        $newPage.removeClass('animate_animated animateslideInRight animate_slideInLeft');
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


$('#modalSubirInterpretacion').on('shown.bs.modal', function () {
    const hammertime = new Hammer(document.querySelector('#modalSubirInterpretacion .modal-body'));

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
updatePage($('.page').first())