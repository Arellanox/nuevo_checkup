

var datalist, dataListaPaciente, selectEstudio, dataSelect;

async function obtenerAgendaPacientes(titulos) {
    await obtenerTitulo(`Agenda de pacientes | ${titulos}`);
    $.post("contenido/agenda-pacientes.html", function (html) {
        $("#body-js").html(html);
    }).done(function () {
        // Botones
        $.getScript('contenido/js/agenda-funciones.js')
    });
}


// Botones
$.getScript('contenido/js/agenda-botones.js')



hasLocation()
$(window).on("hashchange", function (e) {
    hasLocation();
});

var paqueteUse = 0;
function hasLocation() {
    paqueteUse = 0;
    var hash = window.location.hash.substring(1);
    // if (validarVista(hash)) {
    switch (hash) {
        case 'CHECKUPS':
            localStorage.setItem('areaActual', 19);
            obtenerAgendaPacientes('Checkups');
            break;

        case 'BIOMOLECULAR':
            localStorage.setItem('areaActual', 12);
            obtenerAgendaPacientes('Laboratorio Biomolecular');
            break;

        case 'ULTRASONIDO':
            localStorage.setItem('areaActual', 11);
            obtenerAgendaPacientes('Ultrasonido');
            break;

        case 'RX':
            localStorage.setItem('areaActual', 8);
            obtenerAgendaPacientes('Rayos X');
            break;

        // case "AGENDA_PACIENTES":
        //     areaActiva = 11;
        //     localStorage.setItem('areaActual', 11);
        //     obtenerAgendaPacientes();
        //     break;
        default:

            break;
    }
    // }
}
