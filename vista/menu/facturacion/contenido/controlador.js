if (validarVista('FACTURACIÓN')){
  hasLocation();
}

$(window).on("hashchange", function (e) {
  hasLocation();
});

function obtenerContenidoEstadoCuenta(){
  obtenerTitulo('Estados de cuentas');
  $.post('contenido/estado-cuentas.php', function(html){
    $('#body-js').html(html);
  }).done(function(){
    
    // Obtener el controlador de vistas de estado cuentas
    $.getScript("contenido/js/estado-controlador-vistas.js").done(function (){
      // JS funcionales
      $.getScript("contenido/js/estadoCuenta-facturar/facturar/botones.js");
    });


  })
}


//Cambia la vista de la pagina
function hasLocation() {
    var hash = window.location.hash.substring(1);
    $("a").removeClass("navlinkactive");
    $("nav li a[href='#" + hash + "']").addClass("navlinkactive");
    switch (hash) {
      case "Estados-Cuentas":
        obtenerContenidoEstadoCuenta();
        break;
      default:
          alert('Sin opción')
        break;
    }
}
