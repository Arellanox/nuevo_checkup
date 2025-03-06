
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
        { data: 'LABORATORIO' },
        { data: 'MOTIVO_RECHAZO' },
        { data: 'USUARIO' },
        {
            data: null,
            render: function(data, type, row){
                if(row.ESTADO){
                    if (row.ESTADO == 1)
                        return `<span class="badge text-bg-success">Aceptado</span>`
                    else
                        return `<span class="badge text-bg-danger">Rechazado</span>`
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
        { target: 5, title: 'Laboratorio', className: 'all' },
        { target: 6, title: 'Motivo Rechazo', className: 'all' },
        { target: 7, title: 'Responsable', className: 'all' },
        { target: 8, title: "Acciones",  className: 'all', orderable: false }

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
        motivo_rechazo: motivoRechazo,
        turno_id: idTurnoGlobal
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
                updateBadgetMenuRequisicion();
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

// asignamos las variables blobales para el metodo que se comparte.
function cambiarEstadoDetReq(req, serv, turn){
    tipoGlobal = 2;
    idReqGlobal = req;
    idServicioGlobal = serv;
    idTurnoGlobal = turn;
    estadoGlobal = 0;

    $("#modalRechazo").modal('show');
}

$("#btnGuardarRequisicion").click(function(){
    var prefolio = $("#prefolio").val();
    var servicio = $("#servicio").val();
    var observaciones = $("#observaciones").val();

    var data;
    data = {
        id_servicio: servicio,
        prefolio: prefolio,
        observaciones: observaciones,
        api: 5
    }

    alertMensajeConfirm({
        title: `¿Está agregando una maquila?`,
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
                alertToast("Maquila agregada!", "success", 4000)
                updateBadgetMenuRequisicion();
                if(tipoGlobal==1)
                    tableRequisiciones.ajax.reload();
                else
                    tableDetalleRequisicion.ajax.reload();
                    $('#formRequisicion')[0].reset();
            }
        }
    );
    },1);

})


// rellenar el select para la nueva requisicion
select2("#formRequisicion #servicio", "ModalAgregarRequisicion", 'Seleccione un estudio');
rellenarSelect('#formRequisicion #servicio', 'servicios_api', 3, "ID_SERVICIO", "DESCRIPCION", {
    id_area: 6
});

async function updateBadgetMenuRequisicion() {
  $.post(
      "/nuevo_checkup/api/requisiciones_api.php",
      {
        api: 3,
      },
      function (response) {
        let parsedResponse = JSON.parse(response);
        let data =
          parsedResponse.response && Array.isArray(parsedResponse.response.data)
            ? parsedResponse.response.data
            : [];

        if (data.length > 0) {
          pendientes = data.filter(
            (requisicion) => requisicion.ESTADO === null
          );

          console.log(data);

          $(".alert_requisiciones")
            .css("display", "inline-block")
            .text(pendientes?.length ?? 0);
        } else {
          $(".alert_requisiciones").css("display", "none");
        }
      }
    ).fail(function (error) {
      console.error("Error obteniendo los datos:", error);
      exec = false; // Resetear `exec` si la solicitud falla
    });
}