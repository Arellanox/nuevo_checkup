tableDetalleRequisicion = $('#tableDetalleRequisicion').DataTable({
    autoWidth: true,
    language: {
        url: "https://cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json",
    },
    lengthChange: false,
    info: true,
    paging: true,
    sorting: true,
    scrollY: '68vh',
    scrollX: true,
    scrollCollapse: true,
    fixedHeader: true,
    ajax: {
        dataType: 'json',
        data: function(d){
            return $.extend(d, dataTableDetalleRequisicion);
        },
        method: 'POST',
        url: '../../../api/requisiciones_api.php',
        error: function (jqXHR, textStatus, errorThrown) {
            alertErrorAJAX(jqXHR, textStatus, errorThrown);
        },
        dataSrc: 'response.data'
    },
    // createdRow: function (row, data, dataIndex) {
    //     if (data.FINALIZADO == 0) {
    //         $(row).addClass('bg-warning text-black');
    //     } else if (data.FINALIZADO == 1) {
    //     }
    // },
    columns: [
        { data: 'COUNT' },
        { data: 'FOLIO' },
        { data: 'PREFOLIO' },
        { data: 'PACIENTE' },
        { data: 'SERVICIO' },
        { data: 'MOTIVO_RECHAZO' },
        { data: 'USUARIO' },
        {
            data: null,
            render: function(data, type, row){
                if(row.ESTADO){
                    return `
                        <button class="btn btn-danger btn-sm disabled">Rechazar</button>
                    `;
                } else {
                    return `
                        <button class="btn btn-danger btn-sm" onclick="cambiarEstadoDetReq(${row.ID_REQUISICION}, ${row.ID_SERVICIO}, ${row.ID_TURNO})">Rechazar</button>
                    `;
                }
                
            },
            title: 'Acciones',
            orderable: false
        }
    ],
    columnDefs: [
        { target: 0, title: '#', className: 'all' },
        { target: 1, title: 'Folio', className: 'all' },
        { target: 2, title: 'Prefolio', className: 'all'},
        { target: 3, title: 'Paciente', className: 'all' },
        { target: 4, title: 'Servicio', className: 'all' },
        { target: 5, title: 'Motivo Rechazo', className: 'all' },
        { target: 6, title: 'Responsable', className: 'all' },
        { target: 7, title: "Acciones",  className: 'all', orderable: false }

    ],
    dom: 'Bl<"dataTables_toolbar">frtip',
    buttons: [
    ]

});


$("#btnRechazar").click(function(){
    // tipoGlobal 1, requisicion
    // tipoGlobal 2, detalle requisicion
    var api = tipoGlobal == 1 ? 2 : 4;
    var mensaje;
    var motivoRechazo = $("#motivoRechazo").val();
    switch (tipoGlobal) {
        case 1:
            mensaje = "Estás rechazando la requisición";
            break;
        case 2:
            mensaje = "Estás rechazando el servicio";
            break;
        default:
            break;
    }

    var data = {
        api: api,
        estado: estadoGlobal,
        id_requisicion: idReqGlobal,
        servicio_id: idServicioGlobal,
        motivo_rechazo: motivoRechazo
    }

    alertMensajeConfirm({
        title: `¿${mensaje}?`,
        text: "¿Desea continuar?.",
        icon: "warning"
    },
    function(){
      ajaxAwait(
        data,
        'requisiciones_api', 
        { callbackAfter: true },
        false,
        function(data){
            if(data.response.code == 1){
                alertToast("Estado actualizado!", "success", 4000)
                if(tipoGlobal==1)
                    tableRequisiciones.ajax.reload();
                else
                    tableDetalleRequisicion.ajax.reload();
            }
        }

    );
    },1);

    $("#modalRechazo").modal('hide');

})