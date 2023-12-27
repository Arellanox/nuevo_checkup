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
        {
            data: 'COUNT', render: function (data) {
                return ifnull(data, '', [data.COUNT])
            }
        },
        {
            data: 'NOMBRE', render: function (data) {
                return ifnull(data, '', [data.NOMBRE])
            }
        },
        {
            data: 'USUARIO', render: function (data) {
                return ifnull(data, '', [data.USUARIO])
            }
        },
        {
            data: 'TELEFONO', render: function (data) {
                return badgeNull(config = { data: data, index: 'data.TELEFONO' }, type = 'TELEFONO');
            }
        },
        {
            data: 'CORREO', render: function (data) {
                return badgeNull(config = { data: data, index: 'data.CORREO' }, type = 'CORREO');
            }
        },
        {
            data: 'AREA', render: function (data) {
                return badgeNull(config = { data: data, index: 'data.AREA' }, type = 'AREA');
            }
        },
        {
            data: null, render: function (data) {
                // return formatearHora(data);
                let horario = `${formatearHora(ifnull(data, '', ["HORARIO_ENTRADA"]))} - ${formatearHora(ifnull(data, '', ['HORARIO_SALIDA']))}`
                return horario;
            }
        },
        {
            data: null, render: function (data) {
                // return formatearHora(data);
                let registro = `${backHora({ data: data, hora: 'HORA_ENTRADA' }, 'registro')} - ${backHora({ data: data, hora: 'HORA_SALIDA' }, 'registro')}`;
                return registro;
            }
        },
    ],
    columnDefs: [
        { target: 0, title: '#', className: 'all', width: '1px' },
        { target: 1, title: 'Nombre', className: 'all' },
        { target: 2, title: 'Usuario', className: 'all' },
        { target: 3, title: 'Telefono', className: 'all' },
        { target: 4, title: 'Correo', className: 'all' },
        { target: 5, title: 'Area', className: 'all' },
        { target: 6, title: 'Horario', className: 'all' },
        { target: 7, title: 'Registro', className: 'all ' },

    ],
    dom: 'Bfrtip',
    buttons: [
        {
            text: '<i class="fa fa-file-excel-o"></i> Excel',
            className: 'btn btn-secondary buttons-excel buttons-html5 btn-success',
            action: function (data) {
                obtenerReporteExcel(data);
            }
        },
        {
            text: '<i class="bi bi-eye-fill"></i> Verificar Rostro',
            className: 'btn-',
            action: function (data) {
                if (!usuarioSelected) {
                    alertToast('No hay ningun usuario seleccionado', 'error', 4000)
                    return false;
                }

                configurarModal()
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


// Select para la tabla principals
selectTable('#TablaAsistencia', TablaAsistencia, {
    unSelect: true, dblClick: false,
}, async function (select, data, callback) {
    if (select) {
        usuarioSelected = data;
        callback('In')
    } else {
        usuarioSelected = false
        callback('Out')
    }
})

// Evento change cuando cambie el input de type date
$(document).on('change', '#fechaListadoAsistencia', function (e) {
    dataAsistencia.fecha_inicial = $('#fechaListadoAsistencia').val()
    TablaAsistencia.ajax.reload();
})

function obtenerReporteExcel() {
    alertMensajeConfirm({
        title: '¿Desea generar el reporte de asistencia?',
        text: 'Confirme para descargar el reporte de asistencia en excel',
        icon: 'info',
        confirmButtonText: "Si, estoy seguro"
        // denyButtonText: "No",
        // showDenyButton: true
    }, () => {
        // sacamos la fecha inicial
        const fecha_inicial = sumarfecha();
        // sacamos la fecha final
        const fecha_final = $('#fechaListadoAsistencia').val();
        // se llama al metodo para descargar el archivo
        descargarReporte(fecha_inicial, fecha_final.replaceAll("/", "-"));
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
    fecha_formatter.setDate(fecha_formatter.getDate() - dias);
    // se formatea la fecha para enviarla a backs
    const result = fecha_formatter.getDate() + '/' + (fecha_formatter.getMonth() + 1) + '/' + fecha_formatter.getFullYear();
    // se returna ña fecha formateada
    return result;
}

// function para formatear hora
function formatearHora(hora) {
    if (hora === "" || hora === null) {
        return hora;
    } else {
        // Obtiene la fecha actual
        var fechaActual = new Date();

        // Divide la cadena de hora en horas, minutos y segundos
        var partesHora = hora.split(":");
        var horas = parseInt(partesHora[0]);
        var minutos = parseInt(partesHora[1]);

        // Crea un nuevo objeto de fecha con la misma fecha pero con la hora de la base de datos
        var fechaConHoraDesdeBD = new Date(fechaActual.getFullYear(), fechaActual.getMonth(), fechaActual.getDate(), horas, minutos);

        // Obtiene las horas y minutos en formato de 12 horas
        var horas12 = fechaConHoraDesdeBD.getHours() % 12 || 12; // Si es 0, se convierte a 12
        var minutosFormateados = ('0' + fechaConHoraDesdeBD.getMinutes()).slice(-2); // Asegura dos dígitos para los minutos

        // Determina si es AM o PM
        var ampm = fechaConHoraDesdeBD.getHours() < 12 ? 'AM' : 'PM';

        // Construye la hora formateada
        var horaFormateada = horas12 + ':' + minutosFormateados + ' ' + ampm;

        // se regresa la hora formateada
        return horaFormateada;
    }

}
//  no tiene hora de entrada "",
// "Sin captura" -> es que no se ha registrado su salida y es el dia de hoy
// "sin registro" -> es que no se registro su salida y es otro dia 


function backHora(config = { data: [], hora: null, horario: { entrada: '', salida: '' }, msg: '' }, tip) {
    return ifnull(config.data, null, [config.hora], (result) => {
        if (!result) {
            switch (tip) {
                case 'registro':
                    return '<span class="badge rounded-pill bg-warning">Sin captura</span>'; break;
                    break;
                case 'salida':
                    return '<span class="badge rounded-pill bg-danger">Sin registro</span>'; break;
                default:
                    return 'Sin hora'; break;
            }
        } else {
            return formatearHora(result);
        }
    })
}

function badgeNull(config = { data: [], index: '[]' }, type = '') {
    return ifnull(config.data, null, [config.index], (result) => {
        if (!result) {
            switch (type) {
                case 'CORREO':
                    return ''; break;
                case 'TELEFONO':
                    return ''; break;
                case 'AREA':
                    return ''; break;
                default:
                    return '';
                    break;
            }
        } else {
            return result;
        }
    })
}

// function para descargar el reporte de excel
function descargarReporte(fecha_inicial, fecha_final) {
    // hacermos la peticion al archivo para conseguir el reporte
    $.ajax({
        url: `${http + servidor + "/" + appname + "/clases/hacerExcel.php"}`,
        method: 'POST',
        data: { fecha_inicial: fecha_inicial, fecha_final: fecha_final },
        xhrFields: {
            responseType: 'blob' // Configuración de responseType para manejar blobs
        },
        success: function (data) {
            alertToast('Reporte generado con éxito', 'success', 4000);

            // Crear un objeto Blob a partir de los datos recibidos
            var blob = new Blob([data], { type: 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet' });

            // Crear un enlace y simular clic para descargar el archivo
            var link = document.createElement('a');
            let nombre_archivo = `ReporteAsistencia_Quincena_${fecha_inicial}.xlsx`;
            link.href = window.URL.createObjectURL(blob);
            link.download = nombre_archivo;
            document.body.appendChild(link);
            link.click();
            document.body.removeChild(link);
        },
        error: function (error) {
            alertErrorAJAX(null, null, error);
            console.error('Error al descargar el archivo:', error);
        }
    });



    // ajaxAwait({
    //     api: 4,
    //     fecha_inicial: fecha_inicial,
    //     fecha_final: fecha_final,
    // }, 'hacerExcel', { callbackAfter: true }, false, (data) => {
    //     // Crear un objeto Blob con la respuesta y generar un enlace para descargar
    //     var blob = new Blob([data]);
    //     var link = document.createElement('a');
    //     let nombre_archivo = `ReporteAsistencia_Quincena_${fecha_inicial}.xlsx`;
    //     link.href = window.URL.createObjectURL(blob);
    //     link.download = nombre_archivo;
    //     document.body.appendChild(link);
    //     link.click();
    //     document.body.removeChild(link);
    // })
}

// function para configurar el modal
function configurarModal() {
    // rellenamos el titulo
    $('#verRostrosTitle').html(`Rostro del usuario (<b>${usuarioSelected.NOMBRE}</b>)`)
    // ponemos el avatar en el modal}
    let avatar = `
        <img src="${usuarioSelected.AVATAR}" class='img-fluid' alt="${usuarioSelected.NOMBRE}">
    `;
    $('#avatar').html(avatar);
    // abrimos el modal
    $('#modalVerRostros').modal('show');
}

function limpiarModal() {
    $('#verRostrosTitle').html()
}