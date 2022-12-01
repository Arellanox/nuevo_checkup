//Primer menu
$(document).on('click', '.VistaEstadoCuenta', function () {
  $('.VistaEstadoCuenta').removeClass('active')
  $('.VistaEstadoCuenta').removeClass('disabled')
  $(this).addClass('active');
  $(this).addClass('disabled');
  switch ($(this).attr('data-ds')) {
    case "1":
        obtenerVistaFacturar()
      break;
    case "2":
        obtenerVistaGrupos()
      break;
    default:
  }
});




let dataAjaxCargos = {api: 7}, selectCuenta = new GuardarArreglo();
// Obtener de primer vista el estado de cuenta


function obtenerVistaFacturar(){
  $.post('contenido/vistas/cuenta-facturar.php', function(html){
    $('#VistaEstadoCuenta').html(html);
  }).done(function(){
    //Botones
    $.getScript('contenido/js/VistaFacturar/vistaFacturar-botones.js');


    $.getScript('contenido/js/VistaFacturar/controlador.js');

    // JS necesarios
    // cambiarVistaEstadoCuenta('Out')
    // $.getScript('contenido/js/VistaFacturar/tabla.js').done(function(){
    //   $.getScript('contenido/js/VistaFacturar/botones.js');
    // })
    // $.getScript('contenido/js-vistas-controlador/estado-facturar-controlador-vista.js');
  })
}



function obtenerVistaGrupos(){
  $.post('contenido/vistas/cuenta-grupo.php', function(html){
    $('#VistaEstadoCuenta').html(html);
  }).done(function(){
    // JS necesarios
  })
}


function cambiarVistaEstadoCuenta(fade) {
  switch (fade) {
    case 'Out':
      $('.vistaCargosFacturar').fadeOut(0)
    break;
    case 'In':
      $('.vistaCargosFacturar').fadeIn(0)
    break;
  
    default:
    break;
  }
   //Ocultar plantilla para buscar el estado de cuenta
}




