


tablaVistaProveedores = $('#tablaVistaProveedores').DataTable({
    language: {
        url: "https://cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"
    },
    lengthChange: false,
    info: false,
    paging: false,
    scrollY: '73vh',
    scrollCollapse: true,
    // ajax: {
    //     dataType: 'json',
    //     data: function (d) {
    //         return $.extend(d, dataVistaVendedores);
    //     },
    //     method: 'POST',
    //     url: '../../../api/vendedores_api.php',
    //     complete: function () {
    //         $.fn.dataTable
    //             .tables({
    //                 visible: true,
    //                 api: true
    //             })
    //             .columns.adjust();
    //     },
    //     dataSrc: 'response.data'
    // },
    // columns: [
    //     { data: 'COUNT' },
    //     { data: 'VENDEDOR' },
    //     {
    //         data: 'FECHA_NACIMIENTO', render: function (data) {
    //             return formatoFecha2(data, [0, 1, 4, 1, 0])
    //         }
    //     },
    //     { data: 'EDAD' },
    //     { data: 'EMAIL' },
    //     { data: 'TELEFONO' },
    //     {
    //         data: 'COMISION_OTORGADA', render: function (data) {
    //             return data + ' %'
    //         }
    //     },

    //     { data: null }
    // ],
    columnDefs: [
        { target: 0, title: '#', className: 'all', width: '5px' },
        { target: 1, title: 'Vendedor', className: 'all' },
        { target: 2, title: 'Fecha de nacimiento', className: 'none' },
        { target: 3, title: 'Edad', className: 'none' },
        { target: 4, title: 'Correo', className: 'all' },
        { target: 5, title: 'Telefono', className: 'all' },
        { target: 6, title: 'Comision', className: 'all' },
        {
            target: 7, title: '<i class="bi bi-window-stack"></i>', className: 'all', width: '5px',
            defaultContent: `
                <div class="d-flex d-lg-block align-items-center" style="max-width: max-content; padding: 0px;">
                    <div class="d-flex flex-wrap flex-lg-nowrap align-items-center">

                        <i class="btn mx-2 btn-pantone-7408 bi bi-cash-coin comisiones-vendedor"  style="cursor: pointer"></i>

                       <i class="btn mx-2 btn-borrar bi bi-trash eliminar-diagnostico" style="cursor: pointer"></i>
                                               
                    </div>
                </div>
            `
        }
    ]

})



inputBusquedaTable('tablaVistaProveedores', tablaVistaProveedores, [
    {
        msj: 'Visualiza todo los proveedores disponibles',
        place: 'top'
    },
    {
        msj: '',
        place: 'top'
    }
], [], 'col-12')


// // Solo para eliminar o obtener comisiones
// selectTable('#tablaVistaVendedores', tablaVistaVendedores, {
//     OnlyData: true,
//     ClickClass: [
//         {
//             class: 'eliminar-diagnostico',
//             callback: function (data) {

//                 // Recuperar ID del vendedor de la tabla
//                 var id_vendedor = data.ID_VENDEDOR;

//                 // Confirmacion del usuario
//                 alertMensajeConfirm({
//                     title: '¿Está seguro que desea desactivar el registro?',
//                     text: 'No podrá modificarlo despues',
//                     icon: 'warning',
//                 }, function () {

//                     // Envio a api
//                     ajaxAwait({ api: 3, id_vendedor: id_vendedor }, 'vendedores_api', { callbackAfter: true }, false, function (data) {
//                         alertToast('Vendedor eliminado!', 'success', 4000)

//                         tablaVistaVendedores.ajax.reload();
//                     })
//                 }, 1)
//             },
//         },

//         {
//             class: 'comisiones-vendedor',
//             callback: function (data) {
//                 // Recuperar ID del vendedor de la tabla
//                 var id_vendedor = data.ID_VENDEDOR;

//                 dataVistaPeriodos['id_vendedor'] = id_vendedor;
//                 tablaPeriodosVendedor.ajax.reload();

//                 setTimeout(() => {
//                     $('#modal_comisionesVendedor').modal('show')

//                     // Arregla los encabezados de la tabla
//                     setTimeout(() => {
//                         $.fn.dataTable
//                             .tables({
//                                 visible: true,
//                                 api: true
//                             })
//                             .columns.adjust();
//                     }, 300);
//                 }, 300);


//             }
//         }
//     ],
// })
