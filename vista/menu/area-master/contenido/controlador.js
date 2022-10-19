

var tablaContenido, areaActiva = 1;
var dataListaPaciente = {api:7};

$.post("contenido/contenido.php", function (html) {
  $("#body-js").html(html);
  // // Botones
  // $.getScript("contenido/js/estudio-botones.js");
}).done(function(){
  // // Datatable
   $.getScript("contenido/js/vista-tabla.js").done(function(){
     async function obtenerContenidoImg() {
       await obtenerTitulo('Resultados de Imagenología')
       areaActiva = 7;
       recargartabla()

     }
     async function obtenerContenidoRX() {
       await obtenerTitulo('Resultados de Rayos X');
       areaActiva = 8;
       recargartabla()

     }
     async function obtenerContenidoEspiro() {
       await obtenerTitulo('Resultados de Espirometría');
       areaActiva = 5;
       recargartabla()

     }
     async function obtenerContenidoAudio() {
       await obtenerTitulo('Resultados de Audiometría');
       areaActiva = 4;
       recargartabla()

     }
     async function obtenerContenidoOftal() {
       await obtenerTitulo('Resultados de Oftalmología');
       areaActiva = 3;
       recargartabla()

     }

     function hasLocation() {
       var hash = window.location.hash.substring(1);
       // $("a").removeClass("navlinkactive");
       // $("nav li a[href='#" + hash + "']").addClass("navlinkactive");
            if (sessionVista(hash) == true){
              switch (hash) {
               case "IMAGENOLOGIA":

                 obtenerContenidoImg();
               break;
               case "RX":
                 obtenerContenidoRX();
               break;
               case "ESPIROMETRIA":
                 obtenerContenidoEspiro();
               break;
               case "AUDIOMETRIA":
                 obtenerContenidoAudio();
               break;
               case "OFTALMOLOGIA":
                 obtenerContenidoOftal();
               break;
               default:
                 obtenerContenidoCliente();
                 break;
             }
            }else{
              window.location.href = http + servidor + '/nuevo_checkup/vista/login/';
            }



     }
     hasLocation();
     $(window).on("hashchange", function (e) {
      hasLocation();
    });
   });
});

// obtenerContenidoRX()
function sessionVista(areaVista) {
  let vista = session.vista;
  return vista[areaVista] == 1 ? true:false;
}

function recargartabla(){
  $('#fechaListadoAreaMaster').change(function(){
    console.log($('#fechaListadoAreaMaster').val())
    recargartabla()
  })
  dataListaPaciente = {api:5, fecha_busqueda: $('#fechaListadoAreaMaster').val(), area_id: areaActiva}
  tablaContenido.ajax.reload();
  return 1;
}
