function initLoggin () {
    loggin(function (val) {
        if (val) {
            getGalleryPromociones_menu();

            $(document).on('click', '.promociones_event', function(event) {
                oneClick_promociones += 1;

                setTimeout(() => {
                    if (oneClick_promociones === 1) {
                        getGalleryPromociones_menu();
                    }
                }, 250);
            });

            $(function() {
                $.getScript('contenido/controlador.js').done(function(data) {// Aqui controlar e incluir las modals
                    if (validar === true) { //Aquí controlar e incluir las tablas
                        $.getScript('modals/controlador.js').done(function() {});
                        // ¡Algunos modals de algunas áreas no usan la clase GuardarArreglo!
                    }
                });
            })
        }
    }, tipoUrl);
}

function getGalleryPromociones_menu() {
    ajaxAwait({api: 2, vigente: 1}, 'promociones_api', {callbackAfter: true}, false, (data) => {
        // Resetea para volver a consultar
        oneClick_promociones = 0;

        if (data.response.data.length > 0) {
            const galleria = new CargadorProgresivo({
                contenedor: 'vistaPromociones',
                html_case: 'PROMOCIONES_BIMO',
                datos: data.response.data,
                itemsIniciales: 10,
                itemsPorCarga: 50,
                html: {
                    imagenes_css: {
                        width: '100%',
                    },
                    divElement: {
                        class: 'col-lg-6 col-md-6 mb-4'
                    }
                }
            });
            modal_alert = 1;

            $('.promociones-block').fadeIn(100);
        } else {
            $('.promociones-block').fadeOut(0);
            $('#modalPromociones').modal('hide');

            modal_alert = 0;

            if (modal_alert) alertToast('Promociones no activas', 'info', 5000)
        }
    })
}

initLoggin();