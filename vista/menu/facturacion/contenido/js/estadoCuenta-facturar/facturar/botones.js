
$('#LimpiarNumeroCuenta').prop('disabled', true);
// Busca el estado de cuenta y genera toda la vista
$('#BuscarNumeroCuenta').click(function() {
    disabledButtonsVista();
    button = $(this);
    input = $('#inputBuscarEstadoCuenta');

    // Cambiar botones
    input.prop('disabled', true);
    button.prop('disabled', true);
    $('#LimpiarNumeroCuenta').prop('disabled', false);
    $("#selectDisabled").addClass("disable-element");
    // 

    $.ajax({
        url: http + servidor + "/nuevo_checkup/api/turnos_api.php",
        dataType: "json",
        method: "POST",
        data: {},
        beforeSend: function() {
            
        },
        success: function (data) {
            cargarDatosCuenta(data);
        }
    })

})

$('#LimpiarNumeroCuenta').click(function (){
    button = $(this);

    // Cambiar botones
    $('#BuscarNumeroCuenta').prop('disabled', false);
    button.prop('disabled', false);
    $('#LimpiarNumeroCuenta').prop('disabled', true);
    $("#selectDisabled").removeClass("disable-element");
    // 
})




$(document).on('click', '.vistaFacturar', function () {
  $('.vistaFacturar').removeClass('active')
  $('.vistaFacturar').removeClass('disabled')
  $(this).addClass('active');
  $(this).addClass('disabled');
  menu($(this).attr('data-ds'));
//   obtenerContenidoInfo(parseInt($(this).attr('data-ds')))
});



