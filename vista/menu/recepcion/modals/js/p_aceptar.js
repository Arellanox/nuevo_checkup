// Obtener datos del paciente seleccionado
let url_paciente = null, validarEstudiosLab = 0, validarEstudiosRX = 0, validarEstudiosImg = 0, validarEstudiosOtros = 0;
let estudiosEnviar = [];
let detallesEstudiosCotizacion = [];
let PaquetesDatos;

select2("#select-paquetes", "modalPacienteAceptar", 'Seleccione un paquete');
select2("#select-lab", "modalPacienteAceptar", 'Seleccione un estudio');
select2("#select-labbio", "modalPacienteAceptar", 'Seleccione un estudio');
select2("#select-rx", "modalPacienteAceptar", 'Seleccione un estudio');
select2("#select-us", "modalPacienteAceptar", 'Seleccione un estudio');
select2("#select-otros", "modalPacienteAceptar", 'Seleccione un estudio');
select2('#select-segmento-aceptar', "modalPacienteAceptar", 'Seleccione un segmento');
select2('#select-vendedor', 'modalPacienteAceptar', 'Selecciona un vendedor') //<-- //Rellena el select de los vendedores
select2('#select-recepcion-medicos-tratantes', 'modalPacienteAceptar', 'Seleccione un medico tratante')

var modalPacienteAceptar = document.getElementById('modalPacienteAceptar')
modalPacienteAceptar.addEventListener('show.bs.modal', async event => {
    limpiarFormAceptar();
    reset_email_inputs_medicos();

    document.getElementById("title-paciente_aceptar").innerHTML = array_selected[1];

    array_selected['ALERGIAS'] ? $('#alergias-aceptar-paciente').val(array_selected['ALERGIAS']) : $('#alergias-aceptar-paciente').val('');
    array_selected['DIAGNOSTICO_TURNO'] ? $('#diagnostico-aceptar-paciente').val(array_selected['DIAGNOSTICO_TURNO']) : $('#diagnostico-aceptar-paciente').val('');

    await rellenarSelect('#select-paquetes', 'paquetes_api', 2, 'ID_PAQUETE', 'DESCRIPCION', {
        'cliente_id': array_selected['CLIENTE_ID']
    }, (data) => { PaquetesDatos = data });

    await rellenarSelect('#select-segmento-aceptar', 'segmentos_api', 2, 0, 'DESCRIPCION', {
        cliente_id: array_selected['CLIENTE_ID']
    }, function (data) {
        array_selected['ID_SEGMENTO'] ?
            $('#select-segmento-aceptar').val(array_selected['ID_SEGMENTO']).trigger('change') : false;
    });

    if (array_selected['MOSTRAR_CAT_CONVERSION'] == "1") {
        $('#comoNosConocisteDiv').html(`<div class="col-12 text-center">
                  <h3>¿Cómo nos conociste?</h3>
                  <select class="input-form" id="comoNosConociste">

                  </select>
                </div>`)
        await rellenarSelect('#comoNosConociste', 'clientes_api', 9, 'ID_CONVERSION', 'DESCRIPCION')
    } else {
        $('#comoNosConocisteDiv').html(``)
    }

    await rellenarSelect("#select-lab", "precios_api", 7, 'ID_SERVICIO', 'ABREVIATURA.SERVICIO.DIAS_DE_ENTREGA', {
        cliente_id: array_selected['CLIENTE_ID'],
        area_id: 6,
        recepcion: 1
    }, function (data) {
        estudiosLab = data;
        if (data.length <= 0) {
            Toast.fire({
                icon: 'warning',
                title: 'No se encontraron estudios para este paciente, añade un precio para poder verlos.'
            })
        }
    });
    await rellenarSelect("#select-labbio", "precios_api", 7, 'ID_SERVICIO', 'ABREVIATURA.SERVICIO.DIAS_DE_ENTREGA', {
        cliente_id: array_selected['CLIENTE_ID'],
        area_id: 12,
        recepcion: 1,
    }, function (data) {
        // Se usa en el hover  de  detalle
        estudiosLabBio = data;
    });
    await rellenarSelect('#select-us', "precios_api", 7, 'ID_SERVICIO', 'ABREVIATURA.SERVICIO.DIAS_DE_ENTREGA', {
        cliente_id: array_selected['CLIENTE_ID'],
        area_id: 11,
        recepcion: 1,
    }, function (data) {
        // Se usa en el hover  de  detalle
        estudiosUltra = data;
    });
    await rellenarSelect('#select-rx', "precios_api", 7, 'ID_SERVICIO', 'ABREVIATURA.SERVICIO.DIAS_DE_ENTREGA', {
        cliente_id: array_selected['CLIENTE_ID'],
        area_id: 8,
        recepcion: 1,
    }, function (data) {
        // Se usa en el hover  de  detalle
        estudiosRX = data;
    });
    await rellenarSelect('#select-otros', "precios_api", 7, 'ID_SERVICIO', 'ABREVIATURA.SERVICIO.DIAS_DE_ENTREGA', {
        cliente_id: array_selected['CLIENTE_ID'],
        area_id: 0,
        recepcion: 1
    }, function (data) {
        // Se usa en el hover  de  detalle
        estudiosOtros = data;
    });

    await rellenarSelect('#select-vendedor', 'usuarios_api', 2, 'ID_USUARIO', 'nombrecompleto', {}, () => {
        $('#select-vendedor').val(0).trigger("change")
    })


    await rellenarSelect('#select-recepcion-medicos-tratantes', 'medicos_tratantes_api', 2, 'ID_MEDICO', 'NOMBRE_MEDICO', {}, () => {
        $('#select-recepcion-medicos-tratantes').val(0).trigger('change');
    })

    // Convertir los objetos en arrays
    const lab = Object.values(estudiosLab);
    const bio = Object.values(estudiosLabBio);
    const ultra = Object.values(estudiosUltra);
    const rx = Object.values(estudiosRX);
    const otros = Object.values(estudiosOtros);

    // Fusionar los arrays
    const arrayFusionado = [...lab, ...bio, ...ultra, ...rx, ...otros];

    // Convertir el array fusionado en un objeto con claves consecutivas
    estudiosTodos = {};
    arrayFusionado.forEach((item, index) => {
        estudiosTodos[index] = item;
    });
    estudiosTodos = Object.values(estudiosTodos);
})

$("#btn-obtenerID").click(function () {
    $.ajax({
        url: "../../../api/archivos/imagen_paciente.php",
        type: "POST",
        data: {
            api: 1
        },
        success: function (data) {
            data = jQuery.parseJSON(data);
            $("#image-perfil").attr("src", "identificacion/" + data[2]);
            url_paciente = `https:bimo-lab.com/\${appname}/vista/menu/recepcion/identificacion/${data[2]}`;
            url_paciente = data;
        }
    });
})

$('#formAceptarPacienteRecepcion').submit(function (event) {
    event.preventDefault();

    let dataJson = {
        api: 2,
        url: url_paciente,
        id_turno: array_selected['ID_TURNO'],
        estado: 1,
        comentario_rechazo: $('#Observaciones-aceptar').val(),
        alergias: $('#alergias-aceptar-paciente').val(),
        diagnostico: $('#diagnostico-aceptar-paciente').val(),
        segmento_id: $('#select-segmento-aceptar').val(),
        servicios: estudiosEnviar,
        medico_tratante: $('#medico-aceptar-paciente').val(),
        medico_correo: $('#medico-correo-aceptar').val(),
        vendedor: $('#select-vendedor').val(),
        nuevo_medico: 0,
        medico_tratante_id: 0,
        folio: $('#input-cotizacion').val()
    }

    // Envío de detalles de servicios cargados por medio de un folio de cotizacion
    if ($("#input-cotizacion").val()) {
        dataJson['servicios_detalles'] = JSON.stringify(detallesEstudiosCotizacion);
    }

    if ($("#comoNosConociste").length > 0) {
        dataJson['como_nos_conociste'] = $('#comoNosConociste').val()
    }

    if ($("#checkBox-NewMedico").is(":checked")) {
        dataJson['medico_tratante'] = $('#medico-aceptar-paciente').val()
        dataJson['medico_correo'] = $('#medico-correo-aceptar').val()
        dataJson['medico_telefono'] = $('#medico-telefono-aceptar').val()
        dataJson['medico_especialidad'] = $('#medico-especialidad-aceptar').val()
        dataJson['nuevo_medico'] = 1
    } else {
        dataJson['medico_tratante_id'] = $('#select-recepcion-medicos-tratantes').val();
    }

    let paquete = '';
    if (!$('#checkPaqueteAceptar').is(":checked")) {
        if ($('#select-paquetes').val()) {
            dataJson['id_paquete'] = $('#select-paquetes').val()
            paquete = `Cargarás el paquete ${$('#select-paquetes option:selected').text()} \n`
        }
    }

    alertMensajeConfirm({
        title: `${paquete}¿Está seguro de aceptar el paciente?`,
        text: "¡Recuerda revisar que todo este en orden!",
        icon: paquete !== '' ? 'warning' : 'info',
        confirmButtonText: "Aceptar",
        allowOutsideClick: false
    }, function () {
        ajaxAwaitFormData(dataJson, 'recepcion_api', 'formAceptarPacienteRecepcion', {
            callbackAfter: true,
            callbackBefore: true
        }, () => {
            alertMensaje('info', 'Aceptando paciente', 'Espere un momento mientras el sistema carga al paciente')
        }, (data) => {
            Swal.fire({
                position: 'center',
                icon: 'success',
                title: 'Turno: ' + data.response.data[1]['TURNO'],
                text: '¡Paciente aceptado! Recuerda generar sus documentos.',
                showCloseButton: false,
            })
            limpiarFormAceptar();
            $("#modalPacienteAceptar").modal("hide");
            tablaRecepcionPacientes.ajax.reload();
        }).then(r => {
        })
    }, 1)

    event.preventDefault();
})

// Create an observer instance.
$('#btn-AgregarEstudioLab').on('click', function () {
    let text = $("#select-lab option:selected").text();
    let id = $("#select-lab").val();
    validarEstudiosLab = 1;
    actualizarTotal(id, estudiosLab, true)
    agregarFilaDiv('#list-estudios-laboratorio', text, id)
})
var Obserlab = new MutationObserver(function (mutations) {
    if ($('#list-estudios-laboratorio').children().length == 0 || array_selected['CLIENTE_ID'] != 1) {
        validarEstudiosLab = 0;
    }
}); // Pass in the target node, as well as the observer options.
Obserlab.observe(document.querySelector('#list-estudios-laboratorio'), {
    attributes: true,
    childList: true,
    characterData: true
});

$('#btn-agregarEstudioRX').on('click', function () {
    let text = $("#select-rx option:selected").text();
    let id = $("#select-rx").val();
    actualizarTotal(id, estudiosRX, true)
    agregarFilaDiv('#list-estudios-rx', text, id)
})
var ObserRX = new MutationObserver(function (mutations) {
    if ($('#list-estudios-rx').children().length == 0 || array_selected['CLIENTE_ID'] != 1) {
        validarEstudiosRX = 0;
        // $('#file-r-x').prop('required', false);
    } else {
        // $('#file-r-x').prop('required', true);
    }
});
ObserRX.observe(document.querySelector('#list-estudios-rx'), {
    attributes: true,
    childList: true,
    characterData: true
});

$('#btn-agregarEstudioImg').on('click', function () {
    let text = $("#select-us option:selected").text();
    let id = $("#select-us").val();
    actualizarTotal(id, estudiosUltra, true)
    agregarFilaDiv('#list-estudios-ultrasonido', text, id)
})
var ObserULTRSONIDO = new MutationObserver(function (mutations) {
    if ($('#list-estudios-ultrasonido').children().length == 0 || array_selected['CLIENTE_ID'] != 1) {
        validarEstudiosImg = 0;
    }
});
ObserULTRSONIDO.observe(document.querySelector('#list-estudios-ultrasonido'), {
    attributes: true,
    childList: true,
    characterData: true
});

$('#btn-agregarEstudioOtros').on('click', function () {
    let text = $("#select-otros option:selected").text();
    let id = $("#select-otros").val();
    actualizarTotal(id, estudiosOtros, true)
    agregarFilaDiv('#list-estudios-otros', text, id)
})
var ObserOtros = new MutationObserver(function (mutations) {
    if ($('#list-estudios-otros').children().length == 0 || array_selected['CLIENTE_ID'] != 1) {
        validarEstudiosOtros = 0;
    }
});
ObserOtros.observe(document.querySelector('#list-estudios-otros'), {
    attributes: true,
    childList: true,
    characterData: true
});

$('#btn-AgregarEstudioLabBio').on('click', function () {
    let text = $("#select-labbio option:selected").text();
    let id = $("#select-labbio").val();
    actualizarTotal(id, estudiosLabBio, true)
    agregarFilaDiv('#list-estudios-laboratorio-biomolecular', text, id)
})
var ObserOtros = new MutationObserver(function (mutations) {
    if ($('#list-estudios-laboratorio-biomolecular').children().length == 0 || array_selected['CLIENTE_ID'] != 1) {
        validarEstudiosOtros = 0;
    }
});
ObserOtros.observe(document.querySelector('#list-estudios-laboratorio-biomolecular'), {
    attributes: true,
    childList: true,
    characterData: true
});

$(document).on('click', '.eliminarfilaEstudio', function () {
    let id = $(this).attr('data-bs-id');
    actualizarTotal(id, estudiosTodos, false)
    eliminarElementoArray(id);
    var parent_element = $(this).closest("li[class='list-group-item']");
    $(parent_element).remove()

});

function agregarFilaDiv(appendDiv, text, id) {
    estudiosEnviar.push(id)
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

function eliminarElementoArray(id) {
    estudiosEnviar = jQuery.grep(estudiosEnviar, function (value) {
        return value != id;
    });
}

function limpiarFormAceptar() {
    $('#list-estudios-laboratorio').html('')
    $('#file-laboratorio').val('');
    $('#list-estudios-laboratorio-biomolecular').html('')
    $('#list-estudios-rx').html('')
    $('#file-r-x').val('');
    $('#list-estudios-ultrasonido').html('')
    $('#file-ultra-sonido').val('');
    $('#list-estudios-otros').html('')
    $('#Observaciones-aceptar').val('')
    $('#aceptar-totalCargado').html('$0.00')

    validarEstudiosLab = 0;
    validarEstudiosRX = 0;
    validarEstudiosImg = 0;
    validarEstudiosOtros = 0;
    estudiosEnviar = [];
    totalAcumulado = 0;  //Precio final

    // New set page
    const page = 'SecondPage-aceptar';
    const next = 'FirstPage-aceptar';

    $('button.SecondPage-aceptar, button.FirstPage-aceptar').attr('disabled', true);
    const btn = $(`button.${next}`);

    $(`.${page}:not(button)`).fadeOut('fast');

    btn.attr('disabled', false) // btn.fadeIn(0);
    setTimeout(() => {
        $(`.${next}:not(button)`).fadeIn('fast') // btn.attr('disabled', false)
    }, 100);

    // Medico tratante
    $(`#${'checkBox-NewMedico'}`).prop('checked', false)
    $("#CollapseNuevoMedico").collapse("hide");
    $('#select-recepcion-medicos-tratantes').attr('disabled', false)
    $('.input-new-medico').val('');
    $('#select-recepcion-medicos-tratantes').val(0)
}

$('.SecondPage-aceptar:not(button)').fadeOut(0);
$('button.SecondPage-aceptar').attr('disabled', true);
$('.pagination-aceptar').on('click', function (e) {
    e.preventDefault();

    const page = $(this).attr('page');
    const next = $(this).attr('nextPage');

    $('button.SecondPage-aceptar, button.FirstPage-aceptar').attr('disabled', true);
    const btn = $(`button.${next}`);

    $(`.${page}:not(button)`).fadeOut('fast');
    // btn.fadeIn(0);
    btn.attr('disabled', false)
    setTimeout(() => {
        $(`.${next}:not(button)`).fadeIn('fast')
        // btn.attr('disabled', false)
    }, 100);

})

// Variable global para almacenar el total acumulado
let totalAcumulado = 0;

$('#checkPaqueteAceptar, #select-paquetes').on('change', function () {
    const id = $('#select-paquetes').val();
    const paquete = PaquetesDatos.find(paquete => paquete.ID_PAQUETE == id);
    const total = parseFloat(paquete.PRECIO_VENTA);

    if (!$('#checkPaqueteAceptar').prop('checked')) {
        $('#aceptar-totalPaqueteCargado').text(`$${parseFloat(total).toFixed(2)}`);
    } else {
        $('#aceptar-totalPaqueteCargado').text('$0.00');
    }
});

var checkedNewMedico = false;
// Cuando cambie el estado del checkbox
$(`#${'checkBox-NewMedico'}`).change(function () {
    if (this.checked) {
        // bloquea el select y muestra ambos campos
        $("#CollapseNuevoMedico").collapse("show");
        $('#select-recepcion-medicos-tratantes').attr('disabled', true)
        checkedNewMedico = true;
    } else {
        // desbloquea el select y oculta los campos
        $("#CollapseNuevoMedico").collapse("hide");
        $('#select-recepcion-medicos-tratantes').attr('disabled', false)
        $('.input-new-medico').val('');
        checkedNewMedico = false;
    }
});

function actualizarTotal(id, servicios, sumar = true) {
    const servicio = servicios.find(servicio => servicio.ID_SERVICIO == id);
    if (servicio) totalAcumulado += sumar ? parseFloat(servicio.PRECIO_VENTA) : -parseFloat(servicio.PRECIO_VENTA);

    $('#aceptar-totalCargado')
        .html(`$${totalAcumulado.toFixed(2)}`); // Actualizar el elemento HTML con el total acumulado
}

$('#select-recepcion-medicos-tratantes').on('change', async function () {
    var valorSeleccionado = $(this).val();

    if(checkedNewMedico || !valorSeleccionado) {
        $('#detalles-medicos-tratante').addClass('d-none');
    } else {
        $('#detalles-medicos-tratante').removeClass('d-none')
    }

    if (valorSeleccionado) {
        alertToast('Recuperando información', 'info');

        await ajaxAwait({
            api: 24,
            id_medio: $('#select-recepcion-medicos-tratantes').val()
        }, 'recepcion_api', {callbackAfter: true}, false, (data) => {
            const response = data.response.data[0];
            console.log(response);

            $('#medico_tratante_email_actualizar').val(response.EMAIL);
            $('#medico_tratante_phone_actualizar').val(response.TELEFONO);
            $('#medico_tratante_especialidad_actualizar').val(response.ESPECIALIDAD);
        });
    }
});

$('#btn-actualiza-datos-medico').on('click', async function () {
    const idMedico = $('#select-recepcion-medicos-tratantes').val();
    const correo = $('#medico_tratante_email_actualizar').val();
    const telefono = $('#medico_tratante_phone_actualizar').val();
    const especialidad = $('#medico_tratante_especialidad_actualizar').val();

    await  ajaxAwait({
        api: 23,
        id_medio: idMedico,
        medico_tratante_correo: correo,
        medico_tratante_telefono: telefono,
        medico_tratante_especialidad: especialidad
    }, 'recepcion_api', {callbackAfter: true}, false, (data) => {
        alertToast('Información actualizada exitosamente', 'success')
    });
});