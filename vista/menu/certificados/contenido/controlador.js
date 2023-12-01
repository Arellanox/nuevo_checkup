
//==========================================VARIABLES==============================================================//
var TablaContenidoPaciCertificados
var dataListaPaciente
var dataJson //<-- Guarda el arreglo de cada formulario
let datalist,
    datPaciente //<-- guarda lo que llega de informacion del paciente

//================================================================================================================//

// if (validarVista('ADMINISTRACIÓN')) {
    contenidoCertificados()
// }
async function contenidoCertificados() {
    await obtenerTitulo("CERTIFICADOS");
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