
    //Variables para el DOM 
    let cuentaInput = $('#inputBuscarEstadoCuenta');
    let cuentaRadio = $('input[name="flexRadioDefault"]');
$('#BuscarNumeroCuenta').on('click', function(){
    $.ajax({
        data: {
            api: 7, //Prueba
            correo: 1
        },
        url: "../../../api/turnos_api.php", //URL prueba
        type: "POST",
        beforeSend: function(){
            cuentaInput.prop('disabled', true);
            cuentaRadio.prop('disabled', true);
        },
        success: function(data) {
            // Obtener información del paciente
            selectCuenta = new GuardarArreglo(data)
            obtenerContenidoInfo(1,1)
        }
      });
})

$('#LimpiarNumeroCuenta').on('click', function(){
    cambiarVistaEstadoCuenta('Out')
})

