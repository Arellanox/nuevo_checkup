//Generación de reportes de las maquilas aprobadas
$('#btn-generar-reportes').on('click', function (event) { abrirSeleccionDeReportesPorLaboratorio(event); });
$('#btn-generar-pdf').on('click', function (event) { generarReporteMaquilas(event); });

function abrirSeleccionDeReportesPorLaboratorio(event){
    event.preventDefault();
    $('#modalMaquilaEstudios').modal('show');
    rellenarOrdenarSelect('#select-laboratorios-maquila', 'laboratorio_maquila_api', 2, 'ID_LABORATORIO', 'DESCRIPCION');
}

function generarReporteMaquilas(event){
    event.preventDefault();
    const laboratorio_texto = $('#select-laboratorios-maquila option:selected').text();
    const laboratorio_id = $('#select-laboratorios-maquila').val();

    /*if(laboratorio_id !== '9'){
        Toast.fire({icon: 'error', title: '¡No se puede generar reporte de maquilas para este laboratorio en este momento!', timer: 2000});
        return;
    }*/

    if(maquilasCompletadas < 0){
        Toast.fire({icon: 'error', title: '¡No se puede generar reporte de maquilas con estatus pendiente!', timer: 2000});
        return;
    }

    const maquilasDelLaboratorio = listaMaquilas.filter(maquila =>
        maquilasCompletadas.includes(maquila.ID_MAQUILA) &&
        maquila.ID_LABORATORIO.toString() === laboratorio_id.toString()
    );

    if (maquilasDelLaboratorio.length <= 0) {
        Toast.fire({ icon: 'error', title: '¡No se puede generar el reporte si hay maquilas sin aprobar!', timer: 2000});
        return;
    }

    alertMensajeConfirm({
        title: '¿Quieres completar esta acción?',
        text: `Se generara un reporte de maquilas por ${laboratorio_texto}`,
        icon: 'warning',
        confirmButtonText: 'Sí'
    }, function () {
        ajaxAwait({
            api: (laboratorio_id !== '9' ? 6 : 5),
            laboratorio_id: laboratorio_id,
            fecha_inicio: rangoFechas[0],
            fecha_final: rangoFechas[1]
        }, 'laboratorio_solicitud_maquila_api', { callbackAfter: true }, false, function (response) {
            const url = response.response.data.url;
            window.open(url, '_blank');
        });

    }, 1, function () { alert("Acción cancelada."); }, () => {});
}
//---