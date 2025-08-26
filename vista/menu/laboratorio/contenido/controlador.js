var areaActiva, totalNotificacionesDisponibles = 0, idsEstudiosa;
var tablaListaPaciente, dataListaPaciente, selectListaLab;
var rangoFechas = [new Date().toISOString().split('T')[0],new Date().toISOString().split('T')[0]];

async function obtenerContenidoLaboratorio(titulo) {
    await obtenerTitulo(titulo);

    $.post("contenido/laboratorio.php", function (html) {
        $("#body-js").html(html);
    }).done(async function () {
        dataListaPaciente = {
            api: 5,
            fecha_busqueda: $('#fechaListadoLaboratorio').val(),
            area_id: areaActiva
        };

        $.getScript('contenido/js/lista-tabla.js');
        $.getScript('contenido/js/laboratorio-botones.js');
        $.getScript('contenido/js/maquilas.js');
        $.getScript('contenido/js/maquilas_aliases.js');

        await obtenerBadgePendientesLabClinico();
    });
}

async function obtenerBadgePendientesLabClinico() {
    // notificacion de estudios pendientes
    await ajaxAwait({
        api: 7
    }, 'laboratorio_servicios_api', {callbackAfter: true}, false, function (data) {
        if (data.response.data?.length > 0) {
            let totalEstudiosPendientes = data.response.data?.length

            if (totalEstudiosPendientes > 0) {
                $('#badge_estudios_pendientes').removeClass('hidden');
                $('#badge_estudios_pendientes').text(1);

                $('#badge_estudio_icon').removeClass('hidden');
                $('#badge_estudio_icon_total').removeClass('hidden');
                $('#badge_estudio_icon_total').text(1);
            }
        }
    });

    // notificacion de maquilas pendientes
    await ajaxAwait({
        api: 2, MOSTRAR_OCULTOS: 0,
        FECHA_INICIO: dataListaPaciente['fecha_busqueda'] ?? rangoFechas[0] ?? null,
        FECHA_FIN: dataListaPaciente['fecha_busqueda_final'] ?? rangoFechas[1] ?? null
    }, 'laboratorio_solicitud_maquila_api', {callbackAfter: true}, false, function (data) {
        if (data.response.data?.length > 0) {
            const maquilasPendientes = data.response.data.filter(maquila =>
                maquila['LAB_MAQUILA_ESTATUS'] == 0 || maquila['LAB_MAQUILA_ESTATUS'] == null
            );

            if (maquilasPendientes.length > 0) {
                $('#badge_maquilas_pendientes').removeClass('hidden');
                $('#badge_maquilas_pendientes').text(maquilasPendientes.length);

                $('#badge_maquila_icon').removeClass('hidden');
                $('#badge_maquila_icon_total').removeClass('hidden');
                $('#badge_maquila_icon_total').text(maquilasPendientes.length);
            }
        }
    });
}

function hasLocation() {
    var hash = window.location.hash.substring(1);
    $("a").removeClass("navlinkactive");
    $("nav li a[href='#" + hash + "']").addClass("navlinkactive");
    if (validarVista(hash)) {
        switch (hash) {
            case "LABORATORIO":
                areaActiva = 6;
                obtenerContenidoLaboratorio('Resultados de Laboratorio Clinico');
                break;
            case "LABORATORIO_MOLECULAR":
                areaActiva = 12;
                obtenerContenidoLaboratorio("Resultados de Laboratorio Biomolecular");
                break;
            default:
                avisoArea();
                break;
        }
    }
}

$(window).on("hashchange", function (e) { hasLocation(); });

hasLocation();