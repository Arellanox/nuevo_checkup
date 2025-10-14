const hoy = new Date();
var laboratorioSelect = null;
var fecha_inicio = formatDateToYMD(new Date(hoy.getFullYear(), hoy.getMonth() - 2, 1));
var fecha_final = formatDateToYMD(new Date(hoy.getFullYear(), hoy.getMonth(), hoy.getDate() + 1));

$('#btn-filtro-modal').on('click', function () {
    rellenarOrdenarSelect('#select_laboratorios', 'laboratorio_maquila_api', 2, 'ID_LABORATORIO', 'DESCRIPCION');
    $('#select_laboratorios').append(new Option('Todos', null, true));
    $('#modalFiltrarReporte').modal('show');
})

let datosConsolidados = {};
let count = 1;
let tablaPrincipal = $('#TablaReporteMaquilas').DataTable({
    language: { url: "https://cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json" },
    lengthChange: false,
    info: true,
    paging: true,
    lengthMenu: [
        [20, 35, 50, 100, -1],
        [20, 35, 50, 100, "All"]
    ],
    scrollY: '61vh',
    scrollCollapse: true,
    ordering: false,
    ajax: {
        dataType: 'json',
        method: 'POST',
        url: `../../../../api/laboratorio_solicitud_maquila_api.php`,
        data: function (d) {
            return {
                api: 17,
                FECHA_INICIO: fecha_inicio,
                FECHA_FIN: fecha_final
            }
        },
        dataSrc: 'response.data',
        beforeSend: function(){ loader("In") },
        complete: function(){ loader("Out", 'bottom') }
    },
    columns: [
        { data: "COUNT", title: '#'},
        { data: 'DESCRIPCION', title: 'Servicio' },
        { data: 'ABREVIATURA', title: 'Abreviatura' },
        { data: 'COSTO', title: 'Costo', render: function (data) {
                return `$${parseDataTable(data)}`;
            }
        },
        { data: 'PRECIO_VENTA', title: 'Precio Venta', render: function (data) {
                return `$${parseDataTable(data)}`;
            }
        },
        { data: 'PRECIO_DIAGNOSTICA', title: 'Lab. Diagnostica', render: function (data) {
                return `$${parseDataTable(data)}`;
            }
         },
        { data: 'PRECIO_BIOGENICA', title: 'Lab. Biogenica', render: function (data) {
                return `$${parseDataTable(data)}`;
            }
         },
        { data: 'PRECIO_ORTHIN', title: 'Lab. Orthin', render: function (data) {
                return `$${parseDataTable(data)}`;
            }
         },
    ],
    dom: 'Bfrtip',
    buttons: [
        {
            text: '<i class="fa fa-file-excel-o"></i> Excel',
            className: 'btn btn-success',
            titleAttr: 'Descargar Excel',
            action: function () {
                ajaxAwait({
                    api: 19,
                    SERVICIO_ID: null
                }, 'laboratorio_solicitud_maquila_api', { callbackAfter: true }, false, function (data) {
                    let url = 'https://bimo-lab.com/nuevo_checkup/' + data.response.data.url;

                    const link = document.createElement('a');
                    link.href = url;
                    link.target = '_blank';

                    document.body.appendChild(link);
                    link.click();
                    document.body.removeChild(link);
                })
            }
        },
        {
            text: '<i class="fa fa-file-pdf-o"></i> PDF',
            className: 'btn btn-danger',
            titleAttr: 'Descargar PDF',
            action: function () {
                ajaxAwait({
                    api: 18,
                    SERVICIO_ID: null
                }, 'laboratorio_solicitud_maquila_api', { callbackAfter: true }, false, function (data) {
                    let url = data.response.data.url;

                    // Verificar si estás en localhost y si la URL contiene "bimo-lab.com"
                    if (servidor === 'localhost' && url.includes('bimo-lab.com')) {
                        // Reemplazar "https://bimo-lab.com" por el origen actual (http://localhost)
                        const localOrigin = window.location.origin;
                        url = url.replace(/^https?:\/\/bimo-lab\.com/);
                    }

                    const link = document.createElement('a');
                    link.href = url;
                    link.target = '_blank';

                    document.body.appendChild(link);
                    link.click();
                    document.body.removeChild(link);
                });
            }
        }
    ]
});

inputBusquedaTable('TablaReporteMaquilas', tablaPrincipal, [
    {
        msj: 'Puedes organizar el contenido con los encabezados de la tabla.',
        place: 'top'
    },
    {
        msj: 'El campo de busqueda filtra sus coincidencias.',
        place: 'top'
    },
], {}, 'col-12')

$('#TablaReporteMaquilas tbody').on('click', '.background-group', function () {
    var rows = tablaPrincipal.rows($(this).nextUntil('.background-group'));
    if (rows.nodes().to$().hasClass('d-none')) {
        rows.nodes().to$().removeClass('d-none');
    } else {
        rows.nodes().to$().addClass('d-none');
    }
});

function parseDataTable(data){
    let parsed = parseFloat(data);
    return isNaN(parsed) ? '0.00' : parsed.toFixed(2);
}

function formatDateToYMD(date) {
    const y = date.getFullYear();
    const m = String(date.getMonth() + 1).padStart(2, '0');
    const d = String(date.getDate()).padStart(2, '0');
    return `${y}-${m}-${d}`;
}