
// |------------------------- Información del paciente -------------------------|
// Arma los datos y formulario
async function getDataFirst(type) {

    // Resetea el formulario
    resetForm();

    //Pruebas
    await rellenarSelect("#select-labClinico", "precios_api", 7, 'ID_SERVICIO', 'ABREVIATURA.SERVICIO', {
        cliente_id: session['CLIENTE_ID'],
        area_id: 6,
    });
    await rellenarSelect("#select-labBio", "precios_api", 7, 'ID_SERVICIO', 'ABREVIATURA.SERVICIO', {
        cliente_id: session['CLIENTE_ID'],
        area_id: 12,
    });

    if (type === '2') {
        await rellenarSelect("#paciente_existente", "maquilas_api", 3, 'ID_SERVICIO', 'FOLIO.PACIENTE.SIHO_CUENTA.TIPO_SOLICITUD', {
            cliente_id: session['id_cliente'], bit_solitudes: 1 //<--- para todos
        });
    } else {
        console.log('Hola client')
    }
    return 1;
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

    // Llamar a esta función para reiniciar
    restartPages();
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
                html += '<i class="bi bi-arrow-right-short"></i><strong>' + row[i]['MUESTRA'] + '</strong> - <strong>' + row[i]['CONTENEDOR'] + '</strong></li>';

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
function muestrasInfoPaciente() {
    const nombre = `${$('#nombre-form-agregar').val()} ${$('#paterno-form-agregar').val()} ${$('#materno-form-agregar').val()}`
    $('#nombre-paciente').html(nombre)
    $('#fecha_de_nacimiento-paciente').html($('#nacimiento-form-agregar').val())
    $('#edad-paciente').html($('#edad-form-agregar').val())
    $('#curp-paciente').html($('#curp-form-agregar').val())
    $('#numero_cuenta-paciente').html($('#numero_cuenta-form-agregar').val())

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


// Obtener las etiquetas del paciente
$(document).on('click', '#btn-etiquetas-pdf', function (e) {
    e.preventDefault();
    e.stopPropagation();

    const btn = $(this)
    // Obtener URL para abrir
    api = encodeURIComponent(window.btoa('laboratorio'));
    area = encodeURIComponent(window.btoa(-1));
    turno = encodeURIComponent(window.btoa(btn.attr('data-bs-turno_guardado')));

    var win = window.open(`http://localhost/nuevo_checkup/visualizar_reporte/?api=${api}&turno=${turno}&area=${area}`, '_blank')

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
        // Envia fotos para guardarlo
        ajaxAwaitFormData({
            servicios: estudiosEnviar,
            api: 2,
        }, 'maquilas_api', 'formAgregarPaciente', { callbackAfter: true }, false, async (data) => {

            const row = data.response.data;

            // Guarda el turno que se ha hecho
            turno = row.ID_TURNO;

            let folio_empresa = row.FOLIO;
            $('#folio-paciente').html(folio_empresa);

            // Muestra la información que se guardo en la base;
            muestrasInfoPaciente(); // Muestra información del paciente

            $('#btn-etiquetas-pdf').attr('data-bs-turno_guardado', turno)

            // alertMensajeConfirm({
            //     title: ''
            // })

            await getListMuestras(turno); // Obtiene las muestras
            btnEstatus(2); // Cambia de botones
            combinePages('page_control-agregar_paciente', 1) // Cambia de pagina
            swal.close();
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

    // actualizarTotal(id, estudiosLab, true)
    agregarFilaDiv(`#${id_list}`, text, id)
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



// |------------------------- Posicion entre paginas -------------------------|

// Movilidad de tablet o paginacion
let isAnimating = false;
function updatePage($newPage, direction) {
    const $currentVisiblePage = $('.page:visible');
    const $prevButton = $('button.control-pagina-interpretacion[target="back"]')
    const $nextButton = $('button.control-pagina-interpretacion[target="next"]')

    //     // Verificar si es la última página
    if ($newPage.is('.page:last')) {
        $('.pagination-interpretacion').fadeIn(400);
    } else {
        $('.pagination-interpretacion').hide();
    }
    // });
    if (!direction) {
        $newPage.show();
        $currentVisiblePage.hide();
        return;
    }

    if (isAnimating) return;  // Si una animación está en curso, no hacemos nada

    isAnimating = true;  // Establecer el semáforo a verdadero

    if (direction === 'next') {
        $currentVisiblePage.addClass('animate__animated animate__slideOutLeft');
        $newPage.show().addClass('animate__animated animate__slideInRight');
    } else if (direction === 'back') {
        $currentVisiblePage.addClass('animate__animated animate__slideOutRight');
        $newPage.show().addClass('animate__animated animate__slideInLeft');
    }

    $currentVisiblePage.one('animationend', function () {
        $currentVisiblePage.removeClass('animate__animated animate__slideOutLeft animate__slideOutRight').hide();
    });

    $newPage.one('animationend', function () {
        $newPage.removeClass('animate__animated animate__slideInRight animate__slideInLeft');
        isAnimating = false;

        // Determinar la página actual y ajustar la visibilidad de los botones
        const isFirstPage = $newPage.is($('.page').first());
        const isLastPage = $newPage.is($('.page').last());


        $prevButton.attr('disabled', isFirstPage ? true : false)
        $nextButton.attr('disabled', isLastPage ? true : false)
    });
}


$(document).on('click', '.control-pagina-interpretacion', function (event) {
    event.preventDefault();
    event.stopPropagation();
    const $btn = $(this);
    const action = $btn.attr('target');
    const $visiblePage = $('.page:visible');
    console.log($visiblePage)
    switch (action) {
        case 'back':
            const $prevPage = $visiblePage.prev('.page');
            console.log($visiblePage.prev('.page'))
            if ($prevPage.length) {
                updatePage($prevPage, action);
            }
            break;
        case 'next':
            const $nextPage = $visiblePage.next('.page');
            console.log($visiblePage.next('.page'))
            if ($nextPage.length) {
                updatePage($nextPage, action);
            }
            break;
        default:
            break;
    }
});



// Inicializamos mostrando la primera página
// updatePage($('.page').first());
function restartPages() {
    // Ocultar todas las páginas
    $('.page').hide();

    // Mostrar la primera página sin animación
    $('.page').first().show();
}

// Llamar a esta función para reiniciar
restartPages();