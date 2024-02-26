// const modalVistaVendedores = document.getElementById('modalVistaVendedores')
// modalVistaVendedores.addEventListener('show.bs.modal', event => {

//     setTimeout(() => {
//         $.fn.dataTable
//             .tables({
//                 visible: true,
//                 api: true
//             })
//             .columns.adjust();
//     }, 350);
// })


$(document).on('submit', '#form-vendedores', function (e) {
    e.preventDefault();

    alertMensajeConfirm({
        title: '¿Esta seguro que los datos estan correctos?',
        text: 'No se podra modificar despues',
        icon: 'info'
    }, function () {
        ajaxAwaitFormData({ api: 1 }, 'vendedores_api', 'form-vendedores', { callbackAfter: true }, false, function () {
            alertToast('Los datos se guardaron correctamente', 'success');

            $('#modalVistaVendedores').modal('hide');

            tablaVistaVendedores.ajax.reload();
            $('#form-vendedores')[0].reset(); // Reinicia el formulario



        })
    }, 1)
})
