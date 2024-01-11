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
