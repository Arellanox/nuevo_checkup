tablaPrincipal = $('#tablaPrincipal').DataTable({
    language: {
        url: "https://cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json",
        emptyTable: "No se ha elegido fecha y procedencia a mostrar.",
    },
    lengthChange: false,
    info: true,
    paging: true,
    lengthMenu: [
        [20, 35, 50, 100, -1],
        [20, 35, 50, 100, "All"]
    ],
    scrollY: '61vh',
    scrollCollapse: true,
    ajax: {
        dataType: 'json',
        data: function (d) {
            return $.extend(d, dataList);
        },
        method: 'POST',
        url: `${http}${servidor}/${appname}/api/reportes_api.php`,
        beforeSend: function () { loader("In") },
        complete: function () {
            loader("Out", 'bottom')
        },
        dataSrc: 'response.data'
    },
    columns: [
        { data: 'PREFOLIO' },
        { data: 'PACIENTE' },
        { data: 'SERVICIO' },
        { data: 'AREA' },
        { data: 'NUM_PASE' },
        { data: 'CLAVE_BENEFICIARIO' },
        { data: 'NUM_PROVEEDOR' },
        { data: 'FACTURA' },
        {data: 'COSTO'},
        { data: 'PRECIO_VENTA' },
        { data: 'PROCEDENCIA' },
    ],
    columnDefs: [
        { target: 0, className: 'all', title: 'Prefolio', width: '7%' },
        { target: 1, className: 'all', title: 'Paciente' },
        { target: 2, className: 'all', title: 'Servicios' },
        { target: 3, className: 'all', title: 'Area' },
        { target: 4, className: 'all', title: 'No. Pase' },
        { target: 5, className: 'all', title: 'No. Proveedor', width: '7%' },
        { target: 6, className: 'all', title: 'No. Factura' },
        { target: 7, className: 'all', title: 'Costo' },
        { target: 8, className: 'all', title: 'Precio Venta' },
        { target: 9, className: 'all', title: 'Procedencia' },
    ],
    rowGroup: {
        dataSrc: 'PREFOLIO', // Columna utilizada para la agrupación
        startRender: function (rows, group) {
            // Renderización personalizada del grupo
            var prefolio = rows.data()[0].PREFOLIO;
            var paciente = rows.data()[0].PACIENTE;
            var area = rows.data()[0].AREA;
            var no_pase = rows.data()[0].NUM_PASE;
            var no_proveedor = rows.data()[0].NUM_PROVEEDOR;
            var no_factura = rows.data()[0].FACTURA;
            var costo_servicio = rows.data().pluck('COSTO').reduce(function (a, b) { return a + parseFloat(parseDataTable(b)); }, 0);
            var precio_venta = rows.data().pluck('PRECIO_VENTA').reduce(function (a, b) { return a + parseFloat(parseDataTable(b)); }, 0);
            var procedencia = rows.data()[0].PROCEDENCIA;

            let tr = $('<tr/>')
            tr.addClass('background-group');

            return tr
                .append(`<td>${prefolio}</td>`)
                .append(`<td>${paciente}</td>`)
                .append(`<td>${rows.count()} servicios</td>`)
                .append(` <td>${area}</td>`)
                .append(`<td>${no_pase ?? 'Sin detalle'}</td>`)
                .append(`<td>${no_proveedor}</td>`)
                .append(`<td>${no_factura ?? 'Sin detalles' }</td>`)
                .append(`<td>\$${costo_servicio?.toFixed(2)}</td>`)
                .append(`<td>\$${precio_venta?.toFixed(2)}</td>`)
                .append(`<td>${procedencia}</td>`)
                .append(`<td></td>`)
        }
    },
    dom: 'Bfrtip',
    buttons: [
        {
            text: '<i class="fa fa-file-excel-o"></i> Excel',
            className: 'btn btn-success',
            titleAttr: 'Descargar Excel',
            action: function () {
                alertToast('Modulo en desarrollo, gracias por la comprension.', 'info', 3000)
                // GENERACIÓN DE EXCEL DE REPORTE DE VENTAS
                /*dataList['api'] = 6;

                ajaxAwait(dataList, 'cargos_turnos_api', { callbackAfter: true }, false, function (data) {
                    let url = data.response.data.url;

                    // Verificar si estás en localhost y si la URL contiene "bimo-lab.com"
                    if (servidor === 'localhost' && url.includes('bimo-lab.com')) {
                        // Reemplazar "https://bimo-lab.com" por el origen actual (http://localhost)
                        const localOrigin = window.location.origin;
                        url = url.replace(/^https?:\/\/bimo-lab\.com/, localOrigin);
                    }

                    const link = document.createElement('a');
                    link.href = url;
                    link.target = '_blank';

                    document.body.appendChild(link);
                    link.click();
                    document.body.removeChild(link);
                })

                dataList['api'] = 3;*/
            }
        },
        {
            text: '<i class="fa fa-file-pdf-o"></i> PDF',
            className: 'btn btn-danger',
            titleAttr: 'Descargar PDF',
            action: function () {
                alertToast('Modulo en desarrollo, gracias por la comprension.', 'info', 3000)
                // GENERACIÓN DEL PDF DE REPORTES VENTAS
                /*dataList['api'] = 9;

                ajaxAwait(dataList, 'cargos_turnos_api', { callbackAfter: true }, false, function (data) {
                    let url = data.response.data.url;

                    // Verificar si estás en localhost y si la URL contiene "bimo-lab.com"
                    if (servidor === 'localhost' && url.includes('bimo-lab.com')) {
                        // Reemplazar "https://bimo-lab.com" por el origen actual (http://localhost)
                        const localOrigin = window.location.origin;
                        url = url.replace(/^https?:\/\/bimo-lab\.com/, localOrigin);
                    }

                    const link = document.createElement('a');
                    link.href = url;
                    link.target = '_blank';

                    document.body.appendChild(link);
                    link.click();
                    document.body.removeChild(link);
                });

                dataList['api'] = 3;*/
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
        }
    ]
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
    var rows = tablaPrincipal.rows($(this).nextUntil('.background-group'));
    if (rows.nodes().to$().hasClass('d-none')) {
        rows.nodes().to$().removeClass('d-none');
    } else {
        rows.nodes().to$().addClass('d-none');
    }
});