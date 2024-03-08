// function TablaFacturas(){
tablaListaFacturas = $("#tablaListaFacturas").DataTable({
    language: { url: "https://cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json", },
    lengthChange: false,
    info: true,
    paging: true,
    scrollY: '53vh',
    scrollCollapse: true,
    // destroy: true,
    ajax: {
        dataType: 'json',
        data: function (d) {
            return $.extend(d, dataListaFacturas);
        },
        method: 'POST',
        url: `${http}${servidor}/${appname}/api/precios_api.php`,
        beforeSend: function () {

        },
        complete: function () {
            $.fn.dataTable
                .tables({
                    visible: true,
                    api: true
                })
                .columns.adjust();
        },
        error: function (jqXHR, textStatus, errorThrown) {
            alertErrorAJAX(jqXHR, textStatus, errorThrown);
        },
        dataSrc: 'response.data'
    },
    columns: [
        {
            data: 'COUNT'
        },
        {
            data: 'NOMBRE_COMERCIAL'
        },
        {
            data: 'SERVICIO'
        },
        {
            data: 'ABREVIATURA'
        },
        {
            data: 'COSTO', render: function (data, type, row) {
                if (type === 'display' || type === 'filter') {
                    if (data !== null && !isNaN(data)) {
                        return `$${parseFloat(data).toFixed(2)}`;
                    }
                    return '$0.00'; // O algún valor predeterminado o indicación de que no hay datos.
                }
                return data; // Retorna el dato sin modificar para otros tipos que no sean de display o filter.
            }
        },
        {
            data: 'UTILIDAD'
        },
        {
            data: 'PRECIO_VENTA'
        },
        // {
        //     data: 'ES_USUARIO', render: function (data) {
        //         let html;

        //         if (data === "1") {
        //             html = `<i class="bi bi-check-square-fill text-success "></i>`;
        //         } else if (data === "0") {
        //             html = `<i class="bi bi-x-square-fill text-danger  "></i>`;
        //         }

        //         return html;
        //     }
        // },
        // {
        //     data: 'TELEFONO', render: function (data) {
        //         return ifnull(data, 'N/A')
        //     }
        // },
        // {
        //     data: 'ESPECIALIDAD', render: function (data) {
        //         return ifnull(data, 'N/A')
        //     }
        // },
        // {
        //     data: 'TIENE_VENDEDOR', render: function (data, type, row) {
        //         if (data == '1') {
        //             return `<span class="badge text-bg-success">Con vendedor</span>`
        //         } else {

        //             return `<span class="badge text-bg-warning"  data-id = "${row.ID_MEDICO}" style = "cursor: pointer"
        //             onclick="selectVendedorMedicoTratantes.call(this)">Sin vendedor</span>`
        //         }
        //     }
        // },
        // {
        //     data: 'ID_MEDICO', render: function (data) {
        //         return `<i class="bi bi-trash eliminar-diagnostico" data-id = "${data}" style = "cursor: pointer"
        //         onclick="desactivarTablaMedicosTratantes.call(this)"></i>`;

        //     }
        // },
        // {
        //     data: 'VENDEDOR', render: function (data) {
        //         if (data != null) {
        //             return data;
        //         } else {
        //             return 'Sin vendedor'
        //         }
        //     }
        // }
    ],
    columnDefs: [
        { target: 0, title: '#', className: 'all' },
        { target: 1, title: 'Nombre comercial', className: 'none' },
        { target: 2, title: 'Servicio', className: 'all' },
        { target: 3, title: 'Abreviatura', className: 'all' },
        { target: 4, title: 'Costo', className: 'all' },
        { target: 5, title: 'Utilidad', className: 'all' },
        { target: 6, title: 'Precio de venta', className: 'all' },


        // { target: 4, title: '<i class="bi bi-download"></i>', className: 'all' },
        // { target: 5, title: 'Teléfono: ', className: 'none' },
        // { target: 6, title: 'Especialidad: ', className: 'none' },
        // { target: 7, title: 'Vendedor', className: 'all' },
        // { target: 8, title: '<i class="bi bi-trash"></i>', className: 'all', width: '5px' },
        // { target: 9, title: 'Vendedor', className: 'none' }
    ]
})

inputBusquedaTable('tablaListaFacturas', tablaListaFacturas, [], [], 'col-18')
// }