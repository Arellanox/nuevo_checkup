//Funcion para eliminar los medicos tratantes
// function desactivarTablaMedicosTratantes() {
//     var id_medico = $(this).data("id");
// btn-vizu-reporte

//         ajaxAwait(dataJson_eliminarMedico, 'medicos_tratantes_api', { callbackAfter: true }, false, function (data) {
//             alertToast('Médico tratante eliminado!', 'success', 4000)
//             tablaPacientesTratantes.ajax.reload();
//         })
//     }, 1)
// }



// ==============================================================================

// ###################### Variables #############################################

// ==============================================================================

var selectedPacientes;
var dataJsonTablaEstudiosPaciente;

// ==============================================================================

// ###################### Tablas ################################################

// ==============================================================================
dataPacientesTratantes = { api: 4, fecha_inicio: obtenerFechaActualYMD(), fecha_fin: obtenerFechaActualYMD(), todos: 0 };
//Tbla donde se vizualiza los Médicos tratantes ya registrados en la base de datos
tablaPacientesTratantes = $("#tablaPacientesTratantes").DataTable({
    language: { url: "https://cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json", },
    lengthChange: false,
    info: false,
    paging: true,
    scrollY: '40vh',
    scrollCollapse: true,
    ajax: {
        dataType: 'json',
        data: function (d) {
            return $.extend(d, dataPacientesTratantes);

        },
        method: 'POST',
        url: `${http}${servidor}/${appname}/api/medicos_tratantes_api.php`,
        beforeSend: function () {
        },
        complete: function () {
            tablaPacientesTratantes.columns.adjust().draw()
            // obtenerBTNEstudios()
        },
        error: function (jqXHR, textStatus, errorThrown) {
            alertErrorAJAX(jqXHR, textStatus, errorThrown);
        },
        dataSrc: 'response.data'
    },
    columns: [
        { data: 'COUNT' },
        { data: 'PX' },
        { data: 'NOMBRE_MEDICO' },
        { data: 'CLIENTE' },
        {
            data: 'FECHA_RECEPCION', render: function (data) {
                return formatoFecha2(data, [0, 1, 3, 1])
            }
        },
        {
            data: 'FECHA_AGENDA', render: function (data) {
                return formatoFecha2(data, [0, 1, 3, 1])
            }
        },
        { data: 'PREFOLIO' },
        { data: 'ID_TURNO' },
        {
            data: 'EDAD', render: function (data) {
                return formatoEdad(data)
            }
        },
        { data: 'GENERO' },
        { data: null },
    ],
    columnDefs: [
        { target: 0, title: '#', className: 'all', width: '1%' },
        { target: 1, title: 'Nombre del Paciente', className: 'all' },
        { target: 2, title: 'Médico Tratante', className: 'all' },
        { target: 3, title: 'Procedencia', className: 'all' },
        { target: 4, title: 'Fecha de recepcion', className: 'all' },
        { target: 5, title: 'Fecha agendado', className: 'all' },
        { target: 6, title: 'Prefolio', className: 'all' },
        { target: 7, title: 'Turno', className: 'none' },
        { target: 8, title: 'Edad', className: 'none' },
        { target: 9, title: 'Sexo', className: 'none' },
        {
            targets: 10,
            title: '#',
            className: 'all actions',
            width: '1%',
            data: null,
            defaultContent: `
                <button type="button" class="btn-vizu-reporte btn btn-pantone-325" style="font-size: 20px;margin: 0;padding: 1px 8px 1px 8px;">
                    <i class="bi bi-clipboard2-pulse-fill btn-vizu-reporte"></i>
                </button>`
        }
    ]
})

inputBusquedaTable('tablaPacientesTratantes', tablaPacientesTratantes, [], [], 'col-18')

selectTable('#tablaPacientesTratantes', tablaPacientesTratantes,
    {
        // onlyData: true,
        ClickClass: [
            {
                class: 'btn-vizu-reporte',
                callback: function (data) {
                    // Cargar modal de estudios del paciente
                    configurarModal(data)
                },
                selected: false,
            },
        ]
    }
)

// ==============================================================================

// ###################### FUNCIONES #############################################

// ==============================================================================

// function para configurar el modal
async function configurarModal(data) {
    ChangePacienteData(data)
    const NOMBRE = selectedPacientes['PX'];
    const TURNO_ID = selectedPacientes['ID_TURNO'];

    $('#estudios_nombre-paciente').html(NOMBRE)

    dataJsonTablaEstudiosPaciente = {
        api: 6,
        turno_id: TURNO_ID
    }

    await ajaxAwait(dataJsonTablaEstudiosPaciente, 'medicos_tratantes_api', {callbackAfter: true}, false, (data) => {
        if(data.response.data && data.response.data.length > 1) {
            TablaEstudiosCargadosPaciente.ajax.reload()
            $("#ModalVisualizarEstudiosPaciente").modal('show');
        } else {
            if(data.response.data[0]?.RUTA){
                window.open(data.response.data[0]?.RUTA, '_blank');
            } else alertToast('No ha seleccionado ningún registro', info)

        }
    });
}

// Funcion para setear o limpiar en una variable la informacion del paciente
function ChangePacienteData(data = false) {

    if (data) {
        selectedPacientes = data;
    } else {
        selectedPacientes = null;
    }
}

// ==============================================================================

// ###################### Otras cosas ###########################################

// ==============================================================================