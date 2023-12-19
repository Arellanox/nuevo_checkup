let id_servicio_global = null
$(document).on('click', '.btn-acciones', async function (event) {
    event.preventDefault();

    id_servicio_global = $(this).attr('data-bs-id');

    await getCapturas(id_servicio_global);

    $('#modalCapturasMicroscopio').modal('show');

})


async function getCapturas(servicio_id) {
    return new Promise(async function (resolve, reject) {
        await ajaxAwait({ api: 2, turno_id: selectListaLab['ID_TURNO'], servicio_id: servicio_id }, 'laboratorio_api', { callbackAfter: true }, false, (data) => {
            console.log(data);
            $('#carrusel_microscopio').html('')

            $('#carrusel_microscopio').html(crearHTMLImag(data.response.data))
            activeFancybox();
            // Retorna que esta listo
            resolve(1)
        })

    })
}

function crearHTMLImag(capturasData) {
    try {
        const capturas = capturasData[0]['CAPTURAS'][0];

        let carouselItems = capturas.map((element, index) => `
            <div data-fancybox="galeria-microscopio" class="f-carousel__slide" data-src="${element['url']}" data-thumb-src="${element['url']}">
                <img data-lazy-src="${element['url']}" alt="Imagen ${index + 1}">
            </div>`).join('');

        return `
            <div class="col-12">
                <div class="f-carousel">
                    ${carouselItems}
                </div>
            </div>`;

    } catch (error) {
        console.error('Error generating carousel section:', error);
        return '';
    }
}


function activeFancybox() {
    // Crea la galeria
    const carousels = document.querySelectorAll(".f-carousel");
    const options = {
        Thumbs: {
            type: "classic"
        }
    };

    carousels.forEach((carousel) => {
        new Carousel(carousel, options, { Thumbs });
    });

    Fancybox.bind('[data-fancybox]', {
        Toolbar: {
            display: {
                left: ["infobar"],
                middle: ["zoomIn", "zoomOut", "flipX", "flipY"],
                right: ["close"]
            }
        },
        Images: {
            initialSize: "fit"
        },
        contentClick: "iterateZoom",
        Panzoom: {
            maxScale: 2
        },
        Thumbs: {
            type: "classic",
        },
        Hash: false,
        contentClick: "iterateZoom",
        Panzoom: {
            maxScale: 3  // Permite un zoom de hasta 3 veces el tamaño original
        }
    });
}




InputDragDrop('#dropMicroscopio', (inputArea, salidaInput) => {

    ajaxAwaitFormData({
        turno_id: selectListaLab['ID_TURNO'], api: 1, servicio_id: id_servicio_global
    }, 'laboratorio_api', 'subirCapturaMicroscopio', { callbackAfter: true }, false, function () {
        //   obtenerPanelInformacion(pacienteActivo.array['ID_TURNO'], 'consulta_api', 'listado_resultados', '#listado-resultados')

        getCapturas(id_servicio_global)

        // Siempre se ejecuta al final del proceso
        salidaInput();

    })
}, { multiple: true })