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
        //Muestra las columnas
        callback('In')
    } else {
        // Oculta las columnas una vez deseleccionado
        callback('Out')

    }
})



// evento change del checkbox para aparecer a todos los pacientes
$('#checkDiaAnalisis').click(function () {
    console.log(1)
    if ($(this).is(':checked')) {
        reloadTable(false)
        $('#fechaListadoAreaMaster').prop('disabled', true)
    } else {
        reloadTable(true);
        $('#fechaListadoAreaMaster').prop('disabled', false)
    }
})


function reloadTable(fecha = false) {
    DataPrequirurgico = {
        api: 1,
        area_id: 1,
        cliente_id: 31
    }

    if (fecha) DataPrequirurgico['fecha_busqueda'] = $(`#${'fechaListadoAreaMaster'}`).val();

    TablaPacientesPrequirurgica.ajax.reload()
}