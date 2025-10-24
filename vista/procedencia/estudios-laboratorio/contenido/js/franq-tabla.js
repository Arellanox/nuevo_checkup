// Detalles de datos a api
tablaPacientes = $('#tablaPacientes').DataTable({
    language: {
        url: "https://cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"
    },
    lengthChange: false,
    info: true,
    paging: false,
    scrollY: '47vh',
    scrollCollapse: true,
    ajax: {
        dataType: 'json',
        data: { api: 6 },
        method: 'POST',
        url: `${http}${servidor}/${appname}/api/maquilas_api.php`,
        complete: function () { loader("Out", 'bottom') },
        error: function (jqXHR, exception, data) { alertErrorAJAX(jqXHR, exception, data) },
        dataSrc: 'response.data'
    },
    columns: [
        { data: 'COUNT' },
        { data: 'NOMBRE' },
        { data: 'EDAD' },
        { data: 'SIHO_CUENTA' },
        { data: 'FOLIO' },
        { data: 'DESCRIPCION_SOLICITUD', render: function (data, type, row, meta) {
            switch (row.TIPO_SOLICITUD) {
                case "1":return `<span class="badge text-bg-info">${data}</span>`;
                case "2":return `<span class="badge text-bg-warning">${data}</span>`;
                default: return 'Sin estado';
            }
        }},
        { data: 'FECHA_ALTA', render: function (data) { return formatoFecha2(data, [0, 1, 5, 2, 2, 2, 0])} },
        { data: 'FECHA_TOMA_MUESTRA', render: function (data) {
            if (ifnull(data)) {
                // Si la muestra ha sido tomada, aparcerá la fecha
                const formattedDate = formatoFecha2(data, [0, 1, 5, 2, 0, 0, 0], null);
                const parts = formattedDate.split(', ');
                const datePart = parts[0];
                return `<span class="d-block">${datePart}</span>`;
            }

            return html = `
                    <div class="col-12">
                        <button type="button" class="btn btn-info btn_tomar_muestra">
                            <i class="bi bi-droplet-half btn_tomar_muestra"></i>
                        </button>
                    </div>
                `;
        }}
    ],
    columnDefs: [
        { "targets": 0, "className": "all", "title": "#", "width": "0px" },
        { "targets": 1, "className": "all", "title": "Paciente" },
        { "targets": 2, "className": "all", "title": "Edad" },
        { "targets": 3, "className": "desktop", "title": "Cuenta" },
        { "targets": 4, "className": "all", "title": "Folio" },
        { "targets": 5, "className": "all", "title": "Solicitud" },
        { "targets": 6, "className": "min-tablet", "title": "Registro" },
        { "targets": 7, "className": "all", "title": "Muestra" }
    ]
})

inputBusquedaTable('tablaPacientes', tablaPacientes, [], false, 'col-12')

selectTable('#tablaPacientes', tablaPacientes, {
    onlyData: true,
    ClickClass: [
        {
            class: 'btn_tomar_muestra',
            callback: function (data) {
                turno = data.ID_TURNO
                console.log(data.ID_TURNO)
                $('#form_toma_muestra_tablet').val('');
                $('#ModaltomarMuestra').modal('show');
            },
            selected: false
        }
    ],
})
