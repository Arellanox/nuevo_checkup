
$(document).on('click', '.VistaEstadoCuenta', function () {
  $('.VistaEstadoCuenta').removeClass('active')
  $(this).addClass('active');
  switch ($(this).attr('data-ds')) {
    case "1":
        $.post('contenido/vistas/cuenta-facturar.php', function(html){
          $('#VistaEstadoCuenta').html(html);
        }).done(function(){
          // JS necesarios
          obtenerPanelInformacion(3, "pacientes_api", 'paciente');
        })
      break;
    case "2":
        $.post('contenido/vistas/cuenta-grupo.php', function(html){
          $('#VistaEstadoCuenta').html(html);
        }).done(function(){
          // JS necesarios
        })
      break;
    default:
  }
});
