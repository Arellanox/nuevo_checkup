let maquilas_pendientes = $('#TablaMaquilasPendientesAprovacion').DataTable({
    language: {
        url: "https://cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json",
    },
    searching: false,
    lengthChange: false,
    info: false,
    paging: false,
    scrollY: autoHeightDiv(0, 300),
    scrollCollapse: true,
    ajax: {
        dataType: "json",
        data: { api: 2, MOSTRAR_OCULTOS: 1 },
        method: "POST",
        url: "../../../api/laboratorio_solicitud_maquila_api.php",
        dataSrc: "response.data",
    },
    columns: [
        {
            data: "SERVICIO",
            createdCell: function (td) {
                $(td).attr('colspan', '2')
            }
        },
        {
            data: "LABORATORIO",
            createdCell: function (td) {
                $(td).attr('colspan', '2')
            }
        },
        {
            data: "SOLICITANTE",
            createdCell: function (td) {
                $(td).attr('colspan', '2')
            }
        },
        {
            data: "ESTATUS",
            createdCell: function (td) {
                $(td).attr('colspan', '1')
            }
        },
        {
            data: "FECHA_REGISTRO",
            createdCell: function (td) {
                $(td).attr('colspan', '2')
            }
        },
        {
            data: null,
            render: function (data, type, row) {
                return `
                <div class="d-flex gap-2 align-items-center justify-content-center">
                    <buttton type="button" role="button" onclick="ocultarMaquilasPendientes(${row.ID_MAQUILA})">
                        <i class="fa fa-eye-slash"></i>
                    </buttton>
                    <buttton type="button" role="button" onclick="eliminarMaquilaPendiente(${row.ID_MAQUILA})">
                        <i class="fa fa-trash"></i>
                    </buttton>
                </div>
                `;
            },
            createdCell: function(td){
                $(td).attr('colspan', '1')
            }
        }
    ],
    columnDefs: [
        { width: "3px", targets: 0 }
    ]
});

function ocultarMaquilasPendientes(idMaquila) {
    alertMensajeConfirm({
        icon: 'alert',
        title: '¿Estas seguro de ocultar esta solicitud de maquilación?',
        text: 'No podra revertir esta acción',
        showCancelButton: true
    }, function () {
        $.ajax({
            dataType: "json",
            data: { api: 3, ID_MAQUILA: idMaquila, ACTIVO: 2},
            method: "POST",
            url: "../../../api/laboratorio_solicitud_maquila_api.php",
            success: function (response) {
                if (response.response.code) {
                    Toast.fire({
                        icon: "success",
                        title: "¡Maquila ocultada!",
                    })

                    maquilas_pendientes.ajax.reload();
                }
            }
        });
    }, 1);
}

function eliminarMaquilaPendiente(idMaquila) {
    alertMensajeConfirm({
        icon: 'warning',
        title: '¿Estas seguro de eliminar esta solicitud de maquilación?',
        text: 'No podra revertir esta acción',
        showCancelButton: true
    }, function () {
        $.ajax({
            dataType: "json",
            data: {api: 4, ID_MAQUILA: idMaquila},
            method: "POST",
            url: "../../../api/laboratorio_solicitud_maquila_api.php",
            success: function (response) {
                if (response.response.code) {
                    Toast.fire({
                        icon: "success",
                        title: "¡Maquila eliminada!",
                    })

                    maquilas_pendientes.ajax.reload();
                }
            }
        });
    }, 1);
}