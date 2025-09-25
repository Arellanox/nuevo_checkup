var listaMaquilas = [];
var maquilasPendientes = [];
var maquilasCompletadas = [];
var maquilasRechazadas = [];
var rangoFechas = [new Date().toISOString().split('T')[0],new Date().toISOString().split('T')[0]];

var tablaMaquilaasPorAprobar = $('#TablaMaquilaasPorAprobar').DataTable({
    language: { url: "https://cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json" },
    scrollCollapse: true,
    deferRender: true,
    scrollY: '65vh',
    paging: true,
    ajax: {
        dataType: 'json',
        data: function (d) {
            return {
                api: 2,
                FECHA_INICIO: rangoFechas[0] ?? null,
                FECHA_FIN: rangoFechas[1] ?? null
            }
        },
        method: 'POST',
        url: '../../../api/laboratorio_solicitud_maquila_api.php',
        dataSrc: 'response.data',
        beforeSend: function () { console.info('📣 System: Obtencion de maquilas iniciada.') },
        complete: function (data) {
            if (data.responseJSON && data.responseJSON.response) {
                listaMaquilas = data.responseJSON.response.data ?? [];

                ({ maquilasPendientes, maquilasCompletadas, maquilasRechazadas } =
                    guardarMaquilasPorEstatus(listaMaquilas));
            }

            console.info('📣 System: Obtencion de maquilas completada.')
        },
        error: function () { Toast.fire({icon: 'error', title: '¡Error al recuperar las maquilas!'}); }
    },
    columns: [
        {
            data: "TURNO_PREFOLIO",
            render: function (data, type, row) {
                return `
                    <div class="d-flex align-items-center dt-control" style="cursor:pointer; color: #00bbb9 !important;">
                        <i class="bi bi-caret-down-fill"></i>
                        <div class="ms-2">
                            <p class="text-xs font-weight-bold mb-0" style="color: #00bbb9 !important">${data}</p>
                        </div>
                    </div>
                `;
            }
        },
        {data: "LABORATORIO_NOMBRE"},
        {data: "SERVICIO"},
        {
            data: "LISTA_ESTUDIOS",
            render: function (data, type, row) {
                return data.length;
            }
        },
        {data: "PACIENTE_NOMBRE"},
        {data: "USUARIO_SOLICITANTE"},
        {
            data: "LAB_MAQUILA_ESTATUS",
            render: function (data, type, row) {
                let text = "Desconocido: " + data;
                let className = "badge bg-secondary"; // Estilos por defecto

                if (data === null || data == 0) {
                    text = "Pendiente";
                    className = "badge bg-warning text-dark"; // Amarillo
                } else if (data == 1) {
                    text = "Aprobado";
                    className = "badge bg-success"; // Verde
                } else if (data == 2) {
                    text = "Rechazado";
                    className = "badge bg-danger"; // Rojo
                }

                return `<span class="${className}">${text}</span>`;
            }
        },
        {data: "LAB_MAQUILA_REGISTRO"},
        { // Botones de acciones
            data: null,
            render: function (data, type, row) {
                //Si no tiene permisos de aprobar no se monstraran los botones
                if(session['permisos']['AprobarSolictudMaquilas'] != 1) {
                    return '';
                }

                let buttons = ``;

                if (row.LAB_MAQUILA_ESTATUS == 0 || row.LAB_MAQUILA_ESTATUS == null || row.LAB_MAQUILA_ESTATUS == 1) {
                    buttons += `
                        <button onclick="rechazarMaquila(${row.ID_MAQUILA})" type="button" role="button" class="btn btnRechazar" data-bs-toggle="tooltip" data-bs-title="Rechazar maquila">
                            <i class="bi bi-file-earmark-excel-fill"></i> Rechazar
                       </button>
                    `;
                }

                if (row.LAB_MAQUILA_ESTATUS != 1) {
                    buttons += `
                        <button onclick="aprobarMaquila(${row.ID_MAQUILA})" type="button" role="button" class="btn btnAprobar" data-bs-toggle="tooltip" data-bs-title="Aprobar maquila">
                            <i class="bi bi-file-earmark-check-fill"></i> Aprobar
                        </button>
                    `;
                }

                if (row.LAB_MAQUILA_ESTATUS != 1) {
                    buttons += `
                        <button onclick="eliminarMaquila(${row.ID_MAQUILA})" type="button" role="button" class="btn btnEliminar" data-bs-toggle="tooltip" data-bs-title="Eliminar maquila">
                            <i class="bi bi-trash-fill"></i> Eliminar
                        </button>
                    `;
                }

                return buttons;
            }
        }
    ],
    columnDefs: [ { width: "50px", targets: 0 } ],
});

inputBusquedaTable('TablaMaquilaasPorAprobar', tablaMaquilaasPorAprobar, [
    {
        msj: 'Filtra la tabla con palabras u oraciones que coincidan en el campo de busqueda',
        place: 'left'
    },
])

//---Desplegar detalles de los estudios de servicio de maquilación
$('#TablaMaquilaasPorAprobar tbody').on('click', 'tr', function (event) {
    if ($(event.target).closest('button').length > 0 || $(event.target).is('i')) return;

    const tr = $(this);
    const row = tablaMaquilaasPorAprobar.row(tr);

    if (row.child.isShown()) {
        row.child.hide();
        tr.removeClass('shown');
    } else {
        row.child(formatearEstudios(row.data().DETALLES_ESTUDIOS)).show();
        tr.addClass('shown');
    }
});
function formatearEstudios(estudios) { //---Mostrar detalles de estudios
    if (!Array.isArray(estudios) || estudios.length === 0) {
        return '<div class="p-2 text-muted">Sin estudios relacionados.</div>';
    }

    let table = `
        <div class="table-responsive">
            <table class="table align-items-center mb-0" style="border-left: 1px solid #e9ecef; border-right: 1px solid #e9ecef">
                <thead>
                    <tr>
                        <th class="text-uppercase text-white text-xxs font-weight-bolder opacity-7">#</th>
                        <th class="text-uppercase text-white text-xxs font-weight-bolder opacity-7">Estudio</th>
                        <th class="text-uppercase text-white text-xxs font-weight-bolder opacity-7">Grupo</th>
                        <th class="text-uppercase text-white text-xxs font-weight-bolder opacity-7">Abreviatura</th>
                        <th class="text-uppercase text-white text-xxs font-weight-bolder opacity-7">Abreviatura Estudio</th>
                    </tr>
                </thead>
                <tbody>
    `;

    estudios.forEach((estudio, index) => {
        table += `
            <tr>
                <td><p class="text-xs mb-0" style="color: #0c0c0c; font-weight: 300">${index}</p></td>
                <td><p class="text-xs mb-0" style="color: #0c0c0c; font-weight: 300">${estudio.NOMBRE_ESTUDIO}</p></td>
                <td><p class="text-xs mb-0" style="color: #0c0c0c; font-weight: 300">${estudio.NOMBRE_GRUPO}</p></td>
                <td><p class="text-xs mb-0" style="color: #0c0c0c; font-weight: 300">${estudio.ABREVIATURA_GRUPO}</p></td>
                <td><p class="text-xs mb-0" style="color: #0c0c0c; font-weight: 300">${estudio.ABREVIATURA_ESTUDIO}</p></td>
            </tr>
        `;
    });

    table += `</tbody></table></div>`;

    return table;
}

//---Acciones de las tablas
function aprobarMaquila(id) { //---Aprobación de una maquila por fechas
    alertMensajeConfirm({
        title: '¿Está seguro de aprobar esta maquila?',
        text: 'No podrá revertir los cambios',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Aceptar',
        cancelButtonText: 'Cancelar'
    }, function () {
        ajaxAwait({
            api: 3,
            ID_MAQUILA: id,
            MAQUILA_ESTATUS: 1
        }, 'laboratorio_solicitud_maquila_api', {callbackAfter: true}, false, function (response) {
            if (response.response.code) {
                Toast.fire({icon: 'success', title: '¡Maquila aprobada!', timer: 2000});
                tablaMaquilaasPorAprobar.ajax.reload();

                ajaxAwait({
                    api: 3,
                    viculo: `${current_url}/vista/menu/maquilas/`,
                    mensaje: 'Su solicitud de maquila ha sido aprobada por ' + session.nombre,
                    cargos_id: '11,2'
                }, 'notificaciones_api', {callbackAfter: true}, false, function () {
                    alertToast('Notificación de aprovación enviada', 'success', 4000);
                });
            }
        }).then(r => {});
    });
}
function rechazarMaquila(id) { //---Rechazo de una maquila
    alertMensajeConfirm({
        title: '¿Está seguro de rechazar esta maquila?',
        text: 'No podrá revertir los cambios',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Aceptar',
        cancelButtonText: 'Cancelar'
    }, function () {
        ajaxAwait({
            api: 3,
            ID_MAQUILA: id,
            MAQUILA_ESTATUS: 2
        }, 'laboratorio_solicitud_maquila_api', {callbackAfter: true}, false, function (response) {
            if (response.response.code) {
                Toast.fire({icon: 'success', title: '¡Maquila rechazada!', timer: 2000});
                tablaMaquilaasPorAprobar.ajax.reload();

                ajaxAwait({
                    api: 3,
                    viculo: `${current_url}/vista/menu/maquilas/`,
                    mensaje: 'Su solicitud de maquilación ha sido rechazada por ' + session.nombre,
                    cargos_id: '11,2'
                }, 'notificaciones_api', {callbackAfter: true}, false, function () {
                    alertToast('Notificación de rechazo enviada', 'success', 4000);
                });
            }
        }).then(r => {});
    });
}
function eliminarMaquila(id) { //---Eliminación de una maquila
    alertMensajeConfirm({
        title: '¿Está seguro de eliminar esta maquila?',
        text: 'No podrá revertir los cambios',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Aceptar',
        cancelButtonText: 'Cancelar'
    }, function () {
        ajaxAwait({
            api: 4,
            ID_MAQUILA: id
        }, 'laboratorio_solicitud_maquila_api', {callbackAfter: true}, false, function (response) {
            if (response.response.code) {
                Toast.fire({icon: 'success', title: '¡Maquila eliminada!', timer: 2000});
                tablaMaquilaasPorAprobar.ajax.reload();
            }
        }).then(r => {});
    });
}
function guardarMaquilasPorEstatus(response) { //---Guardar maquilas por estatus
    return response.reduce(
        (acc, maquila) => {
            const estatus = maquila.LAB_MAQUILA_ESTATUS?.toString(); // Convierte a string para evitar inconsistencias

            if (estatus === null || estatus === undefined || estatus === "0") {
                acc.maquilasPendientes.push(maquila.ID_MAQUILA);
            } else if (estatus === "1") {
                acc.maquilasCompletadas.push(maquila.ID_MAQUILA);
            } else if (estatus === "2") {
                acc.maquilasRechazadas.push(maquila.ID_MAQUILA);
            }

            return acc;
        },
        { maquilasPendientes: [], maquilasCompletadas: [], maquilasRechazadas: [] }
    );
}

//---Aprobación de todas las maquilas pendientes
$('#btn-aprobar-todos').on('click', function () { aprobarTodasMaquilas(maquilasPendientes); });
$('#btn-select-fechas').on('click', function () { $('#modal-select-fechas').modal('show'); })
$('#btn-confirmar-seleccion-fechas').on('click', function () {
    const fecha_inicial = $('[name="fecha_inicio"]').val();
    const fecha_final = $('[name="fecha_final"]').val();

    rangoFechas = [fecha_inicial, fecha_final];
    tablaMaquilaasPorAprobar.ajax.reload();

    $('#modal-select-fechas').modal('hide');

    alertToast('Cambios guardados', 'success', 2000);
})

function aprobarTodasMaquilas(ids) { //---Aprobación de todas las maquilas pendientes por fechas
    alertMensajeConfirm({
        title: '¿Está seguro de aprobar todas las maquilas?',
        text: 'No podrá revertir los cambios',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Aceptar',
        cancelButtonText: 'Cancelar'
    }, function () {
        if (ids && ids.length > 0) {
            Toast.fire({ icon: 'info', title: 'Espere un momento, estamos procesando su solicitud.' });

            ajaxAwait({
                api: 3,
                ID_MAQUILA: ids,
                MAQUILA_ESTATUS: 1,
                FECHA
            }, 'laboratorio_solicitud_maquila_api', { callbackAfter: true }, false, function (response) {
                if (response.response.code) {
                    Toast.fire({ icon: 'success', title: '¡Maquilas aprobadas!', timer: 2000 });
                    tablaMaquilaasPorAprobar.ajax.reload();

                    ajaxAwait({
                        api: 3,
                        viculo: `${current_url}/vista/menu/maquilas/`,
                        mensaje: 'Sus solicitudes de maquilación ha sido aprobadas por ' + session.nombre,
                        cargos_id: '11,2'
                    }, 'notificaciones_api', {callbackAfter: true}, false, function () {
                        alertToast('Notificación de aprovación enviada', 'success', 4000);
                    });
                }
            });
        }
    });
}

//---Generación de reportes de las maquilas aprobadas
$('#btn-generar-reportes').on('click', function (event) { abrirSeleccionDeReportesPorLaboratorio(event); });
$('#btn-generar-pdf').on('click', function (event) { generarReporteMaquilas(event); });

function abrirSeleccionDeReportesPorLaboratorio(event) { //--Abrir Modal de generación de reporte por laboratorios
    event.preventDefault();
    $('#modalMaquilaEstudios').modal('show');
    rellenarOrdenarSelect('#select-laboratorios-maquila', 'laboratorio_maquila_api', 2, 'ID_LABORATORIO', 'DESCRIPCION');
}
function generarReporteMaquilas(event){ //--Generar reportes de un laboratorio
    event.preventDefault();
    const laboratorio_texto = $('#select-laboratorios-maquila option:selected').text();
    const laboratorio_id = $('#select-laboratorios-maquila').val();

    if(maquilasCompletadas < 0){
        Toast.fire({icon: 'error', title: '¡No se puede generar reporte de maquilas con estatus pendiente!', timer: 2000});
        return;
    }

    const maquilasDelLaboratorio = listaMaquilas.filter(maquila =>
        maquilasCompletadas.includes(maquila.ID_MAQUILA) &&
        maquila.ID_LABORATORIO.toString() === laboratorio_id.toString()
    );

    if (maquilasDelLaboratorio.length <= 0) {
        Toast.fire({ icon: 'error', title: '¡No se puede generar el reporte si hay maquilas sin aprobar!', timer: 2000});
        return;
    }

    alertMensajeConfirm({
        title: '¿Quieres completar esta acción?',
        text: `Se generara un reporte de maquilas por ${laboratorio_texto}`,
        icon: 'warning',
        confirmButtonText: 'Sí'
    }, function () {
        ajaxAwait({
            api: (
                //laboratorio_id !== '9' ? 6 : 5
                laboratorio_id == 9 ? 5 :
                laboratorio_id == 7 ? 13 :
                laboratorio_id == 8 ? 14 : 6
            ),
            laboratorio_id: laboratorio_id,
            fecha_inicio: rangoFechas[0],
            fecha_final: rangoFechas[1]
        }, 'laboratorio_solicitud_maquila_api', { callbackAfter: true }, false, function (response) {
            const url = response.response.data.url;
            window.open(url, '_blank');
        });

    }, 1, function () { alert("Acción cancelada."); }, () => {});
}

/*
//---Modal listado de precios por laboratorios
$('#btn-modal-lista-precios').on('click', function (event) {
    event.preventDefault();
    $('#modalListaPreciosEstLab').modal('show');
    rellenarOrdenarSelect('#select-laboratorios-maquila-by-list', 'laboratorio_maquila_api', 2, 'ID_LABORATORIO', 'DESCRIPCION');
})
$('#btn-confirm-laboratorio').on('click', function (event) { //---Consultar API para obtener los servicios y estudios del laboratorio seleccionado
    event.preventDefault();

    ajaxAwait({
        api: 10,
        LABORATORIO_MAQUILA_ID: $('#select-laboratorios-maquila-by-list').val()
    }, 'laboratorio_solicitud_maquila_api', { callbackAfter: true }, false, function (response) {
        $('#empty_message').css('display', 'none');
        $('#btn-confirm-laboratorio').css('background', '#30614f');

        $('#TablaListadoPreciosEstudiosLab tbody').empty();

        llenarTablaServicios(response.response.data)
    });
});

function llenarTablaServicios(servicios) {
    const tbody = $('#TablaListadoPreciosEstudiosLab tbody');

    tbody.empty();
    let contador = 1;

    servicios.forEach(function(servicio) {
        // Fila principal del servicio (expandible)
        const servicioRow = `
            <tr class="servicio-row" data-servicio-id="${servicio.ID_SERVICIO}" style="cursor: pointer; background-color: #f8f9fa;">
                <td style="font-weight: bold;">
                    <i class="bi bi-chevron-right expand-icon" style="margin-right: 8px;"></i>
                    ${contador}
                </td>
                <td style="font-weight: bold;">
                    <span class="badge badge-${servicio.ES_GRUPO ? 'primary' : 'secondary'}" style="margin-right: 8px;">
                        ${servicio.ES_GRUPO ? 'GRUPO' : 'INDIVIDUAL'}
                    </span>
                    ${servicio.DESCRIPCION}
                    ${servicio.ABREVIATURA ? `<small class="text-muted"> (${servicio.ABREVIATURA})</small>` : ''}
                    <br>
                    <small class="text-success">Precio: ${parseFloat(servicio.PRECIO_VENTA || 0).toFixed(2)}</small>
                </td>
                <td style="font-weight: bold;">
                    <span class="badge badge-info">${servicio.ESTUDIOS.length} estudio${servicio.ESTUDIOS.length > 1 ? 's' : ''}</span>
                </td>
            </tr>
        `;

        tbody.append(servicioRow);

        // Filas de estudios (ocultas inicialmente)
        servicio.ESTUDIOS.forEach(function(estudio, index) {
            const alias = estudio.ALIAS || {};
            const precioLab = alias.PRECIO ? parseFloat(alias.PRECIO).toFixed(2) : 'Sin precio';
            const precioVenta = estudio.PRECIO_VENTA ? parseFloat(estudio.PRECIO_VENTA).toFixed(2) : 'Sin precio';
            const clavelab = alias.LAB_ESTUDIO_CLAVE || 'Sin clave';
            const nombreAlias = alias.LAB_ESTUDIO_NOMBRE || 'Sin alias';
            const idAlias = alias.ID_ALIAS;

            const estudioRow = `
                <tr class="estudio-row" data-servicio-id="${servicio.ID_SERVICIO}" style="display: none; background-color: #fff;">
                    <td style="padding-left: 40px;">
                        <small class="text-muted">${contador}.${index + 1}</small>
                    </td>
                    <td colspan="2">
                        <div style="display: flex; flex-direction: column; gap: 5px;">
                            <table class="table table-hover display responsive w-full" id="TablaListadoPreciosEstudiosLab">
                                <thead>
                                    <tr>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr style="user-select: none">
                                        <td><i class="bi bi-box2-heart"></i> ${estudio.DESCRIPCION}</td>
                                        <td><i class="bi bi-tag"></i> ${estudio.ABREVIATURA ? estudio.ABREVIATURA : ''}</td>
                                        <td><i class="bi bi-currency-dollar"></i> ${precioVenta}</td>
                                    </tr>
                                </tbody>
                            </table>
                            <strong>Catologo del Laboratorio Seleccionado: </strong>
                            <table class="table table-hover display responsive w-full" id="TablaListadoPreciosEstudiosLab">
                                <thead>
                                    <tr>
                                        <th>Estudio</th>
                                        <th>Abreviatura</th>
                                        <th>Precio</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="tr-estudio-details"
                                        data-id-alias="${idAlias}"
                                        data-abreviatura="${clavelab}"
                                        data-alias="${nombreAlias}"
                                        data-precio="${precioLab}"
                                    >
                                        <td style="color: #007bff;"><i class="bi bi-box2-heart"></i> ${nombreAlias}</td>
                                        <td><i class="bi bi-tag"></i> ${clavelab}</td>
                                        <td><i class="bi bi-currency-dollar"></i>${precioLab}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </td>
                </tr>
            `;

            tbody.append(estudioRow);
        });

        contador++;
    });

    // Evento click para expandir/contraer
    $('.servicio-row').off('click').on('click', function() {
        const servicioId = $(this).data('servicio-id');
        const estudiosRows = $(`.estudio-row[data-servicio-id="${servicioId}"]`);
        const expandIcon = $(this).find('.expand-icon');
        const chevronIcon = $(this).find('.bi-chevron-down, .bi-chevron-up');

        if (estudiosRows.is(':visible')) {
            estudiosRows.slideUp(200);
            expandIcon.removeClass('bi-chevron-down').addClass('bi-chevron-right');
            chevronIcon.removeClass('bi-chevron-up').addClass('bi-chevron-down');
            $(this).css('background-color', '#f8f9fa');
        } else {
            estudiosRows.slideDown(200);
            expandIcon.removeClass('bi-chevron-right').addClass('bi-chevron-down');
            chevronIcon.removeClass('bi-chevron-down').addClass('bi-chevron-up');
            $(this).css('background-color', '#e3f2fd');
        }
    });
}*/
