var hash = window.location.hash.substring(1);
var tableData;




// if (tableData != false)
//     alertMensaje('info', 'No puede usar esta ventana', 'No es el area correcta', 'Este mensaje no deberia existir'); return false;



checkPacienteBeneficia


$('#checkPacienteBeneficia').change(function () {
    if ($(this).is(":checked")) {
        $('#datos-nuevo-trabajador').fadeIn(200)
    } else {
        $('#datos-nuevo-trabajador').fadeOut(200)
    }

});

//Rechazados
$("#formBeneficiadoTrabajador").submit(function (event) {
    event.preventDefault();
    if (array_selected['CLIENTE_ID'] == 18) {
        alertMensaje('info', 'No tienes permtido hacer esta acción', '?')
        return false
    }
    var form = document.getElementById("formRegistrarPaciente");
    var formData = new FormData(form);
    formData.set('api', 1);
    /*DATOS Y VALIDACION DEL REGISTRO*/
    $.ajax({
        data: formData,
        processData: false,
        contentType: false,
        url: "../../../api/recepcion_api.php",
        type: "POST",
        success: function (data) {
            data = jQuery.parseJSON(data);
            if (mensajeAjax(data)) {
                alertMensaje('info', '¡Paciente rechazado!', 'El paciente está en la lista de rechazados.');
                document.getElementById("btn-rechazar-paciente").disabled = false;
                $("#modalPacienteRechazar").modal("hide");
                tablaRecepcionPacientes.ajax.reload();
            }
        }
    });
    event.preventDefault();
});

// select2('#lista-pacientes-trabajadores', "ModalBeneficiario")
// rellenarSelect('#lista-pacientes-trabajadores', 'pacientes_api', 2, 'ID_PACIENTE', 'CURP.PASAPORTE.NOMBRE_COMPLETO.NACIMIENTO.EXPEDIENTE', { cliente_id: 1, onlyTrabajadores: true })