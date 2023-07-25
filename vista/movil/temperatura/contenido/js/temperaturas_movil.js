var checkFactorCorrecion;
BuildPage()

// Renderizar title:
async function BuildPage() {
    equipo_id == '' ? equipo_id = false : equipo_id = equipo_id;

    if (!equipo_id) {
        // alertToast('No se encontro ningun equipo', 'error', 5000);
        alertMsj({
            title: '¡Falta definir Equipo!', text: 'No se encontro ningun equipo, vuelve a escanear el QR',
            icon: 'error', allowOutsideClick: false, showCancelButton: false, showConfirmButton: false
        })
        return false;
    }

    await ajaxAwait({
        api: 1,
        id_equipo: equipo_id,
        id_tipos_equipos: 5
    }, 'equipos_api', { callbackAfter: true }, false, (data) => {
        selectedEquipos = data.response.data;

        selectedEquipos.forEach(e => {
            $("#agregartitle").html(`Capturar temperatura del equipo: ${e['DESCRIPCION']}`)
        });
    })

    loader('Out')
}

// Button para enviar el formulario de nuevo registro de temperaturas desde el QR
$("#formCapturarTemperatura").on('submit', function (e) {
    e.preventDefault();
    // console.log(equipo_id)


    alertMensajeConfirm({
        title: `¿Deseas capturar ${$('#lectura').val()} °C?`,
        text: "Recuerde usar el simbolo negativo (-) si es necesario, para su correcta captura",
        icon: "info"
    }, () => {
        ajaxAwaitFormData({
            api: 17,
            Enfriador: equipo_id,
            checkFactorCorrecion: checkFactorCorrecion
        }, 'temperatura_api', 'formCapturarTemperatura', { callbackAfter: true }, false, function (data) {
            $("#formCapturarTemperatura").trigger("reset");
            alertMsj({
                title: 'Capturado',
                text: 'Se ha guardado su captura excitosamente',
                icon: 'success',
                showCancelButton: false,
                timer: 2000,
            });
        })
    }, 1)
})


checkFactorCorrecion = 0;
$(document).on('change', '#checkFactorCorrecion', function () {
    var switchState = $(this).is(':checked');
    if (switchState) {
        checkFactorCorrecion = 1;
    } else {
        checkFactorCorrecion = 0;
    }

});



