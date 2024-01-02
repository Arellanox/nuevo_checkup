
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


async function contenidoCertificados(config = { 'titulo': 'Certificados médicos general' }) {
  await obtenerTitulo(`${config.titulo}`);
  $.post("contenido/certificados.html", function (html) {
    $("#body-js").html(html);
  }).done(function () {

    dataListaPaciente['fecha_busqueda'] = $('#fechaListadoAreaMaster').val();

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
  let config = { titulo: '' }
  if (validarVista(hash)) {
    subtipo = false;
    switch (hash) {
      case 'CERTIFICADOS_MEDICOS':
        dataListaPaciente['tipo_certificado'] = 1; // Es el tipo de certificado que necesita back para traer la lista de pacientes
        certificado_tipo = { tipo: 1, certificacion: null };
        config.titulo = 'Certificados médicos general'
        break;

      case 'CERTIFICADOS_POE':
        dataListaPaciente['tipo_certificado'] = 2; // Es el tipo de certificado que necesita back para traer la lista de pacientes
        certificado_tipo = { tipo: 2, certificacion: 'POE' }

        config.titulo = 'Certificados Poe'
        break;

      default:
        break;
    }


    contenidoCertificados(config)
  }

}