var tablaContenido, areaActiva;
var dataListaPaciente = {
  api: 7
};
var selectPacienteArea, hash, formulario;
//Variable para guardar los servicios de un paciente seleccionado
var selectEstudio = new GuardarArreglo();
var selectrue = 0;

hasLocation();
$(window).on("hashchange", function (e) {
  hasLocation();
});

function hasLocation() {
  hash = window.location.hash.substring(1);
  // $("a").removeClass("navlinkactive");
  // $("nav li a[href='#" + hash + "']").addClass("navlinkactive");
  if (validarVista(hash) == true) {
    switch (hash) {
      case "IMAGENOLOGIA":
        formulario = "";
        obtenerContenidoVistaMaster(7, 'Resultados de Imagenología');
        break;
      case "RX":
        formulario = "";
        obtenerContenidoVistaMaster(8, 'Resultados de Rayos X');
        break;
      case "ESPIROMETRIA":
        formulario = "";
        obtenerContenidoVistaMaster(5, 'Resultados de Espirometría');
        break;
      case "AUDIOMETRIA":
        formulario = "";
        obtenerContenidoVistaMaster(4, 'Resultados de Audiometría');
        break;
      case "OFTALMOLOGIA":
        formulario = "formSubirInterpretacionOftalmo";
        obtenerContenidoVistaMaster(3, 'Resultados de Oftalmología', 'contenido_oftalmologia.php');
        break;
      default:
        // obtenerContenidoVistaMaster(7, 'Resultados de Imagenología');
        break;
    }
  }

}



//Notas de cosas necesarias:
/*
  -Recibir el confirmado de si un resultado o interpretacion ya ha sido subido (si existe resultado)
  -Poder consultar las capturas y mandarlas ordenadas por pruebas
  -Guardar la fecha de registro de resultado y quien lo cargó
  -Generar el reporte de oftalmo y guardarlo junto a los campos


*/
function obtenerContenidoVistaMaster(area, titulo, contenidoHTML = 'contenido.php') {
  areaActiva = area;
  $.post("contenido/" + contenidoHTML, async function (html) {
    $("#body-js").html(html);
    await obtenerTitulo(titulo)
    dataListaPaciente = {
      api: 5,
      fecha_busqueda: $('#fechaListadoAreaMaster').val(),
      area_id: areaActiva
    }
  }).done(function () {
    switch (area) {
      case 3:
        // Datatable
        $.getScript("contenido/js/oftalmo-tabla.js")
        break;

      default:
        // Datatable
        $.getScript("contenido/js/vista-tabla.js")
        break;
    }
    // Botones
    $.getScript("contenido/js/area-botones.js")

    switch (area) {
      case 3:
        $('#btn-analisis-pdf').fadeOut(0)
        $('#btn-capturas-pdf').fadeOut(0)
        $('#btn-analisis-oftalmo').fadeIn(0)
        break;
      default:
        $('#btn-analisis-pdf').fadeIn(0)
        $('#btn-capturas-pdf').fadeIn(0)
        $('#btn-analisis-oftalmo').fadeOut(0)

    }
  });
}

// obtenerContenidoRX()

// function sessionVista(areaVista) {
//   let vista = session.vista;
//   return vista[areaVista] == 1 ? true:false;
// }