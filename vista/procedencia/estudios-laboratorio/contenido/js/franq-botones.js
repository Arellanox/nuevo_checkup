

$(document).on('click', '.btn-agregar_paciente', async function (event) {
    event.preventDefault();
    event.stopPropagation();

    // Avisamos que esta cargando datos
    // Avisamos que esta cargando datos
    alertMsj({
        title: 'Por favor, espere',
        text: 'Estamos actualizando la información con los últimos datos disponibles.',
        showCancelButton: false, showConfirmButton: false,
        icon: 'info'
    })


    const type = $(this).attr('data-bs-type');
    form_type = type; // <-- 1 agregar, 2 agendar
    tipoFormulario(type);

    getDataFirst(type);
})


// |------------------------- Lotes enviados -----------------------------|
// Abre el modal de la vista de los lotes enviados
$(document).on('click', '#btn-muestras_enviadas', async function (event) {
    event.preventDefault(); // Prevenimos los eventos
    event.stopPropagation(); // Prevenimos la propagacion

    $('#tab-reporte').fadeOut('fast');

    alertToast('Espere un momento...', 'info') // Mandamos una pequeña alerta
    TablaListaLotes.ajax.reload() //Recargamos la tabla de la lista de los lotes enviados


    // //Hacemos un retraso de un 1 segundo para que la tabla pueda recargar
    setTimeout(() => {
        $('#LotesEnviados').modal('show'); // Abrimos el modal una vez pasado el segundo de espera
    }, 1000);
})

// Abre el estado de los lotes
$(document).on('click', '#btn-envio_muestras', async function (event) {
    event.preventDefault();
    event.stopPropagation();
    // tablaPacientesFaltantes_inicio = true

    restartPages('page_control-envio_lotes')
    btnCambioPages(1)
    $('#folio_de_solicitud_muestras').html('')
    $('#formato_de_envio').attr('href', '#SinRellenar');


    // Configura y obten los datos antes de la tabla de lotes
    tablaPacientesFaltantes.ajax.reload();
    TablaPacientesNewGrupo.clear().draw();


    // alertToast('')

    $('#EnvioLotesPacientes').modal('show');
    // Una vez obtenido, abre el modal (esto desde el complete del ajax de la tabla)
})
