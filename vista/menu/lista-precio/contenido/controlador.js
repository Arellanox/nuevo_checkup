hasLocation();

$(window).on("hashchange", function (e) {
  hasLocation();
});

var idsEstudios, data ={api:8, id_area: 7}, apiurl = '../../../api/servicios_api.php', tablaPrecio, tablaPaquete;
var dataSet = new Array();
var iva, total, subtotalPrecioventa, subtotalCosto
function obtenerContenidoPrecios() {
  obtenerTitulo("Lista de precios"); //Aqui mandar el nombre de la area
  $.getScript("contenido/js/funciones-listaprecios.js").done(function(){
    $.post("contenido/listaprecios.php", function (html) {
      var idrow;
      $("#body-js").html(html);
    }).done(function(){
        // Datatable
        $.getScript("contenido/js/precios-tabla.js");
        // Botones
        $.getScript("contenido/js/precio-botones.js");
        // Funciones js
        $.getScript("contenido/js/funciones-listaprecios.js")
    });
  })
}


function obtenerContenidoPaquetes(tabla) {
  obtenerTitulo("Paquetes de clientes"); //Aqui mandar el nombre de la area
  // Funciones js
  $.getScript("contenido/js/funciones-listaprecios.js").done(function(){
    contenidoPaquete();
    $.post("contenido/paquetes.php", function (html) {
      var idrow;
      $("#body-js").html(html);

    }).done(function () {
         // Datatable
      $.getScript("contenido/js/paquete-tabla.js");
      // Botones
      $.getScript("contenido/js/paquete-botones.js");
      select2('#seleccion-paquete', 'form-select-paquetes')
      select2('#seleccion-estudio','form-select-paquetes')
    });
  })

}

function hasLocation() {
  var hash = window.location.hash.substring(1);
  $("a").removeClass("navlinkactive");
  $("nav li a[href='#" + hash + "']").addClass("navlinkactive");
  switch (hash) {
    case "PreciosEstudios":
      obtenerContenidoPrecios();
      break;
    case "PaquetesClientes":
      obtenerContenidoPaquetes();
      break;
    default:
      obtenerContenidoPrecios();
      break;
  }
}
