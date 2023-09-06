

if (validarVista('REGISTRO_TEMPERATURA')) {
    hasLocation();
    $(window).on("hashchange", function (e) {
        hasLocation();
    });
}

// Variables globales
var selectRegistro, selectedEquipos, selectDataEquipos, editRegistro = false, id_equipos = null, btnequipos = false, Termometro = null;
var Domingos, dataConfig = {}, selectedEquiposTemperaturas = {}, SelectedFoliosData = {};

var selectTableFolio = false, DataEquipo;

async function obtenerTemperaturas() {
    await obtenerTitulo('Registros de Temperatura'); //Aqui mandar el nombre de la area
    $.post("contenido/temperatura_refrigador.php", function (html) {
        $("#body-js").html(html);
    }).done(async function () {
        // Cargar los equipos primero
        await rellenarSelect("#Equipos", "equipos_api", 1, "ID_EQUIPO", "DESCRIPCION", { id_tipos_equipos: 5, area_id: localStorage.getItem('area_fisica') }, function (data, html) {
            selectDataEquipos = data;
        })


        // Carga de vista

        // Datatable
        $.getScript("contenido/js/temperatura-tablas.js").done(function () {
            switchEquipoSelect(false);
        });

        // Filtros
        // $.getScript("contenido/js/filtro-temperatura.js");
    });
}


// Botones
$.getScript("contenido/js/temperatura-botones.js");

function hasLocation() {
    var hash = window.location.hash.substring(1);
    $("a").removeClass("navlinkactive");
    $("nav li a[href='#" + hash + "']").addClass("navlinkactive");
    switch (hash) {

        case 'BIOMOLECULAR':
            localStorage.setItem('area_fisica', 18)
            obtenerTemperaturas();
            break;

        case 'LABORATORIO':
            localStorage.setItem('area_fisica', 17)
            obtenerTemperaturas();
            break;
        default:
            // window.location.hash = '#TEMPERATURA';
            break;
    }
}