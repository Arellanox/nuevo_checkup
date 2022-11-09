hasLocation();

$(window).on("hashchange", function (e) {
  hasLocation();
});

function obtenerContenidoEstadoCuenta(){
  obtenerTitulo('Estados de cuentas');
  $.post('contenido/estado-cuentas.php', function(html){
    $('#body-js').html(html);
  }).done(function(){
    // Obtener el controlador de vistas de estado cuentas
    $.getScript("contenido/js-vistas-controlador/estado-controlador-vistas.js");
    obtenerPanelInformacion(3, "pacientes_api", 'paciente'); //Eliminar luego
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
