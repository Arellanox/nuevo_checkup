

dataVistaVendedores = { api: 2 }
tablaVistaProveedores = $('#tablaVistaProveedores').DataTable({
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
        url: '../../../api/proveedores_api.php',
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
        { data: 'COUNT', },
        { data: 'NOMBRE_COMERCIAL', },
        { data: 'OBJETO_SOCIAL', },
        { data: 'RAZON_SOCIAL', },
        { data: 'TELEFONO', },
        { data: 'TIPO_PERSONA', },
        // { data: 'RAZON_SOCIAL' },
        { data: 'SITIO_WEB', },
        {
            data: 'ID_PROVEEDOR', render: function (data, type) {
                if (type === 'display') {
                    return `
                        <div class="row" style="width: 50px">

                            <div class="col-6"> 
                                <!-- Direcciones -->
                                <i class="bi bi-signpost-2-fill btn-direccion icons-btn d-block "
                                    data-bs-id="${data}">
                                </i>
                            </div>

                            <div class="col-6"> 
                                <!-- Contactos -->
                                <i class="bi bi-person-lines-fill btn-contantos icons-btn d-block" 
                                    data-bs-id="${data}">
                                </i>
                            </div>  
                                
                            <div class="col-6"> 
                                <!-- Creditos -->
                                <i class="bi bi-receipt btn-cargar-documentos icons-btn d-block" 
                                    data-bs-id="${data}">
                                </i>
                            </div>

                            <div class="col-6">
                                <!-- Archivos -->
                                <i class="bi bi-file-earmark-pdf-fill btn-offcanva btn-subir-documentos icons-btn d-block" 
                                    data-bs-id="${data}">
                                </i>
                            </div>  
                        </div>
                        `;
                } else {
                    return '';
                }
            },
        }
    ],
    columnDefs: [
        { target: 0, title: '#', className: 'all', width: '5px' },
        { target: 1, title: 'Nombre Comercial', className: 'all' },
        { target: 2, title: 'Objeto Social', className: 'desktop' },
        { target: 3, title: 'Razón Social', className: 'desktop' },
        { target: 4, title: 'Teléfono', className: 'min-tablet' },
        { target: 5, title: 'Tipo', className: 'min-tablet' },
        // { target: 6, title: 'Razon Social', className: 'all' },
        { target: 6, title: 'Sitio Web', className: 'desktop', },
        { target: 7, title: '#', className: 'all', width: "50px" }

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
