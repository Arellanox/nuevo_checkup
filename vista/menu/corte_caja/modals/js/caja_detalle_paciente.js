// ==============================================================================

// ###################### TABLA DETALLES PACIENTES ##############################

// ==============================================================================
dataTablePacientesCajaDetalle = {
    api: 9
}

// Tabla de los pacientes que estan en la caja seleccionada
TablaPacientesCajaDetalle = $('#TablaPacientesCajaDetalle').DataTable({
    language: {
        url: "https://cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json",
    },
    lengthChange: false,
    info: true,
    paging: false,
    sorting: false,
    scrollY: '50vh',
    scrollCollapse: true,
    ajax: {
        dataType: 'json',
        data: function (d) {
            return $.extend(d, dataTablePacientesCajaDetalle);
        },
        method: 'POST',
        url: `../../../api/corte_caja_api.php`,
        beforeSend: function () { },
        complete: function () {
            // getResumen(TablaPacientesCajaDetalle);
        },
        dataSrc: 'response.data.0'
    },
    // 
    columns: [
        // { data: null, render: () => { return '' } },
        { data: 'PREFOLIO' },
        { data: 'PACIENTE' },
        {
            data: 'NUM_ESTADO_CUENTA', render: function (data) {
                let html = `<div class="d-flex justify-content-center PacienteInfoCargo" style="width: 40px">  ${ifnull(data, '')}  </div>`
                return html
            }
        },
        {
            data: 'SUBTOTAL', render: function (data) {
                return `$${parseFloat(ifnull(data, 0)).toFixed(2)}`
            }
        },
        {
            data: 'MONTO_IVA', render: function (data) {
                return `$${parseFloat(ifnull(data, 0)).toFixed(2)}`
            }
        },
        {
            data: 'TOTAL', render: function (data) {
                return `$${parseFloat(ifnull(data, 0)).toFixed(2)}`
            }
        },
        {
            data: null, render: function (meta) {
                monto = '';
                if (ifnull(meta, false, ['FORMA_PAGO_MONTO'])) {
                    monto = `: $${parseFloat(ifnull(meta, 0, ['FORMA_PAGO_MONTO'])).toFixed(2)}`;
                }
                return `<strong>${ifnull(meta, 'Sin pagar', ['FORMA_PAGO'])}</strong>${monto}`
            }
        },
        { data: 'FACTURA' },
        // { data: 'FECHA_RECEPCION' },
        { data: 'NOMBRE_COMERCIAL' },
        // { data: 'FORMA_PAGO' }
    ],
    columnDefs: [
        // { target: 0, title: '', className: 'all', width: '1px' },
        { target: 0, title: 'Prefolio', className: 'desktop' },
        { target: 1, title: 'Paciente', className: 'all' },
        { target: 2, title: 'Cuenta' }, //Numero de estado de cue,className: 'desktop'nta
        { target: 3, title: 'Subtotal', width: '7%', className: 'all' },
        { target: 4, title: 'IVA', width: '7%', className: 'all' },
        { target: 5, title: 'Total', width: '7%', className: 'all' },
        { target: 6, title: 'Forma de pago', className: 'desktop' },
        { target: 7, title: 'Factura', className: 'desktop' },
        // { target: 9, title: 'Fecha Recepción', width: '12%', className: 'none' },
        { target: 8, title: 'Procedencia', className: 'desktop' }

    ],

    footer: true,
    footerCallback: function (row, data, start, end, display) {
        let api = this.api();

        //Subtotal
        subtotal = api
            .column(3, { page: 'current' })
            .data()
            .reduce(function (a, b) {
                b = ifnull(b, '0', ['SUBTOTAL'])
                // Eliminar el símbolo "$" y los separadores de miles antes de sumar
                var num = parseFloat(b.replace(/[^0-9.-]+/g, ""));
                return a + num;
            }, 0);


        //Iva
        iva = api
            .column(4)
            .data()
            .reduce(function (a, b) {
                b = ifnull(b, '0', ['IVA'])
                // Eliminar el símbolo "$" y los separadores de miles antes de sumar
                var num = parseFloat(b.replace(/[^0-9.-]+/g, ""));
                return a + num;
            }, 0);

        //Total
        total = api
            .column(5)
            .data()
            .reduce(function (a, b) {
                b = ifnull(b, '0', ['TOTAL'])
                // Eliminar el símbolo "$" y los separadores de miles antes de sumar
                var num = parseFloat(b.replace(/[^0-9.-]+/g, ""));
                console.log(b, num);
                return a + num;
            }, 0);


        // Mostrar los totales en la fila de pie de página
        // $(api.column(3).footer()).html(`Costo: $${parseFloat(costo).toFixed(2)}`);
        // $(api.column(1).footer()).html(``);
        $(api.column(3).footer()).html(`<p>Subtotal: </p>$${parseFloat(subtotal).toFixed(2)}`);

        // $(api.column(3).footer()).html(`<p>IVA (16%): </p>`);
        $(api.column(4).footer()).html(`<p>IVA (16%): </p>$${parseFloat(iva).toFixed(2)}`);

        // $(api.column(5).footer()).html(`<p>Total: </p>`);
        $(api.column(5).footer()).html(`<p>Total: </p>$${parseFloat(total).toFixed(2)}`);
    },

    dom: 'Bfrtip',
    buttons: [
        {
            extend: 'excelHtml5',
            text: '<i class="fa fa-file-excel-o"></i> Excel',
            className: 'btn btn-success',
            titleAttr: 'Excel',
            filename: filename,
            title: title,
            footer: true,
            attr: {
                'data-bs-toggle': "tooltip",
                'data-bs-placement': "top",
                title: "Exporta la tabla en formato excel."
            },
            // exportOptions: {
            //     // Especifica las columnas que deseas exportar
            //     columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16]
            // }
        },
    ]

    // rowGroup: {

    // }
})


inputBusquedaTable("TablaPacientesCajaDetalle", TablaPacientesCajaDetalle, [
    {
        msj: 'Tabla de los pacientes que estan en la caja',
        place: 'top'
    },
    {
        msj: "¡Los pacientes por pagar, se mostrarán en amarillo!",
        place: 'top'
    }
], {
    msj: "Filtre los resultados",
    place: 'top'
}, "col-12")


const modalDetalleCajaPacientes = document.getElementById("modalDetalleCajaPacientes");
modalDetalleCajaPacientes.addEventListener("show.bs.modal", (event) => {
    setTimeout(() => {
        $.fn.dataTable
            .tables({
                visible: true,
                api: true
            })
            .columns.adjust();
    }, 200);
});

// ==============================================================================
