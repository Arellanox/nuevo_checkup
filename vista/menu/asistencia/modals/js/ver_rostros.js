tablaUsuariosFiltro = $('#tablaUsuariosFiltro').DataTable({
    language: {
        url: "https://cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json",
    },
    lengthChange: false,
    info: false,
    paging: false,
    sorting: false,
    scrollY: '40vh',
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
}, 500);

// Select para la tabla principals
selectTable('#tablaUsuariosFiltro', tablaUsuariosFiltro, {
    unSelect: true, dblClick: false,
}, async function (select, data, callback) {
    if (select) {
        fadeTableAsistencia({ type: 'In', data: data })
    } else {
        fadeTableAsistencia({ type: 'Out', data: null })
    }
})

// ==============================================================
tablaReporteAsistencias = $('#tablaReporteAsistencias').DataTable({
    language: {
        url: "https://cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json",
    },
    lengthChange: false,
    info: true,
    paging: false,
    sorting: false,
    scrollY: '68vh',
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
            data: 'FECHA'
        }
        , {
            data: 'HORA_ENTRADA'
        },
        {
            data: 'HORA_SALIDA'
        }
    ],
    columnDefs: [
        { target: 0, title: '#', className: 'all', width: '1px' },
        { target: 1, title: 'Fecha', className: 'all' },
        { target: 2, title: 'Entrada', className: 'all' },
        { target: 3, title: 'Salida', className: 'all' },
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

}, 500);

function fadeTableAsistencia(config = { type: 'In' || 'Out', data: null }) {
    return new Promise((resolve, reject) => {

        const div = $('#divtablaReporteAsistencias');
        const horarios = $('#divHorarios');
        const element = config.data

        const fecha_incio = $('#FechaInicio').val();
        const fecha_final = $('#FechaFinal').val();

        const divHorarios = $('#divHorarios');

        switch (config.type) {
            case 'In':
                div.fadeIn();
                horarios.fadeIn();

                divHorarios.html("");
                divHorarios.html(
                    buldHorarios({ data: element })
                );

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
                horarios.fadeOut();
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
            break;
        default:
            fadeTablaUsuarios({ type: 'Out' });
            break;
    }
}

function buldHorarios(config = { data: '' }) {
    let data = config.data
    return `
    <div class="d-flex justify-content-center gap-4">
            <div class="d-flex">
                <h5 class=" ">
                    Horario de entrada:
                    <strong>${data.HORARIO_ENTRADA}</strong>
                </h5>
            </div>
            <div class="d-flex">
                <h5 class=" ">Horario de salida:
                    <strong>${data.HORARIO_SALIDA}</strong>
                </h5>
            </div>
        </div>
    `;
}


$(document).on('click', '#consultarInformacion', (e) => {

    // const inicio = $('#FechaInicio').val()
    // const final = $('#FechaFinal').val()

    // if (inicio === "" || final === "") {
    //     alertToast('Las fechas estan vacias', 'error', 2000);
    //     return false;
    // } else {

    // }

    fadeTablaUsuarios({
        type: 'In'
    });
})