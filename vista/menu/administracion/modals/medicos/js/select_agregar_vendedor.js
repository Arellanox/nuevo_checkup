

$(document).on('submit', '#formSelectMedicoVendedor', function (event) {
    event.preventDefault();
    event.stopPropagation();



    alertMensajeConfirm({
        title: '¿Está seguro de agregar este vendedor al médico?',
        text: 'El vendedor asigando correspondrá a las ventas del médico',
        icon: 'warning'
    }, () => {
        ajaxAwaitFormData({ api: 5, id_medico: SelectedMedicosTratantes.ID_MEDICO}, 'vendedores_api', 'formSelectMedicoVendedor', { callbackAfter: true }, false, (data) => {
            $('#modalSelectVendedor').modal('hide');
            alertToast('Se le a asigno correctamente', 'success');
            TablaVistaMedicosTratantes.ajax.reload()
        })
    }, 1)
})