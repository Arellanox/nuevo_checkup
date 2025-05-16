// cambiar fecha de la Lista
$('#fechaListadoLaboratorio').change(function () {
    recargarVistaLab();
});

$('#fechaFinalListadoLaboratorio').change(function () {
    recargarVistaLab();
});

$('#checkDiaAnalisis').click(function () {
    if ($(this).is(':checked')) {
        recargarVistaLab(0)
        $('#fechaListadoLaboratorio').prop('disabled', true)
        $('#fechaFinalListadoLaboratorio').prop('disabled', true)
    } else {
        recargarVistaLab();
        $('#fechaListadoLaboratorio').prop('disabled', false)
        $('#fechaFinalListadoLaboratorio').prop('disabled', false)
    }
})

function recargarVistaLab(fecha = 1) {
    dataListaPaciente = {
        api: 12,
        area_id: areaActiva
    }

    if (fecha) {
        dataListaPaciente['fecha_busqueda'] = $('#fechaListadoLaboratorio').val();
        dataListaPaciente['fecha_busqueda_final'] = $('#fechaFinalListadoLaboratorio').val();
    }

    tablaListaPaciente.ajax.reload();
    getPanel('.informacion-labo', '#loader-Lab', '#loaderDivLab', tablaListaPaciente, 'Out')
}

//Rechazar paciente
$('#btn-confirmarenviar-resultado').click(function () {
    let turno = dataSelect.array['turno']
    if (session.permisos['CorreosLab'] != 1) {
        alertMensaje('error', 'Permiso requerido', 'No tienes permiso para realizar esta acción')
        return 0;
    }
    if (selectEstudio.getguardado() != 1 || datalist.DOBLE_CHECK != 1 || 1) {
        alertMensajeConfirm({
            title: "¿Está seguro de validar el resultado?",
            text: `Si es necesario, se enviará al correo del paciente (${selectEstudio.array.CORREO})`,
            icon: "info",
        }, function () {
            $.ajax({
                url: `${http}${servidor}/${appname}/api/turnos_api.php/`,
                type: "POST",
                data: {
                    id_turno: turno,
                    api: 13,
                    id_area: areaActiva
                },
                dataType: "json",
                beforeSend: function () {
                    alertMensaje('info', 'Validando reporte', 'Espere un momento mientras validamos el reporte al paciente')
                },
                success: function (data) {
                    if (mensajeAjax(data)) {
                        alertMensaje('success', '¡Reporte validado!', 'El reporte ha sido validado correctamente.')
                    }
                },
                error: function (jqXHR, exception, data) {
                    alertErrorAJAX(jqXHR, exception, data)
                },
            })
        }, 1)
    } else {
        alertToast('Reporte confirmado...', 'error')
    }
})


//Aceptar paciente
$('#btn-rechazar-resultado').click(function () {
    let turno = dataSelect.array['turno']
    if (session.permisos['CorreosLab'] != 1) {
        alertMensaje('error', 'Permiso requerido', 'No tienes permiso para realizar esta acción')
        return 0;
    }
    alertMensajeConfirm({
        title: "¿Está seguro rechazar y deshacer el confirmado de este resultado?",
        text: "¡No podrá revertir esta acción!",
        icon: "warning",
    }, function () {
        $.ajax({
            url: `${http}${servidor}/${appname}/api/turnos_api.php/`,
            type: "POST",
            data: {
                id_turno: turno,
                api: 15,
                id_area: areaActiva
            },
            dataType: "json",
            beforeSend: function () {
                alertMensaje('info', 'Invalidando resultado', 'Espere un momento mientras hacemos cambios en el reporte')
            },
            success: function (data) {
                if (mensajeAjax(data)) {
                    alertMensaje('success', '¡Reporte invalidado!', 'Ahora el formulario de resultado de este reporte ha sido abierto nuevamente')
                    tablaListaPaciente.ajax.reaload()
                }
            },
            error: function (jqXHR, exception, data) {
                alertErrorAJAX(jqXHR, exception, data)
            },
        })
    }, 1)
})


// Reemplazar el reporte del paciente.
$('#file-upload-rep-lab').on('change',function(){

    var fileInput = $(this)[0];

    if(fileInput.files && fileInput.files.length > 0 ){
        var formData = new FormData();
        formData.append('file', fileInput.files[0]);
        formData.append('api', 22);
        formData.append('ruta_reporte', selectEstudio.array.RUTA)
        

        alertMensajeConfirm({
            title: "¿Se actualizará el reporte del paciente " + dataSelect.array.nombre_paciente + "?",
            text: "¡No podrá revertir esta acción!",
            icon: "warning",
        }, function () {
            $.ajax({
                url: `${http}${servidor}/${appname}/api/turnos_api.php/`,
                type: "POST",
                data: formData,
                dataType: "json",
                processData: false, // Asegúrate de incluir esto para evitar que jQuery procese los datos
                contentType: false, // Asegúrate de incluir esto para enviar los datos en formato multipart/form-data
                beforeSend: function () {
                    alertMensaje('info', 'Sustituyendo reporte...', 'Espere un momento')
                },
                success: function (data) {
                    if (mensajeAjax(data)) {
                        alertMensaje('success', '¡Reporte actualizado!', 'Los cambios se han aplicado.')
                        tablaListaPaciente.ajax.reaload()
                    }
                },
                error: function (jqXHR, exception, data) {
                    alertErrorAJAX(jqXHR, exception, data)
                },
            })
        }, 1)
    }

});

$('#file-upload-rep-lab').on('focus',function(){
    $('#file-upload-rep-lab').val('');
});