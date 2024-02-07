

$(document).on('click', '.btn-agregar_paciente', async function (event) {
    event.preventDefault();
    event.stopPropagation();

    const type = $(this).attr('data-bs-type');
    tipoFormulario(type);

    $('#AgregarNuevoPaciente').modal('show');
    await getDataFirst();
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
    tablaPacientesFaltantes_inicio = true

    // Configura y obten los datos antes de la tabla de lotes
    tablaPacientesFaltantes.ajax.reload();

    // Una vez obtenido, abre el modal (esto desde el complete del ajax de la tabla)
})

