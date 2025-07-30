var selectServicioMaquila = null;
var tempNewAliasEstudio = null;
var listaEstudiosNoMaquilables = []; // Estudios que no pueden ser maquilados
var listaServiciosMaquilaEstudios = []; //Grupo de estudios para maquila de un servicio (solo para mostrar estudios)
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

//Confirmación de maquila de estudios
$(document).on('click', '.btn-modal-maquila-confirm', function (event) {
    event.preventDefault();
    const laboratorio_texto = $('#select-laboratorios-maquila option:selected').text();
    const laboratorio_id = $('#select-laboratorios-maquila').val();
    const estudiosMarcados = $('.input-estudios-check:checked').toArray().map(a => a.value);

    if (estudiosMarcados.length <= 0) {
        alertToast('No ha seleccionado ningún estudio.', 'warning', 4000);
        return;
    }

    alertMensajeConfirm({
        title: '¿Quieres completar esta acción?',
        text: `Sera maquilado por ${laboratorio_texto}: ${estudiosMarcados.length} estudios`,
        icon: 'warning',
        confirmButtonText: 'Sí'
    }, function () {
        //Guardar maquila
        ajaxAwait({
            api: 1,
            LABORATORIO_MAQUILA_ID: laboratorio_id,
            TURNO_ID: selectListaLab.ID_TURNO,
            SERVICIO_ID: selectServicioMaquila,
            LISTA_ESTUDIOS: estudiosMarcados
        }, 'laboratorio_solicitud_maquila_api', {callbackAfter: true}, false, async function () {
            alertToast('Se registro la maquila exiotsamente.', 'success', 4000);
            $('#modalMaquilaEstudios').modal('hide');
            listaServiciosMaquilaEstudios = [];

            //Generar notificacion
            ajaxAwait({
                api: 3,
                viculo: `${current_url}/vista/menu/maquilas/`,
                mensaje: 'Solicitud de aprobación de maquilación generada por ' + session.nombre,
                lab_maquila_id: laboratorio_id,
                turno_id: selectListaLab.ID_TURNO,
                servicio_id: selectServicioMaquila,
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

// Muestra el modal de maquilación de estudios donde se pueden seleccionar los estudios en especifico a maquilar
$(document).on('click', '.btn-maquila-estudios', async function (event) {
    event.preventDefault();
    alertToast('Cargando grupo de estudios, espera un momento', 'info', 1500);

    try {
        selectServicioMaquila = $(this).attr('data-bs-id');

        await ajaxAwait({
            api: 7,
            ID_GRUPO_SERVICIO: selectServicioMaquila
        }, 'laboratorio_solicitud_maquila_api', {callbackAfter: true}, false, function (data) {
            listaServiciosMaquilaEstudios = data.response.data;

            crearListaCheckboxEstudio();
            rellenarOrdenarSelect('#select-laboratorios-maquila', 'laboratorio_maquila_api', 2, 'ID_LABORATORIO', 'DESCRIPCION', {}, () => { // Rellenar selects
                select2Multiple('#select-aliases-estudio', 'modalMaquilaEstudios', 'Seleccione el alias del estudio', '100%');
                actualizarAliasEstudiosInSelect();
            });

            $('#modalMaquilaEstudios').modal('show');
        });
    } catch (error) {
        console.warn(`❗System: Error al obtener el grupo de estudios, grupo id: ${selectServicioMaquila}.`)
        console.warn(error);
    }
});

// Si se registra un alias nuevo se muestra el modal para vincularlo con un estudio
$('#select-aliases-estudio').on('select2:select', function (e) {
    tempNewAliasEstudio = e.params.data;

    // Muestra el modal para vincular un estudio con un alias nuevo
    if (tempNewAliasEstudio.id === tempNewAliasEstudio.text) {
        alertToast('Cargando información, espera un momento', 'info', 1500);

        rellenarOrdenarSelect('#servicio_estudio_id', 'laboratorio_solicitud_maquila_api', 7, 'ID_ESTUDIO', 'NOMBRE_ESTUDIO', {
            ID_GRUPO_SERVICIO: selectServicioMaquila
        }, () => {
            $('#modalAsociarEstudio').modal('show');
        })
    } else {
        actualizarAliasEstudiosInSelect();
        alertToast('El alias se encuentra en uso o no fue seleccionado para ser maquilado.', 'warning', 4000);
    }
});

// Actualiza los estudios en el select2 cuando cambia el laboratorio
$('#select-laboratorios-maquila').on('change', function () { actualizarAliasEstudiosInSelect(); });

// Si se cancela la asociacion de un estudio con un alias nuevo se oculta el modal y limpia la variable
$("#btn_cancel_alias").on("click", function () {
    actualizarAliasEstudiosInSelect();
    $('#modalAsociarEstudio').modal('hide');
    tempNewAliasEstudio = null;
});

// Si se confirma la asociacion de un estudio con un alias nuevo, se registra, se oculta el modal y se limpia la variable
$("#btn_confirm_alias").on("click", function () {
    const servicioId = $('#servicio_estudio_id').val();
    const precio = $('#asociar_precio_estudio').val();
    const clave = $('#asociar_clave_estudio').val();
    const alias = tempNewAliasEstudio?.text;
    const laboratorio_id = $('#select-laboratorios-maquila').val();

    if (servicioId.length > 0 && clave.length > 0 && alias.length > 0) {
        alertMensajeConfirm({
            title: '¿Está Seguro de Registrar el Alias?',
            text: `El alias: ${alias} con la clave: ${clave} se asociará al estudio ${servicioId}.`,
            icon: 'warning',
            confirmButtonText: 'Registrar Nuevo Alias',
        }, () => {
            ajaxAwait({
                SERVICIO_ESTUDIO_ID: servicioId,
                NOMBRE_ALIAS_ESTUDIO: alias,
                CLAVE_ALIAS_ESTUDIO: clave,
                PRECIO_ALIAS_ESTUDIO: precio,
                LABORATORIO_MAQUILA_ID: laboratorio_id,
                api: 9
            }, 'laboratorio_solicitud_maquila_api', {callbackAfter: true}, false, () => {
                alertMensaje('info', '¡Alias Registrado!', 'El alias se ha registrado con exito.');
                actualizarAliasEstudiosInSelect();
                $('#modalAsociarEstudio').modal('hide');
                tempNewAliasEstudio = null;
            });
        }, 1);
    } else {
        alertToast('Selecciona un estudio e ingresa la clave del estudio.', 'warning', 4000);
    }
});

// Carga los alias de estudios en el select2 y los preselecciona
const actualizarAliasEstudiosInSelect = () => {
    const estudiosIds = listaServiciosMaquilaEstudios.map(estudio => estudio.ID_ESTUDIO);
    const laboratorio_id = $('#select-laboratorios-maquila').val();

    rellenarOrdenarSelect('#select-aliases-estudio', 'laboratorio_solicitud_maquila_api', 8, 'LAB_ALIAS_SERVICIO_ID', 'LAB_ESTUDIO_NOMBRE', {
        LISTA_ESTUDIOS: estudiosIds.join(",").toString() || "",
        LABORATORIO_MAQUILA_ID: laboratorio_id ?? '0'
    }, () => {
        // Recuperar seleccionados (excepto los removidos)
        const seleccionados = estudiosIds
            .filter(id => !listaEstudiosNoMaquilables.includes(id.toString()));

        $('#select-aliases-estudio').val(seleccionados).trigger('change');
    });
}

// Muestra los estudios del servicio seleccionado para la selección granular de estudios a maquilar
function crearListaCheckboxEstudio() {
    if (listaServiciosMaquilaEstudios.length > 0) {
        let generateCheckbox = '';

        for (let i = 0; i < listaServiciosMaquilaEstudios.length; i++) {
            const id = listaServiciosMaquilaEstudios[i].ID_ESTUDIO;

            generateCheckbox += `
                <div class="form-check-lista-estudios">
                    <label class="form-check-label" for="check${id}">
                        <input type="checkbox"
                            value="${id}" 
                            id="check${id}"
                            ${listaEstudiosNoMaquilables.includes(id.toString()) ? '' : 'checked'}
                            class="input-checkbox input-estudios-check"
                        >
                        <span style="margin-left: 4px">${listaServiciosMaquilaEstudios[i].NOMBRE_ESTUDIO}</span>
                    </label>
                </div>
            `;
        }

        $('#body-maquila-estudios-grupos-container').html(generateCheckbox);

        $(".input-estudios-check").on("change", function () {
            actualizarAliasEstudios(this);
        });
    } else {
        $('#body-maquila-estudios-grupos-container').html(`
            <p class="text-center">No se encontraron estudios para maquila.</p>
        `);
    }
}

function actualizarAliasEstudios(current) {
    const id = $(current).val();

    if ($(current).is(':checked')) {
        // Si se vuelve a marcar, lo quitamos de la lista de removidos
        listaEstudiosNoMaquilables = listaEstudiosNoMaquilables.filter(x => x !== id);
    } else {
        // Si se desmarca, lo agregamos a la lista de removidos
        if (!listaEstudiosNoMaquilables.includes(id)) {
            listaEstudiosNoMaquilables.push(id);
        }
    }

    // Actualizamos el select2 con los estudios marcados
    const seleccionados = $(".input-estudios-check:checked").map(function () {
        return $(this).val();
    }).get();

    $('#select-aliases-estudio').val(seleccionados).trigger('change');
}
