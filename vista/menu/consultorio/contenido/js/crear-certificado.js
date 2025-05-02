$('#btn-crear-certificado').on('click', function (e) {
    e.preventDefault(); // Detiene la recarga

    const vigencia = $('select[name="vigencia"]').val();
    const gradoSaludValor = $('#clasificacion_grado_salud').val();
    const tipoExamenMedico = [];
    $('input[name="tipo_examen_medico"]:checked').each(function () {
        tipoExamenMedico.push($(this).val());
    });
    const aptitudTrabajo = [];
    $('input[name="aptidud_trabajo"]:checked').each(function () {
        aptitudTrabajo.push($(this).val());
    });

    alertMensajeConfirm({
        title: "¿Desea generar el certificado?",
        text: "Una vez creado, no podrá modificar esta información.",
        icon: "warning",
        showCancelButton: true,
        cancelButtonColor: "#3085d6",
        confirmButtonColor: "#d33",
        confirmButtonText: "Si, generar",
        cancelButtonText: "Cancelar",
    }, function () {
        alertToast('Creando certificado, espere un momento...', 'info', 4000)

        const tipoExamenMedicoJson = JSON.stringify(tipoExamenMedico);
        const aptitudTrabajoJson = JSON.stringify(aptitudTrabajo);

        const params = {
            vigencia: vigencia,
            fecha_vigencia: calcularFechaVencimiento(vigencia),
            grado_salud: gradoSaludValor,
            tipo_examen_medico: tipoExamenMedicoJson,
            aptitud_trabajo: aptitudTrabajoJson,
            turno_id: pacienteActivo.array['ID_TURNO'],
            api: 3
        }

        ajaxAwait(params, 'certificado_medico_api', { callbackAfter: true }, false, function (data) {
            alertToast('Certificado generado exitosamente!', 'success', 4000);
            $('#modalCrearCertificadoBimo').modal('hide');
        });
    })
});

function calcularFechaVencimiento(meses) {
    const fechaActual = new Date();
    fechaActual.setMonth(fechaActual.getMonth() + parseInt(meses));
    return fechaActual.toISOString().split('T')[0]; // formato yyyy-mm-dd
}