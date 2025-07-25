let tableEstudiosPendientes = $('#TablaEstudiosPendientes').DataTable({
    language: {url: "https://cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json",},
    // searching: false,
    lengthChange: false,
    info: false,
    paging: false,
    scrollY: autoHeightDiv(0, 300),
    scrollCollapse: true,

    ajax: {
        dataType: "json",
        data: { api: 7},
        method: "POST",
        url: "../../../api/laboratorio_servicios_api.php",
        dataSrc: "response.data",
    },
    columns: [
        { data: "COUNT" },
        { data: "FECHA_RECEPCION" },
        { data: "PX" },
        { data: "PREFOLIO" },
        { data: "SERVICIO" },
        { data: "CODIGO" },
        { data: "USUARIO" },
        // { data: "ID_TURNO" }
        {
            data: null, 
            render: function (data, type, row) {
                return `<i class="fa fa-check-circle" data-id-turno = "${row.ID_TURNO}" data-id-servicio="${row.ID_SERVICIO}" style = "cursor: pointer"onclick = "eliminarEstudioPendiente(${row.ID_TURNO}, ${row.ID_SERVICIO}, '${row.SERVICIO}')"></i>`;
            },
            createdCell: function(td){
                $(td).addClass('text-center');
            }
        }
    ],
    columnDefs: [
        { width: "50px", targets: 0 }
    ],
});

function eliminarEstudioPendiente(id_turno, idServicio, servicio){
    alertMensajeConfirm({
        title: '¿Marcar como completado?',
        text: servicio,
        icon: 'warning',
    }, function () {

        // Enviar la solicitud para marcar el estudio como completado
        ajaxAwait(
            { 
                api: 5, 
                turno_id: id_turno,
                id_servicio: idServicio,
                pendiente: 0
            }, 
            'laboratorio_servicios_api', 
            { callbackAfter: true }, false, function (data) {
            alertToast('Completado!', 'success', 4000)

        });

        // actualizar la notificacion de estudios pendietnes
        ajaxAwait({
            api: 6
        }, 'laboratorio_servicios_api', { callbackAfter: true }, false, function (data) {
            $('#estudios-pendientes-notificacion').text(data.response.data);
        });

        tableEstudiosPendientes.ajax.reload();
    }, 1)
}