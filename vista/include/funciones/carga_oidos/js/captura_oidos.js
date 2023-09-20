const getFormOidosAudiometria = (paciente) => {

    recuperarCapturasOidos() // <- Intenta recuperar imagenes
    // console.log(paciente)
    const capturador = (area, direccion) => {
        InputDragDrop(area, async (inputArea, salidaInput) => {
            await envioCapturaOidos(direccion)
            recuperarCapturasOidos() // <- Intenta recuperar imagenes
            salidaInput(); // <- Marca salida
        })
    }

    //Subir captura del oido izquierdo
    capturador('#dropOidoIzquierdo', 'subirCapturaOidoIzquierdo')
    //Subir captura del oido derecho
    capturador('#dropOidoDerecho', 'subirCapturaOidoDerecho')

    function envioCapturaOidos(formAudiometria) {
        return new Promise((resolve) => {
            ajaxAwaitFormData(
                { api: 3, turno_id: paciente.ID_TURNO },
                'audiometria_api', formAudiometria, { callbackAfter: true }, false,
                function () {
                    resolve(1)
                })
        })

        // console.log(paciente);
        // return false;
    }

    // Recupera y crea HTML de la imagen o mensaje de no disponible
    function recuperarCapturasOidos() {
        // Manda mensaje de respuesta, no hay imagenes disponibles
        const derecho_error = () => { $('#contend-oido-der').html(`<p id="mensaje-oido-derecho">No hay imagen disponible para el oído derecho.</p>`) }
        const izquierdo_error = () => { $("#contend-oido-izq").html(`<p id="mensaje-oido-derecho">No hay imagen disponible para el oído izquierdo.</p>`) }

        ajaxAwait({ api: 4, turno_id: paciente.ID_TURNO }, 'audiometria_api', { callbackAfter: true, WithoutResponseData: true }, false, function (row) {

            // Reseteamos la imagen para nueva carga
            $('#contend-oido-der').html('');
            $("#contend-oido-izq").html('');

            if (!ifnull(row, false, [0])) {
                row = row[0];
                // Muestra imagenes disponibles
                ifnull(row, false, ['CAPTURA_IZQ']) ?
                    $("#contend-oido-izq").html(`<img src="${row['CAPTURA_IZQ']}" class="img-fluid mb-2" alt="..." id="captura-oido-izquierdo">`) : izquierdo_error();
                ifnull(row, false, ['CAPTURA_DER']) ?
                    $("#contend-oido-der").html(`<img src="${row['CAPTURA_DER']}" class="img-fluid mb-2" alt="..." id="captura-oido-izquierdo">`) : derecho_error();
            } else {
                izquierdo_error()
                derecho_error()
            }

        })
    }
}