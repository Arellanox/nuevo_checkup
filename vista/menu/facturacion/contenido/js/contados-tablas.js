// $('#TablaContados thead tr')
//     .clone(true)
//     .addClass('filters')
//     .appendTo('#TablaContados thead');
selectTicket = null
tablaContados = $('#TablaContados').DataTable({
    language: { url: "https://cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json", },
    scrollY: autoHeightDiv(0, 374),
    scrollCollapse: true,
    deferRender: true,
    lengthMenu: [
        [20, 25, 30, 35, 40, 45, 50, -1],
        [20, 25, 30, 35, 40, 45, 50, "All"]
    ],
    ajax: {
        dataType: 'json',
        data: { api: 2, estado: 1 },
        method: 'POST',
        url: '../../../api/tickets_api.php',
        beforeSend: function () {
            loader("In")
        },
        complete: function () {
            loader("Out")
            tablaContados.columns.adjust().draw()
        },
        error: function (jqXHR, textStatus, errorThrown) {
            alertErrorAJAX(jqXHR, textStatus, errorThrown);
        },
        dataSrc: 'response.data'
    },
    columns: [
        //NUMERO,  NOMBRE DEL PACIENTE, PREFOLIO, FECHA DE RECEPCION QUE FUE ACEPTADO O TERMMINADO, FACTURA SI O NO, GENERO, TURNO 
        { data: 'COUNT' },
        { data: 'NOMBRE_COMPLETO' },
        { data: 'PREFOLIO' },
        {
            data: 'NUM_ESTADO_CUENTA', render: function (data) {
                let html = `<div class="d-flex justify-content-center detalleCuenta" style="width: 40px"> ${ifnull(data, '0000')} </div>`
                return html
            }
        },
        {
            data: 'FECHA_IMPRESION', render: function (data) {
                return formatoFecha2(data, [0, 1, 5, 2, 0, 0, 0], null);
            }
        },
        {
            data: 'FACTURA', render: function (data) {
                // return data == 1 ? '<p class="fw-bold text-success" style="letter-spacing: normal !important;">Facturado</p>' : '<p class="fw-bold text-warning" style="letter-spacing: normal !important;">No facturado</p>';
                return data != 0 ? data : '<p class="fw-bold text-warning" style="letter-spacing: normal !important;">Sin Facturar</p>';
            }
        },
        {
            data: 'FECHA_FACTURA', render: function (data) {
                return formatoFecha2(data, [0, 1, 5, 2, 0, 0, 0]);
            }
        },
        { data: 'TURNO' },
        { data: 'GENERO' },
        {
            data: 'FACTURA', render: function (data) {
                return data != 0 ? 'Facturado' : 'Sin Facturar'; // <-- Buscable
            }
        },
        {
            data: 'FACTURA', render: function (data) {
                return `<i class="bi bi-receipt-cutoff btn-facturar" style="cursor: pointer; font-size:18px;"> Facturar</i>`;
            }
        }
    ],
    columnDefs: [
        { target: 0, title: '#', className: 'all' },
        { target: 1, title: 'Nombre', className: 'all' },
        { target: 2, title: 'Prefolio', className: 'all' },
        { target: 3, title: 'Cuenta', className: 'all' },
        { target: 4, title: 'Finalizado', className: 'all' },
        { target: 5, title: 'Factura', className: 'all' },
        { target: 6, title: 'Fecha', className: 'all' },
        { target: 7, title: 'Turno', className: 'none' },
        { target: 8, title: 'Genero', className: 'none' },
        { target: 9, visible: false, searchable: true }, // <-- ocultarlo pero buscable para los facturados
        { target: 10, title: 'Facturar', className: 'all', width: '' },

    ],

    dom: 'Bfrtip',
    buttons: [
        {
            text: '<i class="bi bi-receipt-cutoff" style="cursor: pointer;"> Ticket',
            titleAttr: 'PDF',
            className: 'btn btn-danger',
            action: function () {
                if (selectTicket) {
                    alertMensaje('info', 'Generando Ticket', 'Podrás visualizar el ticket en una nueva ventana', 'Si la ventana no fue abierta, usted tiene bloqueada las ventanas emergentes')

                    api = encodeURIComponent(window.btoa('ticket'));
                    turno = encodeURIComponent(window.btoa(selectTicket['TURNO_ID']));
                    area = encodeURIComponent(window.btoa(16));


                    window.open(`${http}${servidor}/${appname}/visualizar_reporte/?api=${api}&turno=${turno}&area=${area}`, "_blank");


                } else {
                    alertToast('Por favor, seleccione un paciente', 'info', 4000)
                }
            }
        }
    ]

})


selectTable('#TablaContados', tablaContados, {
    OnlyData: true, divPadre: '#false',
    ClickClass: [
        {
            class: 'detalleCuenta',
            callback: function (data) {
                let px = data['NOMBRE_COMPLETO']
                getInfoEstadoCuenta(px, data['TURNO_ID']);
            }
        }
    ]
}, async (select, data) => {
    selectTicket = data;
    if (select) {
        selectCuenta = new GuardarArreglo({
            select: select,
            data: data,
            id: data['TURNO_ID']
        })
        await obtenerPanelInformacion(data['TURNO_ID'], 'tickets_api', 'PanelTickets', '#InformacionTickets')
    } else {
        selectTicket = null;
        selectCuenta = false
        await obtenerPanelInformacion(0, 'tickets_api', 'PanelTickets', '#InformacionTickets')
    }
})


inputBusquedaTable('TablaContados', tablaContados, [
    {
        msj: 'Dale click a un registro para ver la información de ticket y/o factura.',
        place: 'top'
    }
], {}, 'col-12')

