// cambiar fecha de la Lista
$('#fechaListadoLaboratorio').change(function () {
    recargarVistaLab();
})

$('#checkDiaAnalisis').click(function () {
    if ($(this).is(':checked')) {
        recargarVistaLab(0)
        $('#fechaListadoLaboratorio').prop('disabled', true)
    } else {
        recargarVistaLab();
        $('#fechaListadoLaboratorio').prop('disabled', false)
    }
})

function recargarVistaLab(fecha = 1) {
    dataListaPaciente = {
        api: 12,
        area_id: 6
    }
    if (fecha) dataListaPaciente['fecha_busqueda'] = $('#fechaListadoLaboratorio').val();

    tablaListaPaciente.ajax.reload();
    getPanel('.informacion-labo', '#loader-Lab', '#loaderDivLab', tablaListaPaciente, 'Out')
}

//Rechazar paciente
$('#btn-confirmarenviar-resultado').click(function () {
    let turno = dataSelect['turno']
    if (selectEstudio.getguardado() != 1 || datalist.DOBLE_CHECK != 1) {
        alertMensajeConfirm({
            title: "¿Está seguro de confirmar y enviar el resultado?",
            text: "¡No podrá revertir esta acción!",
            icon: "warning",
        }, function () {
            $.ajax({
                url: http + servidor + '/nuevo_checkup/api/turnos_api.php/',
                type: "POST",
                data: {
                    id_turno: turno,
                    api: 13
                },
                beforeSend: function () {
                    alertMensaje('info', 'Confirmando resultado', 'Espere un momento mientras confirmamos y enviamos el resultado al paciente')
                },
                success: function (data) {
                    if (mensajeAjax(data)) {
                        alertMensaje('success', '¡Resultado confirmado y enviado!', 'El resultado a sido enviado excitosamente')
                    }
                }
            })
        })
    }
})


//Aceptar paciente
$('#btn-rechazar-resultado').click(function () {
    let turno = 0;
    alertMensajeConfirm({
        title: "¿Está seguro rechazar y deshacer el confirmado de este resultado?",
        text: "¡No podrá revertir esta acción!",
        icon: "warning",
    }, function () {
        $.ajax({
            url: http + servidor + '/nuevo_checkup/api/turnos_api.php/',
            type: "POST",
            data: {
                id_turno: turno,
                api: 0
            },
            beforeSend: function () {
                alertMensaje('info', 'Confirmando resultado', 'Espere un momento mientras confirmamos y enviamos el resultado por correo')
            },
            success: function (data) {
                if (mensajeAjax(data)) {
                    alertMensaje('success', '¡Resultado confirmado y enviado!', 'El resultado a sido enviado excitosamente')
                }
            }
        })
    })
})