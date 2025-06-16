var tablaRecepcionPacientes, dataRecepcion = {api: 1};
var TablaReportesNoEnviados, dataReporteNoEnviados = {api: 2, enviado: 0};

var estudiosLab = [], estudiosLabBio = [], estudiosRX = [], estudiosUltra = [], estudiosOtros = [];
var hash = '', clientesConfiguraciones, clientesConfiguraciones_particulares;

validaciones()
cargarScripts();
obtenerTitulo('Recepción | Espera');
obtenerPanelInformacion(0, 0, 0);
notificacionReportesNoEnviados(null); //Notificacion de reportes faltantes
obtenerConfiguracionesClientes();
detectCoincidence('#medico-aceptar-paciente');

function validaciones() {
    switch (session['cargo']) {
        case '18':
        case 18:
            // Redirect to specific URL and destroy session if the user has cargo '18'
            $(location).attr('href', `${http}${servidor}/${appname}/vista/procedencia/pacientes/#UJAT`);
            destroySession();
            break;
    }

    if (validarVista('RECEPCIÓN')) {
        hasLocation();
        $(window).on("hashchange", function (e) {
            hasLocation();
        });
    }
}

function hasLocation() {
    hash = window.location.hash.substring(1);
    $("a").removeClass("navlinkactive");
    $("nav li a[href='#" + hash + "']").addClass("navlinkactive");

    switch (hash) {
        case "rechazados":
            obtenerContenidoRechazados();
            dataRecepcion = {api: 1, estado: 0};
            break;
        case "ingresados":
            obtenerContenidoAceptados();
            dataRecepcion = {api: 1, estado: 1};
            break;
        case "pendientes":
            obtenerContenidoEspera();
            dataRecepcion = {api: 1};
            break;
        case 'pacientes':
            dataRecepcion = {api: 17};
            obtenerContenidoTodosPacientes();
            break;
        default:
            window.location.hash = 'pendientes';
            break;
    }
}

function cargarScripts() {
    $.getScript("contenido/js/recepcion-botones.js");
}

function obtenerContenidoEspera() {
    $('#titulo_area').html('Recepción | Espera');
    $.post("contenido/recepcion.html", function (html) {
        $("#body-js").html(html);
    }).done(function () {
        $.getScript("contenido/js/recepcion-tabla.js");
    });
}

function obtenerContenidoAceptados() {
    $('#titulo_area').html('Recepción | Aceptados');
    $.post("contenido/recepcion-ingresados.html", function (html) {
        $("#body-js").html(html);
    })
        .done(function () {
            $.getScript("contenido/js/recepcion-aceptados-tabla.js");
        });
}

function obtenerContenidoRechazados() {
    $('#titulo_area').html('Recepción | Rechazados');
    $.post("contenido/recepcion-rechazados.html", function (html) {
        $("#body-js").html(html);
    })
        .done(function () {
            $.getScript("contenido/js/recepcion-tabla.js");
        });
}

function obtenerContenidoTodosPacientes() {
    $('#titulo_area').html('Pacientes registrados');
    $.post("contenido/pacientes/pacientes.html", function (html) {
        $("#body-js").html(html);
    })
        .done(function () {
            $.getScript("contenido/pacientes/js/pacientes.js");
        });
}

async function obtenerConfiguracionesClientes() {
    await ajaxAwait({api: 10}, 'clientes_api', {callbackAfter: true}, false, (data) => {
        clientesConfiguraciones = data.response.data;

        clientesConfiguraciones_particulares = clientesConfiguraciones
            .filter(item => item.DETALLE_PAGO == 1)
            .map(item => item.CLIENTE_ID);
    });
}

async function notificacionReportesNoEnviados(count) {
    var span = '#numReportes';
    var btn = '#btn-modalNotificacionesReportes';

    return new Promise((resolve) => {
        ajaxAwait({api: 1}, 'correos_api', {callbackAfter: true}, false, function (data) {
            var noti = ifnull(data.response.data, false, {0: 'NOTIFICACION'});

            if (noti > 0 && noti !== count) {
                $(span).fadeIn('fast');
                $(span).html(noti)
                $(btn).addClass('animated-button');
            } else if (noti !== count) {
                $(span).fadeOut(0);
                $(btn).removeClass('animated-button')
            }

            resolve(1);
        });
    });
}