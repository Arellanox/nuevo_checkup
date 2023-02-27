//Menu predeterminado
hasLocation();
$(window).on("hashchange", function (e) {
    hasLocation();
});

if (validarVista('SERVICIOS-AREAS')) {
    //Menu predeterminado
    hasLocation();
    $(window).on("hashchange", function (e) {
        hasLocation();
    });

}

// Variable de seleccion de metodo
var array_metodo, numberContenedor = 0, numberContenedorEdit = 0, numberContenedorGrupo = 0, numberContenedorGrupoEdit = 0;
var idMetodo = null;

function obtenerContenidoEstudios(titulo) {
    obtenerTitulo(titulo); //Aqui mandar el nombre de la area
    $.post("contenido/estudios.php", function (html) {
        var idrow;
        $("#body-js").html(html);
        // Datatable
        $.getScript("contenido/js/estudio-tabla.js");
        // Botones
        $.getScript("contenido/js/estudio-botones.js");
    });
}

function obtenerContenidoGrupos(titulo) {
    obtenerTitulo(titulo); //Aqui mandar el nombre de la area
    $.post("contenido/grupos.php", function (html) {
        var idrow;
        $("#body-js").html(html);
        // Datatable
        $.getScript("contenido/js/grupos-tabla.js");
        // Botones
        $.getScript("contenido/js/grupos-botones.js");
    });
}

// function obtenerContenidoEquipos(titulo) {
//     obtenerTitulo(titulo); //Aqui mandar el nombre de la area
//     $.post("contenido/equipos.php", function (html) {
//         var idrow;
//         $("#body-js").html(html);
//         // Datatable
//         $.getScript("contenido/js/equipos-tabla.js");
//         // Botones
//         $.getScript("contenido/js/equipos-botones.js");
//     });
// }


//Consultar Controlador modals
// // Datatable Metodo
// $.getScript("contenido/js/metodo-tabla.js");
// // Metodo botones
// $.getScript("contenido/js/metodo-botones.js");


function agregarContenedorMuestra(div, numeroSelect, tipo) {
    let startRow = '<div class="row">';
    let startDivSelect = '<div class="col-5 col-md-5">';
    let startDivButton = '<div class="col-2 d-flex justify-content-start align-items-center">';
    let endDiv = '</div>';

    // <label for="contenedores[contenedor-uno[]]" class="form-label">Contenedor</label>
    // <select name="contenedores[contenedor-uno[]]" id="registrar-contenedor1-estudio" required></select>

    html = startRow + startDivSelect + '<label for="contenedores[contenedor-' + numeroSelect + '[]]" class="form-label select-contenedor">Contenedor</label>' +
        '<select name="contenedores[' + numeroSelect + '[]]" id="registrar-contenedor' + numeroSelect + '-estudio" class="input-form" required>' +
        '<option value="1">Frasco</option><option value="2">Tubo azul</option><option value="3">Tubo lila</option><option value="4">Tubo rojo</option>' +
        '<option value="5">Tubo negro</option><option value="6">Tubo verde</option><option value="7">Transcult</option>' +
        '</select>' + endDiv + startDivSelect +
        '<label for="contenedores[' + numeroSelect + '[]]" class="form-label select-contenedor">Tipo o muestra</label>' +
        '<select name="contenedores[' + numeroSelect + '[]]"  id="registrar-muestraCont' + numeroSelect + '-estudio" class="input-form" required placeholder="Seleccione un contenedor">' +
        '<option value="1">Sangre</option><option value="2">Saliva</option><option value="3">...</option>' +
        '</select>' + endDiv +
        startDivButton + '<button type="button" class="btn btn-hover eliminarContenerMuestra' + tipo + '" data-bs-contenedor="' + numeroSelect + '" style="margin-top: 20px;"><i class="bi bi-trash"></i></button>' + endDiv + endDiv;
    $(div).append(html);
}

function hasLocation() {
    var hash = window.location.hash.substring(1);
    $("a").removeClass("navlinkactive");
    $("nav li a[href='#" + hash + "']").addClass("navlinkactive");
    switch (hash) {
        case "Estudios":
            if (validarVista('SERVICIOS (ESTUDIOS)')) {
                obtenerContenidoEstudios("Estudios");
            }
            break;
        case "Grupos":
            if (validarVista('SERVICIOS (GRUPOS)')) {
                obtenerContenidoGrupos("Grupos de examenes");
            }
            break;
        // case "Equipos":
        //     if (validarVista('SERVICIOS (EQUIPOS)')) {
        //         obtenerContenidoEquipos("Equipos");
        //     }
        //     break;
        default:
            window.location.hash = 'Estudios';
            // obtenerContenidoEstudios("Estudios");
            break;
    }
}
