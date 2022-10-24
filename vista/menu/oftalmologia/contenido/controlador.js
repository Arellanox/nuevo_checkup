var tablaContenido, areaActiva = 1;
var dataListaPaciente = {api:7};
var selectListaLab, hash;

$.post("contenido/contenido.php", function (html) {
  $("#body-js").html(html);
  // // Botones
  $.getScript("contenido/js/oftalmo-botones.js");
}).done(function(){
  // // Datatable
   $.getScript("contenido/js/vista-tabla.js").done(function(){

     async function obtenerContenidoOftal() {
       await obtenerTitulo('Resultados de Oftalmología');
       areaActiva = 3;
       recargartabla()

     }

     function hasLocation() {
       hash = window.location.hash.substring(1);
       // $("a").removeClass("navlinkactive");
       // $("nav li a[href='#" + hash + "']").addClass("navlinkactive");
            if (sessionVista(hash) == true){
              switch (hash) {

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
  dataListaPaciente = {api:5, fecha_busqueda: $('#fechaListadoAreaMaster').val(), area_id: areaActiva}
  tablaContenido.ajax.reload();
  return 1;
}