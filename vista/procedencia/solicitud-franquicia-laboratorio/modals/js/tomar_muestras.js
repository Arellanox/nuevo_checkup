// Guardar muestra
$(document).on('submit', '#formulario_submit_muestras', function (e) {
    e.preventDefault();
    e.stopPropagation();

    const form = $(this);
    const input = form.find('input');
    const btn = $('button[form="formulario_submit_muestras"]');

    // const botonGuardarMuestra = form.find('.btn_submit_tomarmuestra'); // Encuentra el botón dentro del formulario

    guardarMuestraTomada(input, false)
})

function guardarMuestraTomada(input, botonGuardarMuestra) {
    alertMensajeConfirm({
        title: '¿Está seguro de cargar correctamente la fecha de toma?',
        text: 'No podrás modificarlo luego.',
        icon: 'warning',
    }, () => {
        // Datos a enviar
        const data_json = { api: 9, id_turno: turno, fecha_toma: input.val() };
        ajaxAwait(data_json, 'maquilas_api', { callbackAfter: true }, false, () => {
            alertToast('¡Fecha de muestra guardada!', 'success', 4000)

            tablaPacientes.ajax.reload();
            $('#ModalTomarMuestra').modal('hide');

            if (botonGuardarMuestra)
                // Cambiar el boton
                botonGuardarMuestra.attr('disabled', true) // Deshabilita el botón para prevenir clics adicionales
                    .removeClass('btn-confirmar') // Opcional: remover la clase original si deseas
                    .addClass('btn-success') // Cambia a color verde
                    .html('<i class="bi bi-droplet-fill"></i> Muestra Tomada'); // Cambia el contenido del botón a "Muestra Tomada" y el ícono a una gota de agua llena


        })
    }, 1)
}