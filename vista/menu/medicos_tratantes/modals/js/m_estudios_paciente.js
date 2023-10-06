// ==============================================================================

// ###################### Variables #############################################

// ==============================================================================

var selectedEstudiosCargadosPacientes; // <- Aqui se guardan toda la información del estudio que seleccione

// ==============================================================================

// ###################### Tablas ################################################

// ==============================================================================

TablaEstudiosCargadosPaciente = $("#tablaEstudiosCargadosPaciente").DataTable({
    language: { url: "https://cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json", },
    lengthChange: false,
    info: true,
    paging: false,
    scrollY: '43vh',
    scrollCollapse: true,
    ajax: {
        dataType: 'json',
        data: function (d) {
            return $.extend(d, dataJsonTablaEstudiosPaciente);
        },
        method: 'POST',
        url: `${http}${servidor}/${appname}/api/medicos_tratantes_api.php`,
        beforeSend: function () {
        },
        complete: function () {
            TablaEstudiosCargadosPaciente.columns.adjust().draw()
            // obtenerBTNEstudios()
        },
        error: function (jqXHR, textStatus, errorThrown) {
            alertErrorAJAX(jqXHR, textStatus, errorThrown);
        },
        dataSrc: 'response.data'
    },
    columns: [
        { data: 'AREA_LABEL' },
        {
            data: null, render: function () {

                return 0
            }
        }
    ],
    columnDefs: [
        { target: 0, title: 'Estudio', className: 'all' },
        { target: 1, title: '#', className: 'all' }
    ]
})

selectTable('#tablaEstudiosCargadosPaciente', TablaEstudiosCargadosPaciente, { unSelect: true, dblClick: false, noColumns: true }, async function (select, data, callback) {

    // if (select) {
    //     SaveDataEstudiosPacientes(data)
    // } else {
    //     SaveDataEstudiosPacientes()
    // }
})

inputBusquedaTable('tablaEstudiosCargadosPaciente', TablaEstudiosCargadosPaciente, [], [], 'col-18')

// ==============================================================================

// ###################### FUNCIONES #############################################

// ==============================================================================

// funcion para setear o limpiar los estudios cargados de un paciente
function SaveDataEstudiosPacientes(data = false) {
    if (data) {
        selectedEstudiosCargadosPacientes = data
    } else {
        selectedEstudiosCargadosPacientes = null
    }
}

// ==============================================================================

// ###################### Otras cosas ###########################################

// ==============================================================================

const ModalVisualizarEstudiosPaciente = document.getElementById('ModalVisualizarEstudiosPaciente')
ModalVisualizarEstudiosPaciente.addEventListener('show.bs.modal', event => {
    setTimeout(() => {
        $.fn.dataTable
            .tables({
                visible: true,
                api: true
            })
            .columns.adjust();
    }, 210);

})
