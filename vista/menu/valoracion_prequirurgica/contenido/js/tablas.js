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
    if (select) {
        // getPanel('.informacion-paciente', '#loader-paciente', '#loaderDivPaciente', datalist, 'In', async function (divClass) {
        await obtenerPanelInformacion(data['ID_TURNO'], 'pacientes_api', 'paciente', '#panel-informacion', '_lab')

        // Llamar a esta función para reiniciar
        restartPages();

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
    fadePanelInfoInterpretacion("Out");
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