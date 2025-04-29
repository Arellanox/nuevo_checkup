if (validarVista('ESTUDIOS_LABORATORIO')) {
    //Menu predeterminado
    hasLocation();
    $(window).on("hashchange", function (e) {
        hasLocation();
    });
}

// Variable de seleccion de metodo
var array_metodo, numberContenedor = 0, numberContenedorEdit = 0, numberContenedorGrupo = 0,
    numberContenedorGrupoEdit = 0;
var idMetodo = null;
var modalEdit, formEstudios;
var infoServicioEdit = false;

function obtenerContenidoEstudios(titulo) {
    obtenerTitulo(titulo); //Aqui mandar el nombre de la area
    $.post("contenido/estudios.html", function (html) {
        var idrow;
        $("#body-js").html(html);
        // Datatable
        $.getScript("contenido/js/estudio-tabla.js");
    });
}

function obtenerContenidoGrupos(titulo) {
    obtenerTitulo(titulo); //Aqui mandar el nombre de la area
    $.post("contenido/grupos.html", function (html) {
        var idrow;
        $("#body-js").html(html);
        // Datatable
        $.getScript("contenido/js/grupos-tabla.js");

        // Botones
        $.getScript("contenido/js/grupos-botones.js");
    });
}

//Get scripts
// Botones
$.getScript("contenido/js/estudio-botones.js");

function generarOpcionesSelect(opciones) {
    return opciones.map(opcion => `<option value="${opcion.value}">${opcion.text}</option>`).join('');
}

const opcionesContenedor = [
    {value: '1', text: "FRASCO"},
    {value: '2', text: "TUBO AZUL"},
    {value: '3', text: "TUBO LILA"},
    {value: '4', text: "TUBO ROJO"},
    {value: '5', text: "TUBO NEGRO"},
    {value: '6', text: "TUBO VERDE"},
    {value: '7', text: "TRANSCULT"},
    {value: '8', text: "TUBO AMARILLO"},
    {value: '9', text: "MEDIO DE TRANSPORTE UNIVERSAL"},
    {value: '10', text: "PAPEL FILTRO PARA TAMIZ"},
    {value: '11', text: "FECAL SWAP"},
    {value: '12', text: "BREATHCARD"}
];

const opcionesMuestra = [
    {value: '1', text: 'EXPECTORACIÓN'},
    {value: '2', text: 'EXUDADO'},
    {value: '3', text: 'HECES'},
    {value: '4', text: 'LÍQUIDO'},
    {value: '5', text: 'ORINA'},
    {value: '6', text: 'SANGRE'},
    {value: '7', text: 'SEMEN'},
    {value: '8', text: 'UÑAS'},
    {value: '10', text: 'Hisopado Naso - Faríngea'},
    {value: '11', text: 'Orofaríngea'},
    {value: '12', text: 'SANGRE CAPILAR'},
    {value: '13', text: 'Líquido Céfalo - Raquídeo'},
    {value: '14', text: 'Hisopado Rectal'},
    {value: '15', text: 'Colonia Bacteriana'},
    {value: '16', text: 'Plasma EDTA'},
    {value: '17', text: 'Sangre Total con EDTA'},
    {value: '18', text: 'L.C.R.'},
    {value: '19', text: 'Biopsia'},
    {value: '20', text: 'Líquido de lavado Bronquioalveolar'},
    {value: '21', text: 'ALIENTO'}
];


function agregarContenedorMuestra(div, numeroSelect, tipo) {

    numeroSelect = getRandomInt(10000000000000); // Asegúrate de que esta es la lógica deseada

    // Simplificación del HTML usando plantillas literales
    const html = `
    <div class="row">
      <div class="col-5 col-md-5">
        <label for="contenedores[${numeroSelect}][contenedor]" class="form-label select-contenedor">Contenedor</label>
        <select name="contenedores[${numeroSelect}][contenedor]" id="registrar-contenedor${numeroSelect}-estudio" class="input-form" required>
          ${generarOpcionesSelect(opcionesContenedor)}
        </select>
      </div>
      <div class="col-5 col-md-5">
        <label for="contenedores[${numeroSelect}][muestra]" class="form-label select-contenedor">Tipo o muestra</label>
        <select name="contenedores[${numeroSelect}][muestra]" id="registrar-muestraCont${numeroSelect}-estudio" class="input-form" required>
          ${generarOpcionesSelect(opcionesMuestra)}
        </select>
      </div>
      <div class="col-2 d-flex justify-content-start align-items-center">
        <button type="button" class="btn btn-hover eliminarContenerMuestra${tipo}" data-bs-contenedor="${numeroSelect}" style="margin-top: 20px;"><i class="bi bi-trash"></i></button>
      </div>
    </div>`;

    $(div).append(html);
    recargarSelects(); // Asegúrate de que esta función está definida en otro lugar

    return {
        0: `contenedores[${numeroSelect}][contenedor]`,
        1: `contenedores[${numeroSelect}][muestra]`
    };
}

function agregarHTMLSelectorInput(div, label, relleno, editID = null, cantidad = null) {
    let id = getRandomInt(1000000000)
    classSelect = `input-form select-contenedor-${label}`
    html = '<div class="row">' +
        '<div class="col-12 col-lg-12 col-xxl-6">' +
        '<label for="grupoExamen[' + id + '][grupo_id]" class="form-label">' + label + '</label>' +
        '<select name="grupoExamen[' + id + '][grupo_id]" class="' + classSelect + '" required="">';

    html += `${relleno}`;
    // console.log(cantidad, editID)
    let classInput = `form-control input-form`;
    html += '</select>' +
        '</div>' +
        '<div class="col-12 col-lg-8 col-xxl-4">' +
        '<label for="grupoExamen[' + id + '][orden]" class="form-label">Posicion del grupo</label>' +
        '<input type="text" placerholder="Orden del servicio para el grupo" name="grupoExamen[' + id + '][orden]" ' +
        'class="' + classInput + '" value="' + ifnull(cantidad, '') + '" required>' +
        '</div>' +
        '<div class="col-2 d-flex justify-content-start align-items-center">' +
        '<button type="button" class="btn btn-hover eliminarContenerMuestra1" data-bs-contenedor="2" style="margin-top: 20px;" >' +
        '<i class="bi bi-trash"></i>' +
        '</button>' +
        '</div>' +
        '</div>';
    $(div).append(html);
    recargarSelects()
    return 'grupoExamen[' + id + '][grupo_id]';
}

function agregarHTMLSelector(div, label, relleno) {

    let id = getRandomInt(1000000000)
    html = '<div class="row">' +
        '<div class="col-10 col-md-10">' +
        '<label for="' + label + '[' + id + ']" class="form-label">' + label + '</label>' +
        '<select name="' + label + '[' + id + ']" class="input-form select-contenedor-' + label + '" required="">';

    html += `${relleno}`;

    html += '</select>' +
        '</div>' +
        '<div class="col-2 d-flex justify-content-start align-items-center">' +
        '<button type="button" class="btn btn-hover eliminarContenerMuestra1" data-bs-contenedor="2" style="margin-top: 20px;">' +
        '<i class="bi bi-trash"></i>' +
        '</button>' +
        '</div>' +
        '</div>';
    $(div).append(html);
    recargarSelects();
    return `${label}[${id}]`;
}

function recargarSelects(grupo = false) {
    if (grupo) {
        rellenarSelect('.select-contenedor-Grupo', 'servicios_api', 7, 0, 'DESCRIPCION', {id_area: 6}, function (data, o) {
            rellenoGrupoSelect = o
        })
    }
    select2("#registrar-clasificacion-estudio", "ModalRegistrarEstudio");

    select2("#registrar-medidas-estudio", "ModalRegistrarEstudio");
    select2("#registrar-concepto-facturacion", "ModalRegistrarEstudio");

    select2("#registrar-contenedor1-estudio", "ModalRegistrarEstudio");
    select2("#registrar-muestraCont1-estudio", "ModalRegistrarEstudio");

    select2('.select-contenedor-equipo', 'ModalRegistrarEstudio');
    select2('.select-contenedor-Método', 'ModalRegistrarEstudio');
    select2('.select-contenedor-Grupo', 'ModalRegistrarEstudio');

}


function hasLocation() {
    var hash = window.location.hash.substring(1);
    $("a").removeClass("navlinkactive");
    $("nav li a[href='#" + hash + "']").addClass("navlinkactive");
    switch (hash) {
        case "EstudiosLab":
            // if (validarVista('SERVICIOS (ESTUDIOS)')) {
            obtenerContenidoEstudios("Estudios - Laboratorio");
            // }
            break;
        case "GruposLab":
            // if (validarVista('SERVICIOS (GRUPOS)')) {
            obtenerContenidoGrupos("Grupos de estudios - Laboratorio");
            // }
            break;
        // case "Equipos":
        //   if (validarVista('SERVICIOS (EQUIPOS)')) {
        //     obtenerContenidoEquipos("Equipos");
        //   }
        //   break;
        default:
            window.location.hash = 'EstudiosLab';
            // obtenerContenidoEstudios("Estudios");
            break;
    }
}
