$(document).on('click', '#btn-agendar-calendario', function (e) {
    $('#modalNuevaAgenda').modal('show');
})


//fechaSelected

// cambiar fecha de la Lista
$(document).on('change', '#fechaSelected', function () {
    getListAgenda(11, $('#fechaSelected').val())
})

$(document).on('click', '#checkDiaFechaSelected', function () {
    if ($(this).is(':checked')) {
        getListAgenda(11, 'null')
        $('#fechaSelected').prop('disabled', true)
    } else {
        getListAgenda(11, $('#fechaSelected').val())
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