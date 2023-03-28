
if (validarVista('LABORATORIO_ESTUDIOS')) {
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
//   obtenerTitulo(titulo); //Aqui mandar el nombre de la area
//   $.post("contenido/equipos.php", function (html) {
//     var idrow;
//     $("#body-js").html(html);
//     // Datatable
//     $.getScript("contenido/js/equipos-tabla.js");
//     // Botones
//     $.getScript("contenido/js/equipos-botones.js");
//   });
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

  html = startRow + startDivSelect + '<label for="contenedores[' + numeroSelect + '][contenedor]" class="form-label select-contenedor">Contenedor</label>' +
    '<select name="contenedores[' + numeroSelect + '][contenedor]" id="registrar-contenedor' + numeroSelect + '-estudio" class="input-form" required>' +
    '<option value="1">Frasco</option><option value="2">Tubo azul</option><option value="3">Tubo lila</option><option value="4">Tubo rojo</option>' +
    '<option value="5">Tubo negro</option><option value="6">Tubo verde</option><option value="7">Transcult</option>' +
    '</select>' + endDiv + startDivSelect +
    '<label for="contenedores[' + numeroSelect + '][muestra]" class="form-label select-contenedor">Tipo o muestra</label>' +
    '<select name="contenedores[' + numeroSelect + '][muestra]"  id="registrar-muestraCont' + numeroSelect + '-estudio" class="input-form" required placeholder="Seleccione un contenedor">' +
    '<option value="1">EXPECTORACIÓN</option>' +
    '<option value="2">EXUDADO</option>' +
    '<option value="3">HECES</option>' +
    '<option value="4">LÍQUIDO</option>' +
    '<option value="5">ORINA</option>' +
    '<option value="6">SANGRE</option>' +
    '<option value="7">SEMEN</option>' +
    '<option value="8">UÑAS</option>' +
    '</select>' + endDiv +
    startDivButton + '<button type="button" class="btn btn-hover eliminarContenerMuestra' + tipo + '" data-bs-contenedor="' + numeroSelect + '" style="margin-top: 20px;"><i class="bi bi-trash"></i></button>' + endDiv + endDiv;
  $(div).append(html);
}

function agregarHTMLSelector(div, label, relleno) {
  console.log(relleno)
  let id = getRandomString();
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
}



function hasLocation() {
  var hash = window.location.hash.substring(1);
  $("a").removeClass("navlinkactive");
  $("nav li a[href='#" + hash + "']").addClass("navlinkactive");
  switch (hash) {
    case "EstudiosLab":
      if (validarVista('SERVICIOS (ESTUDIOS)')) {
        obtenerContenidoEstudios("Estudios");
      }
      break;
    case "GruposLab":
      if (validarVista('SERVICIOS (GRUPOS)')) {
        obtenerContenidoGrupos("Grupos de examenes");
      }
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
