
hasLocation();
$(window).on("hashchange", function (e) {
    hasLocation();
});


// Variable de seleccion de metodo
var areaActiva, dataList, htmlBodyFormEstudios;

function obtenerContenidoEstudios(titulo) {
    obtenerTitulo(titulo); //Aqui mandar el nombre de la area
    $.post("contenido/estudios.html", function (html) {
        $("#body-js").html(html);
    }).done(function () {

        // Datatable
        $.getScript("contenido/js/estudio-tabla.js");
        // Botones
        $.getScript("contenido/js/estudio-botones.js");
    });
}


function hasLocation() {
    hash = window.location.hash.substring(1);

    if (validarVista(hash) == true) {
        subtipo = false;
        switch (hash) {
            case 'ESTUDIOS_RAYOSX':
                areaActiva = 8;
                dataList = { api: 15, tipgrupo: 0, id_area: areaActiva }
                obtenerContenidoEstudios('Estudios de Rayos X');
                break;

            case 'ESTUDIOS_ULTRASONIDO':
                areaActiva = 11;
                dataList = { api: 15, tipgrupo: 0, id_area: areaActiva }
                obtenerContenidoEstudios('Estudios de Ultrasonido')
                break;

            case 'ESTUDIOS_AREAS':
                areaActiva = 'todos';
                dataList = { api: 15, tipgrupo: 0, id_area: 0 }
                obtenerContenidoEstudios('Estudios Checkup')
                break;

            // case "EstudiosLab":
            //     if (validarVista('SERVICIOS (ESTUDIOS)')) {
            //         obtenerContenidoEstudios("Estudios - Laboratorio");
            //     }
            //     break;
            // case "GruposLab":
            //     if (validarVista('SERVICIOS (GRUPOS)')) {
            //         obtenerContenidoGrupos("Grupos de estudios - Laboratorio");
            //     }
            //     break;

            default:
                // obtenerContenidoVistaMaster(7, 'Resultados de Imagenología');

                break;
        }
    }

}
