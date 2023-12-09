// Datatable para la tabla de TablaPacientesPrequirurgica
TablaPacientesPrequirurgica = $('#TablaPacientesPrequirurgica').DataTable({
    language: { url: "https://cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json", },
    lengthChange: false,
    info: true,
    paging: false,
    sorting: false,
    scrollY: '75vh',
    scrollCollapse: true,
    // ajax: {
    //     dataType: 'json',
    //     data: function (d) {
    //         return $.extend(d, DataEquipo);
    //     },
    //     // data: { api: 2, equipo: id_equipos },
    //     method: 'POST',
    //     url: '../../../api/temperatura_api.php',
    //     beforeSend: function () {
    //         fadeRegistro('Out')
    //         loader("In")
    //         selectTableFolio = false
    //         tablaTemperaturaFolio.clear().draw();
    //     },
    //     complete: function () {
    //         //Para ocultar segunda columna
    //         loader("Out", 'bottom')
    //         reloadSelectTable()
    //         fadeRegistro('In')
    //         $.fn.dataTable
    //             .tables({
    //                 visible: true,
    //                 api: true
    //             })
    //             .columns.adjust();
    //         // $("#lista-meses-temperatura").fadeIn('fast');

    //         // Hacer clic en la primera fila
    //         var firstRow = tablaTemperaturaFolio.row(0).node(); // La fila 0 es la primera fila
    //         $(firstRow).click(); // Simula un clic en la fila
    //         $("#loader-TablaTemperaturasFolio").fadeOut('fast');

    //     },
    //     // error: function (jqXHR, textStatus, errorThrown) {
    //     //     alertErrorAJAX(jqXHR, textStatus, errorThrown);
    //     // },
    //     dataSrc: 'response.data'
    // },
    // columns: [
    //     { data: 'FOLIO' },
    //     {
    //         data: 'FECHA_REGISTRO', render: function (data) {
    //             // Mes
    //             return formatoFecha2(data, [0, 1, 3, 0]).toUpperCase();
    //         }
    //     },
    //     {
    //         data: null, render: function (data) {
    //             let html = `<i class="bi bi-file-earmark-pdf-fill generarPDF" style="cursor: pointer; color: red;font-size: 23px;"></i>`
    //             return session['permisos']['SupTemp'] == '1' ? html : '';
    //         }
    //     },
    //     {
    //         data: 'FECHA_REGISTRO', render: function (data) {
    //             // ANHO
    //             return formatoFecha2(data, [0, 1, 0, 0]).toUpperCase();
    //         }
    //     }
    // ],
    columnDefs: [
        { target: 0, title: '#', className: 'all' },
        { target: 1, title: 'Nombre', className: 'all' },
        { target: 2, title: 'Prefolio  ', className: 'all' },
        { target: 3, title: 'Procedencia', className: 'none' },
        { target: 4, title: 'Edad   ', className: 'none' },
        { target: 5, title: 'Sexo', className: 'none' }

    ],
    // dom: 'Bfrtip',
    // buttons: [
    //     {
    //         text: '<i class="bi bi-file-earmark-pdf-fill"></i> Generar PDF',
    //         className: 'btn btn-borrar',
    //         action: function (data) {

    //         }
    //     }
    // ]
})


inputBusquedaTable("TablaPacientesPrequirurgica", TablaPacientesPrequirurgica, [{
    msj: 'Tabla de los pacientes para valoracion prequirurgica  ',
    place: 'top'
}], {
    msj: "Filtre los resultados por el folio que escriba",
    place: 'top'
}, "col-12")