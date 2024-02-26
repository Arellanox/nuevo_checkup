

$(document).on('submit', '#formSelectMedicoVendedor', function (event) {
    event.preventDefault();
    event.stopPropagation();



    alertMensajeConfirm({
        title: '¿Está seguro de agregar este vendedor al médico?',
        text: 'El vendedor asigando correspondrá a las ventas del médico',
        icon: 'warning'
    }, () => {
        ajaxAwaitFormData({ api: 3 }, 'vendedores_api', 'formSelectMedicoVendedor', { calbackBefore: true }, false, (data) => {

        })
    }, 1)
})