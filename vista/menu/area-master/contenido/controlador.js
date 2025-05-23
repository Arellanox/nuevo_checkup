var tablaContenido, areaActiva;
var dataListaPaciente = {
  api: 7
};
var hash, servicio_nombre, formulario = 1, api, url_api, selecta, nombre_paciente, pdf_view;
var subtipo; //Para la tabla de lista de trabajo
//Variable para guardar los servicios de un paciente seleccionado
var selectEstudio = new GuardarArreglo(), dataSelect = new GuardarArreglo();
var selectrue = 0,
  confirmado;

var formEspiroHTML;

let cropper;
let defaultCropBoxPercentages = {
  width: 0.6403659233847913,
  height: 0.4184027777777778,
  left: 0.17981703830760437,
  top: 0.1753472222222222
};

hasLocation();
$(window).on("hashchange", function (e) {
  hasLocation();
});

var control_turnos;
function hasLocation() {
  hash = window.location.hash.substring(1);
  // $("a").removeClass("navlinkactive");
  // $("nav li a[href='#" + hash + "']").addClass("navlinkactive");
  if (validarVista(hash) == true) {
    subtipo = false;
    switch (hash) {
      case "ULTRASONIDO":
        control_turnos = 8;
        formulario = "formSubirInterpretacion";
        api_capturas = 2;
        api_interpretacion = 1;
        url_api = 'ultrasonido_api';
        obtenerContenidoVistaMaster(11, 'Resultados de Ultrasonido', 'contenido_modal.php');
        break;
      case "ULTRASONIDOTOMA":
        control_turnos = 8;
        formulario = "1"; // Para toma capturas
        api_capturas = 2;
        api_interpretacion = 0;
        url_api = 'ultrasonido_api';
        subtipo = 'ULTRATOMA';
        obtenerContenidoVistaMaster(11, 'Carga de imagenes de Ultrasonido', 'contenido_modal.php', 'tomaCapturas');
        break;
      case "RX":
        control_turnos = null;
        formulario = "formSubirInterpretacion";
        api_capturas = 2;
        api_interpretacion = 1;
        url_api = 'rayosx_api';
        obtenerContenidoVistaMaster(8, 'Resultados de Rayos X', 'contenido_modal.php');
        break;
      case "RXTOMA":
        control_turnos = 9
        formulario = "1"; // Para toma capturas
        api_capturas = 2;
        api_interpretacion = 0;
        url_api = 'rayosx_api';
        subtipo = 'RXTOMA';
        obtenerContenidoVistaMaster(8, 'Carga de placas de Rayos X', 'contenido_modal.php', 'tomaCapturas');
        break;

      case "ESPIROMETRIA":
        control_turnos = 6;
        formulario = "formAreadeEspirometria";
        api_capturas = 3;
        api_interpretacion = 1;
        url_api = 'espirometria_api';
        subtipo = 'ESPIROMETRIA';
        obtenerContenidoVistaMaster(5, 'Resultados de Espirometría', 'contenido_modal.php');
        break;
      case "ELECTROCARDIOGRAMA":
        control_turnos = null;
        formulario = "formSubirInterpretacionElectro";
        api_capturas = 5;
        api_interpretacion = 1;
        url_api = 'electrocardiograma_api';
        obtenerContenidoVistaMaster(10, 'Resultados de Electrocardiograma', 'contenido_modal.php');
        break;
      case "ELECTROCARDIOGRAMA_CAPTURAS":
        control_turnos = 10;
        formulario = "1"; // Para toma capturas
        api_capturas = 5;
        api_interpretacion = 1;
        url_api = 'electrocardiograma_api';
        subtipo = 'ELECTROTOMA';
        obtenerContenidoVistaMaster(10, 'Carga de Electrocardiograma', 'contenido_modal.php', 'tomaCapturas');
        break;
      case "NUTRICION":
        control_turnos = null;
        formulario = "formSubirInterpretacionElectro";
        api_capturas = 5;
        api_interpretacion = 1;
        url_api = 'nutricion_api';
        obtenerContenidoVistaMaster(14, 'Nutrición', 'contenido_modal.php');
        break;
      case "NUTRICION_CAPTURAS":
        control_turnos = 14;
        formulario = "1"; // Para toma capturas
        api_capturas = 1;
        api_interpretacion = 1;
        url_api = 'inbody_api';
        subtipo = 'NUTRITOMA';
        obtenerContenidoVistaMaster(14, 'Estudio de Composición Corporal (InBody)', 'contenido_modal.php', 'tomaCapturas');
        break;
      case "AUDIOMETRIA":
        control_turnos = 5
        formulario = "formSubirInterpretacionPRUEBA";
        api_capturas = 2;
        api_interpretacion = 7;
        url_api = 'audiometria_api';
        obtenerContenidoVistaMaster(4, 'Resultados de Audiometría', 'contenido_modal.php');
        break;
      case "OFTALMOLOGIA":
        control_turnos = 4;
        url_api = 'oftalmologia_api';
        api_interpretacion = 1;
        formulario = "formSubirInterpretacionOftalmo";
        obtenerContenidoVistaMaster(3, 'Resultados de Oftalmología', 'contenido_modal.php');
        break;
      case "CITALOGIA":
        control_turnos = null;
        formulario = "formSubirInterpretacionCitologia";
        api_capturas = 5;
        api_interpretacion = 1;
        url_api = 'electrocardiograma_api';
        obtenerContenidoVistaMaster(13, 'Resultados de Citología', 'contenido_modal.php');
        break;
      case "PRUEBA_DE_ESFUERZO":
        // control_turnos = 16
        // formulario = "formSubirInterpretacionPRUEBA";
        api_capturas = 1;
        // api_interpretacion = 1;
        url_api = 'prueba_esfuerzo_api';
        obtenerContenidoVistaMaster(9, 'Resultados de Prueba de Esfuerzo', 'contenido_modal.php', 'tomaCapturas');
        break;
      case "ECOCARDIOGRAMA":
        // control_turnos = 16
        // formulario = "formSubirInterpretacionPRUEBA";
        api_capturas = 1;
        // api_interpretacion = 1;
        url_api = 'ecocardiograma_api';
        obtenerContenidoVistaMaster(18, 'Resultados de Ecocardiograma', 'contenido_modal.php', 'tomaCapturas');
        break;
      default: avisoArea(); break;
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
function obtenerContenidoVistaMaster(area, titulo, contenidoHTML = 'contenido.html', tipovista) {
  areaActiva = area;
  $.post("contenido/" + contenidoHTML, {
    form: formulario, tipovista: tipovista, control_turnos: control_turnos
  }, function (html) {
    $("#body-js").html(html);
  }).done(async function () {
    await obtenerTitulo(titulo);

    btnOmitir = $('#omitir-paciente');
    btnLlamar = $('#llamar-paciente');
    btnLiberar = $('#liberar-paciente')

    dataListaPaciente = {
      api: 5,
      fecha_busqueda: $('#fechaListadoAreaMaster').val(),
      //fechan_busqueda_final: $('#fechaFinalListadoAreaMaster').val(),
      area_id: areaActiva
    }

    // Cambiar aspecto
    $('.btnResultados').fadeOut(0)
    // Datatable
    $.getScript("contenido/js/controlador-tabla.js");

    $('.abrirModalResultados').attr('disabled', false);
    switch (area) {
      case 3: //Oftalmología
        $('#btn-analisis-oftalmo').fadeIn(0)
        $('#formSubirInterpretacionOftalmo').fadeIn(0)
        // Subir resultado
        $.getScript("modals/js/of_subir_oftalmo.js");
        break;

      default: //Areas Genericas
        $('#btn-analisis').fadeIn(0)
        $('.btn-capturas-pdf').fadeIn(0)
        $('#formSubirInterpretacion').fadeIn(0)

        // Subir resultado
        $.getScript("modals/js/master_subir_interpretación.js");
        break;

      //Area de espiro
      case 5:

        $('#btn-analisis').fadeIn(0)
        $('.btn-capturas-pdf').fadeOut(0)
        $('#formSubirInterpretacion').fadeIn(0)
        $('.btn-resultados-espiro-pdf').fadeIn(0)
        $('#btn-resultados-espiro-pdf').fadeIn(0)
        // Subir resultado
        $.getScript("modals/js/master_subir_interpretación.js");

        break;

      //Area de audiometria
      case 4:
        $('.btn-capturas-pdf').fadeOut(0)
        $('.abrirModalResultados').attr('disabled', true);
        $('.btn_reporte_audiometria').fadeIn(0)
        $.getScript("modals/js/master_subir_interpretación.js");

        // Visualizar la paginacion del formulario
        $('#panel-paginacion').fadeIn(0);

        break;
      case 10:
        $('#btn-analisis').fadeIn(0)
        $('.btn-capturas-pdf').fadeIn(0)
        $('#formSubirInterpretacion').fadeIn(0)

        // Subir resultado
        $.getScript("modals/js/master_subir_interpretación.js");

        // Boton  de imagenes
        if (session['permisos']['CaptuElectro'] == 1) {
          // $('#vistaCapturasAreas').html('<div class="row"> <div class="col-12 text-start" style="margin-top:4px;margin-bottom:5px;">' +
          //   '<button type="button" class="btn btn-hover me-2 btnResultados" style="margin-bottom:4px" id="btn-capturas-pdf">' +
          //   '<i class="bi bi-plus-lg"></i> Capturar Electro del  paciente' +
          //   '</button> </div> </div>')
          // $('#vistaCapturasAreas').fadeIn(0)
        }
        break;
    }
    // Botones
    $.getScript("contenido/js/area-botones.js")


  });
}
