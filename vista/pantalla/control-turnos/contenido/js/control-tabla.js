tablaControlTurnos = $('#TablaControlTurnos').DataTable({
    language: { url: "https://cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json", },
    lengthChange: false,
    info: false,
    paging: false,
    scrollY: autoHeightDiv(0, 244),
    scrollCollapse: true,
    ajax: {
        dataType: 'json',
        data: function (d) {
            return $.extend(d, dataTurnos);
        },
        method: 'POST',
        // url: '../../../api/tunero_api.php',
        url: http + servidor + '/nuevo_checkup/api/turnero_api.php',
        beforeSend: function () {
            loader("In"), array_selected = null
        },
        complete: function () {
            loader("Out")
        },
        dataSrc: 'response.data'
    },
    columns: [
        {
            data: 'TURNO', render: function (data, row) {
                console.log(data);
                console.log(row);
                if (row == 1) {
                    let html = '<div class="turnoActivo alert-success" role="alert"> bimo1 - Consultorio 1 </div>';
                    return html;
                } else {
                    return 'bimo1 - Rayos X';
                }
                // let html = '<div class="turnoActivo alert-success" role="alert"> bimo1 - Consultorio 1 </div>'
            }
        },
        // {defaultContent: 'En progreso...'}
    ],
    columnDefs: [
        { width: "5px", targets: 0 },
    ],

})