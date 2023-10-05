$(document).on('change', '#usuario_medico_check', function () {
    // Escuchar los cambios en el switch
    ChangeAdjuntarUsuario('usuario_medico_check')
})

$(document).on("change", "#usuarios_medicos", function () {
    ObtenerDibujarNombreDelUsuario(2)
})

$(document).on('submit', '#form_medicos_tratantes_a', function (e) {
    e.preventDefault()
    ActualizarMedicoTratante()
})

function ChangeAdjuntarUsuario(checkbox) {
    let btn = $(`#${checkbox}`).is(':checked');
    let AdjuntarUsuario;
    if (btn) {
        AdjuntarUsuario = 1;
        $('#usuarios_medicos').prop('disabled', false);
        $('#nombre-medicoTrarante-a').prop('disabled', true);
        ObtenerDibujarNombreDelUsuario(2)
    } else {
        AdjuntarUsuario = 0;
        $('#usuarios_medicos').prop('disabled', true);
        $('#nombre-medicoTrarante-a').prop('disabled', false);
        $('#nombre-medicoTrarante-a').val(SelectedMedicosTratantes['NOMBRE_MEDICO']);
    }

    return AdjuntarUsuario;
}

