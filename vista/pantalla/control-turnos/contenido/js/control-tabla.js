tablaControlTurnos = $('#TablaControlTurnos').DataTable({
    language: { url: "https://cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json", },
    lengthChange: false,
    info: false,
    paging: false,
    // scrollY: autoHeightDiv(0, 90),
    // scrollCollapse: false,
    searching: false,
    ordering: false,
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
            loader("Out"), rowdrawalert()
        },
        dataSrc: 'response.data'
    },
    columns: [
        {
            data: 'TURNO.COUNT'
        }, {
            data: 'TURNO', render: function (data, row) {
                let html = `${data.PACIENTE}`;
                return 'Cuevas González Luis Gerardo';
            }
        }, {
            data: 'TURNO', render: function (data, row) {
                let html = `${data.ETIQUETA_TURNO}`;
                return html;
            }
        }, {
            data: 'TURNO', render: function (data, row) {
                let html = `${data.MODULO}`;
                return html;
            }
        }
        // {defaultContent: 'En progreso...'}
    ],
    columnDefs: [
        { targets: 0, visible: true },
        { targets: 2, width: '20px' }

    ],
    // drawCallback: function () {
    //     $("table thead").remove();
    // }

})

// $('#table-info-row #results-table_info, #table-info-row .dt-buttons, #results-table thead').show();


function rowdrawalert() {
    var temp = tablaControlTurnos.row(0).data();
    tablaControlTurnos.row(0)
    $('#TablaControlTurnos tbody tr:first').addClass('selected');
    $('#TablaControlTurnos tbody tr:first').addClass('firstSelect')
    temp['TURNO']['first'] = 1;
    // console.log(temp);
    $('#TablaControlTurnos').dataTable().fnUpdate(temp, 0, undefined, false);
}


// console.log(data);
// console.log(meta);
// if (data['first'] == 1) {
//     let html = `<div class="turnoActivo alert-success"> ${data.MODULO} </div>`;
//     return html;
// } else {
//     let html = `${data.ETIQUETA_TURNO} - ${data.MODULO}`
//     return html;
//     // let html = '<div class="turnoActivo alert-success"> bimo1 - Consultorio 1 </div>'
// }

function controlListadoTurnos() {
    document.getElementById('alert-paciente').play() //Tono de aviso
}