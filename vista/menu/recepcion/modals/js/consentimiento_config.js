// Evento click para el boton de recepción para solicitar un consentimiento
$(document).on('click', '#btn-solicitar-consentimiento', function () {
    alertMensajeConfirm({
        title: '¿Ha rellenado todos los campos correctamente?',
        text: 'Los datos seleccionado se reflejaran en el PDF del consentimiento.',
        icon: 'info'
    }, function () {
        solicitarConsentimiento();
    }, 1)
})

// Function para configurar el modal para solicitar el consentimiento de un paciente
async function configurarModalConsentimientoConfiguracion() {

    // Se limpia el modal cada vez que se abre para eliminar cualquier defecto que pueda tener
    clearModal()

    // Se saca el nombre del paciente
    const $px = array_selected.NOMBRE_COMPLETO;

    // Se muestra en el titulo del modal
    $('#title-consentimientoConfiguracion').html(`Consentimiento del paciente: (<strong>${$px}</strong>)`);

    // Se construyen los formularios del consentimiento
    await construiConsentimientoFormulario();

    await rellenarSelect('.select-usuario', 'usuarios_api', 2, 'ID_USUARIO', 'nombrecompleto', {}, () => {
        // $('#select-vendedor').val(0).trigger("change")
    })

    await select2('.select-usuario', 'modalConsentimientoConfiguracion')


    // Se abre el modal
    $("#modalConsentimientoConfiguracion").modal('show');
}

// Function para construir los consentimiento dependiendo de cuantos tenga
async function construiConsentimientoFormulario() {
    return new Promise(function (resolve, reject) {

        // Contenedor de los formularios
        const $div = $('#formularios_consentimiento'); // <-- div padre de los formularios de consentimiento
        $div.html("") // <-- se limpia el contenedor en caso de que tenga algo

        // Se obtiene el array donde estan todos los consentimientos
        let $row = JSON.parse(array_selected.CONSENTIMIENTO);

        // Se recorre el array para acceder a los datos y armar los formularios
        for (const key in $row) {
            if (Object.hasOwnProperty.call($row, key)) {
                const element = $row[key];

                const $ID = element.ID_CONSENTIMIENTO; // <-- ID del consentimiento
                const $NOMBRE = element.NOMBRE_CONSENTIMIENTO; // <-- Nombre del consentimientoe

                // Se arma el html para el formulario
                let $html = `
                 <div class="card shadow mx-1 my-3 p-3 row my-3">
                    <h5 class='fw-bold'>${$NOMBRE}</h5>
                    <div class="col-12">
                        <div class="mb-3">
                            <label for="quimico_${$ID}" class="form-label p-0 m-0" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-original-title="La quimica por defecto no se puede cambiar">Quimico:</label>
                            <select class=" form-select input-form" name="quimico_${$ID}" id="quimico_${$ID}" disabled>
                                <option value="57">NERY FABIOLA ORNELAS RESENDIZ</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="mb-3">
                            <label for="muestra_${$ID}" class="form-label p-0 m-0">Tomador:</label>
                            <select class="select-usuario form-select input-form" name="muestra_${$ID}" id="muestra_${$ID}" required>
                                <option selected>Elige el que va a tomar la muestra</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="mb-3">
                            <label for="medico_${$ID}" class="form-label p-0 m-0">Medico:</label>
                            <select class="select-usuario form-select input-form" name="medico_${$ID}" id="medico_${$ID}" required>
                                <option selected>Elige un medico</option>
                            </select>
                        </div>
                    </div>
                </div>
                `;

                $div.append($html);
            }
        }
        resolve(1)
    })
}


// Function para solicitar y regresar el qr para visualizar el consentimiento del paciente
async function solicitarConsentimiento() {
    return new Promise(async function (resolve, reject) {

        // Se obtiene el array donde estan todos los consentimientos
        let $row = JSON.parse(array_selected.CONSENTIMIENTO);

        // Inicializamos la variable data donde se guardara el array de todos los consentimientos con sus formularios
        let $data = [];

        // Recorremos el array de los consentimientos para acceder a la informacion de los formularioss
        for (const key in $row) {
            if (Object.hasOwnProperty.call($row, key)) {
                const element = $row[key];
                const $ID = element.ID_CONSENTIMIENTO; // <-- ID del consentimiento

                // Obtenemos todos los valores del formulario
                var $quimico = 57 //$(`quimico_${$ID}`)
                var $muestra = $(`#muestra_${$ID}`).val()
                var $medico = $(`#medico_${$ID}`).val()

                // Armamos el array de todos los formularios
                $data[key] = {
                    ID_CONSENTIMIENTO: $ID,
                    QUIMICO: $quimico,
                    TOMADOR_MUESTRA: $muestra,
                    MEDICO: $medico
                };
            }
        }

        // se hace la peticion a la api para recuperar el QR del consentimiento del paciente
        ajaxAwait({
            api: 5,
            turno_id: array_selected.ID_TURNO,
            data_consentimiento: $data
        }, 'consentimiento_api', { callbackAfter: true }, false, (data) => {
            data = data.response.data

            // Le mostramos al usuario una alerta avisandole que el proceso se realizo con exito
            alertToast('!QR generado con exito.!', 'success', 2000)

            // Sacamos la imagen y ruta del QR
            const $ruta = data.url; // <-- Ruta del QR
            const $imagen = data.qr; // <-- Imagen del qr

            // Contenedor del QR para mostrarlo
            const $div_QR = $('#qr');
            $div_QR.html(''); // <-- Limpiamos el contenedor del QR en caso de que tenga algo no deseado para remplazarlo con el nuevo

            // Armamos la estructura HTML para mostrar el QR
            let html = `
                <p class="text-center fw-bold">
                    Escanee el QR para firmar el consentimiento
                </p>
                <img class="img-fluid shadow rounded-2 my-1 mx-auto d-flex justify-content-center w-75" src="${$imagen}" href='${$ruta}' alt="${$ruta}" target="_blank" />
                <a href="${$ruta}" target="_blank" style="display:flex; justify-content:center;"> ${$ruta}</a>
            `;


            $div_QR.html(html); // <-- Mostramos la imgen del QR para que pueda ser escaneada
            $div_QR.fadeIn(100); // <-- Hacemos que aparezca todo el contenido
        })
        resolve(1)
    })
}

// Function para limpiar el modal 
function clearModal() {
    $('#qr').html('');
    $('#formularios_consentimiento').html('')
    $('#title-consentimientoConfiguracion').html('')
}