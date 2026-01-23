// Obtener datos del paciente seleccionado
const modalOrdenesMedicas = document.getElementById('modalOrdenesMedicas')
modalOrdenesMedicas.addEventListener('show.bs.modal', event => {
    // document.getElementById("title-paciente_perfil_imagen").innerHTML = ;
    $('#title-orden_medica').html("Cargar ordenes medicas: <br />" + array_selected['NOMBRE_COMPLETO']);

    $('input [type="file"]').val('');

})

//Rechazados
$("#formOrdenesMedicasPaciente").submit(async function (event) {
    event.preventDefault();

    let dataAjax = await ajaxAwaitFormData({
        turno_id: array_selected['ID_TURNO'],
        api: 10
    }, 'recepcion_api', 'formOrdenesMedicasPaciente')

    if (dataAjax) {
        alertToast('Orden medicas cargada', 'success', 4000)
        $('input [type="file"]').val('');
    }

    $('#modalOrdenesMedicas').modal('hide');

    event.preventDefault();
});

const modalConsentimiento = document.getElementById('modalConcentimientos')
modalConsentimiento.addEventListener('show.bs.modal', event => {
    // document.getElementById("title-paciente_perfil_imagen").innerHTML = ;
    $('#title-consentimientos').html("Cargar Consentimiento: <br />" + array_selected['NOMBRE_COMPLETO']);

    $('input [type="file"]').val('');
})

$("#formconsentimientos").submit(async function (event) {
    event.preventDefault();

    let dataAjax = await ajaxAwaitFormData(
        {
            turno_id: array_selected['ID_TURNO'],
            api: 10
        },
        'recepcion_api',
        'formconsentimientos'
    );

    if (dataAjax) {
        alertToast('Consentimiento cargado correctamente', 'success', 4000);
        // CORRECCIÓN: Debe coincidir con el ID del HTML "modalConcentimientos"
        $('#modalConcentimientos').modal('hide');
    }
});