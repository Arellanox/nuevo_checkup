//EnvioLotesPacientes

$(document).on('click', '#btn-envio_muestras', async function (event) {
    event.preventDefault();
    event.stopPropagation();

    restartPages('page_control-envio_lotes');
    btnCambioPages(1);

    $('#folio_de_solicitud_muestras').html('');
    $('#formato_de_envio').attr('href', '#SinRellenar');

    tablaPacientesFaltantes.ajax.reload();
    TablaPacientesNewGrupo.clear().draw();

    $('#EnvioLotesPacientes').modal('show');
})
