
//==========================================VARIABLES==============================================================//
var TablaContenidoPaciCertificados
var dataListaPaciente = {
  api: 1,
};
var dataJson //<-- Guarda el arreglo de cada formulario
let datalist,
  datPaciente //<-- guarda lo que llega de informacion del paciente
let certificado_tipo = 0;
let pdf_format = null;

//================================================================================================================//

hasLocation();
$(window).on("hashchange", function (e) {
  hasLocation();
});


async function contenidoCertificados(config = { 'titulo': 'Certificados médicos general' }, tipo) {
  await obtenerTitulo(`${config.titulo}`);
  $.post("contenido/certificados.html", function (html) {
    $("#body-js").html(html);
  }).done(function () {



    dataListaPaciente['fecha_busqueda'] = $('#fechaListadoAreaMaster').val();

    //Vista de tabla
    $.getScript('contenido/js/vista-tabla.js')

    //Botones generales
    $.getScript('contenido/js/global-botones.js')

    switch (tipo) {
      case 'POE':
        $('#btn-caratulaPoe').fadeIn(0);
        break;

      default:
        break;
    }
  })
}

function reiniciarForm() {

}

function hasLocation() {
  hash = window.location.hash.substring(1);
  // $("a").removeClass("navlinkactive");
  // $("nav li a[href='#" + hash + "']").addClass("navlinkactive");
  let config = { titulo: '' }
  if (validarVista(hash)) {
    subtipo = false;
    switch (hash) {
      case 'CERTIFICADOS_MEDICOS':
        dataListaPaciente['tipo_certificado'] = 1; // Es el tipo de certificado que necesita back para traer la lista de pacientes
        dataListaPaciente['api'] = 1;
        certificado_tipo = { tipo: 1, certificacion: null };
        config.titulo = 'Certificados médicos general'
        break;

      case 'CERTIFICADOS_POE':
        dataListaPaciente['tipo_certificado'] = 2; // Es el tipo de certificado que necesita back para traer la lista de pacientes
        dataListaPaciente['api'] = 4;
        certificado_tipo = { tipo: 2, certificacion: 'POE' }

        config.titulo = 'Certificados Poe'
        break;

      default:
        break;
    }


    contenidoCertificados(config, certificado_tipo.certificacion)
  }

}




// Reinicia el formulario de interpretación
function limpiarForm(form) {
  document.getElementById(form).reset()
  $(`#${form} div.collapse`).collapse('hide'); // Oculta de nuevo todos los collapse
}

// Cambia y muestra los botones del formulario
function estadoFormulario(guardado, confirmado) {
  let $vista_previa = $('#btn-vistaPrevia') // Boton de vista previa de pdf
  let $confirmar_rept = $('#btn-confirmarReporte') // Boton de confirmar reporte
  let $guardar_inter = $('#btn-guardarInterpretacion') // Boton de guardar interpretación

  // Resetea los botones para colocar el estado apropiado
  $('.btn_interpretacion_modal').prop('disabled', false)

  if (guardado == 0 && confirmado == 0) {
    // Estado cuando no tiene nada de datos
    $vista_previa.fadeOut()
    $confirmar_rept.fadeOut()
  } else if (guardado == 1 && confirmado == 0) {
    // Estado cuando solo esta guardado
    $('.btn_interpretacion_modal').fadeIn() // Recupera/Visualiza todo
  } else {
    // Estado cuando Esta confirmado
    $('.btn_interpretacion_modal').fadeIn() // Recupera/Visualiza todo
    $confirmar_rept.prop('disabled', true)
    $guardar_inter.prop('disabled', true)

  }
}


