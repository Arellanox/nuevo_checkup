tablaRecepcionPacientesIngrersados = $('#TablaEstatusTurnos').DataTable({
    language: {
        url: "https://cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json",
    },
    scrollY: "60vh",
    scrollCollapse: true,
    lengthMenu: [
        [10, 15, 20, 25, 30, 35, 40, 45, 50, -1],
        [10, 15, 20, 25, 30, 35, 40, 45, 50, "All"]
    ],
    ajax: {
        dataType: 'json',
        data: { api: 1, estado: 1 },
        method: 'POST',
        url: '../../../api/recepcion_api.php',
        beforeSend: function () {
            loader("In"), array_selected = null
        },
        complete: function () {
            loader("Out")
        },
        dataSrc: 'response.data'
    },
    createdRow: function (row, data, dataIndex) {
        if (data.REAGENDADO == 1) {
            $(row).addClass('bg-info');
        }
    },
    columns: [
        { data: 'COUNT' },
        { data: 'NOMBRE_COMPLETO' },
        { data: 'PREFOLIO', },
        { data: 'NOMBRE_COMERCIAL' },
        { data: 'DESCRIPCION_SEGMENTO' },
        { data: 'TURNO' },
        {
            data: 'ID_PACIENTE',
            render: function (data) {
                return 'PENDIENTE';
            }
        },
        {
            data: 'ESTADO_ANALISIS',
            render: function (data) {
                switch (data) {
                    case 'Terminado':
                        return `<p class="text-primary fw-bold" style="letter-spacing: normal !important; text-shadow: 0 0 1px #000000;">${data}</p>`;
                    case 'En proceso':
                        return `<p class="text-warning fw-bold" style="letter-spacing: normal !important; text-shadow: 0 0 1px #000000;">${data}</p>`;
                    default:
                        return '';
                }
            }
        },
        {
            data: 'ESTADO_MUESTRA',
            render: function (data) {
                switch (data) {
                    case 'Tomada':
                        return `<p class="text-success fw-bold" style="letter-spacing: normal !important; text-shadow: 0 0 1px #000000;">${data}</p>`;
                    case 'Sin tomar':
                        return `<p class="text-warning fw-bold" style="letter-spacing: normal !important; text-shadow: 0 0 1px #000000;">${data}</p>`;
                    default:
                        return '';
                }
            }
        },
        {
            data: 'FECHA_RECEPCION',
            render: function (data) {
                return formatoFecha2(data, [0, 1, 5, 2, 0, 0, 0], null);
            }
        },
        {
            data: 'FECHA_AGENDA',
            render: function (data) {
                return formatoFecha2(data, [0, 1, 5, 2, 0, 0, 0], null);
            }
        },
        {
            data: 'FECHA_REAGENDA',
            render: function (data) {
                return formatoFecha2(data, [0, 1, 5, 2, 0, 0, 0], null);
            }
        },
        { data: 'GENERO' }
        // {defaultContent: 'En progreso...'}
    ],
    columnDefs: [
        { width: "5px", targets: 0 },
        { visible: false, title: "AreaActual", targets: 6, searchable: false }

    ],

})