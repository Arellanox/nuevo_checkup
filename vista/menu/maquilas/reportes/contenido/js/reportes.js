const hoy = new Date();
var laboratorio = null;
var fecha_inicio = formatDateToYMD(new Date(hoy.getFullYear(), hoy.getMonth() - 2, 1));
var fecha_final = formatDateToYMD(new Date(hoy.getFullYear(), hoy.getMonth(), hoy.getDate() + 1));

$('#btn-filtro-modal').on('click', function () {
    rellenarOrdenarSelect('#select_laboratorios', 'laboratorio_maquila_api', 2, 'ID_LABORATORIO', 'DESCRIPCION');
    $('#select_laboratorios').append(new Option('Todos', null, true));
    $('#modalFiltrarMaquilas').modal('show');
})

let datosConsolidados = {};
let tablaPrincipal = $('#TablaReporteMaquilas').DataTable({
    language: { url: "https://cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json" },
    lengthChange: false,
    info: true,
    paging: true,
    lengthMenu: [
        [20, 35, 50, 100, -1],
        [20, 35, 50, 100, "All"]
    ],
    scrollY: '61vh',
    scrollCollapse: true,
    ordering: false,
    ajax: {
        dataType: 'json',
        method: 'POST',
        url: `../../../../api/laboratorio_solicitud_maquila_api.php`,
        data: function (d) {
            return {
                api: 16,
                FECHA_INICIO: fecha_inicio ?? null,
                FECHA_FIN: fecha_final ?? null,
                LABORATORIO_MAQUILA_ID: laboratorio ?? null
            }
        },
        dataSrc: function(json) {
            const datos = json.response.data;

            // Consolidar por prefolio
            datosConsolidados = {};
            datos.forEach(item => {
                if (!datosConsolidados[item.prefolio]) {
                    datosConsolidados[item.prefolio] = {
                        prefolio: item.prefolio,
                        paciente: item.paciente,
                        laboratorio: item.laboratorio,
                        medico_tratante: item.medico_tratante,
                        fecha: item.fecha,
                        servicios: []
                    };
                }

                // Agregar servicios únicos que realmente pertenecen a este prefolio
                if (item.servicios) {
                    item.servicios.forEach(servicio => {
                        // Solo agregar si el prefolio del servicio coincide con el prefolio del grupo
                        if (servicio.prefolio === item.prefolio) {
                            const existe = datosConsolidados[item.prefolio].servicios
                                .find(s => s.id_solicitud === servicio.id_solicitud);
                            if (!existe) {
                                datosConsolidados[item.prefolio].servicios.push(servicio);
                            }
                        }
                    });
                }

                // Actualizar médico tratante si viene null
                if (!datosConsolidados[item.prefolio].medico_tratante && item.medico_tratante) {
                    datosConsolidados[item.prefolio].medico_tratante = item.medico_tratante;
                }
            });

            // Calcular totales
            Object.keys(datosConsolidados).forEach(prefolio => {
                const grupo = datosConsolidados[prefolio];
                grupo.total_servicios = grupo.servicios.length;
                grupo.total_general = grupo.servicios.reduce((sum, s) => sum + parseFloat(s.subtotal || 0), 0);
            });

            // Retornar solo los prefolios para la tabla (una fila por prefolio)
            return Object.values(datosConsolidados);
        },
        beforeSend: function(){ loader("In") },
        complete: function(){ loader("Out", 'bottom') }
    },
    columns: [
        { data: 'prefolio', title: 'Prefolio' },
        { data: 'paciente', title: 'Paciente' },
        { data: 'total_servicios', title: 'Servicios' },
        { data: 'laboratorio.nombre', title: 'Laboratorio' },
        {
            data: 'total_general',
            title: 'Costo Total',
            render: d => `$${parseDataTable(d)}`
        },
        { data: 'medico_tratante', title: 'Medico Tratante', defaultContent: '' },
        { data: 'fecha', title: 'Fecha Registro' }
    ],
    createdRow: function(row, data) {
        $(row).addClass('grupo-row background-group');
        $(row).attr('data-prefolio', data.prefolio);
        $(row).css('cursor', 'pointer');
    },

});

// Click en grupo para mostrar/ocultar servicios
$('#TablaReporteMaquilas tbody').on('click', '.grupo-row', function() {
    const prefolio = $(this).attr('data-prefolio');
    const grupo = datosConsolidados[prefolio];

    // Buscar si ya existen filas de servicios
    const serviciosExistentes = $(this).nextUntil('.grupo-row', '.servicio-row[data-prefolio="' + prefolio + '"]');

    if (serviciosExistentes.length > 0) {
        // Toggle visibility
        serviciosExistentes.toggleClass('d-none');
        // Si se ocultan, también ocultar estudios
        if (serviciosExistentes.hasClass('d-none')) {
            serviciosExistentes.nextAll('.estudio-row[data-prefolio="' + prefolio + '"]').addClass('d-none');
        }
    } else {
        // Crear filas de servicios
        if (grupo.servicios && grupo.servicios.length > 0) {
            grupo.servicios.forEach((servicio, idx) => {
                const servicioRow = $('<tr/>')
                    .addClass('servicio-row')
                    .attr('data-prefolio', prefolio)
                    .attr('data-servicio-id', servicio.id_solicitud)
                    .css({
                        'background-color': 'white',
                        'cursor': 'pointer'
                    });

                servicioRow.append(`<td style="padding-left: 30px;">${servicio.descripcion}</td>`)
                    .append(`<td>${servicio.prefolio}</td>`)
                    .append(`<td>$${parseDataTable(servicio.subtotal)}</td>`)
                    .append(`<td>${servicio.estudios ? servicio.estudios.length : 0} estudios</td>`)
                    .append(`<td>${servicio.fecha}</td>`)
                    .append('<td colspan="2"></td>');

                $(this).after(servicioRow);
            });
        }
    }
});

// Click en servicio para mostrar/ocultar estudios
$('#TablaReporteMaquilas tbody').on('click', '.servicio-row', function(e) {
    e.stopPropagation();

    const prefolio = $(this).attr('data-prefolio');
    const servicioId = $(this).attr('data-servicio-id');
    const grupo = datosConsolidados[prefolio];
    const servicio = grupo.servicios.find(s => s.id_solicitud === servicioId);

    // Buscar estudios existentes
    const estudiosExistentes = $(this).nextUntil('.servicio-row, .grupo-row')
        .filter('.estudio-row[data-servicio-id="' + servicioId + '"]');

    if (estudiosExistentes.length > 0) {
        // Toggle
        estudiosExistentes.toggleClass('d-none');
    } else {
        // Crear estudios
        if (servicio.estudios && servicio.estudios.length > 0) {
            servicio.estudios.forEach(estudio => {
                const estudioRow = $('<tr/>')
                    .addClass('estudio-row')
                    .attr('data-prefolio', prefolio)
                    .attr('data-servicio-id', servicioId)
                    .css({
                        'background-color': '#f5f5f5',
                        'font-size': '0.9em'
                    });

                estudioRow.append(`<td style="padding-left: 50px;">${estudio.descripcion}</td>`)
                    .append(`<td>Clave: ${estudio.clave ?? 'N/A'}</td>`)
                    .append(`<td>$${parseDataTable(estudio.precio)}</td>`)
                    .append(`<td>Grupo: ${estudio.grupo ?? 'N/A'}</td>`)
                    .append('<td colspan="3"></td>');

                $(this).after(estudioRow);
            });
        }
    }
});

inputBusquedaTable('TablaReporteMaquilas', tablaPrincipal, [
    {msj: 'Puedes organizar el contenido con los encabezados de la tabla.', place: 'top'},
    {msj: 'El campo de busqueda filtra sus coincidencias.', place: 'top'},
], {}, 'col-12')

$('#btn_filtrar').on('click', function () {
    laboratorio = $('#select_laboratorios').val()
    fecha_inicio = $('#fecha_inicio').val()
    fecha_final = $('#fecha_final').val()
    tablaPrincipal.ajax.reload();
    $('#modalFiltrarMaquilas').modal('hide');
})

function parseDataTable(data){
    let parsed = parseFloat(data);
    return isNaN(parsed) ? '0.00' : parsed.toFixed(2);
}

function formatDateToYMD(date) {
    const y = date.getFullYear();
    const m = String(date.getMonth() + 1).padStart(2, '0');
    const d = String(date.getDate()).padStart(2, '0');
    return `${y}-${m}-${d}`;
}