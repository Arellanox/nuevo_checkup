var tablaServicios; // variable global para DataTable

var selectLaboratorioMaquilaId = null; // Laboratorio seleccionado para maquila
var listaEstudiosDelServicio = []; //Estudios del servicio seleccionado (solo para mostrar estudios)
var listaEstudiosAliases = []; //Lista de alias de estudios de laboratorios

var estudioHasIdAlias = null; // Buscamos si el estudio seleccionado ya tiene un alias y si es asi obtenemos el idAlias
var estudioAuxByHasIdAliasIsNull = null; // Auxiliar cuando el estudio no tiene un alias, entonces usamos el id del estudio
var associatedSelectIdAlias = null;
var selectServicioMaquilaId = null; // Servicio a maquilar (principal) desplega todos los estudios que tiene
var autorellenar = true; //Axuiliar para evitar un ciclo redudante en triggers

//_______________________ MAQUILACIÓN _____________________________
async function asociarEstudios(idAlias, estudioId, laboratorio) {
    console.log(estudioId)
    estudioHasIdAlias = idAlias ?? null; // Buscamos obtener el idAlias
    estudioAuxByHasIdAliasIsNull = estudioId; // Auxiliar por si no tiene el id alias
    selectLaboratorioMaquilaId = laboratorio;
    associatedSelectIdAlias = null;

    await ajaxAwait({
        api: 11, LABORATORIO_MAQUILA_ID: selectLaboratorioMaquilaId
    }, 'laboratorio_solicitud_maquila_api', {callbackAfter: true}, false, async function (data) {
        listaEstudiosAliases = data.response.data; // Estudios del servicio general

        if(validarListaAlias()) openModalAliassesForm();
    });
}

// Restablecimiento de formularios
$('#modalMaquilaEstudios').on('hide.bs.modal', resetMaquilaModal);

// Confirma la maquilación de los estudios
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

// Actualiza los checkbox de estudios al cambiar la selección del laboratorio de maquilación
$('#select-laboratorios-maquila').on('change', async function (e) {
    e.preventDefault();

    alertToast('Actualizando estudios...', 'info', 1000)
    selectLaboratorioMaquilaId = $(this).val();
    //console.log("Valor seleccionado:", $(this).val());

    await ajaxAwait({
        api: 11, LABORATORIO_MAQUILA_ID: selectLaboratorioMaquilaId
    }, 'laboratorio_solicitud_maquila_api', {callbackAfter: true}, false, function (data) {
        listaEstudiosAliases = data.response.data; // Estudios del servicio general

        //if(validarListaAlias()) actualizarListaCheckboxEstudio();
    });
});

function resetMaquilaModal() {
    $('#inputBuscarEstudio').val('');
    $('#checkFullEstudios').prop('checked', true);
    listaEstudiosDelServicio = [];
}


//_________________________ ASOCIACIONES ______________________________


// Restablecimiento de formularios
$('#modalAsociarEstudio').on('hide.bs.modal', resetAliasModal);

// Autocompletado de formulario de acuerdo al estudio seleccionado del laboratorio de maquilación
$("#servicio_estudio_id").on('change', async function (e) {
    e.preventDefault();

    associatedSelectIdAlias = $(this).val();
    //console.log('Asociated: ' + associatedSelectIdAlias)

    if(autorellenar) {
        await autorellenarModalAliasesForm()
    } else autorellenar = true
});

// Asocia el alias del estudio del laboratorio seleccionado con el estudio de nuestro servicio actual
$("#btn_confirm_alias").on("click", function (e) {
    e.preventDefault();

    if (associatedSelectIdAlias != null) {
        alertMensajeConfirm({
            title: '¿Seguro de Registrar/Actualizar?',
            html: `Se registrará el Alías 
                <strong>${$('#asociar_alias_estudio').text()}</strong> con la Cláve 
                <strong>${$('#asociar_clave_estudio').text()}</strong> del Estudío 
                <strong style="color: #007bff;">${$('#servicio_estudio_id option:selected').text()}</strong> del Laboratorio 
                <strong style="color: #007bff;">${$('#select-laboratorios-maquila option:selected').text()}</strong>.
            `,
            icon: 'warning',
            confirmButtonText: 'Registrar Alias',
        }, () => {
            ajaxAwait({
                SERVICIO_ESTUDIO_ID: estudioAuxByHasIdAliasIsNull,
                LABORATORIO_ALIAS_ID: associatedSelectIdAlias,
                LABORATORIO_MAQUILA_ID: selectLaboratorioMaquilaId,
                api: 9
            }, 'laboratorio_solicitud_maquila_api', {callbackAfter: true}, false, () => {
                alertMensaje(
                    'info', '¡Alias Registrado!',
                    `Puedes visualizar el cambio acutalizando la tabla (Advertencia esto cierra los estudios desplegados).`
                );

                $('#modalAsociarEstudio').modal('hide');
            });
        }, 1);
    } else {
        alertToast('Selecciona un estudio, ingresa un alias e ingresa la clave del estudio.', 'warning', 4000);
    }
});

function resetAliasModal() {
    $('#asociar_alias_estudio').val('');
    $('#asociar_clave_estudio').val('');
    $('#asociar_precio_estudio').val('');
}

function openModalAliassesForm() {
    alertToast('Cargando información, espera un momento', 'info', 1500);
    select2('#servicio_estudio_id', 'modalAsociarEstudio', 'Selecciona una estudio');

    rellenarOrdenarSelect('#servicio_estudio_id', 'laboratorio_solicitud_maquila_api', 11, 'ID_ALIAS', 'ESTUDIO', {
        LABORATORIO_MAQUILA_ID: selectLaboratorioMaquilaId
    }, () => {
        autorellenarModalAliasesForm();
        $('#modalAsociarEstudio').modal('show');
    });
}

async function autorellenarModalAliasesForm() {
    autorellenar = false;

    if (estudioHasIdAlias !== null) {
        if (associatedSelectIdAlias != estudioHasIdAlias) {
            const estudio = listaEstudiosAliases.find(estudio => estudio.ID_ALIAS == associatedSelectIdAlias);
            $('#asociar_alias_estudio').val(estudio?.ESTUDIO);
            $('#asociar_clave_estudio').val(estudio?.ABREVIATURA);
            $('#asociar_precio_estudio').val(parseFloat((estudio?.PRECIO) ?? 0).toFixed(2));
            autorellenar = true;
            //console.log('Caso 0:' + estudio)
        } else {
            const estudio = listaEstudiosAliases.find(estudio => estudio.ID_ALIAS == estudioHasIdAlias);
            $('#servicio_estudio_id').val(estudioHasIdAlias).trigger('change');
            $('#asociar_alias_estudio').val(estudio?.ESTUDIO);
            $('#asociar_clave_estudio').val(estudio?.ABREVIATURA);
            $('#asociar_precio_estudio').val(parseFloat((estudio?.PRECIO) ?? 0).toFixed(2));
            //console.log('Caso 1:' + estudio)
        }
    } else {
        if(associatedSelectIdAlias) {
            const estudio = listaEstudiosAliases.find(estudio => estudio.ID_ALIAS == associatedSelectIdAlias);
            $('#asociar_alias_estudio').val(estudio?.ESTUDIO);
            $('#asociar_clave_estudio').val(estudio?.ABREVIATURA);
            $('#asociar_precio_estudio').val(parseFloat((estudio?.PRECIO) ?? 0).toFixed(2));
            autorellenar = true;
            //console.log('Caso 2:' + estudio)
        } else {
            const estudio = listaEstudiosAliases[0];
            $('#asociar_alias_estudio').val(estudio?.ESTUDIO);
            $('#asociar_clave_estudio').val(estudio?.ABREVIATURA);
            $('#asociar_precio_estudio').val(parseFloat(estudio?.PRECIO ?? 0).toFixed(2));
            autorellenar = true;
            //console.log('Caso 3:' + estudio)
        }
    }
}

//_________________________ SHARED FUNCTIONS ______________________________


function validarListaAlias() {
    if (listaEstudiosAliases.length === 0) {
        alertToast('No hay estudios disponibles para este laboratorio en este momento, seleccióne otro.', 'info', 1800);
        $('#body-maquila-estudios-grupos-container').html(`<p class="text-center" style="grid-column: 2">No se encontraron estudios para maquila.</p>`);
        return false;
    }

    return true;
}

$(".btn-refresh").on("click", function () {
    tablaServicios.ajax.reload();
    alertMensaje("success", "Tabla actualizada!", "Ahora los cambios son visibles")
})

//_________________________________________________________________________