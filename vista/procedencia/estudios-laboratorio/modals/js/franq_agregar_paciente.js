
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


    // Resetea el canva o imagen de la orden medica
    $('.img-thumbnail').html('');

    // Orden Medica Info
    $('#nombre_orden-paciente').html('');
    $('#comentario_orden_paciente').html('');


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
async function getListMuestras() {
    return new Promise(resolve => {

        ajaxAwait({
            api: 12,
            servicios: arrayATexto(estudiosEnviar)
        }, 'maquilas_api', { callbackAfter: true }, false, (data) => {
            let row = data.response.data;
            console.log(row);

            let html = '';
            for (var i = 0; i < row.length; i++) {
                // console.log(row[i]);
                html += '<li class="list-group-item">';
                html += row[i]['NOMBRE'];
                html += `<i class="bi bi-arrow-right-short"></i><strong>${row[i]['TUBO']}</strong> - <strong>${row[i]['MUESTRA']}</strong> - <strong>${row[i]['DURACION']} <br/> <strong>${row[i]['INDICACIONES']}</strong>
                </li>`;

            }
            $('.lista-estudios-paciente').html(html);

            resolve(1);
        })

    });
}

// Cambia la forma de los botones
function btnEstatus(key) {
    // Primera pagina
    $('.btn-footers').fadeOut(0);
    $('.btn-footers').prop('disabled', true);

    switch (key) {
        case 1:
            $('.page-formulario').fadeIn(0).prop('disabled', false);
            break; // Primera pagina
        case 2:
            // Quita los botones antes de guardar
            $('.page-formulario').fadeOut(0).prop('disabled', true);
            $('#GuardarFormulario').fadeOut(0).prop('disabled', true);

            $('.page-etiquetas').fadeIn(0).prop('disabled', false);
            break; // Segunda pagina
        case 3:
            $('.page-etiquetas, .page-proceso_final').fadeIn(0).prop('disabled', false);
            break; // Reinicio
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
function previewInfoPaciente(data) {
    return new Promise(resolve => {

        ajaxAwait({
            api: 2, id: $('#paciente_existente').val()
        }, 'pacientes_api', { callbackAfter: true }, false, (data) => {
            console.log(data);
            muestraDataPaciente(data.response.data[0])
            resolve(1);
        })

    });

}

//Usa datos del formulario y los muestra en la section 3
function muestraDataPaciente(data) {
    // Variables
    const nombreClass = `${$('#nombre-form-agregar').val()} ${$('#paterno-form-agregar').val()} ${$('#materno-form-agregar').val()}`
    const tipo = $('input[name="tipo"]:checked').val()

    // Informacion del paciente
    $('.nombre-paciente').html(ifnull(data, nombreClass, ['NOMBRE_COMPLETO']))
    $('.fecha_de_nacimiento-paciente').html(formatoFecha(ifnull(data, $('#nacimiento-form-agregar').val(), ['NACIMIENTO'])))
    $('.edad-paciente').html(formatoEdad(ifnull(data, $('#edad-form-agregar').val(), ['EDAD'])))
    $('.curp-paciente').html(ifnull(data, $('#curp-form-agregar').val(), ['CURP']))

    $('.numero_cuenta-paciente').html($('#numero_cuenta-form-agregar').val())
    $('.area-paciente').html($('#area-form-agregar').val()) // Revisar luego


    $('.genero-paciente').html(ifnull(data, $('.required_input_agregar_paciente').val(), ['GENERO']))


    // Comentario de la orden
    $('.comentario_orden-paciente').html(ifnull(data, $('.comentarios_orden').val()))


    if (tipo === "1") {
        $('.tipo_solicitud-paciente').html(`<span class="text-warning tipo_solicitud-paciente"
                                            id="tipo_solicitud-paciente"><strong>Ordinario</strong></span>`)
    } else {
        $('.tipo_solicitud-paciente').html(`<span class="text-danger tipo_solicitud-paciente"
                                            id="tipo_solicitud-paciente"><strong>Urgente</strong></span>`)
    }

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



    // Obtén el archivo del input
    var file = inputArea.get(0).files[0];
    // Obten el nombre
    var nombreArchivo = inputArea.val().split('\\').pop();

    // Verifica si el archivo es un PDF
    if (file.type === 'application/pdf') {
        // Muestra el canvas y oculta el img
        $('#pdf-canvas').show();
        $('#image-preview').hide();

        // Usa PDF.js para leer y mostrar la primera página del PDF
        var fileReader = new FileReader();
        fileReader.onload = function () {
            var typedarray = new Uint8Array(this.result);
            pdfjsLib.getDocument(typedarray).promise.then(function (pdf) {
                pdf.getPage(1).then(function (page) {
                    var canvas = document.getElementById('pdf-canvas');
                    var ctx = canvas.getContext('2d');
                    var viewport = page.getViewport({ scale: 2 });
                    canvas.height = viewport.height;
                    canvas.width = viewport.width;
                    var renderContext = {
                        canvasContext: ctx,
                        viewport: viewport
                    };
                    page.render(renderContext);
                });
            });
        };
        fileReader.readAsArrayBuffer(file);
    } else if (file.type.match('image.*')) {
        // Muestra el img y oculta el canvas
        $('#image-preview').show();
        $('#pdf-canvas').hide();

        // Lee y muestra la imagen
        var reader = new FileReader();
        reader.onload = function (e) {
            $('#image-preview').attr('src', e.target.result).show();
        };
        reader.readAsDataURL(file);
    } else {
        alert('Por favor, selecciona un archivo PDF o una imagen.');
    }



    // Vista previa final
    $('#nombre_orden-paciente').html(nombreArchivo);
    $('#comentario_orden_paciente').html(ifnull($('#comentario_orden_agregar-paciente').val(), ''))

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

    // Verifica nuevamente si existe o no datos
    if (controlFormsPages("1", 'next') || controlFormsPages("2", 'next') || controlFormsPages("3", 'next')) {
        return false;
    }


    alertMensajeConfirm({
        title: '¿Está seguro de cargar este nuevo paciente y sus estudios?',
        text: 'No podrás revertir esta opción',
        confirmButtonText: 'Si, aceptar',
        cancelButtonText: 'No estoy seguro',
    }, () => {

        alertMsj({
            title: '¡Genial, todo en orden!',
            text: 'Cargando todos los datos, espere un momento',
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
            // muestrasInfoPaciente(row); // Muestra información del paciente

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
$(document).on('click', '.btn_submit_tomarmuestra', function (e) {
    e.preventDefault();
    e.stopPropagation();

    const botonGuardarMuestra = $(this);
    const input = botonGuardarMuestra.closest('div.div_muestraTomada').find('input');
    // const botonGuardarMuestra = form.find('.btn_submit_tomarmuestra'); // Encuentra el botón dentro del formulario


    alertMensajeConfirm({
        title: '¿Está seguro de cargar correctamente la fecha de toma?',
        text: 'No podrás modificarlo luego.',
        icon: 'warning',
    }, () => {
        // Datos a enviar
        const data_json = { api: 9, id_turno: turno, fecha_toma: input.val() };
        ajaxAwait(data_json, 'maquilas_api', { callbackAfter: true }, false, () => {
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
$(document).on('click', '.control-pagina-interpretacion', async function (event) {
    event.preventDefault();
    event.stopPropagation();

    if (time_click === 0) {
        time_click = 1; // Bloquea clicks adicionales hasta que la animación termine

        const $btn = $(this); // Botón actual que se clickeó
        const action = $btn.attr('target'); // Acción del botón (next, back)
        const $visiblePage = $('.page:visible'); // Página actualmente visible

        // Bloquea el botón del formulario por defecto
        $('#GuardarFormulario').prop('disabled', true);

        // Determina la página objetivo basándose en la acción
        const $targetPage = action === 'back' ? $visiblePage.prev('.page') : $visiblePage.next('.page');

        if (controlFormsPages($visiblePage.attr('actual-page'), action)) {
            time_click = 0; // Si falta por rellenar campos
            return false;
        }

        // Carga las muestras a cargar y cargadas del paciente
        if ($visiblePage.attr('actual-page') === "3" && action === 'next') {
            alertMsj({
                title: '¡Genial, espera un momento!',
                text: 'Estamos preparando todo.',
                showCancelButton: false, showConfirmButton: false,
                icon: 'info'
            })
            await getListMuestras();
            if (form_type) {
                await previewInfoPaciente();
            } else {
                muestraDataPaciente();
            }
            swal.close();
        }

        // Resetea el estado de deshabilitado en los controles de página
        $('.control-pagina-interpretacion').prop('disabled', false);
        console.log('hola, if')
        if ($targetPage.length) {
            console.log($targetPage);
            updatePage($targetPage, action); // Actualiza la página mostrada

            // Si es la primera o última página, ajusta los controles de navegación
            if ($targetPage.attr('control-page') === 'first') {
                $btn.prop('disabled', true); // Deshabilita botón si es la primera página
            } else if ($targetPage.attr('control-page') === 'last') {
                $btn.prop('disabled', true); // Deshabilita botón si es la última página
                $('#GuardarFormulario').prop('disabled', false); // Habilita el botón del formulario
            }
        }
    }

    // Permite clics después de que la animación haya terminado
    setTimeout(() => {
        time_click = 0;
    }, 350); // Asume que 350ms es la duración de la animación
});

// Verifica cada pagina 
function controlFormsPages(page, action) {
    if (action === 'back')
        return false; // Permite continuar flujo

    switch (page) {
        case "1":
            // Verificar cada campo requerido
            if (!form_type)
                if (requiredInputLeft('formAgregarPaciente')) {
                    alertToast('¡Hay información del paciente que falta rellenar!')
                    return true;
                }
            break;
        case "2":
            // Verificar la orden medica
            const ordenM = $('#input_ordenMedica').val();
            if (ordenM === null || ordenM === undefined || ordenM === '') {
                alertToast('¡No olvide cargar la orden médica!', 'info', 4000)
                return true;
            }

            break;

        case "3":

            // Verifica si hay cargos disponibles
            if (estudiosEnviar.length < 1) {
                alertToast('¡Recuerde cargar los estudios del paciente!', 'info', 4000)
                return true;
            }

            // Verifica si hay algún botón de radio seleccionado para el grupo 'tipo'
            if (!($('input[name="tipo"]:checked').length > 0)) {
                alertToast('¡Selecciona el tipo de solicitud del paceinte!')
                return true;
            }

            break;

    }

    return false;
}