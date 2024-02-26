const modalVistaVendedores = document.getElementById('modalVistaVendedores')
modalVistaVendedores.addEventListener('show.bs.modal', event => {

    setTimeout(() => {
        $.fn.dataTable
            .tables({
                visible: true,
                api: true
            })
            .columns.adjust();
    }, 350);
})


$('#btn-guardar_vendedores').on('click', function (e) {
    e.preventDefault();

    alertMensajeConfirm({
        title: '¿Esta seguro que los datos estan correctos?',
        text: 'No se podra modificar despues',
        icon: 'info'
    }, function () {
        ajaxAwaitFormData({ api: 1 }, 'vendedores_api', 'form-vendedores', { callbackAfter: true }, false, function () {
            alertToast('Los datos se guardaron correctamente', 'success');
            tablaVistaVendedores.ajax.reload();
            $('#form-vendedores')[0].reset(); // Reinicia el formulario

        })
    }, 1)
})



tablaVistaVendedores = $('#tablaVistaVendedores').DataTable({
    language: {
        url: "https://cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"
    },
    lengthChange: false,
    info: false,
    paging: false,
    scrollY: '73vh',
    scrollCollapse: true,
    ajax: {
        dataType: 'json',
        data: function (d) {
            return $.extend(d, dataVistaVendedores);
        },
        method: 'POST',
        url: '../../../api/vendedores_api.php',
        complete: function () {
            $.fn.dataTable
                .tables({
                    visible: true,
                    api: true
                })
                .columns.adjust();
        },
        dataSrc: 'response.data'
    },
    columns: [
        { data: 'COUNT' },
        { data: 'VENDEDOR' },
        { data: 'FECHA_NACIMIENTO', render: function(data) {
            return formatoFecha2(data, [0, 1, 4, 1, 0])
        }},
        { data: 'EDAD' },
        { data: 'EMAIL' },
        { data: 'TELEFONO' },
        { data: 'COMISION_OTORGADA', render: function(data){
            return data + ' %'
        }},
        {
            data: 'ID_VENDEDOR', render: function (data) {
                return `<i class="bi bi-trash eliminar-diagnostico" data-id = "${data}" style = "cursor: pointer"
        onclick="desactivarVendedor.call(this)"></i>`;
            }
        }
    ],
    columnDefs: [
        { target: 0, title: '#', className: 'all', width: '5px' },
        { target: 1, title: 'Vendedor', className: 'all' },
        { target: 2, title: 'Fecha de nacimiento', className: 'none' },
        { target: 3, title: 'Edad', className: 'none' },
        { target: 4, title: 'Correo', className: 'all' },
        { target: 5, title: 'Telefono', className: 'all' },
        { target: 6, title: 'Comision', className: 'all' },
        { target: 7, title: '<i class="bi bi-trash"></i>', className: 'all', width: '5px' }
    ]

})

inputBusquedaTable('tablaVistaVendedores', tablaVistaVendedores, [{
    msj: 'Se mostraran todos los vendedores que esten registrados',
    place: 'top'
}], [], 'col-12')


function desactivarVendedor() {
    var id_vendedor = $(this).data("id");

    alertMensajeConfirm({
        title: '¿Está seguro que desea desactivar el registro?',
        text: 'No podrá modificarlo despues',
        icon: 'warning',
    }, function () {

        ajaxAwait({ api: 3, id_vendedor: id_vendedor }, 'vendedores_api', { callbackAfter: true }, false, function (data) {
            alertToast('Vendedor eliminado!', 'success', 4000)

            tablaVistaVendedores.ajax.reload();
        })
    }, 1)
}
