

$(document).on('click', '.btn-agregar_paciente', async function (event) {
    event.preventDefault();
    event.stopPropagation();

    const type = $(this).attr('data-bs-type');
    tipoFormulario(type);

    $('#AgregarNuevoPaciente').modal('show');
    await getDataFirst();
})


