
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

function obtenerVistaFacturar(){
  $.post('contenido/vistas/cuenta-facturar.php', function(html){
    $('#VistaEstadoCuenta').html(html);
  }).done(function(){
    $.getScript('contenido/js-vistas-controlador/estado-facturar-controlador-vista.js');
    // JS necesarios
    obtenerPanelInformacion(3, "pacientes_api", 'paciente');
  })
}

function obtenerVistaGrupos(){
  $.post('contenido/vistas/cuenta-grupo.php', function(html){
    $('#VistaEstadoCuenta').html(html);
  }).done(function(){
    // JS necesarios
  })
}
