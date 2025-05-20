function cambiarVistaModal() {
    switch (localStorage.getItem('areaActual')) {
        case 19: case '19':
            $('#title-area, #subtext-area').html('Paquete')
            $('#content-area').fadeOut('slow')
            paqueteUse = 1;
            break;

        default:
            $('#title-area, #subtext-area').html('Estudios')
            $('#content-area').fadeIn('slow')
            paqueteUse = 0;

            break;
    }
}

const modalNuevaAgenda = document.getElementById('modalNuevaAgenda')
modalNuevaAgenda.addEventListener('show.bs.modal', event => {
    cambiarVistaModal()

    switch (localStorage.getItem('areaActual')) {
        case 19: case '19':
            rellenarSelect('#select-us', 'paquetes_api', 2, 0, 'DESCRIPCION.CLIENTE', {
                contenido: 1
            });
            break;

        default:
            dataEstudios = false
            rellenarSelect('#select-us', "servicios_api", 2, 'ID_SERVICIO', 'ABREVIATURA.DESCRIPCION', {
                id_area: localStorage.getItem('areaActual')
            }, function (data) {
                // dataEstudios = data;
                dataEstudios = new GuardarArreglo(data);

                let selected = data[$("#select-us").prop('selectedIndex')]
            });
            break;
    }

    rellenarSelect('#select-horas', 'agenda_api', 2, 'ID_HORARIO', 'HORA_INICIAL', {
        area_id: localStorage.getItem('areaActual'),
        date: $('#inputfechaAgenda').val()
    })

    $('#list-estudios-ultrasonido').html('')
    $('#tiempo-aproximado').html('0 minutos')

})


$('#inputfechaAgenda').on('change', function () {
    sinDomingos();

    //Obtener horas disponibles
    $('#select-horas').find('option').remove().end()
    rellenarSelect('#select-horas', 'agenda_api', 2, 'ID_HORARIO', 'HORA_INICIAL', {
        area_id: localStorage.getItem('areaActual'),
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

    let json = {
        api: 1,
        area_id: localStorage.getItem('areaActual')
    }

    alertMensajeConfirm({
        title: '¿Estás seguro de guardar la cita?',
        text: 'Revise los datos antes de guardar',
    }, function () {
        if (servicios.length) {
            json['servicios'] = servicios
        } else if (paqueteUse) {
            json['paquete_id'] = $('#select-us').val();
        } else {
            alertToast('Seleccione un estudio antes de guardar', 'info', 4000)
        }

        ajaxAwaitFormData(json, 'agenda_api', 'FormAgendaNueva', { callbackAfter: true }, false, function (data) {
            alertToast('¡Agenda registrada!', 'success', 4000);
            recargarListas()
        })
    }, 1)
})

let dataEstudios = false;
let servicios = new Array();
$(document).on('click', '#btn-agregarEstudioImg', function (event) {
    event.preventDefault();
    if (dataEstudios) {
        selectData = dataEstudios.array[$("#select-us").prop('selectedIndex')]
        if (!servicios.includes(selectData['ID_SERVICIO'])) {
            servicios.push(selectData['ID_SERVICIO']);

            agregarFilaDiv('#list-estudios-ultrasonido', selectData['DESCRIPCION'], selectData['ID_SERVICIO'])
            try {
                //Establece el tiempo
                if (localStorage.getItem('areaActual') == 6) {
                    dataEstudios.acumularSuma(selectData['MINUTOS'])
                    $('#tiempo-aproximado').html(`${dataEstudios.acumular} minutos`)
                }
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
}

function resetEstudios() {
    dataEstudios = false;
    selectData = false;
    servicios = new Array();
    $('#tiempo-aproximado').html(`0 minutos`)
    $('#list-estudios-ultrasonido').html('')
}

select2("#select-us", "modalNuevaAgenda", 'Seleccione un estudio');
