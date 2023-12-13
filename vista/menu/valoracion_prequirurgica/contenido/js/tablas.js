// Datatable para la tabla de TablaPacientesPrequirurgica
TablaPacientesPrequirurgica = $('#TablaPacientesPrequirurgica').DataTable({
    language: { url: "https://cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json", },
    lengthChange: false,
    info: true,
    paging: false,
    sorting: false,
    scrollY: '75vh',
    scrollCollapse: true,
    ajax: {
        dataType: 'json',
        data: function (d) {
            return $.extend(d, DataPrequirurgico);
        },
        method: 'POST',
        url: '../../../api/prequirurgico_api.php',
        beforeSend: function () {
            loader("In")

        },
        complete: function () {
            loader("Out", 'bottom')

            //Para ocultar segunda columna
            reloadSelectTable()

            // reloadSelectTable()
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
    createdRow: function (row, data, dataIndex) {
        if (data.CONFIRMADO_PREQUIRURGICO == 1) {
            $(row).addClass('bg-success text-white');
        }
    },
    columns: [
        { data: 'COUNT' },
        { data: 'NOMBRE_COMPLETO' },
        { data: 'PREFOLIO' },
        { data: 'CLIENTE' },
        { data: 'EDAD' },
        { data: 'GENERO' }
    ],
    columnDefs: [
        { target: 0, title: '#', className: 'all' },
        { target: 1, title: 'Nombre', className: 'all' },
        { target: 2, title: 'Prefolio  ', className: 'all' },
        { target: 3, title: 'Procedencia', className: 'none' },
        { target: 4, title: 'Edad   ', className: 'none' },
        { target: 5, title: 'Sexo', className: 'none' }

    ],
})

// Input de busqueda
inputBusquedaTable("TablaPacientesPrequirurgica", TablaPacientesPrequirurgica, [{
    msj: 'Tabla de los pacientes para valoracion prequirurgica  ',
    place: 'top'
}], {
    msj: "Filtre los resultados por el folio que escriba",
    place: 'top'
}, "col-12")


// Select para la tabla
selectTable('#TablaPacientesPrequirurgica', TablaPacientesPrequirurgica, {
    unSelect: true, dblClick: true, movil: true, reload: ['col-xl-8']
}, async function (select, data, callback) {
    arrayPaciente = data
    estadoFormulario(arrayPaciente['GUARDADO'], arrayPaciente['CONFIRMADO_PREQUIRURGICO'])

    if (select) {
        limpiarForm('formInterpretacion');
        // getPanel('.informacion-paciente', '#loader-paciente', '#loaderDivPaciente', datalist, 'In', async function (divClass) {
        await obtenerPanelInformacion(data['ID_TURNO'], 'pacientes_api', 'paciente', '#panel-informacion', '_lab')

        // Llamar a esta función para reiniciar
        restartPages();

        $('#btn-vistaPrevia').attr('turno_actual', data['ID_TURNO'])

        await ajaxAwait({ api: 4, turno_id: data['ID_TURNO'] }, 'prequirurgico_api', { callbackAfter: true }, false, (data) => {

            dataRegistro = data.response.data[0] // recupera todos los datos guardados

            // LLenar tabla
            if (dataRegistro !== undefined || dataRegistro === "undefined") {
                tablalistRecomendaciones.rows.add(data.response.data[0].RECOMENDACIONES_JSON).draw()
            }

            //Verifica que si tenga algo y no llegue en null
            if (dataRegistro !== undefined || dataRegistro === "undefined") {
                dataPacientes(dataRegistro) // Funcion que muestra los datos guardados
            }

            // Recupera el panel de información de reporte
            // Llamada a la función principal
            actualizarAcordeon(data.response.data);


        })

        //Muestra las columnas
        callback('In')
    } else {
        // Oculta las columnas una vez deseleccionado
        callback('Out')

    }
})




// evento change del checkbox para aparecer a todos los pacientes
$(document).on('change', '#checkDiaAnalisis', function () {


    // sacamos el boton con el valor si esta checkeado
    let btn = $(this).is(':checked');


    // se valida si el checkbox esta chekeado
    if (btn) {
        // se vuelve a crear el JSON para la tabla
        createJsonObject(2)
        // Se desaparece las 2 columnas en caso de que esten a la vista del usuario
        // fadePanelInfoInterpretacion("Out");
        // se activa el input para cambiar la fecha
        $('#fechaListadoAreaMaster').prop('disabled', true);
    } else {
        // se vuelve a crear el JSON para la tablas
        createJsonObject(1)
        // Se desaparece las 2 columnas en caso de que esten a la vista del usuario
        // fadePanelInfoInterpretacion("Out");
        // se desactiva el input para cambiar la fecha
        $('#fechaListadoAreaMaster').prop('disabled', false);
    }
})

// evento change para cuando cambien las fechas del calendario
$(document).on('change', '#fechaListadoAreaMaster', function () {
    // se vuelve a crear el JSON para la tabla
    createJsonObject(1);
    // Se desaparece las 2 columnas en caso de que esten a la vista del usuario
    // fadePanelInfoInterpretacion("Out");
})


$('#btn-vistaPrevia').click(function () {


    let api = encodeURIComponent(window.btoa('prequirurgica'));
    let turno = encodeURIComponent(window.btoa($(this).attr('turno_actual')));
    let area = encodeURIComponent(window.btoa('-5'));


    window.open(`${http}${servidor}/${appname}/visualizar_reporte/?api=${api}&turno=${turno}&area=${area}`, "_blank");
})


// evento change del checkbox para aparecer a todos los pacientes
// $('#checkDiaAnalisis').click(function () {
//     console.log(1)
//     if ($(this).is(':checked')) {
//         $('#fechaListadoAreaMaster').prop('disabled', true)
//     } else {
//         $('#fechaListadoAreaMaster').prop('disabled', false)
//     }
// })




// console.log(TablaPacientesPrequirurgica)


function actualizarAcordeon(row) {
    let html = row.length ? row.map((dato, indice) => crearItemAcordeon(dato, indice)).join('') : mostrarMensaje('Interpretación del paciente sin cargar');
    $('#resultadosServicios-areas').html(html);
    html ? $('#mostrarResultado').fadeIn() : $('#mostrarResultado').fadeOut();
}

function crearItemAcordeon(dato, indice) {
    return `
        <div class="accordion-item bg-acordion">
            <h2 class="accordion-header" id="collap-historial-estudios${indice}">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-estudio${indice}-Target" aria-expanded="false" aria-controls="accordionEstudios">
                    <div class="row">
                        <div class="col-12">
                            <i class="bi bi-box-seam"></i> &nbsp;&nbsp;&nbsp; Cargado: <strong>${ifnull(dato['CARGADO_POR'])}</strong>
                        </div>
                        <div class="col-12">
                            <i class="bi bi-calendar3"></i> &nbsp;&nbsp;&nbsp; Fecha: <strong>${formatoFecha2(dato['FECHA_RESULTADO'], [3, 1, 2, 2, 1, 1, 1])}</strong>
                        </div>
                    </div>
                </button>
            </h2>
            <div id="collapse-estudio${indice}-Target" class="accordion-collapse collapse" aria-labelledby="collap-historial-estudios${indice}">
                <div class="accordion-body">
                    <div class="row">
                        ${dato['PDF'] ? crearBotonPDF(dato['PDF']) : dato['CONFIRMADO'] == 0 && dato['GUARDADO'] == 1 ? '<div class="alert alert-danger" role="alert"> Reporte sin confirmar </div>' : ''}
                    </div>
                </div>
            </div>
        </div>`;
}

function crearBotonPDF(url) {
    return `<div class="col-12 d-flex justify-content-center">
                <a type="button" target="_blank" class="btn btn-borrar me-2" href="${url}" style="margin-bottom:4px">
                    <i class="bi bi-file-earmark-pdf"></i> Interpretación
                </a>
            </div>`;
}

function mostrarMensaje(mensaje) {
    return `<div class="alert alert-info" role="alert">${mensaje}</div>`;
}


