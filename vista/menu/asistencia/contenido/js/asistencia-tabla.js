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
            data: 'COUNT'
        },
        {
            data: 'NOMBRE'
        },
        {
            data: 'USUARIO'
        },
        {
            data: 'TELEFONO'
        },
        {
            data: 'CORREO'
        },
        {
            data: 'AREA'
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
                let registro = `${backHora({ data: data, hora: 'HORA_ENTRADA' }, 'salida')} - ${backHora({ data: data, hora: 'HORA_SALIDA' }, 'salida')}`;
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
            action: async function (data) {

                obtenerReporteExcel(data);

                setTimeout(() => {
                    $.fn.dataTable
                        .tables({
                            visible: true,
                            api: true
                        })
                        .columns.adjust();
                }, 200);
            }
        },
        // {
        //     text: '<i class="bi bi-eye-fill"></i> Verificar Rostro',
        //     className: 'btn-',
        //     action: function (data) {
        //         if (!usuarioSelected) {
        //             alertToast('No hay ningun usuario seleccionado', 'error', 4000)
        //             return false;
        //         }

        //         configurarModal()
        //     }
        // },
        {
            text: '<i class="bi bi-calendar-check-fill"></i> Reporte personal',
            className: 'btn-',
            action: function (data) {
                if (!usuarioSelected) {
                    alertToast('No hay ningun usuario seleccionado, para realizar esta acciòn', 'error', 4000)
                    return false;
                }

                obtenerReportePersonal()
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
        dataAjax.bimer_id = usuarioSelected.ID_BIMER
        reportes_anteriores_personal.ajax.reload()
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

$(document).on('click', '#generReporteExcel', function (e) {

    const fecha_input = $('#FechaInicio').val()
    const fecha_input_2 = $('#FechaFinal').val()

    if (fecha_input < fecha_input_2) {
        console.log(1)
        if (fecha_input === "" || fecha_input_2 === "") {
            alertToast('Los campos de fecha estan vacios', 'error', 4000)
        } else {
            alertMensajeConfirm({
                title: '¿Desea generar el reporte de asistencia?',
                text: 'Confirme para descargar el reporte de asistencia en excel',
                icon: 'info',
                confirmButtonText: "Si, estoy seguro"
                // denyButtonText: "No",
                // showDenyButton: true
            }, () => {
                // sacamos la fecha inicial
                // const fecha_inicial = sumarfecha();
                // const fecha_inicial_buena = formatearFecha2(fecha_inicial.replaceAll("/", "-"))
                // sacamos la fecha final
                // const fecha_final = $('#fechaListadoAsistencia').val();
                const fecha_inicial = $('#FechaInicio').val()
                const fecha_final = $('#FechaFinal').val()

                // se llama al metodo para descargar el archivo
                descargarReporte(fecha_inicial, fecha_final);
            }, 1)
        }
    } else {

        alertToast('El rango de las fechas son incorrectos', 'error', 4000)
        console.log(2)

    }

})


$(document).on('click', '#generReportePdf', function (e) {

    const fecha_input = $('#FechaInicioPdf').val()
    const fecha_input_2 = $('#FechaFinalPdf').val()

    if (fecha_input < fecha_input_2) {
        if (fecha_input === "" || fecha_input_2 === "") {
            alertToast('Los campos de fecha estan vacios', 'error', 4000)
        } else {
            alertMensajeConfirm({
                title: '¿Desea generar el reporte de asistencia?',
                text: 'Confirme para descargar el reporte de asistencia en Pdf',
                icon: 'info',
                confirmButtonText: "Si, estoy seguro"
                // denyButtonText: "No",
                // showDenyButton: true
            }, () => {
                // sacamos la fecha inicial
                // const fecha_inicial = sumarfecha();
                // const fecha_inicial_buena = formatearFecha2(fecha_inicial.replaceAll("/", "-"))
                // sacamos la fecha final
                // const fecha_final = $('#fechaListadoAsistencia').val();
                const fecha_inicial = $('#FechaInicioPdf').val()
                const fecha_final = $('#FechaFinalPdf').val()

                // se llama al metodo para descargar el archivo
                descargarReportePdf(fecha_inicial, fecha_final);
            }, 1)
        }
    } else {
        alertToast('El rango de las fechas son incorrectos', 'error', 4000)
        console.log(2)
    }

})

function obtenerReporteExcel() {
    // fadeTablaUsuarios({
    //     type: 'in'
    // });
    fadeTableAsistencia({
        type: 'Out'
    })
    // $('#FechaInicio').val("")
    // $('#FechaFinal').val("")


    $('#modalReporteExcel').modal('show');
}

function obtenerReportePersonal() {
    limpiarAdobe();
    $('#FechaInicio').val("")
    $('#FechaFinal').val("")
    $('#modalReportePersonal').modal('show');
    setTimeout(() => {
        $.fn.dataTable
            .tables({
                visible: true,
                api: true
            })
            .columns.adjust();
    }, 230);
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

function formatearFecha2(fecha_mal) {
    // Fecha en formato "DD-MM-YYYY"
    var fechaString = fecha_mal;

    // Dividir la cadena en día, mes y año
    var partesFecha = fechaString.split("-");

    // Crear un objeto Date con las partes de la fecha
    var fecha = new Date(partesFecha[2], partesFecha[1] - 1, partesFecha[0]);


    // Obtener los componentes de la fecha
    var dia = fecha.getDate();
    var mes = fecha.getMonth() + 1; // Los meses en JavaScript son 0-indexados, por eso sumamos 1
    var anio = fecha.getFullYear();

    // Formatear la fecha como "YYYY-MM-DD"
    var fechaFormateada = anio + "-" + (mes < 10 ? "0" : "") + mes + "-" + (dia < 10 ? "0" : "") + dia;

    return fechaFormateada
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


// function para descargar el reporte de excel
function descargarReporte(fecha_inicial, fecha_final) {
    const fecha_formateada = fecha_inicial.replaceAll("/", "-")
    // hacermos la peticion al archivo para conseguir el reporte
    $.ajax({
        url: `${http + servidor + "/" + appname + "/clases/hacerExcel.php"}`,
        method: 'POST',
        data: { fecha_inicial: fecha_formateada, fecha_final: fecha_final },
        xhrFields: {
            responseType: 'blob' // Configuración de responseType para manejar blobs
        },
        success: function (data) {
            alertToast('Reporte generado con éxito', 'success', 4000);

            // Crear un objeto Blob a partir de los datos recibidos
            var blob = new Blob([data], { type: 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet' });

            // Crear un enlace y simular clic para descargar el archivo
            var link = document.createElement('a');
            let nombre_archivo = `ReporteAsistencia_${fecha_inicial}-${fecha_final} .xlsx`;
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
    $('#verRostrosTitle').html(`Rostro del usuario (<b>${ifnull(usuarioSelected, '', ['NOMBRE'])}</b>)`)
    // ponemos el avatar en el modal}
    let avatar = `
        <img src="${ifnull(usuarioSelected, '', ['AVATAR'])}" class='img-fluid' alt="${ifnull(usuarioSelected, '', ['NOMBRE'])}">
    `;

    let captura_registro = `
        <img src="${ifnull(usuarioSelected, '', ['CAPTURA_REGISTRO'])}" class='img-fluid' alt="${ifnull(usuarioSelected, '', ['NOMBRE'])}">
    `;

    $('#avatar').html(avatar);
    $('#captura_registro_foto').html(captura_registro);
    // abrimos el modal
    $('#modalVerRostros').modal('show');
}

function limpiarModal() {
    $('#verRostrosTitle').html()
}


$(document).on('click', '#btnReporteEntradasSalidas', () => {
    const fecha_input = $('#FechaInicioPdf').val()
    const fecha_input_2 = $('#FechaFinalPdf').val()

    if (fecha_input < fecha_input_2) {

    } else {
        alertToast('Las fechas no coinciden con el formato', 'error', 2000);
    }
})


// Evento para el formualrio FormReporteIndividual
$(document).on('submit', '#FormReporteIndividual', (e) => {
    e.preventDefault();

    alertMensajeConfirm({
        title: `¿Desea realizar la accion?`,
        text: "Se guardara en la base de datos",
        icon: "info"
    }, function () {
        enviarFormularioReporteIndividual()
    }, 1)
})



// function para enviar los datos para hacer el reporte inidivudal
let enviarFormularioReporteIndividual = (config = {}) => {
    return new Promise((resolve, reject) => {
        ajaxAwaitFormData({
            api: 7,
            bimer_id: usuarioSelected.ID_BIMER
        }, 'checadorBimo_api', 'FormReporteIndividual', { callbackAfter: true }, false, (data) => {
            alertToast('Reporte generado con éxito', 'success', 4000);
            $('#FormReporteIndividual').trigger("reset");
            reportes_anteriores_personal.ajax.reload()
            limpiarAdobe()
        })

        resolve(1);
    })
}


// function para limpiar el adobe
function limpiarAdobe() {
    $('#adobe-dc-view').html("")
}


// HACER UNA TABLA DE 25 FILAS CONTANDO LOS ENCABEZADOS
