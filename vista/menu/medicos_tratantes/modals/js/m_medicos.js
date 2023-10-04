$(document).on('change', '#usuario_medico_check', function () {
    // Escuchar los cambios en el switch
    ChangeAdjuntarUsuario('usuario_medico_check')
})

$(document).on('submit', '#form-medicos-tratantes-a', function (e) {
    e.preventDefault()
    EnviarMedicoTratante("Update")
})

function ChangeAdjuntarUsuario(checkbox) {
    let btn = $(`#${checkbox}`).is(':checked');
    let AdjuntarUsuario;
    if (btn) {
        AdjuntarUsuario = 1;
        $('#usuarios_medicos').prop('disabled', false);
    } else {
        AdjuntarUsuario = 1;
        AdjuntarUsuario = 0;
        $('#usuarios_medicos').prop('disabled', true);
    }

    return AdjuntarUsuario;
}

