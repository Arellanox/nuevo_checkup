tablaPrincipal = $('#tablaPrincipal').DataTable({
    language: {
        url: "https://cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json",
        emptyTable: "No se ha elegido fecha y procedencia a mostrar.",
    },
    lengthChange: false,
    info: true,
    paging: true,
    scrollY: autoHeightDiv(0, 290),
    scrollCollapse: true,
    ajax: {
        dataType: 'json',
        data: function (d) {
            return $.extend(d, dataList);
        },

        method: 'POST',
        url: `${http}${servidor}/${appname}/api/cargos_turnos_api.php`,
        beforeSend: function () { loader("In") },
        complete: function () {
            loader("Out", 'bottom')
        },
        dataSrc: 'response.data'
    },
    columns: [
        { data: 'NUM_SISTEMA' },
        { data: 'NUM_PROVEEDOR' },
        { data: 'FACTURA' },
        { data: 'CLAVE_BENEFICIARIO' },
        { data: 'PACIENTE' },
        { data: 'PARENTESCO' },
        { data: 'NUM_PASE' },
        { data: 'SERVICIOS' },
        { data: 'PREFOLIO' },
        { data: 'CANTIDAD' },
        {
            data: 'PRECIO_UNITARIO', render: function (data) {
                return `$${parseDataTable(data)}`;
            }
        },
        {
            data: 'SUBTOTAL', render: function (data) {
                return `$${parseDataTable(data)}`;
            }
        },
        {
            data: 'IVA', render: function (data) {
                return `$${parseDataTable(data)}`;
            }
        },
        {
            data: 'TOTAL', render: function (data) {
                return `$${parseDataTable(data)}`;
            }
        },
        {
            data: 'FECHA_RECEPCION', render: function (data) {
                return formatoFecha2(data, [0, 1, 5, 2, 1, 1, 1]);
            }
        },
        // { data: 'PROCEDENCIA' },
        { data: 'VENDEDOR' },
        { data: 'TRABAJADOR' },
        { data: 'VERIFICACION' },
        { data: 'CATEGORIA' },
        { data: 'URES' },
        { data: 'DIAGNOSTICO' },
    ],
    columnDefs: [
        { target: 0, className: 'all', title: 'No. Sistema', width: '7%', visible: false },
        { target: 1, className: 'none beneficiario', title: 'No. Proovedor', visible: false },
        { target: 2, className: 'none beneficiario', title: 'No. Factura', visible: false },
        { target: 3, className: 'none beneficiario', title: 'Clave Beneficiario', width: '10%', visible: false },
        { target: 4, className: 'all', title: 'Paciente' },
        { target: 5, className: 'none beneficiario', title: 'Parentesco', visible: false },
        { target: 6, className: 'none beneficiario', title: 'No. Pase', width: '7%', visible: false },
        { target: 7, className: 'all', title: 'Servicios' },
        { target: 8, className: 'all', title: 'Prefolio' },
        { target: 9, className: 'none', title: 'Cantidad' },
        { target: 10, className: 'all', title: 'Unitario', width: '7%' },
        { target: 11, className: 'all', title: 'Subtotal', width: '7%' },
        { target: 12, className: 'all', title: 'IVA', width: '7%' },
        { target: 13, className: 'all', title: 'Total', width: '7%' },
        { target: 14, className: 'all', title: 'Fecha Recepción', width: '12%' },
        // { target: 15, className: 'all', title: 'Procedencia' },
        { target: 16, className: 'all', title: 'Vendedor' },
        { target: 17, className: 'none beneficiario', title: 'Trabajador', visible: false },
        { target: 18, className: 'none beneficiario', title: 'Verificacion (url)', visible: false },
        { target: 19, className: 'none beneficiario', title: 'Categoria', visible: false },
        { target: 20, className: 'none beneficiario', title: 'Ures', visible: false },
        { target: 21, className: 'all', title: 'Diagnostico' },
    ],


    rowGroup: {
        dataSrc: 'PREFOLIO', // Columna utilizada para la agrupación
        startRender: function (rows, group) {
            // Renderización personalizada del grupo
            var paciente = rows.data()[0].PACIENTE;
            var sumUnitario = rows.data().pluck('PRECIO_UNITARIO').reduce(function (a, b) {
                return a + parseFloat(parseDataTable(b));
            }, 0);
            var sumSubtotal = rows.data().pluck('SUBTOTAL').reduce(function (a, b) {
                return a + parseFloat(parseDataTable(b));
            }, 0);
            var sumIVA = rows.data().pluck('IVA').reduce(function (a, b) {
                return a + parseFloat(parseDataTable(b));
            }, 0);
            var sumTotal = rows.data().pluck('TOTAL').reduce(function (a, b) {
                return a + parseFloat(parseDataTable(b));
            }, 0);
            var fechaRecepcion = rows.data()[0].FECHA_RECEPCION;
            var procedencia = rows.data()[0].PROCEDENCIA;
            var diagnostico = rows.data()[0].DIAGNOSTICO;

            let tr = $('<tr/>')

            tr.addClass('background-group');

            return tr
                .append('<td>' + paciente + '</td>')
                .append(`<td>${rows.count()} servicios</td>`)
                .append('<td>' + group + '</td>')
                .append('<td>$' + sumUnitario.toFixed(2) + '</td>')
                .append('<td>$' + sumSubtotal.toFixed(2) + '</td>')
                .append('<td>$' + sumIVA.toFixed(2) + '</td>')
                .append('<td>$' + sumTotal.toFixed(2) + '</td>')
                .append('<td>' + formatoFecha2(fechaRecepcion, [0, 1, 5, 2, 1, 1, 1]) + '</td>')
                .append('<td>' + procedencia + '</td>')
                .append('<td>' + diagnostico + '</td>');
        }
    },



    dom: 'Bfrtip',
    buttons: [
        // {
        //   extend: 'copyHtml5',
        //   text: '<i class="fa fa-files-o"></i>',
        //   titleAttr: 'Copy'
        // },
        {
            extend: 'excelHtml5',
            text: '<i class="fa fa-file-excel-o"></i> Excel',
            className: 'btn btn-success',
            titleAttr: 'Excel',
            customizeData: function (data) {
                // Eliminar encabezados de columnas ocultas
                for (var i = data.header.length - 1; i >= 0; i--) {
                    if (!$('#tablaPrincipal').DataTable().column(i).visible()) {
                        data.header.splice(i, 1);
                        for (var j = 0; j < data.body.length; j++) {
                            data.body[j].splice(i, 1);
                        }
                    }
                }
            }
        },
        {
            text: '<i class="bi bi-box-arrow-in-down"></i> Incluir Campos Beneficiarios',
            className: 'btn btn-turquesa',
            id: 'btn-ocultar-campos-beneficiarios',
            extend: '',
            action: function () {
                var columnasOcultas = ['beneficiario']; // Clases CSS de las columnas que quieres ocultar
                columnasOcultas.forEach(function (clase) {
                    var columnas = tablaPrincipal.columns('.' + clase);
                    var estadoActual = columnas.visible()[0];
                    columnas.visible(!estadoActual, false);
                });

                tablaPrincipal.buttons().container().removeClass('show-columns');
                tablaPrincipal.buttons().container().addClass('hide-columns');

                tablaPrincipal.columns.adjust().draw(false); // Ajustar columnas y redibujar completamente la tabla

            }
        },
        {
            text: '<i class="bi bi-eye-slash"></i> Ocultar',
            className: 'btn btn-secondary',
            action: function () {
                tablaPrincipal.rows().nodes().to$().addClass('d-none');

            }
        },
        {
            text: '<i class="bi bi-eye"></i> Mostrar',
            className: 'btn btn-secondary',
            action: function () {
                tablaPrincipal.rows().nodes().to$().removeClass('d-none');

            }
        },
    ],


})

function parseDataTable(data) {
    let parsedData;

    if (!isNaN(parseFloat(data))) {
        // Si el dato puede ser convertido a número
        parsedData = parseFloat(data).toFixed(2); // Convertir a número y limitar a dos decimales
    } else {
        // Si el dato es texto
        parsedData = 0;
    }

    return parsedData
}

inputBusquedaTable('tablaPrincipal', tablaPrincipal, [
    {
        msj: 'Puedes organizar el contenido con los encabezados de la tabla.',
        place: 'top'
    },
    {
        msj: 'El campo de busqueda filtra sus coincidencias.',
        place: 'top'
    },
], {}, 'col-12')



// Agregar un evento clic a las filas de grupo
$('#tablaPrincipal tbody').on('click', '.background-group', function () {
    // $(this).toggleClass('group-hidden');
    var rows = tablaPrincipal.rows($(this).nextUntil('.background-group'));
    if (rows.nodes().to$().hasClass('d-none')) {
        rows.nodes().to$().removeClass('d-none');
    } else {
        rows.nodes().to$().addClass('d-none');
    }

});