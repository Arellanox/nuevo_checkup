// |------------------------------- Variables -------------------------------------------------------|
let dataListaLotes = { api: 5, id_cliente: session.id_cliente }; //data de lista de lotes
let dataListaPacientesLotes, selectListLote //data de lista de pacientes del lote seleccionado


// |-------------------------------- Tabla de lista de lotes -----------------------------------------|
TablaListaLotes = $('#TablaListaLotes').DataTable({
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
            return $.extend(d, dataListaLotes);
        },
        method: 'POST',
        url: `${http}${servidor}/${appname}/api/maquilas_api.php`,
        complete: function () {
            // if (TablaListaLotes_inicio)
            //     $('#EnvioLotesPacientes').modal('show');
        },
        dataSrc: 'response.data'
    },
    columns: [
        { data: 'COUNT' },
        { data: 'FOLIO' },
        {
            data: 'ESTATUS', render: function (data) {
                return ifnull(data, 'N/A', true)
            }
        },
        { data: 'REGISTRADO' },
        { data: 'USUARIO' },
    ],
    columnDefs: [
        { "width": "10px", "targets": 0 },
    ],

})

// input que busca en la tabla de listaLotes
inputBusquedaTable('TablaListaLotes', TablaListaLotes, [{
    msj: 'Los pacientes con muestras tomadas se visualizarán confirmados de color verde',
    place: 'top'
}], [], 'col-12')

// Select que selecciona alguno de los lotes que hay disponibles en la lista
selectTable('#TablaListaLotes', TablaListaLotes, { unSelect: true, movil: true, reload: ['col-xl-9'] }, async function (select, data, callback) {
    selectListLote = data; //Recupera los todos los datos del lote seleecionado


    //Si se selecciono alguno de los lotes enviados entonces...
    if (select == 1) {

        dataListaPacientesLotes = { api: 7, id_lote: selectListLote.ID_LOTE }

        TablaDetalleLotes.ajax.reload()

        //Mandamos a llamar la funcion que abrira la vista hacia la tabla de los pacientes de ese lote seleccionado
        // listaPacientesEnviadosLotes(selectListLote)


        //Muestra las columnas
        callback('In')
    }
    else {
        callback('Out')
    }
})

// loaderDiv("Out", null, "#loader-muestras", '#loaderDivmuestras');
// selectDatatable('tablaPacientesFaltantes', tablaPacientesFaltantes, 0, 0, 0, 0, function (selectTR = null, array = null) {

// })


// //new selectDatatable:

// Funcion donde estara la la tabla de la lista de los pacientes enviados del lote seleccionado

// |-------------------------------- Tabla de lista de lotes -----------------------------------------|
TablaDetalleLotes = $('#TablaDetalleLotes').DataTable({
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
            return $.extend(d, dataListaPacientesLotes);
        },
        method: 'POST',
        url: `${http}${servidor}/${appname}/api/maquilas_api.php`,
        complete: function () {
            // if (TablaListaLotes_inicio)
            //     $('#EnvioLotesPacientes').modal('show');
        },
        dataSrc: 'response.data'
    },
    columns: [
        { data: 'COUNT' },
        { data: 'PACIENTE' },
        { data: 'FOLIO' },
        {
            data: 'FECHA_REGISTRO', render: function (data) {
                return formatoFecha2(data, [0, 1, 5, 2, 0, 0, 0])
            }
        },
        {
            data: 'REPORTES', render: function (data) {

                if (data[0]['REPORTE'] == "NA") {
                    return `<div class="badge text-bg-warning px-3 rounded-pill font-weight-normal 
                            text-dark">Pendiente</div>`
                } else {
                    return `<div class="badge text-bg-danger px-3 rounded-pill font-weight-normal">
                        <i class="bi bi-file-earmark-pdf data-id = "${data[0]['REPORTE']}" 
                        style = "cursor: pointer" onclick ="vistapreviaPacienteLote.call(this)"></i></div>`;
                }

            }
        },
        { data: 'REGISTRADO_POR' },
        { data: 'PREFOLIO' },
    ],
    columnDefs: [
        { "width": "10px", "targets": 0 },
    ],

})

// input que busca en la tabla de TablaDetalleLotes
inputBusquedaTable('TablaDetalleLotes', TablaDetalleLotes, [{
    msj: 'Los pacientes con muestras tomadas se visualizarán confirmados de color verde',
    place: 'top'
}], [], 'col-12')


function vistapreviaPacienteLote() {

    var reportePaciente = $(this).data("id");


    area_nombre = 'envio_muestras'
    api = encodeURIComponent(window.btoa(area_nombre));
    // turno = encodeURIComponent(window.btoa(pacienteActivo.array['ID_TURNO']));
    area = encodeURIComponent(window.btoa(-5));

    //lo muestra
    btn.show()
    btn.attr('target', '_blank')
    btn.attr('href', `${http}${servidor}/${appname}/visualizar_reporte/?api=${api}&turno=${turno}&area=${area}`)

}







