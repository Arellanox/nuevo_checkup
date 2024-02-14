
// |------------------------- Información del paciente -------------------------|
// Arma los datos y formulario
async function getDataFirst(type) {
    return new Promise(async function (resolve, reject) {

        // Resetea el formulario
        resetForm();
        // Llamar a esta función para reiniciar la paginacion
        restartPages('page_control-agregar_paciente');


        turno = false;

        //Pruebas a cargar
        await rellenarSelect("#select-labClinico", "precios_api", 7, 'ID_SERVICIO', 'ABREVIATURA.SERVICIO', {
            cliente_id: session['id_cliente'],
            area_id: 6,
        });
        await rellenarSelect("#select-labBio", "precios_api", 7, 'ID_SERVICIO', 'ABREVIATURA.SERVICIO', {
            cliente_id: session['id_cliente'],
            area_id: 12,
        });

        // Lista de pacientes para que busquen y seleccionen más facilmente
        if (type === '2') {
            await rellenarSelect("#paciente_existente", "maquilas_api", 6, 'PACIENTE_ID', 'FOLIO.NOMBRE.SIHO_CUENTA.TIPO_SOLICITUD');

            $('#formAgregarPaciente .required_input_agregar_paciente').removeAttr('required')
        } else {
            $('#formAgregarPaciente input.required_input_agregar_paciente').attr('required', true)
            console.log('Hola client')
        }

        // Proceso final para abrir modal y cerrar ventana de aviso
        $('#AgregarNuevoPaciente').modal('show');
        swal.close();

        // Confirma que esta todo bien
        resolve(1)

    })

}

// Reinicia el formulario
function resetForm() {
    // Resetea la carga de orden medica
    input_ordenMedica.resetInputDrag();

    // Resetea los estudios que estaban cargados
    $('#list-estudios-laboratorio').html('')
    $('#list-estudios-laboratorio-biomolecular').html('')
    estudiosEnviar = new Array();

    // Elimina la muestra 
    $('#lista-estudios-paciente').html('');

    // Vacia el formulario
    $('#formAgregarPaciente').trigger("reset");
    $('#btn-etiquetas-pdf').attr('data-bs-turno_guardado', false)



    // Boton de muestra
    // Cambiar el boton
    $('.btn_submit_tomarmuestra').attr('disabled', false) // Deshabilita el botón para prevenir clics adicionales
        .addClass('btn-confirmar') // Opcional: remover la clase original si deseas
        .removeClass('btn-success') // Cambia a color verde
        .html('<i class="bi bi-droplet-half"></i> Tomar Muestra'); // Cambia el contenido del botón a "Muestra Tomada" y el ícono a una gota de agua llena

    // Llamar a esta función para reiniciar
    restartPages('page_control-agregar_paciente');
    btnEstatus(1); // Primera pagina
}

// Mostrar las muestras en lista (Pagina 2)
function getListMuestras(idturno = null) {
    return new Promise(resolve => {

        ajaxAwait({ api: 2, id_turno: idturno }, 'toma_de_muestra_api', { callbackAfter: true, WithoutResponseData: true }, false, (row) => {
            let html = '';
            for (var i = 0; i < row.length; i++) {
                // console.log(row[i]);
                html += '<li class="list-group-item">';
                html += row[i]['GRUPO'];
                html += '<i class="bi bi-arrow-right-short"></i><strong>' + row[i]['MUESTRA'] + '</strong> - <strong>' + row[i]['CONTENEDOR'] + '</strong> - <strong>' + row[i]['ENTREGA'] + '</strong></li>';

            }
            $('#lista-estudios-paciente').html(html);

            resolve(1);
        });


    });
}

// Cambia la forma de los botones
function btnEstatus(key) {
    // Primera pagina
    $('.btn-footers').fadeOut(0);
    $('.btn-footers').prop('disabled', true);

    switch (key) {
        case 1: $('.page-formulario').fadeIn(0).prop('disabled', false); break; // Primera pagina
        case 2: $('.page-etiquetas').fadeIn(0).prop('disabled', false); break; // Segunda pagina
        case 3: $('.page-etiquetas, .page-proceso_final').fadeIn(0).prop('disabled', false); break; // Reinicio
    }
}

// Cambia el formulario dependiendo cual es cual
function tipoFormulario(tipo) {
    $('.form_control_type').fadeOut(0);
    if (tipo === '1') {
        $('.agregar_paciente_form').fadeIn(1);
    } else {
        $('#nueva_solicitd_paciente_form').fadeIn(1);
    }
}

// Usa datos del formulario y lo muestra en muestras
function muestrasInfoPaciente(data) {
    const nombre = `${$('#nombre-form-agregar').val()} ${$('#paterno-form-agregar').val()} ${$('#materno-form-agregar').val()}`
    $('#nombre-paciente').html(ifnull(data, nombre, ['NOMBRE']))
    $('#fecha_de_nacimiento-paciente').html(ifnull(data, $('#nacimiento-form-agregar').val(), ['NACIMIENTO']))
    $('#edad-paciente').html(ifnull(data, $('#edad-form-agregar').val(), ['EDAD']))
    $('#curp-paciente').html(ifnull(data, $('#curp-form-agregar').val(), ['CURP']))
    $('#numero_cuenta-paciente').html(ifnull(data, $('#numero_cuenta-form-agregar').val(), ['CUENTA']))

    // Informacion de usuario
    $('#usuario-paciente').html(`${session.nombre} ${session.apellidos}`)
}



// Cancela el proceso y reinicia todo
$(document).on('click', '.btn-cerrar_modal', function (event) {
    event.preventDefault();
    event.stopPropagation();

    const btn = $(this).attr('data-bs-cancelar');
    // Solo cierra modal pero uno pregunta
    if (btn === '1') {
        $('#AgregarNuevoPaciente').modal('hide');
    } else {
        alertMensajeConfirm({
            title: '¿Seguro que quieres cancelar?',
            text: '¡El progreso se borrará si no lo has guardado!',
            confirmButtonText: 'Si, aceptar',
            cancelButtonText: 'No estoy seguro',
        }, () => {

            $('#AgregarNuevoPaciente').modal('hide');
        }, 1)

    }
})

// Reinicias el formulario
$(document).on('click', '#reset-agregarPaciente', function (event) {
    event.preventDefault();

    // Reiniciamos formulario
    resetForm();

    // Regresamos a primera vista
    restartPages('page_control-agregar_paciente');

})


// Obtener las etiquetas del paciente
$(document).on('click', '#btn-etiquetas-pdf', function (e) {
    e.preventDefault();
    e.stopPropagation();

    const btn = $(this)
    // Obtener URL para abrir
    api = encodeURIComponent(window.btoa('etiquetas'));
    // area = encodeURIComponent(window.btoa(-1));
    turno = encodeURIComponent(window.btoa(btn.attr('data-bs-turno_guardado')));

    var win = window.open(`${http}${servidor}/${appname}/visualizar_reporte/?api=${api}&turno=${turno}`, '_blank')

    btnEstatus(3); // Abre el estado final para finalizar proceso
})


// |------------------------- Formulario -------------------------|

// Drag and drop
let input_ordenMedica = InputDragDrop('#dropPromocionalesBimo', (inputArea, salidaInput) => {

    // Siempre se ejecuta al final del proceso
    salidaInput({
        msj: { pregunta: 'Carga otro arrastrándolo' },
        dropArea_css: {
            background: 'rgb(200 254 216)', // Indicativo que hay algo cargado
        },
        strong: {
            class: 'none-p',
            borderBottom: '1px solid'
        }
    });
})




// Submit de formulario
let turno;
$(document).on('submit', '#formAgregarPaciente', function (event) {
    event.preventDefault();
    event.stopPropagation();
    if (estudiosEnviar.length < 1) {
        alertToast('Recuerde cargar los estudios del paciente', 'info', 4000)
        return false;
    }

    const ordenM = $('#input_ordenMedica').val();

    if (ordenM === null || ordenM === undefined || ordenM === '') {
        console.log('Hola, no hay orden medica')
        alertToast('¡No olvide cargar la orden médica!', 'info', 4000)
        return false;
    }



    alertMensajeConfirm({
        title: '¿Está seguro de cargar este nuevo paciente y sus estudios?',
        text: 'No podrás revertir esta opción',
        confirmButtonText: 'Si, aceptar',
        cancelButtonText: 'No estoy seguro',
    }, () => {

        alertMsj({
            title: '¡Genial, espere un momento!',
            text: 'Esto puede tardar un rato, estamos configurando el proceso del paciente',
            showCancelButton: false, showConfirmButton: false,
            icon: 'info'
        })

        // Calcula y envia la edad del paciente
        let fecha_nacimiento = $('#nacimiento-form-agregar').val();
        let edad = calcularEdad(fecha_nacimiento);

        const data_json = {
            servicios: estudiosEnviar,
            api: 2, edad: edad
        }

        // Verificamos si estamos agregando un nuevo usuario o ya existente
        if (form_type) {
            data_json['id_paciente'] = $('#paciente_existente').val(); // <-- el que seleccionó el usuario
        }

        // Envia fotos para guardarlo
        ajaxAwaitFormData(data_json, 'maquilas_api', 'formAgregarPaciente', { callbackAfter: true }, false, async (data) => {

            const row = data.response.data;

            // Guarda el turno que se ha hecho
            turno = row.ID_TURNO;

            let folio_empresa = row.FOLIO;
            $('#folio-paciente').html(folio_empresa);

            // Muestra la información que se guardo en la base;
            muestrasInfoPaciente(row); // Muestra información del paciente

            $('#btn-etiquetas-pdf').attr('data-bs-turno_guardado', turno)

            // alertMensajeConfirm({
            //     title: ''
            // })

            tablaPacientes.ajax.reload();
            await getListMuestras(turno); // Obtiene las muestras
            btnEstatus(2); // Cambia de botones
            combinePages('page_control-agregar_paciente', 1) // Cambia de pagina
            swal.close();
        })
    }, 1)
})

// Guardar muestra
$(document).on('submit', '.form_guardarMuestra', function (e) {
    e.preventDefault();
    e.stopPropagation();

    const form = $(this);
    const botonGuardarMuestra = form.find('.btn_submit_tomarmuestra'); // Encuentra el botón dentro del formulario


    alertMensajeConfirm({
        title: '¿Está seguro de cargar correctamente la fecha de toma?',
        text: 'No podrás modificarlo luego.',
        icon: 'warning',
    }, () => {
        // Datos a enviar
        const data_json = { api: 9, id_turno: turno };
        ajaxAwaitFormData(data_json, 'maquilas_api', '', { callbackAfter: true, formJquery: form }, false, () => {
            alertToast('¡Fecha de muestra guardada!', 'success', 4000)

            tablaPacientes.ajax.reload();
            $('#ModaltomarMuestra').modal('hide');

            // Cambiar el boton
            botonGuardarMuestra.attr('disabled', true) // Deshabilita el botón para prevenir clics adicionales
                .removeClass('btn-confirmar') // Opcional: remover la clase original si deseas
                .addClass('btn-success') // Cambia a color verde
                .html('<i class="bi bi-droplet-fill"></i> Muestra Tomada'); // Cambia el contenido del botón a "Muestra Tomada" y el ícono a una gota de agua llena


        })
    }, 1)

})


// |--------------------------------Agregar nuevo estudio---------------------------------------|

// Procedimiento para agregar nuevo estudio
// variables a usar
var estudiosEnviar = new Array(); // <-- Contiene los estudios a cargar
// Agrega estudio que buscó
$(document).on('click', '.btn-agregar_estudio', function (event) {
    event.preventDefault();
    event.stopPropagation();

    const btn = $(this); // Busca el boton actual
    const text = $(`#${btn.attr('data-bs-selectID')} option:selected`).text(); // selecciona el texto
    const id = $(`#${btn.attr('data-bs-selectID')}`).val(); // Busca la ID del estudio actual
    console.log(id)
    const id_list = btn.attr('data-bs-divID') // Busca la id a donde mostrar


    // Verificamos si existe el estudio
    if (!estudiosEnviar.includes(id)) {
        // actualizarTotal(id, estudiosLab, true)
        agregarFilaDiv(`#${id_list}`, text, id)
    } else {
        alertToast('Este estudio ya ha sido seleccionado', 'info', 4000)
    }

})

// Elimina el estudio que fue agregado
$(document).on('click', '.eliminarfilaEstudio', function () {
    let id = $(this).attr('data-bs-id');

    // actualizarTotal(id, estudiosTodos, false)
    var parent_element = $(this).closest("li[class='list-group-item']"); // Busca el item de estudio
    $(parent_element).remove() // Remueve visual el estudio

    // Elimina el estudio a cargar
    estudiosEnviar = jQuery.grep(estudiosEnviar, function (value) {
        return value != id;
    });
});


// Crea el html item del estudio
function agregarFilaDiv(appendDiv, text, id) {
    estudiosEnviar.push(id);
    let html = `
        <li class="list-group-item">
            <div class="row">
                <div class="col-10 d-flex align-items-center">
                    ${text}
                </div>
                <div class="col-2">
                    <button type="button" class="btn btn-hover me-2 eliminarfilaEstudio" data-bs-id="${id}">
                        <i class="bi bi-trash"></i>
                    </button>
                </div>
            </div>
        </li>`;
    $(appendDiv).append(html);
}



// Aun sin usar
// Variable global para almacenar el total acumulado
let totalAcumulado = 0;
function actualizarTotal(id, servicios, sumar = true) {
    console.log(servicios);
    const servicio = servicios.find(servicio => servicio.ID_SERVICIO == id);
    if (servicio) {
        console.log(servicio);
        totalAcumulado += sumar ? parseFloat(servicio.PRECIO_VENTA) : -parseFloat(servicio.PRECIO_VENTA);
    }
    // Actualizar el elemento HTML con el total acumulado
    $('#aceptar-totalCargado').html(`$${totalAcumulado.toFixed(2)}`);
}



// Select2 
select2("#select-labClinico", "AgregarNuevoPaciente", 'Seleccione un estudio');
select2("#select-labBio", "AgregarNuevoPaciente", 'Seleccione un estudio');
select2("#paciente_existente", "AgregarNuevoPaciente", 'Cargando...');


// Previene a mas de un click
let time_click = 0;
$(document).on('click', '.control-pagina-interpretacion', function (event) {
    event.preventDefault();
    event.stopPropagation();
    const $btn = $(this);
    const action = $btn.attr('target');
    const $visiblePage = $('.page:visible');
    if (time_click == 0) {
        time_click = 1;

        switch (action) {
            case 'back':
                // Para regresar pagina
                const $prevPage = $visiblePage.prev('.page');
                // Resetea el bloqueado
                $('.control-pagina-interpretacion').prop('disabled', false);
                // Verifica si existe otra paginas
                if ($prevPage.length) {
                    updatePage($prevPage, action);
                }

                if ($prevPage.attr('control-page') === 'first') {
                    // Si es la primera pagina a mostrar
                    $btn.prop('disabled', true);
                }

                break;
            case 'next':
                // Para siguiente pagina
                const $nextPage = $visiblePage.next('.page');
                // Resetea el bloqueado
                $('.control-pagina-interpretacion').prop('disabled', false);
                // Verifica si existe otra paginas
                if ($nextPage.length) {
                    updatePage($nextPage, action);
                }

                if ($nextPage.attr('control-page') === 'last') {
                    // Si es la ultima pagina a mostrar
                    $btn.prop('disabled', true);
                }
                break;
            default:
                break;
        }

        setTimeout(() => {
            time_click = 0;
        }, 350); // <-- Tiempo en terminar de cargar una pagina
    }
});