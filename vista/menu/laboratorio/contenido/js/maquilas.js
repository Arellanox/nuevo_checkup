var selectServicioMaquila = null;
var listaServiciosMaquilaEstudios = []; //Grupo de estudios para maquila de un servicio (solo para mostrar estudios)

let maquilas_pendientes = $('#TablaMaquilasPendientesAprovacion').DataTable({
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

maquilas_pendientes.ajax.reload();

//Maquilación
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

$(document).on('click', '.btn-maquila-estudios', async function (event) {
    try {
        event.preventDefault();
        selectServicioMaquila = $(this).attr('data-bs-id');
        alertToast('Cargando grupo de estudios, espera un momento', 'info', 2000);

        await ajaxAwait({
            api: 7,
            ID_GRUPO_SERVICIO: selectServicioMaquila
        }, 'laboratorio_solicitud_maquila_api', {callbackAfter: true}, false, function (data) {
            listaServiciosMaquilaEstudios = data.response.data;

            if (listaServiciosMaquilaEstudios.length > 0) {
                let generateCheckbox = '';

                for (let i = 0; i < listaServiciosMaquilaEstudios.length; i++) {
                    generateCheckbox += `
                        <div class="form-check-lista-estudios">
                            <label class="form-check-label" 
                                for="check${listaServiciosMaquilaEstudios[i].ID_ESTUDIO}"
                            >
                                <input type="checkbox"
                                    value="${listaServiciosMaquilaEstudios[i].ID_ESTUDIO}" 
                                    id="check${listaServiciosMaquilaEstudios[i].ID_ESTUDIO}"
                                    checked class="input-checkbox input-estudios-check"
                                >
                                <span style="margin-left: 4px">${listaServiciosMaquilaEstudios[i].NOMBRE_ESTUDIO}</span>
                            </label>
                        </div>
                    `;
                }

                $('#body-maquila-estudios-grupos-container').html(generateCheckbox);
            } else {
                $('#body-maquila-estudios-grupos-container').html(`
                    <p class="text-center">No se encontraron estudios para maquila.</p>
                `);
            }

            rellenarOrdenarSelect('#select-laboratorios-maquila', 'laboratorio_maquila_api', 2, 'ID_LABORATORIO', 'DESCRIPCION');
            $('#modalMaquilaEstudios').modal('show');
        });
    } catch (error) {
        console.warn(`❗System: Error al obtener el grupo de estudios, grupo id: ${selectServicioMaquila}.`)
        console.warn(error);
    }
});
