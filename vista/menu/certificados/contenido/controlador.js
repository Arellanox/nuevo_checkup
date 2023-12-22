
//==========================================VARIABLES==============================================================//
var TablaContenidoPaciCertificados
var dataListaPaciente
var dataJson //<-- Guarda el arreglo de cada formulario
let datalist,
  datPaciente //<-- guarda lo que llega de informacion del paciente

//================================================================================================================//

hasLocation();
$(window).on("hashchange", function (e) {
  hasLocation();
});


async function contenidoCertificados() {
  await obtenerTitulo("Certificados médicos general");
  $.post("contenido/certificados.html", function (html) {
    $("#body-js").html(html);
  }).done(function () {

    dataListaPaciente = {
      api: 1,
      fecha_busqueda: $('#fechaListadoAreaMaster').val()
    };

    //Vista de tabla
    $.getScript('contenido/js/vista-tabla.js')

    //Botones generales
    $.getScript('contenido/js/global-botones.js')
  })
}

function reiniciarForm() {

}

function hasLocation() {
  hash = window.location.hash.substring(1);
  // $("a").removeClass("navlinkactive");
  // $("nav li a[href='#" + hash + "']").addClass("navlinkactive");
  if (validarVista(hash)) {
    subtipo = false;
    switch (hash) {
      case 'CERTIFICADOS_MEDICOS':
        contenidoCertificados()
        break;

      case 'CERTIFICADOS_POE':

        break;

      default:
        break;
    }
  }

}