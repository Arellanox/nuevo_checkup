

getListAgenda()

function getListAgenda(area = 12, fecha = formatoFechaSQL(new Date(), 'yy-mm-dd')) {
    ajaxAwait({
        api: 3, area: area, date: fecha
    }, 'agenda_api', { callbackAfter: true, callbackBefore: true }, function () {
        loaderDiv("In", '#contenedor-list-agenda', "#loader-agenda", '#loaderDivAgenda', 0);
        // alertMsj({
        //     title: 'Cargando agenda...', text: 'Espere un momento para mostrar la agenda acual',
        //     timer: 2000, timerProgressBar: true,
        //     showCancelButton: false, showConfirmButton: false
        // })
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
                    <p>Teléfono: ${ifnull(element.TELEFONO)}</p>`;

                //  <i class="bi bi-pencil-square p-2"></i> 

                let detalle = element['DETALLE_AGENDA'][0];
                html += `<p class="none-p">Estudios:</p>`;
                html += `<p class="mb-1">Ultrasonido:`
                for (const key in detalle) {
                    if (Object.hasOwnProperty.call(detalle, key)) {
                        const element_detalle = detalle[key];
                        html += `<strong>${element_detalle['SERVICIO']}</strong>,`;
                    }
                }
                html += `</p>`;

                html += `<small>${formatoFecha2(element.CITA, [2, 1, 4, 1, 2, 2, 0])} | ${formatoFecha2(element.FINALIZA, [2, 1, 4, 1, 2, 2, 0])}</small>
                </button>`;

            }
        }
        $('#contenedor-list-agenda').html(html ? html : `<div class="alert alert-info" role="alert">
                                                            No hay citas disponibles para este día
                                                        </div>`);
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
        getListAgenda(12, 'null')
        $('#fechaSelected').prop('disabled', true)
    } else {
        getListAgenda(12, $('#fechaSelected').val())
        $('#fechaSelected').prop('disabled', false)
    }
}