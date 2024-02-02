//Varibales
var selectedEstudiosCargadosPacientes

//Evento click que busca exactamente ese boton con la clase
$(document).on('click', 'button.btn-vizu-reporte', function (event) {
    event.preventDefault();
    event.stopPropagation();
    //  la id, y actualizar la tabla
    let btn = $(this);
    let id_turno = btn.attr('data-bs-id')

    // Los datos que recoge para poner en la tabla se ponen con el id_turno que se trae de la pestaña anterior
    dataDetallePacientesReportes = { api: 3, id_turno: id_turno }
    // Se recarga la vista cada vez que entra a un nuevo paciente
    TablaDetallePacientesReportes.clear().draw()
    TablaDetallePacientesReportes.ajax.reload()

    $('#adobe-dc-view').html("")

    // Se abre el molda una vez que se haya cargado todos los datos
    $('#ModalVisualizarDetallePacientes').modal('show');
    setTimeout(() => {
        TablaDetallePacientesReportes.columns.adjust().draw()
    }, 300);
})


TablaDetallePacientesReportes = $("#TablaDetallePacientesReportes").DataTable({
    language: { url: "https://cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json", },
    lengthChange: false,
    info: true,
    paging: false,
    scrollY: '43vh',
    scrollCollapse: true,
    ajax: {
        dataType: 'json',
        data: function (d) {
            return $.extend(d, dataDetallePacientesReportes);
        },
        method: 'POST',
        url: `${http}${servidor}/${appname}/api/tracking_medicos_api.php`,
        beforeSend: function () {
        },
        complete: function () {
            TablaDetallePacientesReportes.columns.adjust().draw()
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
            data: 'RUTA', render: function (data) {
                let html;


                if (data === null || data === "null") {
                    html = `<i class="bi bi-file-earmark-pdf"></i>`
                } else {
                    html = `<i class="bi bi-file-earmark-pdf-fill text-danger"></i>`
                }


                return html;
            }
        }
    ],
    columnDefs: [
        { target: 0, title: 'Estudio', className: 'all' },
        { target: 1, title: 'Reporte', className: 'all' }
    ]
})


selectTable('#TablaDetallePacientesReportes', TablaDetallePacientesReportes,
    { unSelect: true, dblClick: false, noColumns: true, reload: false, divPadre: '#modal-body-show_estudios' },
    async function (select, data, callback) {
        if (select) {
            SaveDataEstudiosPacientes(data)
            MostrarReportePDF()
        } else {
            SaveDataEstudiosPacientes()
        }
    }
)

inputBusquedaTable('TablaDetallePacientesReportes', TablaDetallePacientesReportes, [
    {
        msj: "Si el icono del PDF no aparece en rojo oes por que ese estudio no cuenta con un reporte",
        place: "top"
    },
    {
        msj: "Si no aparecen datos es por que el paciente no tiene ningun estudio cargado",
        place: "top"
    }
], [], 'col-18')


// funcion para setear o limpiar los estudios cargados de un paciente
function SaveDataEstudiosPacientes(data = false) {
    if (data) {
        selectedEstudiosCargadosPacientes = data
    } else {
        selectedEstudiosCargadosPacientes = null
        $('#adobe-dc-view').html("")
    }
}

function MostrarReportePDF() {
    const RUTA = selectedEstudiosCargadosPacientes['RUTA'];
    const NOMBRE = selectedEstudiosCargadosPacientes['NOMBRE_ARCHIVO'];

    if (RUTA === null) {
        alertToast('El estudio seleccionado no cuenta con un reporte', 'error', 2000)
        return false;
    }

    getNewView(RUTA, NOMBRE)
}

// Función que se ejecuta cuando se realiza una acción para obtener un nuevo PDF
function getNewView(url, filename) {
    // Destruir la instancia existente de AdobeDC.View
    // Crear una instancia inicial de AdobeDC.View
    let adobeDCView = new AdobeDC.View({ clientId: "cd0a5ec82af74d85b589bbb7f1175ce3", divId: "adobe-dc-view" });

    var nuevaURL = url;

    // Agregar un parámetro único a la URL para evitar la caché del navegador
    nuevaURL += "?timestamp=" + Date.now();

    // Cargar y mostrar el nuevo PDF en el visor
    adobeDCView.previewFile({
        content: { location: { url: nuevaURL } },
        metaData: { fileName: filename }
    });
}