$(document).on('click', '.vistaFacturar', function () {
  $('.vistaFacturar').removeClass('active')
  $('.vistaFacturar').removeClass('disabled')
  $(this).addClass('active');
  $(this).addClass('disabled');
  $('#TablaCargosVista').fadeOut(0);
  $('#informacionCargos').fadeOut(0);
  $('#FormularioFacturarPaciente').fadeOut(0);
  $('#FormularioFacturarCliente').fadeOut(0);
  switch ($(this).attr('data-ds')) {
    case "1":
      obtenerCargosPaciente(1)
    break;
    case "2":

    break;
    case "3":

    break;
    default:
  }
});

function obtenerCargosPaciente(estadoCuenta){
  $('#TablaCargosVista').fadeIn(0);
  $('#informacionCargos').fadeIn(0);
}

function obtenerFormFacturarPaciente(){
  $('#FormularioFacturarPaciente').fadeIn(0);
}

function obtenerFormFacturarGrupos(){
  $('#FormularioFacturarCliente').fadeIn(0);
}
