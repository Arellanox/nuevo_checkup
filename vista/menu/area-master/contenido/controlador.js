var tablaContenido, areaActiva;
var dataListaPaciente = {
  api: 7
};
var hash, servicio_nombre, formulario, api, url_api, selecta, nombre_paciente;
//Variable para guardar los servicios de un paciente seleccionado
var selectEstudio = new GuardarArreglo(), dataSelect = new GuardarArreglo();
var selectrue = 0,
  confirmado;

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
      case "ULTRASONIDO":
        formulario = "formSubirInterpretacion";
        api_capturas = 2;
        api_interpretacion = 1;
        url_api = 'ultrasonido_api';
        obtenerContenidoVistaMaster(11, 'Resultados de Ultrasonido', 'contenido_new.php');
        break;
      case "RX":
        formulario = "formSubirInterpretacion";
        api_capturas = 2;
        api_interpretacion = 1;
        url_api = 'rayosx_api';
        obtenerContenidoVistaMaster(8, 'Resultados de Rayos X', 'contenido_new.php');
        break;
      case "ESPIROMETRIA":
        formulario = "formSubirInterpretacion";
        api_capturas = 2;
        api_interpretacion = 1;
        url_api = 'espirometria_api';
        obtenerContenidoVistaMaster(5, 'Resultados de Espirometría', 'contenido_new.php');
        break;
      case "ELECTROCARDIOGRAMA":
        formulario = "SinForm";
        api_capturas = 2;
        api_interpretacion = 1;
        url_api = 'electrocardiograma_api';
        obtenerContenidoVistaMaster(10, 'Resultados de Electrocardiograma', 'contenido_new.php');
        break;
      case "AUDIOMETRIA":
        formulario = "formSubirInterpretacion";
        api_capturas = 2;
        api_interpretacion = 1;
        url_api = 'audiometria_api';
        obtenerContenidoVistaMaster(4, 'Resultados de Audiometría', 'contenido_new.php');
        break;
      case "OFTALMOLOGIA":
        url_api = 'oftalmologia_api';
        formulario = "formSubirInterpretacionOftalmo";
        obtenerContenidoVistaMaster(3, 'Resultados de Oftalmología', 'contenido_modal.php');
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
function obtenerContenidoVistaMaster(area, titulo, contenidoHTML = 'contenido.html') {
  areaActiva = area;
  $.post("contenido/" + contenidoHTML, {
    form: formulario
  }, function (html) {
    $("#body-js").html(html);
  }).done(async function () {
    await obtenerTitulo(titulo);
    dataListaPaciente = {
      api: 5,
      fecha_busqueda: $('#fechaListadoAreaMaster').val(),
      area_id: areaActiva
    }

    // Cambiar aspecto
    $('.btnResultados').fadeOut(0)
    switch (area) {

      case 3: //Oftalmología
        $('#btn-analisis-oftalmo').fadeIn(0)
        $('#formSubirInterpretacionOftalmo').fadeIn(0)
        // Datatable
        $.getScript("contenido/js/controlador-tabla.js")
        // Subir resultado
        $.getScript("modals/js/of_subir_oftalmo.js");
        break;

      default: //Areas Genericas
        $('#btn-analisis').fadeIn(0)
        $('#btn-capturas-pdf').fadeIn(0)
        $('#formSubirInterpretacion').fadeIn(0)
        // Datatable
        $.getScript("contenido/js/controlador-tabla.js")
        // Subir resultado
        $.getScript("modals/js/master_subir_interpretación.js");
        break;

      // Versión anterior (Absoleta)
      // default:
      //   $('#btn-analisis-pdf').fadeIn(0)
      //   $('#btn-capturas-pdf').fadeIn(0)
      //   $('.btnResultados').fadeOut(0)
      //   // Datatable
      //   $.getScript("contenido/js/vista-tabla.js");
      //   // Modal para agregar interpretacion
      //   $.getScript("modals/js/ar_subirprueba_area.js");
      //   break;
    }
    // Botones
    $.getScript("contenido/js/area-botones.js")

  });
}

// obtenerContenidoRX()

// function sessionVista(areaVista) {
//   let vista = session.vista;
//   return vista[areaVista] == 1 ? true:false;
// }