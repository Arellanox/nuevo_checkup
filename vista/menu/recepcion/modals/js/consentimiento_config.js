// Evento click para el boton de recepción para solicitar un consentimiento
$(document).on('click', '#btn-solicitar-consentimiento', solicitarConsentimiento)



// Function para configurar el modal para solicitar el consentimiento de un paciente
function configurarModalConsentimientoConfiguracion() {

    // Se saca el nombre del paciente
    const $px = array_selected.NOMBRE_COMPLETO;

    // Se muestra en el titulo del modal
    $('#title-consentimientoConfiguracion').html(`Consentimiento del paciente: (<strong>${$px}</strong>)`);

    // Se abre el modal
    $("#modalConsentimientoConfiguracion").modal('show');
}

// Function para solicitar y regresar el qr para visualizar el consentimiento del paciente
function solicitarConsentimiento() {

    // Obtenemos los valores seleccionado de los 3 camposs
    // Quimico en turno
    const $quimico = $('#quimico').val();
    // Tomador de muestra
    const $muestra = $('#muestra').val();
    // Medico en turno
    const $medico = $('#medico').val();

    // se hace la petiicon a la api para recuperar el qr del consentimiento del paciente
    ajaxAwait({
        api: 18,
        Enfriador: EQUIPO_ID
    }, 'consentimiento_api', { callbackAfter: true }, false, (data) => {
        data = data.response.data

    })
}
