tableRequisiciones = $('#tableRequisiciones').DataTable({
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
            return $.extend(d, dataTableRequisiciones);
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
        { data: 'FECHA_REQUISICION' },
        { data: 'FOLIO' },
        { 
            data: 'ESTADO',
            render: function(data, type, row){
                if(data){
                    if(data == 1){
                        return `<span class="badge bg-success">Enviado</span>`
                    } else {
                        return `<span class="badge bg-danger">Rechazado</span>`
                    }
                    
                } else {
                    return `<span class="badge bg-warning">Abierta</span>`
                }
            }
        },
        { data: 'MOTIVO_RECHAZO' },
        { data: 'RESPONSABLE' },
        {
            data: null,
            render: function(data, type, row) {
                if (data) {
                    if(row.ESTADO === "1"){
                        return `<button class="btn btn-danger btn-sm btn-lista-trabajo-barras" onclick="obtener_reporte(${row.ID_REQUISICION})">Generar PDF</button>`;
                    }
                    
                    return `<button class="btn btn-danger btn-sm" disabled>PDF</button>`;
                }
            }
        },
        {
            data: null,
            render: function(data, type, row){
                if(row.ESTADO){
                    return `
                        <button class="btn btn-success btn-sm disabled" onclick="cambiarEstadoReq(${row.ID_REQUISICION}, 1)">Enviar</button>
                        <button class="btn btn-danger btn-sm disabled" onclick="cambiarEstadoReq(${row.ID_REQUISICION}, 0)">Rechazar</button>
                        <button class="btn btn-info btn-sm" onclick="verDetalleRequisicion(${row.ID_REQUISICION})">Ver</button>
                    `;
                } else {
                    return `
                        <button class="btn btn-success btn-sm" onclick="cambiarEstadoReq(${row.ID_REQUISICION}, 1)">Enviar</button>
                        <button class="btn btn-danger btn-sm" onclick="cambiarEstadoReq(${row.ID_REQUISICION}, 0)">Rechazar</button>
                        <button class="btn btn-info btn-sm" onclick="verDetalleRequisicion(${row.ID_REQUISICION})">Ver</button>
                    `;
                }
                
            },
            title: 'Acciones',
            orderable: false
        }
    ],
    columnDefs: [
        { target: 0, title: '#', className: 'all' },
        { target: 1, title: 'Fecha creación', className: 'all' },
        { target: 2, title: 'Folio', className: 'all'},
        { target: 3, title: 'Estado del envío', className: 'all' },
        { target: 4, title: 'Motivo rechazo', className: 'all' },
        { target: 5, title: 'Responsable', className: 'all' },
        { target: 6, title: 'PDF', className: 'all', orderable: false },
        { target: 7, title: 'Acciones', className: 'all', orderable: false }

    ],
    dom: 'Bl<"dataTables_toolbar">frtip',
    buttons: [
    ]

});


function cambiarEstadoReq(idReq, estado){
    var mensaje = "Estás rechazando la requisición";

    if(estado == 0 ){
        $("#modalRechazo").modal('show');
        estadoGlobal = estado;
        tipoGlobal = 1;
        idReqGlobal= idReq;
        return;
    }

    if(estado == 1){
        mensaje = "Estás enviando la requisición";
    }

    alertMensajeConfirm({
        title: `¿${mensaje}?`,
        text: "¿Desea continuar?.",
        icon: "warning"
    },
    function(){
      ajaxAwait(
        { 
            api: 2,
            id_requisicion: idReq,
            estado: estado
        },
        'requisiciones_api', 
        { callbackAfter: true },
        false,
        function(data){
            if(data.response.code == 1){
                alertToast("Estado actualizado!", "success", 4000)
                tableRequisiciones.ajax.reload();
            }
        }

    );
    },1);
}

function obtener_reporte(turno_id){
    api = encodeURIComponent(window.btoa("requisicion_maquilas"));
    turno = encodeURIComponent(window.btoa(turno_id));
    area = encodeURIComponent(window.btoa('1'));

    window.open(`${http}${servidor}/${appname}/visualizar_reporte/?api=${api}&turno=${turno}&area=${area}`, "_blank");
}

function verDetalleRequisicion(idReq){
    dataTableDetalleRequisicion = {
        api: 3,
        id_requisicion: idReq
    }
    tableDetalleRequisicion.ajax.reload();
    $("#modalDetalleRequisicion").modal('show');
}