$('#formAnalisisLaboratorio').submit(function (event) {
    event.preventDefault();

    if (selectListaLab['CONFIRMADO'] == 0 || selectListaLab['CONFIRMADO'] == "0") {
        let confirmar = 0;
        const form = document.getElementById("formAnalisisLaboratorio");
        const formData = new FormData(form);
        formData.set('id_turno', selectListaLab['ID_TURNO']);
        formData.set('id_area', areaActiva)
        formData.set('api', 9);
        // console.log(formData);
        if ($('.subir-resultado-lab:focus').attr('data-attribute') === 'confirmar') {
            formData.set('confirmar', 1);
            title = "¿Está seguro de confirmar los resultados?";
            text = "¡No podrá revertir esta acción!";
            alertmeensj = 'Cerrando y generando formato de laboratorio';
            alertoas = '¡Resultados listos!';
            confirmar = 1;
        } else {
            title = "¿Estás seguro de guardar los resultados?";
            text = "Use su contraseña de su sesión para guardar/actualizar los resultados";
            alertmeensj = 'Guardando resultado de laboratorio';
            alertoas = '¡Resultados guardados!'
            confirmar = 0;

        }

        Swal.fire({
            title: title,
            text: text,
            showCancelButton: true,
            confirmButtonText: 'Confirmar',
            cancelButtonText: 'Cancelar',
            showLoaderOnConfirm: true,
            html: '<form autocomplete="off" onsubmit="formpassword(); return false;"><input type="password" id="password-confirmar" class="form-control input-color" autocomplete="off" placeholder=""></form>',
            focusConfirm: false,
            preConfirm: () => {
                const password = Swal.getPopup().querySelector('#password-confirmar').value;
                return fetch(`${http}${servidor}/${appname}/api/usuarios_api.php?api=9&password=${password}`)
                    .then(response => {
                        if (!response.ok) {
                            throw new Error(response.statusText)
                        }
                        return response.json()
                    })
                    .catch(error => {
                        Swal.showValidationMessage(
                            `Request failed: ${error}`
                        )
                    });
            },
            allowOutsideClick: () => !Swal.isLoading()
        }).then((result) => {
            if (result.isConfirmed) {
                if (result.value.status == 1) {
                    $.ajax({
                        data: formData,
                        url: "../../../api/turnos_api.php",
                        type: "POST",
                        processData: false,
                        contentType: false,
                        beforeSend: function () {
                            alertMensaje('info', 'Espere un momento', alertmeensj)
                        },
                        success: function (data) {
                            data = jQuery.parseJSON(data);
                            if (mensajeAjax(data)) {
                                alertSelectTable(alertoas, 'success')
                                if (confirmar) {
                                    tablaListaPaciente.ajax.reload();
                                    getPanel('.informacion-labo', '#loader-Lab', '#loaderDivLab', selectListaLab, 'Out')
                                }
                            }
                        },
                    });
                } else {
                    alertSelectTable('¡Contraseña incorrecta!', 'error')
                }
            }
        })
    }
})

$('.subir-resultado-lab').click(function () {
    if ($('.subir-resultado-lab:focus').attr('data-attribute') == 'confirmar') {
        $('.inputFormRequired').prop('required', true);
    } else {
        $('.inputFormRequired').prop('required', false);
    }
    $("#btnConfirmarResultados").click();
})

$('#btn-confirmar-formulario').click(function (e) {
})

//No submit form with enter
function formpassword() {
}

// cambiar fecha de la Lista
$('#fechaListadoLaboratorio').change(function () {
    recargarVistaLab();
})

$('#fechaFinalListadoLaboratorio').change(function () {
    recargarVistaLab();
})

$('#checkDiaAnalisis').click(function () {
    if ($(this).is(':checked')) {
        recargarVistaLab(0)
        $('#fechaListadoLaboratorio').prop('disabled', true)
        $('#fechaFinalListadoLaboratorio').prop('disabled', true)
    } else {
        recargarVistaLab();
        $('#fechaListadoLaboratorio').prop('disabled', false)
        $('#fechaFinalListadoLaboratorio').prop('disabled', false)
    }
})

function recargarVistaLab(fecha = 1) {
    dataListaPaciente = {
        api: 5,
        area_id: areaActiva
    }

    if (fecha) {
        dataListaPaciente['fecha_busqueda'] = $('#fechaListadoLaboratorio').val();
        dataListaPaciente['fecha_busqueda_final'] = $('#fechaFinalListadoLaboratorio').val();
    }

    tablaListaPaciente.ajax.reload();
    getPanel('.informacion-labo', '#loader-Lab', '#loaderDivLab', selectListaLab, 'Out')
}

//Imprimr lista de trabajo con codigo de barras
$('#btn-lista-trabajo-barras').click(function () {
    api = encodeURIComponent(window.btoa('lista-barras'));
    turno = encodeURIComponent(window.btoa($('#fechaListadoLaboratorio').val()));
    area = encodeURIComponent(window.btoa(areaActiva));

    window.open(`${http}${servidor}/${appname}/visualizar_reporte/?api=${api}&turno=${turno}&area=${area}`, "_blank");
});

$('#btn-estudios-pendientes-notificacion').click(function () {
    $('#modalEstudiosPendientes').modal("show");
});
$('#btn-maquilas-pendientes-notificacion').click(function () {
    $('#modalMaquilasPendientes').modal("show");
});

//ObtenerPDF
$(document).on('click', '.obtenerPDF', function (event) {
    event.stopPropagation();
    event.stopImmediatePropagation();
    let id = $(this).attr('data-bs-id');
    $.ajax({
        url: `${http}${servidor}/${appname}/api/servicios_api.php`,
        type: "POST",
        data: {
            id_turno: id,
            api: 13
        },
        beforeSend: function () {
            alertMensaje('info', 'Espere un momento', 'Generando')
        },
        success: function (data) {
            alertMensaje(null, null, null, null,
                `<div class="d-flex justify-content-center"> <a href="` + data + `" class="btn btn-borrar" target="_blank" style="width: 50%"> <i class="bi bi-image"></i> Descargar</a></div></div>`
            )
        }
    })
});

//Marcar un estuio como pendiente
$(document).on('click', '.btn-estudios-pendientes', async function (event) {
    event.preventDefault();

    const servicio_id = $(this).attr('data-bs-id');
    const servicio = $(this).attr('data-bs-text');
    let pending = $(this).attr('data-bs-pending');
    let msh, msh2;

    if (parseInt(pending) === 1) {
        msh = "¿Quieres completar este estudio?";
        pending = 0;
        msh2 = `${servicio} COMPLETADO!`;
    } else {
        msh = "¿Quieres marcar este estudio como PENDIENTE?";
        pending = 1;
        msh2 = `${servicio} está PENDIENTE!`;
    }

    //Volver a la posicion del estudio
    $('html, body').animate({scrollTop: 0}, 'slow');

    //Enviar la solicitud
    alertMensajeConfirm({title: msh, text: servicio, icon: 'warning', confirmButtonText: 'Sí'}, function () {
            ajaxAwait({api: 5, turno_id: selectListaLab.ID_TURNO, id_servicio: servicio_id, pendiente: pending},
                'laboratorio_servicios_api', {callbackAfter: true}, false, function () {
                    alertToast(msh2, 'success', 4000);

                    if (parseInt(pending) === 1) //Cambiar atributo checked
                    {
                        $(`#lbl${servicio_id}`).removeClass('btn-outline-danger');
                        $(`#lbl${servicio_id}`).addClass('btn-danger');
                        $(`#check${servicio_id}`).prop('checked', true);
                    } else {
                        $(`#lbl${servicio_id}`).removeClass('btn-danger');
                        $(`#lbl${servicio_id}`).addClass('btn-outline-danger');
                        $(`#check${servicio_id}`).prop('checked', false);
                    }
                });

            //Actualizar la notificacion de estudios pendientes
            ajaxAwait({api: 6}, 'laboratorio_servicios_api', {callbackAfter: true}, false, function (data) {
                $('#estudios-pendientes-notificacion').text(data.response.data);
            });

            tableEstudiosPendientes.ajax.reload();
        }, 1, function () {
            alert("has negado la accion");
            $('html, body').animate({scrollTop: 0}, 'slow');
        }, function (event) { //Volver a la posicion del estudio en caso de que cancelen la accion la accion
            if (event) event.preventDefault();
            setTimeout(() => {
                document.documentElement.scrollTop = 0; // Para navegadores modernos
                document.body.scrollTop = 0; // Para navegadores antiguos
                return false; // Asegúrate de que la función no continúe
            }, 1500);
        }
    )
});

//Maquilación
$(document).on('click', '.btn-modal-maquila-confirm', function (event) {
    event.preventDefault();
    const laboratorio_texto = $('#select-laboratorios-maquila option:selected').text();
    const laboratorio_id = $('#select-laboratorios-maquila').val();

    alertMensajeConfirm({
        title: '¿Quieres completar esta acción?',
        text: `Sera maquilado por ${laboratorio_texto}`,
        icon: 'warning',
        confirmButtonText: 'Sí'
    }, function () {
        //GUARDAR MAQUILACIÓN
        const servicio_id = $('.dropdown-item .btn-maquila-estudios').attr('data-bs-id');

        console.log(servicio_id);

        ajaxAwait({
            api: 1,
            LABORATORIO_MAQUILA_ID: laboratorio_id,
            TURNO_ID: selectListaLab.ID_TURNO,
            SERVICIO_ID: servicio_id
        }, 'laboratorio_estudios_maquila_api', {callbackAfter: true}, false, function () {
            alertToast('Se registro la maquila exiotsamente.', 'success', 4000);
            $('#modalMaquilaEstudios').modal('hide');
        }).then(r => {
            ajaxAwait({
                api: 3,
                viculo: '#',
                mensaje: 'Solicitud de aprobación de maquilación generada por ' + session.nombre,
                lab_maquila_id: laboratorio_id,
                turno_id: selectListaLab.ID_TURNO,
                servicio_id: servicio_id
            }, 'notificaciones_api', {callbackAfter: true}, false, function () {
                alertToast('Solicitud de aprobación enviada', 'success', 4000);
            });
        });
    }, 1, function () {}, () => {});
});

$(document).on('click', '.btn-maquila-estudios', function (event) {
    event.preventDefault();
    $('#modalMaquilaEstudios').modal('show');
    rellenarOrdenarSelect('#select-laboratorios-maquila', 'laboratorio_maquila_api', 2, 'ID_LABORATORIO', 'DESCRIPCION');
});