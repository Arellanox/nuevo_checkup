
$('#btn-subir-medico-tratante').on('click', function () {
    alertMensajeConfirm({
        title: '¿Está seguro que desea agregar este médico?',
        text: 'No podrá modificarlo despues',
        icon: 'warning',
    }, function () {
        usuario_id = $('#select-usuarios-medicos-tratantes').val()

        dataJson_insertMedicos = {
            api: 1,
            nombre_medico: $('#nombre-medicoTrarante').val(),
            email: $('#email-medicoTratante').val(),
            usuario_id: ifnull(usuario_id, 'null', usuario_id),
            ignorarALevenshtein: 0
        }
        ajaxAwait(dataJson_insertMedicos, 'medicos_tratantes_api', { callbackAfter: true }, false, function (data) {
            alertToast('Médico tratante agregado', 'success', 4000)
            TablaListaDiagnosticos.ajax.reload();
        })
    }, 1)
})