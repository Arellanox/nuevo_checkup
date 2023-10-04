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
            data: null, render: function (data) {
                return 0
            }
        },
        {
            data: null, render: function data() {
                return 0
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
        { target: 5, title: '<i class="bi bi-trash"></i>', className: 'all', width: '5px' }
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
    } else {
        SelectedMedicosTratantes = null;
    }
}

// Function para configurar el modal para agregar o actualizar un usuario a un medico tratante
async function configurarModal() {
    LimpiarModal()
    const NOMBRE_MEDICO = SelectedMedicosTratantes['NOMBRE_MEDICO'];
    const EMAIL_MEDICO = SelectedMedicosTratantes['EMAIL'];
    const ID_MEDICO = SelectedMedicosTratantes['ID_MEDICO'];
    const USUARIO_ID = SelectedMedicosTratantes['USUARIO_ID'];

    $('#usuarioMedicoTitle').html(`Modificar información del médico: <b>${NOMBRE_MEDICO}</b>`)


    $('#nombre-medicoTrarante-a').val(NOMBRE_MEDICO)
    $('#email-medicoTratante-a').val(ifnull(EMAIL_MEDICO, 'Sin correo'))

    await rellenarSelect("#usuarios_medicos", "usuarios_api", 2, "ID_USUARIO", "nombrecompleto");
    select2('#usuarios_medicos', 'UsuarioMedicoTratante ', 'Selecciona un usuario para el medico tratante');

    $('#UsuarioMedicoTratante').modal('show');
}

// Function para limpiar el modal #UsuarioMedicoTratante
function LimpiarModal() {
    $('#usuarioMedicoTitle').html("");
    $('#nombre-medicoTrarante-a').val("");
    $('#email-medicoTratante-a').val("");

    $('#usuario_medico_check').prop('checked', false);
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

// ==============================================================================

// ###################### Otras cosas ###########################################

// ==============================================================================

