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
        // getPanel('.informacion-paciente', '#loader-paciente', '#loaderDivPaciente', datalist, 'In', async function (divClass) {
        await obtenerPanelInformacion(data['ID_TURNO'], 'pacientes_api', 'paciente', '#panel-informacion', '_lab')

        // Llamar a esta función para reiniciar
        restartPages();

        await ajaxAwait({ api: 4, turno_id: data['ID_TURNO'] }, 'prequirurgico_api', { callbackAfter: true }, false, (data) => {
            console.log(data)
            // Recupera la información del reporte

            // LLenar tabla
            tablalistRecomendaciones.rows.add(data.response.data[0].RECOMENDACIONES_JSON).draw()





            // Recupera el panel de información de reporte

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


async function panelResultadoPaciente(row, area) {

    let html = '';
    let itemStart = '<div class="accordion-item bg-acordion">';
    let itemEnd = '</div>';

    let bodyStart = '<div class="accordion-body"> <div class="row">';
    let bodyEnd = '</div>  </div>';
    html += '';
    let truehtml = false;
    $('#resultadosServicios-areas').html(html);

    $('#mostrarResultado').fadeOut()

    if (row[0].length) {
        // console.log(row[0])
        for (const i in row) {

            // console.log(row[i]);
            html += itemStart;
            html += '<h2 class="accordion-header" id="collap-historial-estudios' + i + '">' +
                '<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-estudio' + i + '-Target" aria-expanded="false" aria-controls="accordionEstudios">' +
                '<div class="row">' +
                '<div class="col-12">' +
                '<i class="bi bi-box-seam"></i> &nbsp;&nbsp;&nbsp; Cargado: <strong>' + ifnull(row[i][0]['CARGADO_POR']) + '</strong>' +
                '</div>' +
                '<div class="col-12">' +
                '<i class="bi bi-calendar3"></i> &nbsp;&nbsp;&nbsp; Fecha: <strong>' + formatoFecha2(row[i][0]['FECHA_RESULTADO'], [3, 1, 2, 2, 1, 1, 1]) + '</strong> ' + //<strong>12:00 '+i+'</strong>
                '</div>' +
                '</div>' +
                '</button>' +
                '</h2>' +
                //Dentro del acordion
                '<div id="collapse-estudio' + i + '-Target" class="accordion-collapse collapse " aria-labelledby="collap-historial-estudios' + i + '" > '; //overflow-auto style="max-height: 70vh"

            html += bodyStart;

            //Boton de interpretacion
            if (row[i][0]['PDF']) {
                html += '<div class="col-12 d-flex justify-content-center">' +
                    '<a type="button" target="_blank" class="btn btn-borrar me-2" href="' + row[i][0]['PDF'] + '" style="margin-bottom:4px">' +
                    '<i class="bi bi-file-earmark-pdf"></i> Interpretación' +
                    '</a>' +
                    '</div>';
                //Busca si existe interpretación o imagen
                truehtml = true;
            } else if (row[i][0]['CONFIRMADO'] == 0 && row[i][0]['GUARDADO'] == 1) {
                truehtml = true;
                html += '<div class="col-12 d-flex justify-content-center">' +
                    '<div class="alert alert-danger" role="alert"> Reporte sin confirmar </div>' +
                    '</div>';
            }


            let img = false;
            for (const im in row[i]) {
                // console.log(row[i][im]['CAPTURAS'])
                try {
                    if (row[i][im]['CAPTURAS'].length) img = true;
                } catch (error) {
                    console.log(error);
                }
            }
            if (img) {
                html += '<div class="col-12 d-flex justify-content-center">' +
                    '<a type="button" class="btn btn-option me-2" data-bs-toggle="modal" data-bs-target="#CapturasdeArea" style="margin-bottom:4px">' +
                    '<i class="bi bi-images"></i> Capturas' +
                    '</a>' +
                    '</div>';
                //Busca si existe interpretación o imagen
                truehtml = true;
            }

            if (ifnull(row[i][0]['ELECTRO_PDF'])) {
                html += '<div class="col-12 d-flex justify-content-center">' +
                    '<a type="button" target="_blank" href="' + row[i][0]['ELECTRO_PDF'] + '" class="btn btn-option me-2" style="margin-bottom:4px">' +
                    '<i class="bi bi-images"></i> Capturas' +
                    '</a>' +
                    '</div>';
                //Busca si existe interpretación o imagen
                truehtml = true;
            }


            if (area === 5) {

                if (row[i][0]['RUTA_REPORTES_ESPIRO']) {
                    html += '<div class="col-12 d-flex justify-content-center">' +
                        '<a type="button" target="_blank" class="btn btn-borrar me-2" href="' + row[i][0]['RUTA_REPORTES_ESPIRO'] + '" style="margin-bottom:4px">' +
                        '<i class="bi bi-file-earmark-pdf"></i> Espirometría' +
                        '</a>' +
                        '</div>';
                    //Busca si existe interpretación o imagen
                    truehtml = true;
                }

            }


            html += bodyEnd + '</div>';
            html += itemEnd;
        }

        if (truehtml) {
            $('#spamResultado').html('')
            $('#resultadosServicios-areas').html(html)
            $('#mostrarResultado').fadeIn()
        } else {
            $('#spamResultado').html('<div class="alert alert-info" role="alert">Reporte del paciente sin cargar</div > ')
        }
    } else {
        $('#spamResultado').html('<div class="alert alert-info" role="alert">Interpretación del paciente sin cargar</div>')
    }
}