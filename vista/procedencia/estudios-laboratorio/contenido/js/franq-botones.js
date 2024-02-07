

$(document).on('click', '.btn-agregar_paciente', async function (event) {
    event.preventDefault();
    event.stopPropagation();

    const type = $(this).attr('data-bs-type');
    tipoFormulario(type);

    $('#AgregarNuevoPaciente').modal('show');
    await getDataFirst();
})



// Abre el estado de los lotes
$(document).on('click', '-#muestras_enviadas', async function (event) {
    event.preventDefault();
    event.stopPropagation();

    // Configura y obten los datos antes de la tabla de lotes


    // Una vez obtenido, abre el modal (esto desde el complete del ajax de la tabla)
})


