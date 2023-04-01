
// Obtener datos del paciente seleccionado
const ModalBeneficiario = document.getElementById('ModalBeneficiario')
ModalBeneficiario.addEventListener('show.bs.modal', event => {
    rellenarSelect('#lista-pacientes-trabajadores', 'recepcion_api', 8, 'ID_PACIENTE', 'CURP.PASAPORTE.NOMBRE_COMPLETO.NACIMIENTO.NUMBER_TRABAJADOR', {})

})

await function datosPacienteBeneficiado(turno) {
    return new Promise(function (resolve, reject) {
        $.ajax({
            type: 'POST',
            url: https + servidor + '/nuevo_checkup/api/recepcion_api.php',
            dataType: 'json',
            data: {

            },
            beforeSend: function () {
                alertToast('Verificando si existen datos previos...', 'info', 4000);
            },
            success: function (data) {
                if (mensajeAjax(data)) {


                    alertToast('Datos ')
                }
            },
            complete: function () {
                resolve(1);
            }
        })
    })

}




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

    if (isJson(array_selected)) {
        alertMensaje('error', 'No ha seleccionado ningun paciente', 'No puedes continuar con esta accion');
        return false;
    }

    var form = document.getElementById("formBeneficiadoTrabajador");
    var formData = new FormData(form);
    formData.set('turno_id', array_selected['ID_TURNO'])
    formData.set('api', 7);

    console.log(checkNumber(formData.get('trabajador_id')))
    if (!checkNumber(formData.get('trabajador_id')) && !document.getElementById('checkPacienteBeneficia').checked) {
        alertMensaje('warning', 'No puedes agregar estos datos', 'No ha seleccionado el trabajador')
        return false;
    }

    if (document.getElementById('checkPacienteBeneficia').checked) {
        formData.set('trabajador_id', false);
    }


    if (array_selected['CLIENTE_ID'] != '18') {
        alertMensaje('info', 'No tienes permtido hacer esta acción')
        return false
    }


    /*DATOS Y VALIDACION DEL REGISTRO*/
    alertMensajeConfirm({
        tittle: '¿Estás seguro de que todos los datos están correctos?',
        text: '¡Probablemente no podrás revertir los cambios!',
        icon: 'warning'
    }, function () {
        $.ajax({
            data: formData,
            processData: false,
            contentType: false,
            url: "../../../api/recepcion_api.php",
            type: "POST",
            success: function (data) {
                data = jQuery.parseJSON(data);
                if (mensajeAjax(data)) {
                    alertMensaje('success', '¡Información cargada!', 'Los datos de beneficiario ya estan listos.');
                    rellenarSelect('#lista-pacientes-trabajadores', 'recepcion_api', 8, 'ID_PACIENTE', 'CURP.PASAPORTE.NOMBRE_COMPLETO.NACIMIENTO.NUMBER_TRABAJADOR', {})
                    document.getElementById("btn-rechazar-paciente").disabled = false;
                    $("#ModalBeneficiario").modal("hide");
                    // tablaRecepcionPacientes.ajax.reload();
                }
            }
        });
    }, 1)
    event.preventDefault();
});

// select2('#lista-pacientes-trabajadores', "ModalBeneficiario")
// rellenarSelect('#lista-pacientes-trabajadores', 'pacientes_api', 2, 'ID_PACIENTE', 'CURP.PASAPORTE.NOMBRE_COMPLETO.NACIMIENTO.EXPEDIENTE', { cliente_id: 1, onlyTrabajadores: true })