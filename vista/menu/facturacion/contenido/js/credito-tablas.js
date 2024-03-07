TablaGrupos = $('#TablaGrupos').DataTable({
    language: {
        url: "https://cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"
    },
    lengthChange: false,
    info: false,
    paging: true,
    scrollY: '65vh',
    lengthMenu: [
        [20, 25, 30, 35, 40, 45, 50, -1],
        [20, 25, 30, 35, 40, 45, 50, "All"]
    ],
    scrollCollapse: true,
    ajax: {
        dataType: 'json',
        data: { api: 2 },
        method: 'POST',
        url: '../../../api/admon_grupos_api.php',
        beforeSend: function () {
            loader("In")
            // fadeRegistro('Out')

        },
        complete: function () {
            loader("Out")
            //Para ocultar segunda columna
            reloadSelectTable()

        },
        error: function (jqXHR, textStatus, errorThrown) {
            alertErrorAJAX(jqXHR, textStatus, errorThrown);
        },
        dataSrc: 'response.data'
    },
    createdRow: function (row, data, dataIndex) {
        if (parseInt(ifnull(data, 0, ['FACTURADO']))) {
            $(row).addClass('bg-success text-white');
        }
    },
    columns: [
        { data: 'COUNT' },
        {
            data: 'FOLIO_ETIQUETA', render: function (data) {
                let html = `<div class="d-flex justify-content-center GrupoInfoCreditoBtn" style="width: 40px">  ${ifnull(data, '')}  </div>`
                return html
            }
        },
        { data: 'PROCEDENCIA' },
        {
            data: 'FECHA_CREACION', render: function (data) {
                return formatoFecha2(data, [0, 1, 3, 1]);
            }
        },
        {
            data: 'FECHA_FACTURA', render: function (data) {
                return formatoFecha2(data, [0, 1, 3, 1]);
            }
        },
        { data: 'FACTURA' }
        // {defaultContent: 'En progreso...'}
    ],
    columnDefs: [
        { target: 0, title: '#', className: 'all', width: '1%' },
        { target: 1, title: 'Folio', className: 'all', width: '20px' },
        { target: 2, title: 'Procedencia', className: 'all' },
        { target: 3, title: 'Creacion', className: 'none' },
        { target: 4, title: 'Fecha de Factura', className: 'tablet' },
        { target: 5, title: 'Factura', className: 'tablet' }
    ],

})


inputBusquedaTable("TablaGrupos", TablaGrupos, [], {
    msj: "Filtre los resultados por el folio o por la empresa",
    place: 'top'
}, "col-12")



selectTable('#TablaGrupos', TablaGrupos, {
    unSelect: true, reload: ['col-xl-9'], divPadre: '#vistaGruposFactura',
    // OnlyData: true,
    ClickClass: [
        {
            class: 'GrupoInfoCreditoBtn',
            callback: function (data) {

                $("#ModalInformacionGruposCredito_title").html(`Información Grupos de Crédito - (${ifnull(data['ID_GRUPO'])})`)
                $('#procedencia_grupos_credito').html(ifnull(data['PROCEDENCIA']));
                $('#domicilio-fiscal').html(ifnull(data['DIRECCION']));
                $('#fecha-factura').html(ifnull(formatoFecha2(data['FECHA_FACTURA'], [0, 1, 3, 1])));
                $('#factura').html(ifnull(data['FACTURA']));
                $('#rfc').html(ifnull(data['RFC']));


                $('#ModalInformacionGruposCredito').modal('show');
            },
            selected: true
        },
    ], movil: true, "tab-default": 'Detalle',
    tabs: [
        {
            title: 'Grupos',
            element: '#tab-gruposCredito',
            class: 'active',
        },
        {
            title: 'Detalle',
            element: '#tab-detallesCredito',
            class: 'disabled tab-select'
        },
    ],

}, async function (select, data, callback) {
    // fadeRegistro('Out')
    if (select) {
        // $(".informacion-creditos").fadeIn(0)
        DataGrupo.id_grupo = data['ID_GRUPO']
        SelectedGruposCredito = data
        TablaGrupoDetalle.ajax.reload()

        await getDetalleGrupo(data['ID_GRUPO'])
        setInfoGeneral(data);
        // dataDetallePrecio['id_grupo'] = data['ID_GRUPO'];
        // tablaDetallePrecio.ajax.reload()

        //Muestra las columnas
        callback('In')
    } else {
        callback('Out')
    }
})

var DataGrupo = {
    api: 3,
    id_grupo: 0
};


TablaGrupoDetalle = $('#TablaGrupoDetalle').DataTable({
    language: { url: "https://cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json", },
    lengthChange: false,
    info: true,
    paging: false,
    scrollY: '66vh',
    scrollCollapse: true,
    ajax: {
        dataType: 'json',
        data: function (d) {
            return $.extend(d, DataGrupo);
        },
        method: 'POST',
        url: '../../../api/admon_grupos_api.php',
        beforeSend: function () {
            // fadeRegistro('Out')
        },
        complete: function () {
            // fadeRegistro('In')
            TablaGrupoDetalle.columns.adjust().draw()
        },
        error: function (jqXHR, textStatus, errorThrown) {
            alertErrorAJAX(jqXHR, textStatus, errorThrown);
        },
        dataSrc: 'response.data'
    },
    columns: [
        {
            data: 'PX', render: function (data) {
                return '';
            }
        },
        { data: 'PX' },
        { data: 'PREFOLIO' },
        {
            data: 'NUM_ESTADO_CUENTA', render: function (data) {
                let html = `<div class="d-flex justify-content-center ticketDataButton" style="width: 40px"> ${ifnull(data, '0000')} </div>`
                return html
            }
        },
        { data: 'DIAGNOSTICO' },
        {
            data: 'FECHA_RECEPCION', render: function (data) {
                return formatoFecha2(data, [0, 1, 3, 1]);
            }
        }
    ],
    columnDefs: [
        { target: 0, title: '#', className: 'all', width: '1px' },
        { target: 1, title: 'PACIENTE', className: 'all' },
        { target: 2, title: 'PREFOLIO', className: 'all' },
        { target: 3, title: 'CUENTA', className: 'all', width: '30px' },
        { target: 4, title: 'DIAGNOSTICO', className: 'min-tablet' },
        { target: 5, title: 'RECEPCION' /*FECHA*/, className: 'min-tablet' }
    ],

    dom: 'Bfrtip',
    buttons: [
        // {
        //   extend: 'copyHtml5',
        //   text: '<i class="fa fa-files-o"></i>',
        //   titleAttr: 'Copy'
        // },
        {
            text: '<i class="bi bi-receipt-cutoff"></i>  Facturar',
            className: 'btn btn-turquesa',
            action: function () {
                $('#NumeroFactura').val('')
                if (SelectedGruposCredito['FACTURADO'] == 1) {
                    alertMensaje('info', 'Grupo Facturado', `Este grupo ese ya ha sido facturado previamente (${SelectedGruposCredito['FACTURA']})`)

                    return false
                }
                factura = true;
                $("#ModalTicketCreditoFacturado").modal('show');
            }

        },
        {
            text: '<i class="bi bi-box-seam"></i> Modificar',
            className: 'btn btn-success',
            action: () => {
                if (SelectedGruposCredito['FACTURADO'] == 1) {
                    alertMensaje('info', 'Oops!', 'Este grupo ha sido facturado, no puedes actualizar su detalle.');
                    return false;
                }

                dataFill_edit['id_grupo'] = SelectedGruposCredito['ID_GRUPO'];

                $('#cliente_fill').val(SelectedGruposCredito['CLIENTE_ID'])

                tListPaciGrupo.ajax.reload();
                //Para modificar el grupo
                title = '#title-grupo-factura';
                $(title).html(`Grupo: ${SelectedGruposCredito['FOLIO']}, ${SelectedGruposCredito['PROCEDENCIA']}, ${formatoFecha2(SelectedGruposCredito['FECHA_CREACION'], [0, 1, 5, 2, 2, 2, 0])}`)
                console.log($(title))

                // Abrir modal para modificar
                grupoPacientesModificar = SelectedGruposCredito['ID_GRUPO'];
                $('#modalFiltroPacientesFacturacion').modal('show');

            }
        },
        {
            text: '<i class="bi bi-box-arrow-in-up"></i>  Subir factura',
            className: 'btn btn-confirmar',
            action: function () {
                subirFactura = SelectedGruposCredito['ID_GRUPO'];

                input_facturas.resetInputDrag();
                $("#image-preview").html('');
                $("#pdf-canvas").html('');

                $('#modalSubirFacturas').modal('show');
            }

        }
    ]
})


selectTable('#TablaGrupoDetalle', TablaGrupoDetalle, {
    OnlyData: true, divPadre: '#false',
    ClickClass: [
        {
            class: 'ticketDataButton',
            callback: function (data) {
                let px = data['PX']
                getInfoEstadoCuenta(px, data['ID_TURNO']);
            }
        }
    ]
})


inputBusquedaTable('TablaGrupoDetalle', TablaGrupoDetalle, [], {
    msj: "Filtre los resultados por coincidencia",
    place: 'top'
}, 'col-12')

function fadeRegistro(tipe) {
    if (tipe == 'Out') {
        $("#TablaGrupoDetalleCard").fadeOut(0)
        $("#loaderDivmuestras").fadeIn(0);
        $("#loader-muestras").fadeIn(0);
    } else if (tipe == 'In') {
        $("#TablaGrupoDetalleCard").fadeIn(0)
        $("#loaderDivmuestras").fadeOut(0);
        $("#loader-muestras").fadeOut(0);
    }
}



function getDetalleGrupo(id) {
    return new Promise((resolve) => {
        ajaxAwait({
            id_grupo: id, api: 6
        }, 'admon_grupos_api', { callbackAfter: true, WithoutResponseData: true }, false, (row) => {
            row = row[0]
            for (const key in detalles_grupo) {
                const element = detalles_grupo[key];
                const val = ifnull(row, 0, [element.target])
                const html = $(`#${element.id}`)

                html.html(`$${parseFloat(ifnull(val, 0)).toFixed(2)}`)

            }

            resolve(1);
        })
    })
}

function setInfoGeneral(data) {
    $('#info-procedencia').html(`${ifnull(data, 'desconocido', ['PROCEDENCIA'])}`)
    $('#info-creado').html(`${formatoFecha2(ifnull(data, '', ['FECHA_CREACION']), [0, 1, 3, 1])}`)
    $('#info-factura').html(`${ifnull(data, 'Sin facturar', ['FACTURA'])}`)
    $('#info-facturado').html(`${formatoFecha2(ifnull(data, null, ['FECHA_FACTURA']), [0, 1, 3, 1])}`)
}