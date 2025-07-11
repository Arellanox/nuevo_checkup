if (!validarPermiso('RepIngPaci')) {
    $('#btn-pendiente-ingreso').fadeOut(0);
}

//Finaliza el proceso del paciente
async function finalizarProcesoRecepcion(paciente, factura = false, pago = false) {
    

    let data = ajaxAwait({
        api: 19, // <-- desmarcar o marcar
        turno_completado: 1,
        id_turno: paciente['ID_TURNO'],
        factura: factura, // <-- si  o no
        pago: pago, // <-- si o no
    }, 'turnos_api')

    if (data) {
        alertMsj({
            title: '¡Paciente finalizado!',
            text: `El paciente: ${paciente['NOMBRE_COMPLETO']}, ha sido cerrado, ya no podrás crear modificaciones al paciente...`,
            footer: 'Cargando nuevamente las tablas...',
            icon: 'success',
            showCancelButton: false,
        })
        try {
            tablaRecepcionPacientesIngrersados.ajax.reload()
        } catch (error) {
        }
    }
}

$(document).on('click', '#btn-espera-estatus', function () {
    alertMsj({
        icon: '',
        title: 'Elige una opción',
        html: `
            <button type="button" class="btn btn-pantone-7408 me-2" style="margin-bottom:4px" id="btn-aceptar"
              data-bs-toggle="tooltip" data-bs-placement="top" title="Carga una solicitud de estudios">
              <i class="bi bi-check"></i> Aceptar paciente
            </button>
            <button type="button" class="btn btn-borrar me-2" style="margin-bottom:4px" id="btn-rechazar"
              data-bs-toggle="tooltip" data-bs-placement="top" title="Rechaza/Elimina este registro">
              <i class="bi bi-x"></i> Rechazar paciente
            </button> 
        `,
        showCancelButton: false,
        showConfirmButton: false,
        allowOutsideClick: true,
    })
})

$(document).on('click', '#btn-opciones-paciente', function (e) {
    let html = '';

    if (validarVista('RECEPCIÓN CAMBIO DE ESTUDIOS', false))
        html += `<button type="button" class="btn btn-hover me-2" style="margin-bottom:4px" id="btn-agregar_eliminar-estudios"
          data-bs-toggle="tooltip" data-bs-placement="top" title="Elimine/Agregue estudios al paciente">
          <i class="bi bi-plus-slash-minus"></i> Actualizar Estudios
        </button> `

    if (array_selected) {
        alertMsj({
            icon: '',
            title: 'Elige una opción',
            html: html,
            showCancelButton: false,
            showConfirmButton: false,
            allowOutsideClick: true,
        })
    } else {
        alertSelectTable();
    }
})

//Agregar o eliminar estudios
$(document).on('click', '#btn-agregar_eliminar-estudios', function (e) {
    if (array_selected) {
        getDataEstudiosFirst()
    } else {
        alertSelectTable();
    }
})

$(document).on('click', '#btn-concluir-paciente', function (e) {
    if (array_selected) {
        alertMensajeConfirm({
            title: '¿Estás seguro de finalizar el proceso de recepción del paciente?',
            text: `El paciente, ${array_selected['NOMBRE_COMPLETO']}, ya no se podrán hacer mas modificaciones.`,
            icon: 'warning'
        }, function () {
            const ClientesIDs = [1, 16, 31, 35, 37, 39, 20, 48, 49, 44, 19, 53];

            // if (array_selected['CLIENTE_ID'].includes(clientesConfiguraciones_particulares) || isFranquisiario) {
            if (clientesConfiguraciones_particulares.includes(array_selected['CLIENTE_ID']) || isFranquisiario) {
                $('descuento').val('');
                //Abrir el modal de estudios, precios y detalle
                configurarModal(array_selected);
            } else {
                //Termina el proceso sin factura y credito
                finalizarProcesoRecepcion(array_selected);
            }

        }, 1)
    } else alertSelectTable();
});

$(document).on('click', '#btn-facturar', function (e) {
    if (array_selected) {
        alertToast('Complete los siguientes datos a facturar', 'info', 4000);
        onlyFactura = true;
        configurarFactura(array_selected)
    } else {
        alertSelectTable();
    }
})

$(document).on('click', '.btn-eliminar-estudio', function (event) {
    event.preventDefault();

    if (!validarPermiso('RepEstElim')) return false;

    let name = $(this).closest('tr');
    let id = $(this).attr('data-bd-id');

    name = name.find('td[class="sorting_1 dtr-control"]').html();
    statusEstudiosPaciente(id, 17, 'eliminar', name);
});

$(document).on('click', '.btn-agregar-estudio', function (event) {
    event.preventDefault();
    let name = $(this).closest('tr');
    let id = $(this).attr('data-bd-id');
    name = name.find('td[class="sorting_1 dtr-control"]').html();

    statusEstudiosPaciente(id, 18, 'agregar', name);
});

$(document).on('click', '.btn-agregar-estudios-admin', function (event) {
    event.preventDefault();
    let tipo = $(this).attr('data-bs-tipo');
    let id = $(`#${tipo}`).val();
    let name = $(`#${tipo} option:selected`).html();

    statusEstudiosPaciente(id, 18, 'agregar', name);
});

$(document).on('click', '#btn-perfil-paciente', function () {
    if (array_selected) {
        Swal.close();
        $('#modalPacientePerfil').modal('show');
    } else alertSelectTable();
})

$(document).on('click', '#btn-credencial-paciente', function () {
    if (array_selected) {
        Swal.close();
        $('#modalPacienteIne').modal('show');
    } else alertSelectTable();
})

$(document).on('click', '#btn-ordenes-paciente', function () {
    if (array_selected) {
        Swal.close();
        $('#modalOrdenesMedicas').modal('show');
    } else alertSelectTable();
})

$(document).on('click', '#btn-editar', function () {
    if (array_selected != null) {
        $("#ModalEditarPaciente").modal('show');
    } else alertSelectTable();
})

$(document).on('click', "#btn-perfil", function () {
    if (array_selected != null) {
        $("#modalPacientePerfil").modal('show');
    } else alertSelectTable();
})

$(document).on('click', '#btn-correo-particular', function () {
    if (array_selected != null) {
        Swal.fire({
            title: '¿Desea enviar todos sus resultados y capturas?',
            text: "¡Se usará el correo registro del paciente!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Aceptar y enviar',
            cancelButtonText: "Cancelar"
        }).then((result) => {
            if (result.isConfirmed) {
                // Esto va dentro del AJAX
                $.ajax({
                    data: {
                        id_turno: array_selected['ID_TURNO'],
                        api: 4,
                    },
                    url: "../../../api/recepcion_api.php",
                    type: "POST",
                    success: function (data) {
                        data = jQuery.parseJSON(data);
                        if (mensajeAjax(data)) {
                            alertMensaje('info', '¡Correo enviado!', 'Si el correo es correcto le llegará.');
                        }
                    }
                });
            }
        })
    } else alertSelectTable('No ha seleccionado ningún paciente', 'error')
})

$(document).on('click', '#get-modal-qr-clientes', () => { $('#modalQRClientes').modal('show'); });

//modal para notificar si cuentan con algun reporte sin enviar
$(document).on('click', '#btn-modalNotificacionesReportes', function () {
    $('#modalNotificacionReportesNoEnviados').modal('show');
    setTimeout(() => {
        $.fn.dataTable
            .tables({
                visible: true,
                api: true
            })
            .columns.adjust();
    }, 230);
})


