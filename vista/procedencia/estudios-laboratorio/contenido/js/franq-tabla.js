// Detalles de datos a api
let dataListaPaciente = { api: 3, };
tablaPacientes = $('#tablaPacientes').DataTable({
    language: {
        url: "https://cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"
    },
    lengthChange: false,
    info: true,
    paging: false,
    scrollY: autoHeightDiv(0, 384),
    scrollCollapse: true,
    ajax: {
        dataType: 'json',
        data: function (d) {
            return $.extend(d, dataListaPaciente);
        },
        method: 'POST',
        url: `${http}${servidor}/${appname}/api/maquilas_api.php`,
        beforeSend: function () { loader("In") },
        complete: function () {
            loader("Out", 'bottom')

            //Para ocultar segunda columna
            reloadSelectTable()
        },
        dataSrc: 'response.data'
    },
    createdRow: function (row, data, dataIndex) {
        if (data.MUESTRA_TOMADA == 1) {
            $(row).addClass('bg-success text-white');
        }
    },
    columns: [
        {
            data: 'ID_PACIENTE', render: function (data) {
                return '';
            }
        },
        { data: 'NOMBRE_COMPLETO' },
        { data: 'PREFOLIO' },
        { data: 'EDAD' },
        { data: 'EDAD' },
        // {defaultContent: 'En progreso...'}
    ],
    columnDefs: [
        { "width": "10px", "targets": 0 },
    ],

})

loaderDiv("Out", null, "#loader-muestras", '#loaderDivmuestras');
// selectDatatable('tablaPacientes', tablaPacientes, 0, 0, 0, 0, function (selectTR = null, array = null) {

// })


//new selectDatatable:
selectTable('#tablaPacientes', tablaPacientes, { unSelect: true, movil: true, reload: ['col-xl-9'] }, async function (select, data, callback) {
    selectListaMuestras = data;

    if (select == 1) {

        //Activa o desactiva el boton
        if (selectListaMuestras.MUESTRA_TOMADA == 1) {
            $('#muestra-tomado').prop('disabled', true)
        } else {
            $('#muestra-tomado').prop('disabled', false)
        }

        //Procesos
        await obtenerPanelInformacion(selectListaMuestras['ID_TURNO'], 'pacientes_api', 'paciente', '#panel-informacion', '_lab')
        await obtenerListaEstudiosContenedores(selectListaMuestras['ID_TURNO'])

        //Muestra las columnas
        callback('In')
    } else {

        callback('Out')
        selectListaMuestras = null;
    }
})



inputBusquedaTable('tablaPacientes', tablaPacientes, [{
    msj: 'Los pacientes con muestras tomadas se visualizarán confirmados de color verde',
    place: 'top'
}], [], 'col-12')