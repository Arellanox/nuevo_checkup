$(document).on('click', '.VistaEstadoCuenta', function () {
  $('.VistaEstadoCuenta').removeClass('active')
  $(this).addClass('active');
  switch ($(this).attr('data-ds')) {
    case "1":

    break;
    default:
  }
});
