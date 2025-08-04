$('#inputFilesInterpreArea').on('change', function () {
    var fileList = $(this)[0].files || [] //registra todos los archivos
    let aviso = 0;
    for (file of fileList) { //una iteración de toda la vida
        ext = file.name.split('.').pop()
        // console.log('>ARCHIVO: ', file.name)
        switch (ext) {
            case 'pdf':
                // console.log('>>TIPO DE ARCHIVO CORRECTO: ')
                break;
            default:
                aviso = 1;
                // console.log('>>TIPO DE ARCHIVO INCORRECTO', ext
                break;
        }
    }
    if (aviso == 1) {
        $(this).val('')
        alertMensaje('error', 'Archivo incorrecto', 'Algunos archivos no son correctos')
    }
});

// const ModalSubirInterpretacion = document.getElementById('ModalSubirInterpretacion')
// ModalSubirInterpretacion.addEventListener('show.bs.modal', event => {
//     // console.log(selectPacienteArea)
//     $('#Area-estudio').html(hash)
//     // alert(selectEstudio.selectID)
//     document.getElementById("formSubirInterpretacion").reset();
//     $('#nombre-paciente-interpretacion').val(selectPacienteArea['NOMBRE_COMPLETO'])
// })


//Formulario Para Subir Interpretacion
$(`#${formulario}`).submit(function (event) {
    event.preventDefault();
    /*DATOS Y VALIDACION DEL REGISTRO*/

    if (confirmado != 1 || session.permisos['Actualizar reportes'] == 1) {
        if (areaActiva == 5) {
            RequeriAsignarFirma()
            return;
        }

        PreGuardarCuestionarioConFirma();
    } else {
        alertMensaje('info', 'EL resultado ya ha sido guardado', 'No puede cargar mas resultados a este paciente');
    }
    event.preventDefault();
});

// Boton de capturar Tabla en el modal Reporte de interpretacion
$(document).on('click', '#AbrirModalCapturarTabla', function () {
    CapturarTablaModalConfig("show");
})

$("#btn_confirmar_asignacion_firma").on('click', function () {
    PreGuardarCuestionarioConFirma($("#select_doctor_id").val());
});

function RequeriAsignarFirma() {
    if (validarCuestionarioEspiro()) {
        return false;
    }

    $('#modalAsignarFirma').modal('show');
}

function PreGuardarCuestionarioConFirma(medico_id = session.id) {
    let jsonData = {}
    jsonData['id_turno'] = dataSelect.array['turno'];
    jsonData['id_area'] = areaActiva;
    jsonData['api'] = api_interpretacion;
    jsonData['medico_id'] = medico_id;

    alertMensajeConfirm({
        title: "¿Está seguro de subir la interpretación?",
        text: "Podrá visualizarlo una vez guardado...",
        icon: "warning",
    }, function () {
        ajaxAwaitFormData(jsonData, url_api, formulario, { callbackAfter: true, callbackBefore: true },
            () => {
                $(`#${formulario}:submit`).prop('disabled', true)
                alertMensaje('info', 'Cargando datos de interpretación', 'Espere un momento mientras el sistema registra todos los datos');
            },
            (data) => {
                alertMensaje('success', '¡Interpretación guardada!', 'Consulte o confirme el reporte despues de guardar');
                estadoFormulario(2)
                obtenerServicios(areaActiva, dataSelect.array['turno'])

                switch (areaActiva) {
                    case 4:
                        SubirCapturasAudiometria();
                        break;
                    default:
                        break;
                }

                $("#formSubirInterpretacion:submit").prop('disabled', false)
                $("#modalAsignarFirma").modal("hide");
            }
        )
    }, 1);
}

// Funcion para abrir el modal de capturar tabla
function CapturarTablaModalConfig(type) {
    if (type === "show") {
        $('#modalCapturaTablas').modal('show');
    } else if (type === "hide") {
        $('#modalCapturaTablas').modal('hide');
    }
}

function ResetCapturasDeTablaDeAudio() {
    $('#captures').html('');
    $('#viewer').html('')
    resetInputLabel()
}

$('#btn-confirmar-reporte').click(function (event) {
    event.preventDefault();
    if (confirmado != 1 || session.permisos['Actualizar reportes'] == 1) {

        if (areaActiva == 5) {
            if (validarCuestionarioEspiro()) {
                return false;
            }
        }

        alertMensajeConfirm({
            title: "¿Está seguro de confirmar este reporte?",
            text: "¡No podrá actualizar los datos de reporte!",
            icon: "warning",
        }, function () {

            ajaxAwaitFormData(
                {
                    id_area: areaActiva,
                    api: api_interpretacion,
                    id_turno: dataSelect.array['turno'],
                    confirmado: 1
                }, url_api, formulario, { callbackAfter: true, callbackBefore: true },
                () => {
                    $(`#${formulario}:submit`).prop('disabled', true)
                    alertMensaje('info', 'Confirmando reporte', 'Espere un momento, estamos generando el reporte...');
                },
                (data) => {
                    alertMensaje('success', '¡Interpretación confirmada!', 'El formulario ha sido cerrado');
                    $('#modalSubirInterpretacion').modal('hide')
                    obtenerServicios(areaActiva, dataSelect.array['turno'])
                    estadoFormulario(1)

                    $(`#${formulario}:submit`).prop('disabled', false)
                }
            )

        }, 1)
    } else {
        alertMensaje('info', 'EL resultado ya ha sido guardado', 'No puede cargar mas resultados a este paciente');
    }
    event.preventDefault()
});

//Formulario Para Los Resultados de Espirometria
$("#btn-subir-resultados-espiro").click(async function (event) {
    event.preventDefault();

    Swal.fire({
        title: '¿¡Está seguro de subir este reporte de EASYONE!?',
        text: "¡Asegurece que sea el reporte correcto! : )",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Sí, subir reporte',
        cancelButtonText: "Cancelar"
    }).then((result) => {
        if (result.isConfirmed) {

            ajaxAwaitFormData({
                id_turno: dataSelect.array['turno'],
                api: 3
            }, 'espirometria_api', 'subirResultadosEspiro', { callbackAfter: true }, false, function () {
                alertToast('El reporte ya ha sido guardado', 'success', 4000);

                obtenerServicios(areaActiva, dataSelect.array['turno'])
            })

            $('#ModalSubirResultadosEspiro').modal('hide');

            event.preventDefault();
        }
    })
})

//Subir resultados de audiometria
$("#btn-subir-resultados-audio").click(async function (event) {
    event.preventDefault();

    Swal.fire({
        title: '¿¡Está seguro de subir este estudio!?',
        text: "¡Asegurece que sea el estudio correcto! : )",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Sí, subir estudio',
        cancelButtonText: "Cancelar"
    }).then((result) => {
        if (result.isConfirmed) {

            ajaxAwaitFormData({
                id_turno: dataSelect.array['turno'],
                api: 1
            }, 'audiometria_api', 'subirResultadosAudio', { callbackAfter: true }, false, function () {
                alertToast('El estuido ya ha sido guardado', 'success', 4000);

                obtenerServicios(areaActiva, dataSelect.array['turno'])
            })

            $('#ModalSubirResultadosAudio').modal('hide');

            event.preventDefault();
        }
    })
})

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
    // console.log($visiblePage)
    switch (action) {
        case 'back':
            const $prevPage = $visiblePage.prev('.page');
            // console.log($visiblePage.prev('.page'))
            if ($prevPage.length) {
                updatePage($prevPage, action);
            }
            break;
        case 'next':
            const $nextPage = $visiblePage.next('.page');
            //  console.log($visiblePage.next('.page'))
            if ($nextPage.length) {
                updatePage($nextPage, action);
            }
            break;
        default:
            break;
    }
});


$('#modalSubirInterpretacion').on('shown.bs.modal', function () {
    const hammertime = new Hammer(document.querySelector('#modalSubirInterpretacion .modal-body'));

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
});




// Inicializamos mostrando la primera página
updatePage($('.page').first());