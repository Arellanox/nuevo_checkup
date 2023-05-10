

var datalist, dataListaPaciente, selectEstudio, dataSelect;
var areaActiva;

async function obtenerAgendaPacientes() {
    await obtenerTitulo("Agenda de pacientes | Ultrasonido");
    $.post("contenido/agenda-pacientes.html", function (html) {
        $("#body-js").html(html);
    }).done(function () {
        // Botones
        $.getScript('contenido/js/agenda-botones.js')
        // Botones
        $.getScript('contenido/js/agenda-funciones.js')
    });
}



hasLocation()
$(window).on("hashchange", function (e) {
    hasLocation();
});
function hasLocation() {
    var hash = window.location.hash.substring(1);
    if (validarVista(hash)) {
        switch (hash) {
            case "AGENDA_PACIENTES":
                areaActiva = 11;
                obtenerAgendaPacientes();
                break;
        }
    }
}
