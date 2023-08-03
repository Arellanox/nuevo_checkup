tablaPrincipal = $('#tablaPrincipal').DataTable({
    language: {
        url: "https://cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json",
        emptyTable: "No se ha elegido fecha y procedencia a mostrar.",
    },
    lengthChange: false,
    info: true,
    paging: true,
    scrollY: autoHeightDiv(0, 330),
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
        { data: 'PROCEDENCIA' },
        { data: 'TRABAJADOR' },
        { data: 'VERIFICACION' },
        { data: 'CATEGORIA' },
        { data: 'URES' },
        { data: 'DIAGNOSTICO' },
        { data: 'SERVICIOS_ABREVIATURA' }
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
        { target: 15, className: 'all', title: 'Procedencia' },
        { target: 16, className: 'none beneficiario', title: 'Trabajador', visible: false },
        { target: 17, className: 'none beneficiario', title: 'Verificacion (url)', visible: false },
        { target: 18, className: 'none beneficiario', title: 'Categoria', visible: false },
        { target: 19, className: 'none beneficiario', title: 'Ures', visible: false },
        { target: 20, className: 'all', title: 'Diagnostico' },
        { target: 21, className: 'none', title: 'abreviatura', visible: false, searchable: true },
    ],


})