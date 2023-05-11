$(document).on('click', '#btn-agendar-calendario', function (e) {
    $('#modalNuevaAgenda').modal('show');
})


//fechaSelected

// cambiar fecha de la Lista
$('#fechaSelected').change(function () {
    getListAgenda(12, $('#fechaSelected').val())
})

$('#checkDiaFechaSelected').click(function () {
    if ($(this).is(':checked')) {
        getListAgenda(12, 'null')
        $('#fechaSelected').prop('disabled', true)
    } else {
        getListAgenda(12, $('#fechaSelected').val())
        $('#fechaSelected').prop('disabled', false)
    }
})
