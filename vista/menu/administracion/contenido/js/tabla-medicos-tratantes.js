// ==============================================================================

// ###################### Variables #############################################

// ==============================================================================

var SelectedMedicosTratantes;

// ==============================================================================

// ###################### Tablas ################################################

// ==============================================================================

//Tabla donde se vizualiza los Médicos tratantes ya registrados en la base de datos
TablaVistaMedicosTratantes = $("#TablaVistaMedicosTratantes").DataTable({
    language: { url: "https://cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json", },
    lengthChange: false,
    info: true,
    paging: false,
    scrollY: '38vh',
    scrollCollapse: true,
    ajax: {
        dataType: 'json',
        data: function (d) {
            return $.extend(d, dataMedicosTratantes);

        },
        method: 'POST',
        url: `${http}${servidor}/${appname}/api/medicos_tratantes_api.php`,
        beforeSend: function () {
            SelectedMedicosTratantes = null;
        },
        complete: function () {
            TablaVistaMedicosTratantes.columns.adjust().draw()
            // obtenerBTNEstudios()
        },
        error: function (jqXHR, textStatus, errorThrown) {
            alertErrorAJAX(jqXHR, textStatus, errorThrown);
        },
        dataSrc: 'response.data'
    },
    columns: [
        {
            data: 'COUNT'
        },
        {
            data: 'NOMBRE_MEDICO'
        },
        {
            data: 'EMAIL'
        },
        {
            data: 'PACIENTES_ENVIADO'
        },
        {
            data: 'ES_USUARIO', render: function (data) {
                let html;

                if (data === "1") {
                    html = `<i class="bi bi-check-square-fill text-success "></i>`;
                } else if (data === "0") {
                    html = `<i class="bi bi-x-square-fill text-danger  "></i>`;
                }

                return html;
            }
        },
        {
            data: 'TELEFONO', render: function (data) {
                return ifnull(data, 'N/A')
            }
        },
        {
            data: 'ESPECIALIDAD', render: function (data) {
                return ifnull(data, 'N/A')
            }
        },
        {
            data: 'ID_MEDICO', render: function (data) {
                return `<i class="bi bi-trash eliminar-diagnostico" data-id = "${data}" style = "cursor: pointer"
                onclick="desactivarTablaMedicosTratantes.call(this)"></i>`;

            }
        },
    ],
    columnDefs: [
        { target: 0, title: '#', className: 'all' },
        { target: 1, title: 'Nombre del Médico', className: 'all' },
        { target: 2, title: 'Email', className: 'all' },
        { target: 3, title: 'Pacientes', className: 'all' },
        { target: 4, title: 'Usuario', className: 'all' },
        { target: 5, title: 'Teléfono: ', className: 'none' },
        { target: 6, title: 'Especialidad: ', className: 'none' },
        { target: 7, title: '<i class="bi bi-trash"></i>', className: 'all', width: '5px' }
    ],
    dom: 'Bfrtip',
    buttons: [
        {
            text: '<i class="bi bi-person-fill-up"  style="cursor: pointer; font-size:18px;"></i> ',
            className: 'btn btn-success btn-equipos-qr ',
            titleAttr: 'Moficar a un médico tratante',
            action: function (data) {
                if (!SelectedMedicosTratantes) {
                    alertToast('Por favor seleccione un médico')
                    return false;
                }

                configurarModal()
            }
        },
    ]
})

inputBusquedaTable('TablaVistaMedicosTratantes', TablaVistaMedicosTratantes, [], [], 'col-18')

selectTable('#TablaVistaMedicosTratantes', TablaVistaMedicosTratantes, { unSelect: true, dblClick: false, noColumns: true }, async function (select, data, callback) {

    if (select) {
        SaveDataMedicoTratante(data)
    } else {
        SaveDataMedicoTratante()
    }
})

// ==============================================================================

// ###################### FUNCIONES #############################################

// ==============================================================================

// Funcion para setear variables cuando le da select a la tabla Lista de medicos tratantes
function SaveDataMedicoTratante(data = false) {

    if (data) {
        SelectedMedicosTratantes = data
    }
}

// Function para configurar el modal para agregar o actualizar un usuario a un medico tratante
async function configurarModal() {
    LimpiarModal()
    const NOMBRE_MEDICO = SelectedMedicosTratantes['NOMBRE_MEDICO'];
    const EMAIL_MEDICO = SelectedMedicosTratantes['EMAIL'];
    const TELEFONO_MEDICO = SelectedMedicosTratantes['TELEFONO'];
    const ESPECIALIDAD_MEDICO = SelectedMedicosTratantes['ESPECIALIDAD'];
    const ID_MEDICO = SelectedMedicosTratantes['ID_MEDICO'];

    $('#usuarioMedicoTitle').html(`Modificar información del médico: <b>${NOMBRE_MEDICO}</b>`)


    $('#nombre-medicoTrarante-a').val(NOMBRE_MEDICO)
    $('#email-medicoTratante-a').val(ifnull(EMAIL_MEDICO, 'Sin correo'))
    $('#telefono-medicoTratante-a').val(ifnull(TELEFONO_MEDICO, 'Sin telefono'))
    $('#especialidad-medicoTratante-a').val(ifnull(ESPECIALIDAD_MEDICO, 'Sin especialidad'))

    await rellenarSelect("#usuarios_medicos", "usuarios_api", 2, "ID_USUARIO", "nombrecompleto");
    ObtenerUsuario()
    // select2('#usuarios_medicos', 'UsuarioMedicoTratante ', 'Selecciona un usuario para el medico tratante');


    // Para el modal:
    // El usuario no va a poder cambiar el nombre si tiene el checkbox de "#AdjuntarUsuario" activado ya que el nombre que va aparecer en el input de name, es el del "USUARIO" que seleccione, siempre y cuando este activo el checbox

    // En caso contrario que el checkbox no este activo es decir que "#AdjuntarUsuario" esta desactivado. el input estara activo y el usuario podra ingresar el nombre del medico tratante
    AlertaUsuarioMedico = true;
    $('#UsuarioMedicoTratante').modal('show');
}

// Function para limpiar el modal #UsuarioMedicoTratante
function LimpiarModal() {
    $('#usuarioMedicoTitle').html("");
    $('#nombre-medicoTrarante-a').val("");
    $('#email-medicoTratante-a').val("");

    ObtenerUsuario();
    ChangeAdjuntarUsuario('usuario_medico_check');
}

//Funcion para eliminar los medicos tratantes   
function desactivarTablaMedicosTratantes() {
    var id_medico = $(this).data("id");

    alertMensajeConfirm({
        title: '¿Está seguro que desea eliminar este médico?',
        text: 'No podrá modificarlo despues',
        icon: 'warning',
    }, function () {

        dataJson_eliminarMedico = {
            api: 3,
            id_medico: id_medico
        }

        ajaxAwait(dataJson_eliminarMedico, 'medicos_tratantes_api', { callbackAfter: true }, false, function (data) {
            alertToast('Médico tratante eliminado!', 'success', 4000)
            TablaVistaMedicosTratantes.ajax.reload();
        })
    }, 1)
}

// Function para enviar los datos de los medicos tratantes ya sea para agregar uno nuevo o actualizar
function ActualizarMedicoTratante() {
    alertMensajeConfirm({
        title: '¿Está seguro que desea modificar este médico?',
        text: 'No podrá modificarlo despues',
        icon: 'warning',
    }, function () {

        // const NOMBRE_MEDICO = $('#nombre-medicoTrarante-a').val();
        // const EMAIL = $('#email-medicoTratante-a').val();
        const ID_MEDICO = ifnull(SelectedMedicosTratantes['ID_MEDICO'], 'null');
        // const ADJUNTAR_USUARIO = ChangeAdjuntarUsuario('usuario_medico_check');
        // const USUARIO_ID = $('#usuarios_medicos').val();

        let dataJson_Medicos_a = {
            api: 1,
            ignorarALevenshtein: 1,
            // nombre_medico: NOMBRE_MEDICO,
            // email: EMAIL,
            id_medico: ID_MEDICO,
            usuario_id: 0,
            // adjuntar_usuario: ADJUNTAR_USUARIO
        }

        // if (ADJUNTAR_USUARIO === 0)
        //     dataJson_Medicos_a.usuario_id = 0

        ajaxAwaitFormData(dataJson_Medicos_a, 'medicos_tratantes_api', 'form_medicos_tratantes_a', { callbackAfter: true }, false, function (data) {
            console.log(dataJson_Medicos_a);
            alertToast('Médico tratante actualizado', 'success', 4000);

            VolverConstruirPagina(2)
        })
    }, 1)
}

// Function para volver a construir la pagina cuando agrego o actualizo un medico
function VolverConstruirPagina(type, state = true) {

    switch (type) {
        case 1:
            // Agregar Medico tratante
            alertToast('Médico tratante agregado', 'success', 4000);
            LimpiarFormularioRegistro()
            break;
        case 2:
            // Actualizar Medico tratante
            $('#UsuarioMedicoTratante').modal('hide');
            if (!state)
                alertToast('Médico tratante modificado con exito', 'success', 4000);
            SaveDataMedicoTratante();
            LimpiarModal();
            break;
        default:
            break;
    }

    TablaVistaMedicosTratantes.ajax.reload();
}

// Function que valida si el medico seleccionado tiene un usuario asignado
function ObtenerUsuario() {
    try {
        // Alerta: si cambia el usuario del medico, el medico no podra ver los pacientes
        const ID_USUARIO = SelectedMedicosTratantes['USUARIO_ID'];
        // const USUARIO_ID = SelectedMedicosTratantes['USUARIO_ID'];

        if (ID_USUARIO) {
            $('#usuario_medico_check').prop('checked', true);
            $('#usuarios_medicos').val(ID_USUARIO);
            return true;
        } else {
            $('#usuario_medico_check').prop('checked', false);
            return false;
        }
    } catch (error) {
        console.error(error)
    }
}

// ==============================================================================

// ###################### Otras cosas ###########################################

// ==============================================================================

