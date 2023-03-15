complete = true;
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
            complete = false
        },
        complete: function () {
            loader("Out"), rowdrawalert()
            complete = true;
        },
        error: function (jqXHR, exception, data) {
            // alertErrorAJAX(jqXHR, exception, data)
            // controlListadoTurnos();
            // errorLoadAjaxPantalla(jqXHR, exception, data)
        },
        dataSrc: 'response.data'
    },
    columns: [
        {
            data: 'COUNT'
        }, {
            data: 'PACIENTE'
        }, {
            data: 'ETIQUETA_TURNO'
        }, {
            data: 'MODULO'
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
    // var temp = tablaControlTurnos.row(0).data();
    // tablaControlTurnos.row(0)
    $('#TablaControlTurnos tbody tr:first').addClass('selected');
    $('#TablaControlTurnos tbody tr:first').addClass('firstSelect');
    // console.log(temp);
    // $('#TablaControlTurnos').dataTable().fnUpdate(temp, 0, undefined, false);
}


// console.log(data);
// console.log(meta);
// if (data['first'] == 1) {
//     let html = `<div class="turnoActivo alert-success"> ${data.MODULO} </div
//     return html;
// } else {
//     let html = `${data.ETIQUETA_TURNO} - ${data.MODULO}`
//     return html;
//     // let html = '<div class="turnoActivo alert-success"> bimo1 - Consultorio 1 </div>'
// }

// document.getElementById('alert-paciente').play()

// tablaControlTurnos.settings()[0].jqXHR


var data = '';
recargaLista();
function recargaLista() {
    $.ajax({
        url: http + servidor + '/nuevo_checkup/turnero_data.json',
        type: 'POST',
        dataType: 'JSON',
        success: function (data) {
            // let data = JSON.parse(data);
            // console.log(data)
            if (data.request) {
                setTimeout(() => {
                    controlListadoTurnos()
                }, 300);
            }

            setTimeout(() => {
                recargaLista()
            }, 1000);
        }
    })
}

function controlListadoTurnos() {
    // document.getElementById('alert-paciente').play() //Tono de aviso
    // try {
    //     dataActual = tablaControlTurnos.row(0).data();
    //     if (data['TURNOS'] != dataActual['TURNOS']) {
    //         data = dataActual;
    //     } else {
    //         data = false;
    //     }
    // } catch (error) {
    //     console.log(error)
    // }
    document.getElementById('alert-paciente').play()
    tablaControlTurnos.ajax.reload();

}

// function errorLoadAjaxPantalla(jqXHR, exception, data) {
//     console.log(jqXHR);
//     console.log(exception);
//     console.log(data);
//     setTimeout(() => {
//         // controlListadoTurnos()
//     }, 1000);
// }


jQuery.fn.exists = function () { return this.length > 0; }