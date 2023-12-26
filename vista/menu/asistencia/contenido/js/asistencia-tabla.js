// Tabla de asistencia
dataAsistencia = {
    api: 5,
    fecha_inicial: $('#fechaListadoAsistencia').val()
}

TablaAsistencia = $('#TablaAsistencia').DataTable({
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
            return $.extend(d, dataAsistencia);
        },
        // data: { api: 2, equipo: id_equipos },
        method: 'POST',
        url: '../../../api/checadorBimo_api.php',
        beforeSend: function () {
        },
        complete: function () {
            //Para ocultar segunda columna
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
        { data: 'COUNT' },
        { data: 'NOMBRE' },
        { data: 'AREA' },
        { data: 'HORARIO_ENTRADA' },
        { data: 'HORARIO_SALIDA' },
        { data: 'HORA_ENTRADA' },
        { data: 'HORA_SALIDA' },
    ],
    columnDefs: [
        { target: 0, title: '#', className: 'all' },
        { target: 1, title: 'Nombre', className: 'all' },
        { target: 2, title: 'Area', className: 'all' },
        { target: 3, title: 'Horario de entrada', className: 'all' },
        { target: 4, title: 'Horario de salida', className: 'all ' },
        { target: 5, title: 'Hora de entrada', className: 'all ' },
        { target: 6, title: 'Hora de salida', className: 'all ' },

    ],

})

inputBusquedaTable("TablaAsistencia", TablaAsistencia, [{
    msj: 'Lista de asistencia ',
    place: 'top'
}], {
    msj: "Filtre los resultados de la lista de asistencia",
    place: 'top'
}, "col-12")

selectTable('#TablaAsistencia', TablaAsistencia, {
    unSelect: true, dblClick: false,
}, async function (select, data, callback) {
    if (select) {
        callback('In')
    } else {
        callback('Out')
    }
})