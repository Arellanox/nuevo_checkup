

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
       areaActiva = 6;
       dataListaPaciente = {api:5, fecha_busqueda: $('#fechaListadoAreaMaster').val(), area_id: 6}
       console.log(dataListaPaciente)
       tablaContenido.ajax.reload();

     }
     async function obtenerContenidoRX() {
       await obtenerTitulo('Resultados de Rayos X');
       areaActiva = 8;
       dataListaPaciente = {api:5, fecha_busqueda: $('#fechaListadoAreaMaster').val(), area_id: 8}
       tablaContenido.ajax.reload();

     }
     async function obtenerContenidoEspiro() {
       await obtenerTitulo('Resultados de Espirometría');
       areaActiva = 5;
       dataListaPaciente = {api:5, fecha_busqueda: $('#fechaListadoAreaMaster').val(), area_id: 5}
       tablaContenido.ajax.reload();

     }
     async function obtenerContenidoAudio() {
       await obtenerTitulo('Resultados de Audiometría');
       areaActiva = 4;
       dataListaPaciente = {api:5, fecha_busqueda: $('#fechaListadoAreaMaster').val(), area_id: 4}
       tablaContenido.ajax.reload();

     }
     async function obtenerContenidoOftal() {
       await obtenerTitulo('Resultados de Oftalmología');
       areaActiva = 3;
       dataListaPaciente = {api:5, fecha_busqueda: $('#fechaListadoAreaMaster').val(), area_id: 3}
       tablaContenido.ajax.reload();

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
console.log(vista)
// alert('ACCESSO A AREA NO PERMITIDA');
// return vista.areaVista == 1 ? true:false;
return true;
}