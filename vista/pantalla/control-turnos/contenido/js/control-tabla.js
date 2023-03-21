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


VozActiva = false;

function rowdrawalert() {
    // tablaControlTurnos.row(0)
    $('#TablaControlTurnos tbody tr:first').addClass('selected');
    $('#TablaControlTurnos tbody tr:first').addClass('firstSelect');
    say()
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
    if (!VozActiva) {
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
                    }, 500);
                }
                setTimeout(() => {
                    recargaLista()
                }, 1000);
            }
        })
    } else {
        setTimeout(() => {
            recargaLista()
        }, 1000);
    }
}

document.getElementById('alert-paciente').play()



// Interface de la API
let voice = new SpeechSynthesisUtterance();

// Objeto de la API
let jarvis = window.speechSynthesis;

const playVoice = text => {
    // Reproduce la voz
    voice.lang = 'es_ES';
    voice.text = text;
    jarvis.speak(voice);
};

function controlListadoTurnos() {
    tablaControlTurnos.ajax.reload();
}

function say() {
    VozActiva = true;
    var temp = tablaControlTurnos.row(0).data();
    turno = temp['ETIQUETA_TURNO'];
    area = temp['MODULO']
    turno = turno.split('');
    etiqueta = ''
    for (const key in turno) {
        if (Object.hasOwnProperty.call(turno, key)) {
            const element = turno[key];
            etiqueta += `${element}. `;
        }
    }
    document.getElementById('alert-paciente').play();
    setTimeout(() => {
        playVoice(`Paciente con el turno ${etiqueta}, favor de pasar al área de ${area}`)
    }, 1000);

    setTimeout(() => {
        VozActiva = false;
    }, 7000);

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

var touch = false
$('#logo_empresa_login').click(function () {
    SetFullScreen(document.getElementById('body-controlador'));
    console.log('logo_empresa_login')
})

function FullScreenSupportEnabled() {
    return (document.fullscreenEnabled ||
        document.webkitFullscreenEnabled ||
        document.mozFullScreenEnabled ||
        document.msFullscreenEnabled);
}


function SetFullScreen(elto) {
    //Si no se soporta la API, ya ni lo intentamos
    if (!FullScreenSupportEnabled()) return;
    //Se prueba la variante apropiada según el navegador
    try {
        if (elto.requestFullscreen) {    //Empezando por la estándar
            elto.requestFullscreen();
        } else if (elto.webkitRequestFullscreen) {    //Webkit (Safari, Chrome y Opera 15+)
            elto.webkitRequestFullscreen();
        } else if (elto.mozRequestFullScreen) {    //Firefox
            elto.mozRequestFullScreen();
        } else if (elto.msRequestFullscreen) {    //Internet Explorer 11+
            elto.msRequestFullscreen();
        }
    }
    catch (ex) {
        return false;
    }
    return true;
}