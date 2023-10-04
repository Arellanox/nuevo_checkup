$(document).on('change', '#usuario_medico_check', function () {
    // Escuchar los cambios en el switch
    ChangeAdjuntarUsuario('usuario_medico_check')
})


function ChangeAdjuntarUsuario(checkbox) {
    let btn = $(`#${checkbox}`).is(':checked');

    if (btn) {
        $('#usuarios_medicos').prop('disabled', false);
    } else {
        $('#usuarios_medicos').prop('disabled', true);
    }
}