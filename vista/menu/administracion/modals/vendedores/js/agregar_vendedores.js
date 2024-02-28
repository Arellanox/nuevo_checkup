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

$(document).ready(() => {
    $('#fecha-vendedor').on('input', function() {
        const fechaNacimiento = new Date($(this).val());
        const edad = calcularEdad(fechaNacimiento);
        $('#edad-vendedor').val(edad);
    });
});

function calcularEdad(fechaNacimiento) {
    const hoy = new Date();
    const anioDiferencia = hoy.getFullYear() - fechaNacimiento.getFullYear();
    const mesDiferencia = hoy.getMonth() - fechaNacimiento.getMonth();
    const diaDiferencia = hoy.getDate() - fechaNacimiento.getDate();

    // Calcula la edad basada en el año, luego ajusta basado en el mes y el día
    let edad = anioDiferencia;
    if (mesDiferencia < 0 || (mesDiferencia === 0 && diaDiferencia < 0)) {
        edad--;
    }

    return edad;
}


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
