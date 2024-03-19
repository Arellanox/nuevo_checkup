
$(document).on('click', '#btn-NuevoProveedor', function (e) {
    // Reinicia y abre nuevo modalw
    document.getElementById('form-proveedores').reset();
    $('#modalVistaProveedores').modal('show');
})


$(document).on('submit', '#form-proveedores', function (e) {
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
            api: 1,
        }, 'proveedores_api', 'form-proveedores', { callbackAfter: true, resetForm: true }, false, (data) => {

            alertToast('Proveedor guardado', 'success');
            $('#modalVistaProveedores').modal('hide');
        })
    }, 1)
})