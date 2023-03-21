tablaSignos = $('#TablaListaCursos').DataTable({
    language: {
        url: "https://cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"
    },
    lengthChange: false,
    info: false,
    paging: false,
    scrollY: autoHeightDiv(0, 330),
    scrollCollapse: true,
    // ajax: {
    //     dataType: 'json',
    //     data: function (d) {
    //         return $.extend(d, dataListaPaciente);
    //     },
    //     method: 'POST',
    //     url: '../../../api/turnos_api.php',
    //     beforeSend: function () { loader("In") },
    //     complete: function () {
    //         loader("Out")
    //         loaderDiv("Out", null, "#loader-Signos", '#loaderDivSignos', 0);
    //         $('.informacion-Signos').fadeOut()
    //     },
    //     dataSrc: 'response.data'
    // },
    // createdRow: function (row, data, dataIndex) {
    //     if (data.CONFIRMADO_SOMA == 1) {
    //         $(row).addClass('bg-success text-white');
    //     }
    // },
    // columns: [
    //     { data: 'COUNT' },
    //     { data: 'NOMBRE_COMPLETO' },
    //     { data: 'PREFOLIO' },
    //     { data: 'CLIENTE' },
    //     { data: 'EDAD' },
    //     // {defaultContent: 'En progreso...'}
    // ],
    columnDefs: [
        { "width": "10px", "targets": 0 },
    ],

})