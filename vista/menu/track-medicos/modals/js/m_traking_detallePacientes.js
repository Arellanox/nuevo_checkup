


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
            return $.extend(d, dataJsonTablaEstudiosPaciente);
        },
        method: 'POST',
        url: `${http}${servidor}/${appname}/api/medicos_tratantes_api.php`,
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
    { unSelect: true, dblClick: false, noColumns: true, divPadre: '#modal-body-show_estudios' },
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


// 
$(document).on('click', '.historial-paciente', function () {
    //  la id, y actualizar la tabla
})