
$(document).on('click', '#btn-NuevoProveedor', function (e) {

    // Reinicia y abre nuevo modal

    $('#modalVistaProveedores').modal('show');

})


$(document).on('submit', '#form-vendedores', function (e) {
    e.preventDefault();
    e.stopPropagation();


    // Preguntar si esta todo bien
    alertMensajeConfirm({
        icon: 'info',
        title: '¿Deseas guardar un nuevo proveedor?',
        text: 'Debes guardar un proveedor para agregar nueva información'
    }, () => {

        // Mandar los datos
        ajaxAwaitFormData({
            api: 0,
        }, 'proveedores_api', 'form-vendedores', { callbackAfter: true }, false, (data) => {

            alertToast('Proveedor guardado', 'success');


        })
    }, 1)
})