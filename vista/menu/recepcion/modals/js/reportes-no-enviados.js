TablaReportesNoEnviados = $("#TablaReportesNoEnviados").DataTable({
    language: { url: "https://cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json", },
    lengthChange: false,
    info: false,
    paging: false,
    scrollY: '38vh',
    scrollCollapse: true,
    ajax: {
        dataType: 'json',
        data: function (d) {
            return $.extend(d, dataReporteNoEnviados)
        },
        method: 'POST',
        url: `${http}${servidor}/${appname}/api/correos_api.php`,
        beforeSend: function () {
        },
        complete: function () {
            TablaReportesNoEnviados.columns.adjust().draw()
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
        {
            data: null, render: function (meta) {
                return ifnull(meta, null, ['AREA'])
            }
        },
        { data: 'PROCEDENCIA' },
        {
            data: 'ID_CORREO', render: function (data) {
                return `<i class="bi bi-trash eliminar-ReportesEnviados" data-id = "${data}" style = "cursor: pointer"onclick = "desactivarTablaReportes.call(this)"></i>`;
            }
        }
    ],
    columnDefs: [
        { target: 0, title: '#', className: 'all' },
        { target: 1, title: 'Nombre', className: 'all' },
        { target: 2, title: 'Area', className: 'all' },
        { target: 3, title: 'Procedencia', className: 'all' },
        { target: 4, title: '<i class="bi bi-trash"></i>', className: 'all', width: '5px' }
    ]
    // ,
    // createdRow: function (row, data, dataIndex) {
    //     console.log(data.ENVIADO)
    // }
})


inputBusquedaTable('TablaReportesNoEnviados', TablaReportesNoEnviados, [], [], 'col-18')

function desactivarTablaReportes() {

    var id_correo = $(this).data("id");

    alertMensajeConfirm({
        title: '¿Está seguro que desea desactivar este reporte?',
        text: 'No podrá modificarlo despues',
        icon: 'warning',
    }, function () {
        ajaxAwait({ api: 3, id_correo: id_correo }, 'correos_api', { callbackAfter: true }, false, function (data) {
            alertToast('Reporte eliminado!', 'success', 4000)

            TablaReportesNoEnviados.ajax.reload();
        })
    }, 1)
}

$('#btn-reenviarReportes').on('click', function () {
    alertMensajeConfirm({
        title: '¿Está seguro que desea reenviar todos los reportes?',
        text: 'No podrá modificarlo despues',
        icon: 'warning',
    }, function () {
        ajaxAwait({ api: 4 }, 'correos_api', { callbackAfter: true }, false, function (data) {
            alertToast('Reportes reenviados!', 'success', 4000)
            TablaReportesNoEnviados.ajax.reload();
        })
    }, 1)
})
