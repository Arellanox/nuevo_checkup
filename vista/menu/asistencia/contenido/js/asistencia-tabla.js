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
            loader("In", 'bottom')
        },
        complete: function () {
            //Para ocultar segunda columna
            loader("Out", 'bottom')

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
    dom: 'Bfrtip',
    buttons: [
        {
            text: '<i class="fa fa-file-excel-o"></i> Excel',
            className: 'btn btn-secondary buttons-excel buttons-html5 btn-success',
            action: function (data) {
                generarReporteExcel(data);
            }
        }
    ]

})

setTimeout(() => {
    inputBusquedaTable("TablaAsistencia", TablaAsistencia, [{
        msj: 'Lista de asistencia ',
        place: 'top'
    }], {
        msj: "Filtre los resultados de la lista de asistencia",
        place: 'top'
    }, "col-12")
}, 500);

// Evento change cuando cambie el input de type date
$(document).on('change', '#fechaListadoAsistencia', function (e) {
    dataAsistencia.fecha_inicial = $('#fechaListadoAsistencia').val()
    TablaAsistencia.ajax.reload();
})

function generarReporteExcel() {
    alertMensajeConfirm({
        title: 'Desea generar el reporte de asistencia',
        text: 'confirme para realizar el reporte ',
        icon: 'info',
        confirmButtonText: "Si"
        // denyButtonText: "No",
        // showDenyButton: true
    }, () => {
        // sacamos la fecha final
        const fecha_inicial = $('#fechaListadoAsistencia').val();
        const fecha_final = sumarfecha();
        // se hace la peticion a la api para generar el reporte
        ajaxAwait({
            api: 4,
            fecha_inicial: fecha_inicial,
            fecha_final: fecha_final,
        }, 'checadorBimo_api', { callbackAfter: true }, false, () => {
            alertToast('Reporte generado con exito', 'success', 4000)
        })
    }, 1)
}

// function para sumar una quincena a una fecha
function sumarfecha() {
    // se saca la fecha del input
    const input = $('#fechaListadoAsistencia').val()
    // se saca la fecha formateada con Dates
    const fecha_formatter = new Date(input.replaceAll("-", "/"));
    // se declara los dias que se van a sumar es decir una quincena
    const dias = 15;
    // se suman los dias
    fecha_formatter.setDate(fecha_formatter.getDate() + dias);
    // se formatea la fecha para enviarla a backs
    const result = fecha_formatter.getDate() + '/' + (fecha_formatter.getMonth() + 1) + '/' + fecha_formatter.getFullYear();

    return result;
}
