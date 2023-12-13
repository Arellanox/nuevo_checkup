//Variables
let title
let text
let recomenList;




let Recomendaciones = []; // array donde se guardaran las recomendaciones
// Abrir el model de formulario
$('#btn-interpretacionPrequi').on('click', function () {

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
let index = 0; // indice para las recomendaciones que se vayan agregando
$(document).on('click', '#btn-agregarRecomendaciones', function (e) {

    // Sacamos la recomendacion
    let recomendacion = $('#recomendaciones_list').val();

    // Agregamos la recomendacion a la variable donde se esta almacenando
    Recomendaciones.push({
        recomendacion: recomendacion,
        index: index
    })

    // Se llama al metodo para actualizar la recomendacion
    actualizarRecomendaciones();

    // seteamos el input cada que agregue una nueva recomendacion
    $('#recomendaciones_list').val('')

    // Incrementamos la variable
    index++;
})

// Funcion para agregar un nuevo campo a la tabla de recomendaciones
function actualizarRecomendaciones() {

    // Sacamos el contenedor padre donde se iran insertando los rows
    let tbody = $('#tbody_recomendaciones');
    tbody.html(''); // limpiamos el contenedor padre donde se iran insertando los rows

    let html; // variable donde aqui se iran guardando el esqueleto html

    // recorremos el arreglo de la variable que contiene a todas las recomendaciones
    for (const key in Recomendaciones) {
        if (Object.hasOwnProperty.call(Recomendaciones, key)) {
            const element = Recomendaciones[key];

            // sacamos la posicion para poder enumerar la lista
            let posicion = parseInt(key) + 1;

            // armamos el esqueleto html
            html = `
                <tr>
                    <td class='fw-bold '>${posicion}</td>
                    <td>${element.recomendacion}</td>
                    <td class='d-flex justify-content-center'>
                        <button data-id='${element.index}' class='btn btn-hover me-2 eliminar_recomendacion'>
                            <i class="bi bi-trash3"></i>
                        </button>
                    </td>
                </tr>
            `;

            // Ponemos el row dentrol tbody
            tbody.append(html);
        }
    }
}


// metodo para eliminar la recomendacion de la tabla
$(document).on('click', '.eliminar_recomendacion', function () {

    // sacamos la key del row que quiere eliminar
    key = parseInt($(this).attr('data-id'));

    // Filtramos el array sin tomar en cuenta el que se esta eliminando
    newArray = Recomendaciones.filter(function (i) { return i.index !== key }); // filtramos

    console.log(newArray);

    // remplazamos el antiguo array con el nuevo array
    Recomendaciones = newArray;

    // actualizamos la tabla
    actualizarRecomendaciones();
})

// New table to Datatabl
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
            data: 'index', render: (data) => {
                return parseInt(data) + 1;
            }
        },
        { data: 'recomendacion' },
        {
            data: null, render: (data) => {
                return ` <button data-id='${data}' class='btn btn-hover me-2 eliminar_recomendacion'>
                            <i class="bi bi-trash3"></i>
                        </button>`
            }
        }
    ],
    // scrollY: '75vh',
    // scrollCollapse: true,
})


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
    // seteamos las variables globales 
    Recomendaciones = [];
    index = 0;
    actualizarRecomendaciones();
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
    recomenList.val(JSON.stringify(Recomendaciones))

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

