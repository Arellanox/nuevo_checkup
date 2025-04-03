$(document).on('click', '#btn-envio_muestras', function (eveto) {
    eveto.preventDefault();
    eveto.stopPropagation();

    alertToast('Espere un momento...', 'info') // Mandamos una pequeña alerta

    setTimeout(() => {
        $('#EnvioLotesPacientes').modal('show');
    }, 1000);
});