

getListAgenda()

function getListAgenda(area = 12, fecha = formatoFechaSQL(new Date(), 'yyyy-MM-dd')) {
    ajaxAwait({
        api: 3, area: area, fecha: fecha
    }, 'agenda_api', { callbackAfter: true, callbackBefore: true, response: false }, function () {
        loaderDiv("In", '#contenedor-list-agenda', "#loader-agenda", '#loaderDivAgenda', 0);
        alertMsj({
            title: 'Cargando agenda...', text: 'Espere un momento para mostrar la agenda acual',
            timer: 2000, timerProgressBar: true,
            showCancelButton: false, showConfirmButton: false
        })
        $('#contenedor-list-agenda').html('');
    }, function (data) {
        console.log(data);
        let row = data.response.data;
        let html = ''
        for (const key in row) {
            if (Object.hasOwnProperty.call(row, key)) {
                const element = row[key];

                html += `<button class="list-group-item list-group-item-action" aria-current="true">
                    <div class="d-flex w-100 justify-content-between">
                        <h5 class="mb-1">${element.PACIENTE}</h5>
                        <small> <i class="bi bi-pencil-square p-2"></i> <i class="bi bi-trash p-2"></i>
                        </small>
                    </div>
                    <p>Teléfono: ${element.TELEFONO}</p>
                    <p class="none-p">Estudios:</p>
                    <p class="mb-1">Ultrasonido: <strong>DOPPLER CAROTIDEO UNILAERAL</strong>,
                        <strong>DOPPLER VENOSO
                            AMBOS MIEMBROS PELVICOS</strong>
                    </p>
                    <small>${formatoFecha2(element.inicial, [1, 1, 4, 1, 2, 2, 0])} | ${formatoFecha2(element.inicial, [1, 1, 4, 1, 2, 2, 0])}</small>
                </button>`;

            }
        }
        $('#contenedor-list-agenda').html(html ? html : `<div class="alert alert-info" role="alert">
                                                            No hay pacientes en agenda
                                                        </div>`);
        loaderDiv("Out", '#contenedor-list-agenda', "#loader-agenda", '#loaderDivAgenda', 0);
    });

}