

var datalist, dataListaPaciente, selectEstudio, dataSelect;
async function obtenerVistaCorreosLaboratorio(cliente) {
    await obtenerTitulo("Envio de correos laboratorio");
    $.post("contenido/laboratorio.html", function (html) {
        $("#body-js").html(html);
    }).done(function () {
        dataListaPaciente = { api: 12, fecha_busqueda: $('#fechaListadoLaboratorio').val(), area_id: 6 }
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
    if (validarVista(hash)) {
        switch (hash) {
            case "CORREOSLAB":
                obtenerVistaCorreosLaboratorio('particular');
                break;
            default:
                alertMensajeConfirm({
                    title: 'Area no disponible',
                    message: 'Probablemente no ha seleccionado un area',
                    icon: 'info'
                })
                break;
        }
    }
}
