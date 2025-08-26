/*var selectServicioMaquilaId = null; // Servicio a maquilar (principal)
var selectLaboratorioMaquilaId = null; // Laboratorio seleccionado para maquila
var listaEstudiosDelServicio = []; //Estudios del servicio seleccionado (solo para mostrar estudios)
var listaEstudiosAliases = []; //Lista de alias de estudios de laboratorios*/

var maquilas_pendientes = $('#TablaMaquilasPendientesAprovacion').DataTable({
    language: { url: "https://cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json" },
    lengthChange: false,
    info: false,
    paging: false,
    scrollY: autoHeightDiv(0, 300),
    scrollCollapse: true,
    ajax: {
        dataType: "json",
        data: {
            api: 2,
            MOSTRAR_OCULTOS: 1,
            FECHA_INICIO: dataListaPaciente['fecha_busqueda'] ?? rangoFechas[0] ?? null,
            FECHA_FIN: dataListaPaciente['fecha_busqueda_final'] ?? rangoFechas[1] ?? null
        },
        method: "POST",
        url: "../../../api/laboratorio_solicitud_maquila_api.php",
        dataSrc: "response.data",
        beforeSend: function () { console.info('📣 System: Obtencion de maquilas iniciada.') },
        complete: function () { console.info('📣 System: Obtencion de maquilas completada.') },
        error: function () { Toast.fire({icon: 'error', title: '¡Error al recuperar las maquilas!'}); }
    },
    columns: [
        {data: "SERVICIO"},
        {data: "LABORATORIO_NOMBRE"},
        {data: "SERVICIO_ABREVIATURA"},
        {data: "PACIENTE_NOMBRE"},
        {data: "USUARIO_SOLICITANTE"},
        {
            data: "LAB_MAQUILA_ESTATUS",
            render: function (data, type, row) {
                let text = "Desconocido: " + data;
                let className = "badge bg-secondary"; // Estilos por defecto

                if (data === null || data == 0) {
                    text = "Pendiente";
                    className = "badge bg-warning text-dark"; // Amarillo
                } else if (data == 1) {
                    text = "Aprobado";
                    className = "badge bg-success"; // Verde
                } else if (data == 2) {
                    text = "Rechazado";
                    className = "badge bg-danger"; // Rojo
                }

                return `<span class="${className}">${text}</span>`;
            }
        },
        {data: "LAB_MAQUILA_REGISTRO"}
    ],
    columnDefs: [ { width: "50px", targets: 0 } ]
});

/*

//Marca todos los checkbox como activado
$("#checkFullEstudios").on('click', function () {
    if ($(this).is(':checked')) {
        $('.input-estudios-check').prop('checked', true);
    } else {
        $('.input-estudios-check').prop('checked', false);
    }
});

$('#inputBuscarEstudio').on('input', function () {
    filtrarListaCheckboxEstudio($(this).val());
});

//Confirmación de maquila de estudios
$(document).on('click', '.btn-modal-maquila-confirm', function (event) {
    event.preventDefault();
    const laboratorio_id = $('#select-laboratorios-maquila').val();
    const estudiosMarcados = $('.input-estudios-check:checked').toArray().map(a => a.value);
    const laboratorio = $('#select-laboratorios-maquila option:selected').text();

    if (estudiosMarcados.length <= 0) {
        alertToast('No ha seleccionado ningún estudio.', 'warning', 4000);
        return;
    }

    alertMensajeConfirm({
        title: '¿Quieres solicitar la maquilación de estos estudios?',
        text: `Solo ${estudiosMarcados.length} estudios seran maquilados por ${laboratorio}`,
        icon: 'warning',
        confirmButtonText: 'Sí'
    }, function () {
         ajaxAwait({
            api: 1,
            LABORATORIO_MAQUILA_ID: laboratorio_id,
            TURNO_ID: selectListaLab.ID_TURNO,
            SERVICIO_ID: selectServicioMaquilaId,
            LISTA_ESTUDIOS: estudiosMarcados
        }, 'laboratorio_solicitud_maquila_api', {callbackAfter: true}, false, async function () {
             alertToast('Se registro la maquila exiotsamente.', 'success', 4000);
             $('#modalMaquilaEstudios').modal('hide');

             //Generar notificacion
             ajaxAwait({
                 api: 3,
                 viculo: `${current_url}/vista/menu/maquilas/`,
                 mensaje: 'Solicitud de aprobación de maquilación generada por ' + session.nombre,
                 lab_maquila_id: laboratorio_id,
                 turno_id: selectListaLab.ID_TURNO,
                 servicio_id: selectServicioMaquilaId,
                 cargos_id: '16,2,20'
             }, 'notificaciones_api', {callbackAfter: true}, false, function () {
                 alertToast('Solicitud de aprobación enviada', 'success', 4000);
             }).finally(() => {
                 tableEstudiosPendientes.ajax.reload();
             });

             await obtenerBadgePendientesLabClinico();
        });
    }, 1, function () {}, () => {});
});

// Muestra el modal con los estudios a seleccionar o deseleccionar para maquilar
$(document).on('click', '.btn-maquila-estudios', async function (event) {
    event.preventDefault();
    alertToast('Cargando grupo de estudios, espera un momento', 'info', 1500);

    try {
        await rellenarOrdenarSelect('#select-laboratorios-maquila', 'laboratorio_maquila_api', 2, 'ID_LABORATORIO', 'DESCRIPCION', {}, async () => {
            selectServicioMaquilaId = $(this).attr('data-bs-id');
            selectLaboratorioMaquilaId = $('#select-laboratorios-maquila').val();

            await actualizarListaCheckboxEstudio();
        });
    } catch (error) {
        console.warn(`❗System: Error al obtener el grupo de estudios, grupo id: ${selectServicioMaquilaId}.`)
        console.warn(error);
    }
});

// Actualiza los checkbox de estudios al cambiar la selección del laboratorio de maquilación
$('#select-laboratorios-maquila').on('change', async function () {
    alertToast('Actualizando estudios...', 'info', 1000)
    selectLaboratorioMaquilaId = $(this).val();

    await ajaxAwait({
        api: 11, LABORATORIO_MAQUILA_ID: selectLaboratorioMaquilaId
    }, 'laboratorio_solicitud_maquila_api', {callbackAfter: true}, false, function (data) {
        listaEstudiosAliases = data.response.data; // Estudios del servicio general

        if(validarListaAlias()){
            actualizarListaCheckboxEstudio();
        }
    });
});

// Asocia el alias del estudio del laboratorio seleccionado con el estudio de nuestro servicio actual
$("#btn_confirm_alias").on("click", function () {
    const estudio = $('#servicio_estudio_id option:selected').text();
    const servicioId = $('#servicio_estudio_id').val();
    const precio = $('#asociar_precio_estudio').val();
    const clave = $('#asociar_clave_estudio').val();
    const alias = $('#asociar_alias_estudio').val();
    const laboratorio = $('#select-laboratorios-maquila option:selected').text();

    if (servicioId.length > 0 && clave.length > 0 && alias.length > 0) {
        alertMensajeConfirm({
            title: '¿Seguro de Registrar/Actualizar?',
            html: `Se registrará el Alías <strong>${alias}</strong> con la Cláve <strong>${clave}</strong> del Estudío <strong style="color: #007bff;">${estudio}</strong> para el Laboratorio <strong style="color: #007bff;">${laboratorio}</strong>.`,
            icon: 'warning',
            confirmButtonText: 'Registrar Alias',
        }, () => {
            ajaxAwait({
                SERVICIO_ESTUDIO_ID: servicioId,
                NOMBRE_ALIAS_ESTUDIO: alias,
                CLAVE_ALIAS_ESTUDIO: clave,
                PRECIO_ALIAS_ESTUDIO: precio,
                LABORATORIO_MAQUILA_ID: selectLaboratorioMaquilaId,
                api: 9
            }, 'laboratorio_solicitud_maquila_api', {callbackAfter: true}, false, () => {
                alertMensaje('info', '¡Alias Registrado!', 'El alias se ha registrado con exito.');
                actualizarListaCheckboxEstudio();

                $('#modalAsociarEstudio').modal('hide');
            });
        }, 1);
    } else {
        alertToast('Selecciona un estudio, ingresa un alias e ingresa la clave del estudio.', 'warning', 4000);
    }
});



$('#modalMaquilaEstudios').on('hide.bs.modal', function () {
    resetMaquilaModal();
});

$('#modalAsociarEstudio').on('hide.bs.modal', function () {
    resetAliasModal();
});

// Muestra los estudios del servicio seleccionado para la selección granular de estudios a maquilar
function crearListaCheckboxEstudio() {
    if (listaEstudiosDelServicio.length > 0) {
        let generateCheckbox = '';

        for (let i = 0; i < listaEstudiosDelServicio.length; i++) {
            const id = listaEstudiosDelServicio[i].ID_ESTUDIO;

            generateCheckbox += `
                <div class="form-check-lista">
                    <div class="form-check-lista-estudios">
                        <label class="form-check-label" for="check${id}">
                            <input type="checkbox" value="${id}" id="check${id}" class="input-checkbox input-estudios-check" checked >
                            <span style="margin-left: 4px">${listaEstudiosDelServicio[i].NOMBRE_ESTUDIO}</span>
                        </label>
                    </div>
                    ${crearDetallesListaCheckboxEstudio(i)}
                </div>
            `;
        }

        $('#body-maquila-estudios-grupos-container').html(generateCheckbox);
        aplicarEventosCheckboxEstudio();
    } else {
        $('#body-maquila-estudios-grupos-container').html(`
            <p class="text-center">No se encontraron estudios para maquila.</p>
        `);
    }
}

function filtrarListaCheckboxEstudio(busqueda) {
    // Convertimos a minúsculas para hacer el filtro insensible a mayúsculas
    const texto = busqueda.trim().toLowerCase();

    // Seleccionamos todos los contenedores de los estudios
    document.querySelectorAll('#body-maquila-estudios-grupos-container .form-check-lista').forEach(div => {
        // Obtenemos el texto del label (nombre del estudio)
        const label = div.querySelector('.form-check-label span');

        if (label) {
            const nombreEstudio = label.textContent.toLowerCase();

            // Mostrar u ocultar según si coincide con la búsqueda
            if (nombreEstudio.includes(texto)) {
                div.style.display = ''; // visible
            } else {
                div.style.display = 'none'; // oculto
            }
        }
    });
}

// Obtiene los detalles del estudio seleccionado
function crearDetallesListaCheckboxEstudio(i) {
    if (listaEstudiosDelServicio[i].LAB_ALIAS_LABORATORIO_ID != null) {
        return `
           <div class="form-check-lista-estudios-details" data-bs-toggle="tooltip" data-id="${listaEstudiosDelServicio[i].ID_ALIAS}" data-bs-placement="bottom" title="Haz click para editar el alias">
               <p style="font-weight: bold">Alias: <span style="color: #6a6a6a; font-weight: normal">${listaEstudiosDelServicio[i].LAB_ESTUDIO_NOMBRE}</span></p>
               <p style="font-weight: bold">Clave: <span style="color: #6a6a6a; font-weight: normal">${listaEstudiosDelServicio[i].LAB_ESTUDIO_CLAVE}</span></p>
               <p style="font-weight: bold">Precio: <span style="color: #6a6a6a; font-weight: normal">$${listaEstudiosDelServicio[i].LAB_ALIAS_PRECIO || '0.00'}</span></p>
           </div>
        `;
    } else {
        return`
            <div class="form-check-lista-estudios-details" data-bs-toggle="tooltip" data-id="${listaEstudiosDelServicio[i].ID_ALIAS}" data-bs-placement="bottom" title="Haz click para agregar un alias">
                <i class="bi bi-pencil-fill"></i> No hay alias asociado
            </div>
        `;
    }
}

// Actualiza la lista de estudios al cambiar de laboratorio
async function actualizarListaCheckboxEstudio() {
    await ajaxAwait({
        api: 7,
        ID_GRUPO_SERVICIO: selectServicioMaquilaId, // Servicio general
        LABORATORIO_MAQUILA_ID: selectLaboratorioMaquilaId
    }, 'laboratorio_solicitud_maquila_api', {callbackAfter: true}, false, function (data) {
        listaEstudiosDelServicio = data.response.data; // Estudios del servicio general
        crearListaCheckboxEstudio();
        $('#modalMaquilaEstudios').modal('show');
        aplicarEventosCheckboxEstudio();
    });
}

// Aplica los eventos a los checkbox
function aplicarEventosCheckboxEstudio() {
    document.querySelectorAll('.form-check-lista-estudios-details').forEach(el => {
        el.addEventListener('click', () => {
            registrarAliasEstudio(el.dataset.id ?? null);
        });
    });
}

function registrarAliasEstudio(alias_id = null) {
    alertToast('Cargando información, espera un momento', 'info', 1500);
    select2('#servicio_estudio_id', 'modalAsociarEstudio', 'Selecciona una estudio');

    rellenarOrdenarSelect('#servicio_estudio_id', 'laboratorio_solicitud_maquila_api', 11, 'ID_ALIAS', 'ESTUDIO', {
        LABORATORIO_MAQUILA_ID: selectLaboratorioMaquilaId,
    }, (data) => {
        if (validarListaAlias()) {
            if (alias_id !== undefined && alias_id !== null && alias_id !== "null") {
                $('#servicio_estudio_id').val(alias_id).trigger('change');
                $('#asociar_alias_estudio').val(listaEstudiosAliases.find(estudio => estudio.ID_ALIAS == alias_id)?.LAB_ESTUDIO_NOMBRE);
                $('#asociar_clave_estudio').val(listaEstudiosAliases.find(estudio => estudio.ID_ALIAS == alias_id)?.LAB_ESTUDIO_CLAVE);
                $('#asociar_precio_estudio').val(listaEstudiosAliases.find(estudio => estudio.ID_ALIAS == alias_id)?.LAB_ALIAS_PRECIO);
            } else {
                $('#asociar_alias_estudio').val(listaEstudiosAliases[0].LAB_ESTUDIO_NOMBRE);
            }

            $('#modalAsociarEstudio').modal('show');
        }
    });
}

function resetMaquilaModal() {
    $('#inputBuscarEstudio').val('');
    $('#checkFullEstudios').prop('checked', true);
    listaEstudiosDelServicio = [];
}

function resetAliasModal() {
    $('#asociar_alias_estudio').val('');
    $('#asociar_clave_estudio').val('');
    $('#asociar_precio_estudio').val('');
}

function validarListaAlias() {
    if (listaEstudiosAliases.length === 0) {
        alertMensaje('info', 'Registro de estudios', 'No hay estudios disponibles para este laboratorio en este momento, seleccióne otro.');
        $('#body-maquila-estudios-grupos-container').html(`<p class="text-center">No se encontraron estudios para maquila.</p>`);
        return false;
    }

    return true;
}

*/
