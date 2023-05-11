
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
        area_id: 11,
        date: $('#inputfechaAgenda').val()
    })

})


$('#inputfechaAgenda').on('change', function () {
    sinDomingos();

    //Obtener horas disponibles
    $('#select-horas').find('option').remove().end()
    rellenarSelect('#select-horas', 'agenda_api', 2, 'ID_HORARIO', 'HORA_INICIAL', {
        area_id: 11,
        date: $(this).val()
    })

});

var elDate = $('#inputfechaAgenda').get(0);
var elForm = $('#FormAgendaNueva').get(0);
var elSubmit = $('#btn-agendar');

//valida los domingos
function sinDomingos() {
    var day = new Date($('#inputfechaAgenda').val()).getUTCDay();
    // Días 0-6, 0 es Domingo 6 es Sábado
    elDate.setCustomValidity(''); // limpiarlo para evitar pisar el fecha inválida
    if (day == 0) {
        elDate.setCustomValidity('Domingos no disponibles, por favor seleccione otro día');
    } else {
        elDate.setCustomValidity('');
    }
    if (!elForm.checkValidity()) {
        elSubmit.click()
    };
}

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
                recargarListas()
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
        if (!servicios.includes(selectData['ID_SERVICIO'])) {
            servicios.push(selectData['ID_SERVICIO']);
            console.log(servicios)
            agregarFilaDiv('#list-estudios-ultrasonido', selectData['DESCRIPCION'], selectData['ID_SERVICIO'])
            try {
                //Establece el tiempo
                dataEstudios.acumularSuma(selectData['MINUTOS'])
                $('#tiempo-aproximado').html(`${dataEstudios.acumular} minutos`)
            } catch (error) {
                console.log(error)
                alertToast('No se puedo obtener el tiempo aproximado, falta dato  [MINUTOS]', 'error', 4000)
            }
        } else {
            alertToast('Este servicio ya se encuentra en la lista');
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
    // with return
    let filtro = dataEstudios.array.find(objeto => objeto.ID_SERVICIO === id);
    dataEstudios.acumularResta(filtro['MINUTOS'])
    $('#tiempo-aproximado').html(`${dataEstudios.acumular} minutos`)
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
    $('#tiempo-aproximado').html(`0 minutos`)
    $('#list-estudios-ultrasonido').html('')
}

select2("#select-us", "modalNuevaAgenda", 'Seleccione un estudio');
