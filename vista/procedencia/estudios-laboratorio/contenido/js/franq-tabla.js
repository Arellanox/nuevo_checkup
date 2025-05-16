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
        complete: function () {
            loader("Out", 'bottom')
        },
        error: function (jqXHR, exception, data) {
            alertErrorAJAX(jqXHR, exception, data)
            // console.log('Error')
        },
        dataSrc: 'response.data'
    },
    createdRow: function (row, data, dataIndex) {
        // Más prioridad 
        // if (data.MUESTRA_TOMADA == 0) {
        //     $(row).addClass('bg-warning');
        // }
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
                        return `<span class="badge text-bg-info">${data}</span>`; break;
                    case "2":
                        // Urgente
                        return `<span class="badge text-bg-warning">${data}</span>`; break;

                    default:
                        return ''; break;
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
                    // Si la muestra ha sido tomada, aparcerá la fecha
                    const formattedDate = formatoFecha2(data, [0, 1, 5, 2, 0, 0, 0], null);

                    // Separar la fecha y la hora basado en la coma
                    const parts = formattedDate.split(', ');
                    const datePart = parts[0];

                    // Retornar la fecha y la hora envueltas en spans con las clases correspondientes
                    return `<span class="d-block">${datePart}</span>`;
                }

                let html = `
                        <div class="col-12">
                            <button type="button" class="btn btn-info btn_tomar_muestra">
                                <i class="bi bi-droplet-half btn_tomar_muestra"></i>
                            </button>
                        </div>
                    `;
                return html
            }
        }, // Fecha de muestra (formato)

        { data: 'TOMADOR_MUESTRA' }, // texto
        {
            dat: "ID_TURNO", render: function (data) {

                // Obtener URL para abrir
                api = encodeURIComponent(window.btoa('etiquetas'));
                // Obtener turno para abrir
                data = encodeURIComponent(window.btoa(data));


                url = `${http}${servidor}/${appname}/visualizar_reporte/?api=${api}&turno=${data}`

                // Inicializar un arreglo vacío para contener nuestros botones
                var buttons = [];

                buttons.push(
                    '<a href="' + url + '" target="_blank" class="btn btn-borrar me-2">' +
                    '<i class="bi bi-file-earmark-pdf-fill"></i> Etiquetas de laboratorio' +
                    '</a>'
                );


                return '<div class="d-flex justify-content-start align-items-center">' + buttons.join(' ') + '</div>';

            }
        },
        {
            data: 'REPORTES',
            render: function (data) {
                // Inicializar un arreglo vacío para contener nuestros botones
                var buttons = [];

                // Asegurarse de que 'data' es un array antes de intentar usar 'length'
                if (data) {
                    // Recorrer cada reporte en los datos
                    for (const key in data) {
                        if (Object.hasOwnProperty.call(data, key)) {
                            const element = data[key];
                            buttons.push(
                                '<a href="' + element + '" target="_blank" class="btn btn-borrar me-2">' +
                                '<i class="bi bi-file-earmark-pdf-fill"></i>' +
                                '</a>'
                            );
                        }
                    }
                } else {
                    buttons.push(`<div class="badge text-bg-warning px-3 rounded-pill font-weight-normal 
                            text-dark">Pendiente</div>`)
                    // Manejar el caso en el que 'data' no es un array (por ejemplo, mostrar un mensaje de error o un valor por defecto)
                    // console.error('Data is not an array:', data);
                }

                // Unir todos los botones con un espacio y devolver la cadena HTML
                return '<div class="d-flex justify-content-start align-items-center">' + buttons.join(' ') + '</div>';
            }
        }, // botones 
        {
            data: 'ORDEN_MEDICA', render: function (data) {
                // Inicializar un arreglo vacío para contener nuestros botones
                var buttons = [];

                buttons.push(
                    '<a href="' + data + '" target="_blank" class="btn btn-borrar me-2">' +
                    '<i class="bi bi-file-earmark-pdf-fill"></i> Orden Médica Cargada' +
                    '</a>'
                );

                // Unir todos los botones con un espacio y devolver la cadena HTML
                return '<div class="d-flex justify-content-start align-items-center">' + buttons.join(' ') + '</div>';
            }
        }, // boton
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
        { "targets": 11, "className": "none", "title": "Etiquetas" },
        { "targets": 12, "className": "all", "title": "Resultado" }, // Resultados (Clinico y Biomolecular [PDF])
        { "targets": 13, "className": "none", "title": "Orden médica" }, // Orden médica (boton)
        { "targets": 14, "className": "none", "title": "Comentarios" } // Comentarios de la orden médica
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

                $('#ModaltomarMuestra').modal('show');
            },
            selected: false
        }
    ],
})
