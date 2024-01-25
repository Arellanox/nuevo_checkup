$(document).ready(function () {
    const fechaActual = new Date()
    const diaSemana = fechaActual.getDay()
    const primerDiaSemana = new Date(fechaActual);

    primerDiaSemana.setDate(fechaActual.getDate() - diaSemana + (diaSemana === 0 ? -6 : 1));

    // // Establece los valores de los campos de fecha
    document.getElementById('fecha_inicial_pacientes').valueAsDate = primerDiaSemana;
    document.getElementById('fecha_final_pacientes').valueAsDate = fechaActual;
})

$(document).on('click', '#actualizar_tabla_pacientes', function (e) {
    e.preventDefault();

    dataPacientesTratantes['fecha_inicio'] = $('#fecha_inicial_pacientes').val();
    dataPacientesTratantes['fecha_fin'] = $('#fecha_final_pacientes').val();

    if ($('#check_filtro_pacientes').is(':checked') && validarPermiso('filPacientes')) {
        dataPacientesTratantes['filtrar_todos'] = 1
    } else {
        dataPacientesTratantes['filtrar_todos'] = 0
    }

    tablaPacientesTratantes.ajax.reload();

    alertMsj({
        title: 'Cargando...',
        text: 'Espere un momento',
        showCancelButton: false,
        icon: 'info',
        timer: '1500',
        timerProgressBar: true,
        confirmButtonText: 'Ok'
    }, () => { }, 1)

    $('#modalFiltrarTablaPacientes').modal('hide');

})

