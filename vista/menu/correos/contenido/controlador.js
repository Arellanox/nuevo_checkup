

var datalist, dataListaPaciente, selectEstudio, dataSelect;
var areaActiva;
async function obtenerVistaCorreosLaboratorio(cliente) {
    await obtenerTitulo("Validación de resultados de laboratorio");
    $.post("contenido/laboratorio.html", function (html) {
        $("#body-js").html(html);
    }).done(function () {
        dataListaPaciente = {
            api: 12,
            fecha_busqueda: $('#fechaListadoLaboratorio').val(),
            area_id: areaActiva
        }
        // DataTable
        $.getScript('contenido/js/lista-tabla.js')
        // Botones
        $.getScript('contenido/js/correo-lab-botones.js')
    });
}





hasLocation()
$(window).on("hashchange", function (e) {
    hasLocation();
});

function hasLocation() {
    var hash = window.location.hash.substring(1);
    $("a").removeClass("navlinkactive");
    $("nav li a[href='#" + hash + "']").addClass("navlinkactive");

    // permisos de botones para manipular el reporte

    if (validarVista(hash)) {
        switch (hash) {
            case "CORREOSLAB":
                areaActiva = 6
                obtenerVistaCorreosLaboratorio('particular');
                break;
            case "CORREOSLABBIOMOLECULAR":
                areaActiva = 12
                obtenerVistaCorreosLaboratorio('particular');
                break;
            default: avisoArea(); break;
        }
    }
}
