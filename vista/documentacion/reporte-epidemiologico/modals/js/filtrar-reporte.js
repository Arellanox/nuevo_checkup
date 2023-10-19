$(document).ready(function () {
    const fechaActual = new Date()
    const diaSemana = fechaActual.getDay()
    const primerDiaSemana = new Date(fechaActual);

    primerDiaSemana.setDate(fechaActual.getDate() - diaSemana + (diaSemana === 0 ? -6 : 1));

    // // Establece los valores de los campos de fecha
    document.getElementById('fecha_inicial_epidemio').valueAsDate = primerDiaSemana;
    document.getElementById('fecha_final_epidemio').valueAsDate = fechaActual;
})

//select multiple
// select2('#prueba', 'modalFiltrarTablaReporteEpidemio')


$(document).on('click', '#actualizar_tabla_epidemio', function (e) {
    e.preventDefault();

    dataReporteEpidemiologico['fecha_inicio'] = $('#fecha_inicial_epidemio').val();
    dataReporteEpidemiologico['resultado'] = $('#resultado_epidemio').val();
    dataReporteEpidemiologico['fecha_final'] = $('#fecha_final_epidemio').val();

    TablaTablaReporteEpidemiologico.ajax.reload();

    alertMsj({
        title: 'Cargando...',
        text: 'Espere un momento',
        showCancelButton: false,
        icon: 'info',
        timer: '1500',
        timerProgressBar: true,
        confirmButtonText: 'Ok'
    }, () => { }, 1)

    $('#modalFiltrarTablaReporteEpidemio').modal('hide');

})