

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



// Abre el estado de los lotes
$(document).on('click', '#btn-muestras_enviadas', async function (event) {
    event.preventDefault();
    event.stopPropagation();

    // Configura y obten los datos antes de la tabla de lotes


    // Una vez obtenido, abre el modal (esto desde el complete del ajax de la tabla)
})


// Abre el estado de los lotes
$(document).on('click', '#btn-envio_muestras', async function (event) {
    event.preventDefault();
    event.stopPropagation();
    // tablaPacientesFaltantes_inicio = true
    $('#EnvioLotesPacientes').modal('show');
    // Configura y obten los datos antes de la tabla de lotes
    tablaPacientesFaltantes.ajax.reload();

    // Una vez obtenido, abre el modal (esto desde el complete del ajax de la tabla)
})

