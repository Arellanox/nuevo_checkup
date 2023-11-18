
//==========================================VARIABLES==============================================================//
var TablaContenidoPaciCertificados
var dataListaPaciente
let datalist

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