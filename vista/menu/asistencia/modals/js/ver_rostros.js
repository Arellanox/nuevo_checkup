tablaUsuariosFiltro = $('#tablaUsuariosFiltro').DataTable({
    language: {
        url: "https://cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json",
    },
    lengthChange: false,
    info: false,
    paging: false,
    scrollY: '54vh',
    scrollCollapse: true,
    ajax: {
        dataType: 'json',
        data: function (d) {
            return $.extend(d, {
                api: 9
            });
        },
        // data: { api: 2, equipo: id_equipos },
        method: 'POST',
        url: '../../../api/checadorBimo_api.php',
        beforeSend: function () {
            // loader("In", 'bottom')
        },
        complete: function () {
            // //Para ocultar segunda columna
            // loader("Out", 'bottom')

            $.fn.dataTable
                .tables({
                    visible: true,
                    api: true
                })
                .columns.adjust();
        },
        error: function (jqXHR, textStatus, errorThrown) {
            alertErrorAJAX(jqXHR, textStatus, errorThrown);
        },
        dataSrc: 'response.data'
    },
    columns: [
        {
            data: 'COUNT'
        },
        {
            data: 'NOMBRE'
        }
    ],
    columnDefs: [
        { target: 0, title: '#', className: 'all', width: '1px' },
        { target: 1, title: 'Nombre', className: 'all' },
    ]
})

setTimeout(() => {
    inputBusquedaTable("tablaUsuariosFiltro", tablaUsuariosFiltro, [{
        msj: 'Lista de asistencia ',
        place: 'top'
    }], {
        msj: "Filtre los resultados de la lista de asistencia",
        place: 'top'
    }, "col-12")
}, 1000);

// Select para la tabla principals
isMovil(() => {
    $('#tab-informacion').fadeOut();
})
selectTable('#tablaUsuariosFiltro', tablaUsuariosFiltro, {
    unSelect: true, dblClick: false,
    movil: true, 'tab-default': 'Información', // Envia a la configuración de fechas
    tabs: [
        {
            title: 'Usuarios',
            element: '#tab-usuarios',
            class: 'active',
        },
        {
            title: 'Información',
            element: '#tab-informacion',
            class: 'disabled tab-select'
        },
        {
            title: 'Reporte',
            element: '#tab-reporte',
            callback: function () {
                let boton_click = 'consultarInformacion';
            },
            class: 'disabled tab-select'
        },
    ], reload: ['col-12 col-lg-9'], visibleColumns: true
}, async function (select, data, callback) {
    fadeTableAsistencia({ type: 'Out' });
    tablaReporteAsistencias.clear().draw();
    select_data = data;

    const divHorarios = $('#divHorarios');

    if (select) {

        divHorarios.html("");
        divHorarios.html(
            buldHorarios({ data: data })
        );

        divHorarios.fadeIn();

        fadeTableAsistencia({ type: 'In', data: data })

        //Muestra las columnas
        callback('In')
    } else {

        divHorarios.fadeOut('200');
        setTimeout(() => {
            $
        }, 220);
        callback('Out')
        fadeTableAsistencia({ type: 'Out', data: null })
    }
})

// ==============================================================
tablaReporteAsistencias = $('#tablaReporteAsistencias').DataTable({
    language: {
        url: "https://cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json",
        emptyTable: 'No hay registros disponibles aún.'
    },
    lengthChange: false,
    lengthMenu: [
        [15, 30, 45, -1],
        [15, 30, 45, "All"]
    ],
    info: false,
    paging: false,
    scrollY: '50vh',
    scrollCollapse: true,
    ajax: {
        dataType: 'json',
        data: function (d) {
            return $.extend(d, dataReporteAsistencia);
        },
        // data: { api: 2, equipo: id_equipos },
        method: 'POST',
        url: '../../../api/checadorBimo_api.php',
        beforeSend: function () {
            // loader("In", 'bottom')
        },
        complete: function () {
            // //Para ocultar segunda columna
            // loader("Out", 'bottom')

            $.fn.dataTable
                .tables({
                    visible: true,
                    api: true
                })
                .columns.adjust();

            fadeBotones({ type: 'In' })
        },
        error: function (jqXHR, textStatus, errorThrown) {
            alertErrorAJAX(jqXHR, textStatus, errorThrown);
        },
        dataSrc: 'response.data'
    },
    columns: [
        {
            data: null, render: function (meta) {

                return `
                    <div data-name='ASISTENCIA' data-id='${meta.ID_ASISTENCIA === null ? 0 : meta.ID_ASISTENCIA}'>
                        ${meta.COUNT}
                    </div>
                `
            }
        },
        {
            data: null, render: function (meta) {


                return `
                <div data-name='FECHA' data-id='${meta.ID_ASISTENCIA === null ? 0 : meta.ID_ASISTENCIA}'>
                    ${formatoFecha2(meta.FECHA, [2, 1, 3, 2, 0, 0, 0])}
                </div>
                `
            }
        }
        , {
            data: null, render: function (meta) {

                return `
                    <div class="columns_edit" data-name='HORA_ENTRADA' data-id='${meta.ID_ASISTENCIA === null ? 0 : meta.ID_ASISTENCIA}'>
                        ${meta.HORA_ENTRADA}
                    </div>
                `
            }
        },
        {
            data: null, render: function (meta) {

                return `
                    <div class="columns_edit" data-name='HORA_SALIDA' data-id='${meta.ID_ASISTENCIA === null ? 0 : meta.ID_ASISTENCIA}'>
                        ${meta.HORA_SALIDA}
                    </div>
                `
            }
        },
        {
            data: null, render: function (meta) {

                return `
                <div class="d-flex d-lg-block align-items-center" style="max-width: max-content; padding: 0px;">
                    <div class="d-flex flex-wrap flex-lg-nowrap align-items-center">
                        <i fecha='${meta.FECHA}' count='${meta.COUNT}' id='editar_${meta.COUNT}' data-id='${meta.ID_ASISTENCIA === null ? 0 : meta.ID_ASISTENCIA}' class="editarAsistencia bi bi-pencil-square btn-hover rounded-pill" style="cursor: pointer; font-size:16px;padding: 2px 4px; display:none;"></i>
                        <i fecha='${meta.FECHA}' count='${meta.COUNT}' id='guardar_${meta.COUNT}' data-id='${meta.ID_ASISTENCIA === null ? 0 : meta.ID_ASISTENCIA}' class="guardarAsistencia bi bi-check-circle btn-hover rounded-pill" style="cursor: pointer; font-size:16px;padding: 2px 4px; display:none ;"></i>
                        <i fecha='${meta.FECHA}' count='${meta.COUNT}' id='cancelar_${meta.COUNT}' data-id='${meta.ID_ASISTENCIA === null ? 0 : meta.ID_ASISTENCIA}' class="cancelarAsistencia bi bi-x-circle btn-hover rounded-pill" style="cursor: pointer; font-size:16px;padding: 2px 4px; display:none ;"></i>
                    </div>
                </div>
                `
            }
        }
    ],
    columnDefs: [
        { target: 0, title: '#', className: 'all', width: '1px' },
        { target: 1, title: 'Fecha', className: 'all' },
        { target: 2, title: 'Entrada', className: 'all' },
        { target: 3, title: 'Salida', className: 'all' },
        {
            target: 4,
            title: '#',
            className: 'all actions',
            width: '1%'
        },
    ]

})

setTimeout(() => {
    inputBusquedaTable("tablaReporteAsistencias", tablaReporteAsistencias, [{
        msj: 'Lista de asistencia ',
        place: 'top'
    }], {
        msj: "Filtre los resultados de la lista de asistencia",
        place: 'top'
    }, "col-12")
}, 1000);

function fadeTableAsistencia(config = {}) {
    // data = { type: 'In' || 'Out', data: null }
    return new Promise((resolve, reject) => {

        const div = $('#divtablaReporteAsistencias');
        const element = config.data

        const fecha_incio = $('#FechaInicio').val();
        const fecha_final = $('#FechaFinal').val();

        switch (config.type) {
            case 'In':
                div.fadeIn();

                dataReporteAsistencia = {
                    api: 10,
                    bimer_id: element.ID_BIMER,
                    fecha_inicial: fecha_incio,
                    fecha_final: fecha_final
                }

                tablaReporteAsistencias.ajax.reload();

                setTimeout(() => {
                    $.fn.dataTable
                        .tables({
                            visible: true,
                            api: true
                        })
                        .columns.adjust();
                }, 300);


                break;
            case 'Out':
                div.fadeOut();
                tablaReporteAsistencias.clear().draw();

                break;
            default:
                fadeTableAsistencia({ type: 'Out' });
                break;
        }


        resolve(1)
    })

}

function fadeTablaUsuarios(config = { type: 'In' || 'Out' }) {
    const divTablaUsuarios = $('#divTablaUsuarios');

    switch (config.type) {
        case 'In':
            divTablaUsuarios.fadeIn();

            setTimeout(() => {
                $.fn.dataTable
                    .tables({
                        visible: true,
                        api: true
                    })
                    .columns.adjust();
            }, 250);
            break;
        case 'Out':
            divTablaUsuarios.fadeOut();
            tablaUsuariosFiltro.ajax.reload()
            break;
        default:
            fadeTablaUsuarios({ type: 'Out' });
            break;
    }
}

function buldHorarios(config = { data: '' }) {
    let data = config.data
    return `
        <div>
            <h5 class='text-center'>Horario de trabajo</h5>
            <div class="d-flex justify-content-center gap-4">
                <div class="d-flex">
                    <h5 class="text-dark">
                        Horario de entrada:
                        <strong>${data.HORARIO_ENTRADA}</strong>
                    </h5>
                </div>
                <div class="d-flex">
                    <h5 class="text-dark">Horario de salida:
                        <strong>${data.HORARIO_SALIDA}</strong>
                    </h5>
                </div>
            </div>
        </div>
    `;
};


$(document).on('click', '#consultarInformacion', async (e) => {
    fadeTableAsistencia({ type: 'Out' });

    const inicio = $('#FechaInicio').val()
    const final = $('#FechaFinal').val()

    if (inicio === "" || final === "") {
        alertToast('Las fechas estan vacias', 'error', 2000);
        return false;
    } else {
        await fadeTableAsistencia({ type: 'In', data: select_data })
    }
})


// Botones para la modificacion de las asistenciias

$(document).on('click', '.editarAsistencia', function () {

    fadeBotones({ type: 'OutElement', count: parseInt($(this).attr('count')) });

    // Obten todas las columnas desde tr
    let tr = $(this).closest('tr');

    // Obten las 2 columnas de tiempo
    let columnas_horas = tr.find(`div.columns_edit`);

    // Crear un objeto para almacenar los datos de las columnas
    let columnas = {};

    // Iterar sobre cada columna
    columnas_horas.each(function () {
        // Obten el nombre del elemento (data-name)
        let nombre = $(this).data('name');

        // Obten el texto del div
        let texto = $(this).text().trim().replace(/[\n\r]+|[\s]{2,}/g, ' ');

        // Almacena estos valores en el objeto columnas
        columnas[nombre] = texto;

        // Cambias a un input el div con el valor de texto
        let div = $(this)
        div.html(`<input type="time" value="${texto}" class="new_hours_registros form-control input-form" data-value-column="${texto}">`) // <-- el input debe tener el valor anterior por si cancelar dejar como estaba las horas
    });
});

$(document).on('click', '.guardarAsistencia', function () {
    // Obtener de nuevo el tr
    let tr = $(this).closest('tr');
    let count = parseInt($(this).attr('count'))
    // Obtener los inputs
    let columnas_inputs = tr.find('input.new_hours_registros');

    // Crear un objeto para almacenar los datos de las columnas
    let inputs = {};

    // Crear una iteración para poder obtener los inputs
    columnas_inputs.each(function () {
        // Se obtiene el input
        let input = $(this);

        // Obtener el elemento div que envuelve al input
        let div = input.parent('div');

        // Obten el nombre del elemento (data-name)
        let nombre = div.data('name');

        // Se obtiene el nuevo valor
        let valor_nuevo = input.val();

        // Almacena estos valores en el objeto columnas
        inputs[nombre] = valor_nuevo;

        // En caso contrario de cancelar, debe ser los anteriores del atributo del input
        div.html(valor_nuevo);

    })

    // Una vez hace el primer each para recuperar y armar el array se hace un  AjaxAwait
    ajaxAwait({
        api: 11,
        inputs: inputs,
        bimer_id: select_data.ID_BIMER,
        ID_ASISTENCIA: $(this).attr('data-id'),
        fecha: $(this).attr('fecha')
    }, 'checadorBimo_api', { callbackAfter: true }, false, function (response) {
        let id = response.data[0];

        $(`#editar_${count}`).attr('data-id', id);
        $(`#guardar_${count}`).attr('data-id', id);
        $(`#cancelar_${count}`).attr('data-id', id);

        alertToast('Hora modificada con exito', 'success', 2000);
    })


    fadeBotones({ type: 'InElement', count: parseInt($(this).attr('count')) });

})

$(document).on('click', '.cancelarAsistencia', function () {
    // Obtener de nuevo el tr
    let tr = $(this).closest('tr');
    // Obtener los inputs
    let inputs = tr.find('input.new_hours_registros');

    // Crear una iteración para poder obtener los inputs
    inputs.each(function () {
        // Se obtiene el input
        let input = $(this);
        let valor_anterior = input.attr('data-value-column');

        // Obtener el elemento div que envuelve al input
        let div = input.parent('div');

        // En caso contrario de cancelar, debe ser los anteriores del atributo del input
        div.html(valor_anterior);
    })

    fadeBotones({ type: 'InElement', count: parseInt($(this).attr('count')) });
});



function fadeBotones(config = { type: 'In' || 'Out', count: '' }) {
    const btnEditar = $('.editarAsistencia');
    const btnGuardar = $('.guardarAsistencia');
    const btnCancelar = $('.cancelarAsistencia');

    switch (config.type) {
        case 'In':
            btnEditar.fadeIn();
            btnGuardar.fadeOut();
            btnCancelar.fadeOut();
            break;
        case 'Out':
            btnEditar.fadeOut();
            btnGuardar.fadeIn();
            btnCancelar.fadeIn();
            break;
        case 'InElement':
            $(`#editar_${config.count}`).fadeIn();
            $(`#guardar_${config.count}`).fadeOut();
            $(`#cancelar_${config.count}`).fadeOut();
            break;
        case 'OutElement':
            $(`#editar_${config.count}`).fadeOut();
            $(`#guardar_${config.count}`).fadeIn();
            $(`#cancelar_${config.count}`).fadeIn();
            break;
        default:
            fadeBotones({ type: 'In' })
            break;
    }
}