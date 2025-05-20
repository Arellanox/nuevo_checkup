getListAgenda()

function getListAgenda(area = localStorage.getItem('areaActual'), fecha = formatoFechaSQL(new Date(), 'yy-mm-dd')) {
    ajaxAwait({
        api: 3, area_id: area, date: fecha
    }, 'agenda_api', { callbackAfter: true, callbackBefore: true }, function () {
        loaderDiv("In", '#contenedor-list-agenda', "#loader-agenda", '#loaderDivAgenda', 0);
        $('#contenedor-list-agenda').html('');
    }, function (data) {
        let row = data.response.data;
        let html = ''
        for (const key in row) {
            if (Object.hasOwnProperty.call(row, key)) {
                const element = row[key];

                html += `<button class="list-group-item list-group-item-action" aria-current="true">
                    <div class="d-flex w-100 justify-content-between">
                        <h5 class="mb-1">${element.PACIENTE}</h5>
                        <small> <i class="bi bi-trash p-2 eliminarAgenda" data-id="${element.ID_AGENDA}"></i>
                        </small>
                    </div>
                    <p><span class="none-p">Teléfono:</span> ${ifnull(element.TELEFONO)}</p>`;

                let detalle = element['DETALLE_AGENDA'][0];
                html += `<p class="none-p">Detalle:</p>`;
                html += `<p class="mb-1">`
                for (const key in detalle) {
                    if (Object.hasOwnProperty.call(detalle, key)) {
                        const element_detalle = detalle[key];
                        html += `<strong>${element_detalle['SERVICIO']}</strong>,`;
                    }
                }
                html += `</p>`;
                html += `<p class="none-p">Observaciones: ${ifnull(element.OBSERVACIONES, '<span style="font-style:italic">Sin observaciones</span>')}</p>`;
                html += `<small>${formatoFecha2(element.CITA, [2, 1, 4, 1, 2, 2, 0])} | ${formatoFecha2(element.FINALIZA, [2, 1, 4, 1, 2, 2, 0])}</small> </br>
                        <small>Registrado por: <strong>${element['REGISTRADO_POR']}</strong>${ifnull(element.FECHA_REGISTRO) ? " | " + formatoFecha2(element.FECHA_REGISTRO, [3, 1, 5, 2, 2, 2]) : ''}</small>
                </button>`;
            }
        }

        $('#contenedor-list-agenda').html(
            html ? html : `<div class="alert alert-info" role="alert">No hay citas disponibles para este día</div>`
        );

        swal.close();
        loaderDiv("Out", '#contenedor-list-agenda', "#loader-agenda", '#loaderDivAgenda', 0);
    });

}

function recargarListas() {
    $('#iframeCalendar').attr('src', function (i, val) { return val; });
    resetEstudios()
    $('#modalNuevaAgenda').modal('hide')
    //Convertirlo a funcion
    if ($('#checkDiaFechaSelected').is(':checked')) {
        getListAgenda(11, 'null')
        $('#fechaSelected').prop('disabled', true)
    } else {
        getListAgenda(11, $('#fechaSelected').val())
        $('#fechaSelected').prop('disabled', false)
    }
}