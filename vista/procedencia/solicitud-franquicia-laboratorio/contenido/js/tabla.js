    tablaPacientes = $('#tablaPacientes')?.DataTable({
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
            data: { api: 1 },
            method: 'POST',
            url: '../../../api/franquicias_api.php',
            complete: function (response) {
                tablaPacientes.columns.adjust().draw();
            },
            error: function (jqXHR, textStatus, errorThrown) {
                alertErrorAJAX(jqXHR, textStatus, errorThrown);
            },
            dataSrc: 'response.data'
        },
        columns: [
            { data: 'COUNT' }, // texto
            { data: 'NOMBRE' }, // texto
            { data: 'EDAD' }, // texto
            { data: 'SIHO_CUENTA' }, // texto
            { data: 'FOLIO' }, // texto
            {
                data: 'DESCRIPCION_SOLICITUD', render: function (data, type, row, meta) {
                    switch (row.TIPO_SOLICITUD) {
                        case "1":
                            // Ordinario
                            return `<span class="badge text-bg-info">${data}</span>`;
                        case "2":
                            // Urgente
                            return `<span class="badge text-bg-warning">${data}</span>`;
                        default:
                            return '';
                    }
                }
            }, // Descripcion de solicitud (color de letra)

            { data: 'AREA_SE_ENCUENTRA' }, // texto
            {
                data: 'FECHA_ALTA', render: function (data) {
                    return formatoFecha2(data, [0, 1, 5, 2, 2, 2, 0])
                }
            }, // Registro (formato)

            { data: 'QUIEN_REGISTRA' }, // texto
            {
                data: 'FECHA_TOMA_MUESTRA', render: function (data) {
                    // return 1;
                    if (ifnull(data)) {
                        console.log(data)
                        // Si la muestra ha sido tomada, aparcerá la fecha
                        const formattedDate = formatoFecha2(data, [0, 1, 5, 2, 0, 0, 0], null);

                        // Separar la fecha y la hora basado en la coma
                        const parts = formattedDate.split(', ');
                        const datePart = parts[0];

                        // Retornar la fecha y la hora envueltas en spans con las clases correspondientes
                        return `<span class="d-block">${datePart}</span>`;
                    }

                    return `
                        <div class="col-12">
                            <button type="button" class="btn btn-info btn_tomar_muestra">
                                <i class="bi bi-droplet-half btn_tomar_muestra"></i>
                            </button>
                        </div>
                    `
                }
            }, // Fecha de muestra (formato)
            { data: 'TOMADOR_MUESTRA' }, // texto
            { data: 'COMENTARIO_ORDEN_MEDICA' }, // texto

        ],
        columnDefs: [
            { "targets": 0, "className": "all", "title": "#", "width": "0px" }, // Conteo
            { "targets": 1, "className": "all", "title": "Paciente" }, // PACIENTE
            { "targets": 2, "className": "all", "title": "Edad" },
            { "targets": 3, "className": "desktop", "title": "Cuenta" }, // SIHO_CUENTA
            { "targets": 4, "className": "all", "title": "Folio" }, // FOLIO
            { "targets": 5, "className": "all", "title": "Solicitud" }, // Tipo de solicitud
            { "targets": 6, "className": "none", "title": "Area" },  // area donde se encuentra
            { "targets": 7, "className": "min-tablet", "title": "Registro" }, // FECHA_ALTA
            { "targets": 8, "className": "none", "title": "Quién registro" }, // USUARIO
            { "targets": 9, "className": "all", "title": "Muestra" }, // Muestra (Color rojo sin tomar muestra - colocar fecha o Capturar muestra (modal))
            { "targets": 10, "className": "none", "title": "Muestra Tomado por" }, // ¿quien tomo la muestra?
            { "targets": 11, "className": "none", "title": "Comentarios" } // Comentarios de la orden médica
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
                    $('#form_toma_muestra_tablet').val('');

                    $('#ModalTomarMuestra').modal('show');
                },
                selected: false
            }
        ],
    })