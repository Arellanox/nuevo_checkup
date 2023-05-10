
const modalNuevaAgenda = document.getElementById('modalNuevaAgenda')
modalNuevaAgenda.addEventListener('show.bs.modal', event => {

    dataEstudios = false
    rellenarSelect('#select-us', "servicios_api", 2, 'ID_SERVICIO', 'ABREVIATURA.DESCRIPCION', {
        id_area: 11
    }, function (data) {
        // dataEstudios = data;
        dataEstudios = new GuardarArreglo(data);
    });

    rellenarSelect('#select-horas', 'agenda_api', 2, 'ID_HORARIO', 'HORA_INICIAL', {
        id_area: 11
    })

})


$('#FormAgendaNueva').submit(function (event) {
    event.preventDefault();
    if (servicios.length) {

        alertMensajeConfirm({
            title: '¿Estás seguro de guardar la cita?',
            text: 'Revise los datos antes de guardar',
        }, function () {
            ajaxAwaitFormData({
                api: 1,
                servicios: servicios,
                area_id: 11
            }, 'agenda_api', 'FormAgendaNueva', { callbackAfter: true }, false, function (data) {
                alertToast('¡Agenda registrada!', 'success', 4000);
                $('#iframeCalendar').attr('src', function (i, val) { return val; });

            })

        }, 1)

    } else {
        alertToast('Seleccione un estudio antes de guardar', 'info', 4000)
    }


})




let dataEstudios = false;
let servicios = new Array();
$(document).on('click', '#btn-agregarEstudioImg', function (event) {
    event.preventDefault();
    if (dataEstudios) {
        selectData = dataEstudios.array[$("#select-us").prop('selectedIndex')]
        servicios.push(selectData['ID_SERVICIO']);
        agregarFilaDiv('#list-estudios-ultrasonido', selectData['DESCRIPCION'], selectData['ID_SERVICIO'])
        try {
            //Establece el tiempo
            dataEstudios.acumular(selectData['MINUTOS']);
            $('#tiempo-aproximado').html(`${dataEstudios.acumular} minutos`)
        } catch (error) {
            alertToast('No se puedo obtener el tiempo aproximado, falta dato  [MINUTOS]', 'error', 4000)
        }
    }
})

$(document).on('click', '.eliminarfilaEstudio', function (event) {
    let id = $(this).attr('data-bs-id');
    eliminarElementoArray(id);
    var parent_element = $(this).closest("li[class='list-group-item']");
    $(parent_element).remove()
})

function eliminarElementoArray(id) {
    servicios = jQuery.grep(servicios, function (value) {
        return value != id;
    });
}

function agregarFilaDiv(appendDiv, text, id) {
    let html = '<li class="list-group-item">' +
        '<div class="row">' +
        '<div class="col-10 d-flex  align-items-center">' +
        text +
        '</div>' +
        '<div class="col-2">' +
        '<button type="button" class="btn btn-hover me-2 eliminarfilaEstudio" data-bs-id="' + id + '"> <i class="bi bi-trash"></i> </button>' +
        '</div>' +
        '</div>' +
        '</li>';
    $(appendDiv).append(html);
    // console.log(estudiosEnviar);
}



function resetEstudios() {
    dataEstudios = false;
    selectData = false;
    servicios = new Array();
}

select2("#select-us", "modalNuevaAgenda", 'Seleccione un estudio');
