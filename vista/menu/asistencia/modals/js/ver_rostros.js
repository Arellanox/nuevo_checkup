tablaUsuariosFiltro = $('#tablaUsuariosFiltro').DataTable({
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
}, 300);

// Select para la tabla principals
selectTable('#tablaUsuariosFiltro', tablaUsuariosFiltro, {
    unSelect: true, dblClick: false,
}, async function (select, data, callback) {
    if (select) {
        fadeTableAsistencia({ type: 'In' })
    } else {
        fadeTableAsistencia({ type: 'Out' })
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
}, 300);



function fadeTableAsistencia(config = { type: 'In' || 'Out' }) {
    return new Promise((resolve, reject) => {

        let div = $('#divtablaReporteAsistencias');
        let horarios = $('#divHorarios');

        if (config.type === 'In') {
            div.fadeIn();
            horarios.fadeIn();

            setTimeout(() => {
                $.fn.dataTable
                    .tables({
                        visible: true,
                        api: true
                    })
                    .columns.adjust();
            }, 300);
        } else if (config.type === 'Out') {
            div.fadeOut();
            horarios.fadeOut();
        }

        resolve(1)
    })

}