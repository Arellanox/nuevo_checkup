$(document).on('click', '#btn-agendar-calendario', function (e) {
    $('#modalNuevaAgenda').modal('show');
})

$(document).on('click', '#btn-agendar-tiempoConfig', async function (e) {
    alertMensaje('info', 'Un momento', 'Estamos consiguiendo los horarios...');
    await ajaxAwait({ api: 7, area_id: localStorage.getItem('areaActual') }, 'agenda_api', { callbackAfter: true }, false, (data) => {
        data = data.response.data;
        $('#hora_inicial').val(data.HORA_INICIAL.substring(0, 5));
        $('#hora_final').val(data.HORA_FINAL.substring(0, 5))
    })
    $('#modalHorarioAtencion').modal('show');
    swal.close();
})

//fechaSelected

// cambiar fecha de la Lista
$(document).on('change', '#fechaSelected', function () {
    getListAgenda(localStorage.getItem('areaActual'), $('#fechaSelected').val())
})

$(document).on('click', '#checkDiaFechaSelected', function () {
    if ($(this).is(':checked')) {
        getListAgenda(localStorage.getItem('areaActual'), 'null')
        $('#fechaSelected').prop('disabled', true)
    } else {
        getListAgenda(localStorage.getItem('areaActual'), $('#fechaSelected').val())
        $('#fechaSelected').prop('disabled', false)
    }
})

$(document).on('click', '.eliminarAgenda', function (e) {
    let id = $(this).attr('data-id');
    alertMensajeConfirm({
        title: '¿Desea eliminar esta agenda?',
        text: 'No podrá revertir cambios',
        icon: 'warning'
    }, function () {
        ajaxAwait({
            api: 4,
            id_agenda: id,
        }, 'agenda_api', { callbackAfter: true }, false, function () {
            alertToast('¡Agenda eliminada!', 'success', 4000);
            recargarListas()
        })
    }, 1)
})