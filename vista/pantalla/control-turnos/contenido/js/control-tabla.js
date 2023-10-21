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
        url: `${http}${servidor}/${appname}/api/turnero_api.php`,
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
        { data: 'COUNT' },
        {
            data: null, render: function (data, type, row, meta) {
                // console.log(meta, data, type, row);
                return ` <span class="etiqueta_h2">${ifnull(row, '', ['ETIQUETA_TURNO'])}</span> </br>
                        <span>${ifnull(row, '', ['PACIENTE'])}</span> </br>
                        <span>${ifnull(row, '', ['MODULO'])}</span>`
            }
        },
        // { data: 'PACIENTE' },
        // { data: 'ETIQUETA_TURNO' },
        // { data: 'MODULO' }
        // {defaultContent: 'En progreso...'}
    ],
    columnDefs: [
        { targets: 0, visible: true },
        { targets: 1 },
        // { targets: 2, visible: false },
        // { targets: 3, visible: false },
        // { targets: 4, visible: false }

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
    VozActiva = true;
    videoPlayer.volume = 0.2; // Establecer volumen al máximo

    setTimeout(() => {
        say()
    }, 300);
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
setTimeout(() => {
    recargaLista();
}, 1000);

function recargaLista() {
    if (!VozActiva) {
        $.ajax({
            url: `${http}${servidor}/${appname}/turnero_data_${session['id']}.json`,
            type: 'POST',
            dataType: 'JSON',
            success: function (data) {
                if (data.request) {
                    setTimeout(() => {
                        controlListadoTurnos()
                    }, 500);
                }
            }, complete: function () {
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

try {
    document.getElementById('alert-paciente').play()
} catch (error) {

}

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
    try {
        var temp = tablaControlTurnos.row(0).data();

        turno = temp['ETIQUETA_TURNO'];
        area = temp['MODULO'];

        document.getElementById('alert-paciente').play();
        setTimeout(() => {
            try {
                playVoice(`Paciente con el turno ${temp['ETIQUETA_TURNO']}, favor de pasar al área de ${area}, turno ${temp['ETIQUETA_TURNO']}`)
            } catch (error) {
                // alert(error);
            }
        }, 1000);

        setTimeout(() => {
            VozActiva = false;
            videoPlayer.volume = 0.7; // Establecer volumen al máximo

        }, 7000);
    } catch (error) {
        console.error(error);
        VozActiva = false;
    }


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




// Auto play videos
let videoArray = [
    "http://bimo-lab.com/nuevo_checkup/archivos/sistema/turnero/turnero_1.mp4",
    // "hsttp://bimo-lab.com/nuevo_checkup/archivos/sistema/turnero/turnero_2.mp4",
    // "https://bimo-lab.com/nuevo_checkup/archivos/sistema/turnero/turnero_3.mp4",
    // "https://bimo-lab.com/nuevo_checkup/archivos/sistema/turnero/turnero_4.mp4",
    "http://sbimo-lab.com/nuevo_checkup/archivos/sistema/turnero/turnero_5.mp4",
    "https://bimo-lab.com/nuevo_checkup/archivos/sistema/turnero/turnero_6.mp4",
]      //s Almacena la lista de videos
let currentIndex = 0;     // Índice del video que se está reproduciendo actualmente

// Obtiene la referencia del elemento video
var videoPlayer = document.getElementById("videoPlayer");

// Inicia la reproducción de videos
playNextVideo();

// Añade un listener para el evento 'ended'
videoPlayer.addEventListener('ended', function () {
    console.log("El video terminó de reproducirse.");
    playNextVideo();
});

function playNextVideo() {
    if (currentIndex >= videoArray.length) {
        currentIndex = 0;
    }

    videoPlayer.src = videoArray[currentIndex];
    videoPlayer.play();
    videoPlayer.volume = 0.8;  // Establecer volumen al 80%

    currentIndex++;
}
