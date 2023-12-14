//Variables
let title
let text
let recomenList;

let Recomendaciones = []; // array donde se guardaran las recomendaciones
// Abrir el model de formulario
$(document).on('click', '#btn-interpretacionPrequi', function () {

    $('#MostrarCapturaPrequirurjico').modal('show');
})

// Obtener el reporte previo
$('#btn-ver-reporte').click(function () {
    area_nombre = ''
    api = encodeURIComponent(window.btoa(area_nombre));
    turno = encodeURIComponent(window.btoa(dataSelect.array['turno']));
    area = encodeURIComponent(window.btoa(areaActiva));


    window.open(`${http}${servidor}/${appname}/visualizar_reporte/?api=${api}&turno=${turno}&area=${area}`, "_blank");
})


// // Enviar interpretacion a back
// $(`#formInterpretacion`).submit(function (e) {
//     e.preventDefault();

//     alertMensajeConfirm({
//         tittle: '¿Estás seguro de guardar la interpretacion',
//         text: 'Los cambios previos serán reemplazados al guardar',
//         icon: 'question'
//     }, function () {
//         ajaxAwaitFormData({
//             api: 2,
//         }, 'prequirurgico_api', 'formInterpretacion', { callbackAfter: true }, false, () => {
//             alert(1);
//         })
//     }, 1)
// })

// Evento click para agregar una recomendacion a la tabla en forma de lista
$(document).on('click', '#btn-agregarRecomendaciones', function (e) {

    // Sacamos la recomendacion
    let recomendacion = $('#recomendaciones_list').val();

    // se valida si el campo esta vacio
    if (recomendacion === '') {
        alertToast('El campo esta vacio', 'error', 2000);
        return false;
    }

    // Se agrega la recomendacion a la tabla
    tablalistRecomendaciones.row.add({
        "recomendacion": recomendacion
    }).draw();

    // seteamos el input cada que agregue una nueva recomendacion
    $('#recomendaciones_list').val('');
})

// metodo para eliminar la recomendacion de la tabla
$(document).on('click', '.eliminar_recomendacion', function () {
    // Obtener la fila que contiene el botón
    var fila = $(this).closest('tr');

    // Eliminar la fila de la DataTable y actualizar la vista
    tablalistRecomendaciones.row(fila).remove().draw();

    // Actualizar el contador después de eliminar una fila
    tablalistRecomendaciones.column(0, { search: 'applied', order: 'applied' }).nodes().each(function (cell, i) {
        cell.innerHTML = i + 1;
    });
});




// Tabla de la lista de recomendaciones
tablalistRecomendaciones = $('#tablalistRecomendaciones').DataTable({
    language: {
        url: "https://cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json",
    },
    lengthChange: false,
    info: false,
    paging: false,
    sorting: false,
    columns: [
        {
            data: null, render: function (data, type, row, meta) {
                return meta.row + 1;
            }
        },
        { data: 'recomendacion' },
        {
            data: null, render: () => {
                return ` <button class='btn btn-hover me-2 eliminar_recomendacion'>
                            <i class="bi bi-trash3"></i>
                        </button>`
            }
        }
    ],
    // scrollY: '75vh',
    // scrollCollapse: true,
})

inputBusquedaTable("tablalistRecomendaciones", tablalistRecomendaciones, [{
    msj: 'Tabla de recomendaciones  ',
    place: 'top'
}], {
    msj: "Filtre los resultados por la recomendacion que escriba",
    place: 'top'
}, "col-12")

// tabla para el modal en la seccion de laboratorios
tablaLaboratorios = $('#tablaLaboratorios').DataTable({
    language: {
        url: "https://cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json",
    },
    lengthChange: false,
    info: false,
    paging: false,
    sorting: false,
    // scrollY: '75vh',
    // scrollCollapse: true,
    columns: [
        { data: 'ID' },
        { data: 'SERVICIO' },
        { data: 'RESULTADO' }
    ],
    // scrollY: '75vh',
    // scrollCollapse: true,
})

inputBusquedaTable("tablaLaboratorios", tablaLaboratorios, [{
    msj: 'Tabla de los servicios de laboratorio  ',
    place: 'top'
}], {
    msj: "Filtre los resultados por el servicio que escriba",
    place: 'top'
}, "col-12")


// ============ Funciones para  la paginacion del modal by Gera ================================




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


$('#MostrarCapturaPrequirurjico').on('shown.bs.modal', function () {
    const hammertime = new Hammer(document.querySelector('#MostrarCapturaPrequirurjico .modal-body'));

    hammertime.on('swipeleft', function () {
        const $visiblePage = $('.page:visible');
        const $nextPage = $visiblePage.next('.page');
        if ($nextPage.length) {
            updatePage($nextPage, 'next');
        }
    });

    hammertime.on('swiperight', function () {
        const $visiblePage = $('.page:visible');
        const $prevPage = $visiblePage.prev('.page');
        if ($prevPage.length) {
            updatePage($prevPage, 'back');
        }
    });

    setTimeout(() => {
        // reloadSelectTable()
        $.fn.dataTable
            .tables({
                visible: true,
                api: true
            })
            .columns.adjust();
    }, 250);
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

//funcion para traer todos los datos del paciente
function dataPacientes(data) {
    var signosVitales = data['SIGNOS_VITALES'] //Variable para el for de signos vitales

    //exploracion fisica
    $('#exploracion_fisica').val(ifnull(data, '', ['EXPLORACION_FISICA']))

    if (ifnull(data, false, ['SIGNOS_VITALES'])) {

        for (const key in signosVitales) {
            if (Object.hasOwnProperty.call(signosVitales, key)) {
                const element = signosVitales[key];

                // console.log(element['id']);
                let input = $(`#signos_vitales_padre input[name="signos_vitales[${element['id']}][valor]"]`)
                input.val(element['valor'])

            }
        }
    }


    if (ant = ifnull(data, false, ['JSON_ANTECENDENTES'])) {
        // antecedentes_preguntas

        for (const key in ant) {
            if (Object.hasOwnProperty.call(ant, key)) {
                const element = ant[key];


                // indice o pregunta ID
                let pregunta = ifnull(element, false, ['id_antecedente'])

                let comentario = ifnull(element, '', ['comentario'])
                let id_respuesta = ifnull(element, false, ['id_respuesta'])
                console.log(`#antecedentes_preguntas input[type=radio][name="antecedentes[${pregunta}][option]"][value="${id_respuesta}"]`)
                $(`#antecedentes_preguntas input[type=radio][name="antecedentes[${pregunta}][option]"][value="${id_respuesta}"]`).prop('checked', true)

                if (comentario) {
                    // $('#antecedentes_preguntas div.collapse').show();
                    let textarea = $(`#antecedentes_preguntas textarea[name="antecedentes[${pregunta}][comentario]"]`)
                    textarea.val(comentario)
                    textarea.closest('div.collapse').show(); //Busca el collapse del comentario para mostrarlo
                }
            }
        }
    }

    $('#cirugia_programada').val(ifnull(data, '', ['CIRUGIA_PROGRAMADA']))

    //laboratorio
    $('#electro_derivaciones').val(ifnull(data, '', ['ELECTROCARDIOGRAMA_DERIVACIONES']))


    //Riesgo quirurgico
    $('#select-asa').val(ifnull(data, '', ['ASA']))
    $('#select-goldman').val(ifnull(data, '', ['GOLDMAN']))
    $('#input-geneva').val(ifnull(data, '', ['GEVENA']))
    $('#input-caprini').val(ifnull(data, '', ['CAPRINI']))
    $('#input-ban').val(ifnull(data, '', ['STOP_BANG']))

    $('#gupta_respiratorio').val(ifnull(data, '', ['GUPTA_RESPIRATORIO']))
    $('#gupta_neumonia').val(ifnull(data, '', ['GUPTA_NEUMONIA']))
    $('#gupta_cardiovascular').val(ifnull(data, '', ['GUPTA_CARDIOVASCULAR']))

    // Tablas
    if (data !== undefined || data === "undefined") {
        tablalistRecomendaciones.rows.add(data.RECOMENDACIONES_JSON).draw()
        tablaLaboratorios.rows.add(data.LABORATORIOS).draw()
    }

}

$(document).on('click', '#btn-guardarInterpretacion', function (e) {
    e.preventDefault();
    title = '¿Esta seguro de guardar la valoración prequirúrgica?'
    text = 'Se podra modificarlo despues'
    btnAlertas(title, text, 1)
})

$(document).on('click', '#btn-confirmarReporte', function (e) {
    e.preventDefault();
    title = '¿Esta seguro de confirmar el reporte?'
    text = 'No se podra modificar despues'
    btnAlertas(title, text, 2)
})


function btnAlertas(title, text, bit) {
    alertMensajeConfirm({
        title: title,
        text: text,
        icon: 'warning',
        confirmButtonText: 'Si, estoy seguro'
    }, function () {
        guardarDatos(bit)
    }, 1)
}


function guardarDatos(bit) {
    var recomenList = $('input[name="recomendacion_json"]');
    recomenList.val(JSON.stringify(tablalistRecomendaciones.rows().data().toArray()))

    if (bit == 1) {
        ajaxAwaitFormData({ api: 2, turno_id: arrayPaciente['ID_TURNO'], confirmado: 0 }, 'prequirurgico_api', 'formInterpretacion', { callbackAfter: true }, false, function (data) {
            alertToast('Se han guardado los datos correctamente', 'success', 4000)

        })
    } else {
        ajaxAwait({ api: 3, turno_id: arrayPaciente['ID_TURNO'], confirmado: 1 }, 'prequirurgico_api', { callbackAfter: true }, false, function (data) {
            alertToast('Se han confirmado los datos correctamente', 'success', 4000)
            $('#btn-guardarInterpretacion').prop('disabled', true)
        })
    }
}

