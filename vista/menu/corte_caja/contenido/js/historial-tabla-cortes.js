// ==============================================================================

// ###################### TABLA HISTORIAL DE CORTES DE CAJA #####################

// ==============================================================================

// Tabla historial de cortes de caja
var TablaHistorialCortes = $('#TablaHistorialCortesCaja').DataTable({
    language: {
        url: "https://cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json",
    },
    lengthChange: false,
    info: true,
    paging: false,
    sorting: false,
    scrollY: '75vh',
    scrollCollapse: true,
    ajax: {
        dataType: 'json',
        data: function (d) {
            return $.extend(d, dataTablaHistorialCortes);
        },
        // data: { api: 2, equipo: id_equipos },
        method: 'POST',
        url: '../../../api/corte_caja_api.php',
        beforeSend: function () {
            loader("In")
            fadeTable('Out')
            fadeDetalleTable("Out")
        },
        complete: function () {
            //Para ocultar segunda columna
            loader("Out", 'bottom')
            fadeTable("In")

            $.fn.dataTable
                .tables({
                    visible: true,
                    api: true
                })
                .columns.adjust();


            // Hacer clic en la primera fila
            var firstRow = TablaHistorialCortes.row(0).node(); // La fila 0 es la primera fila
            $(firstRow).click(); // Simula un clic en la fila
        },
        error: function (jqXHR, textStatus, errorThrown) {
            alertErrorAJAX(jqXHR, textStatus, errorThrown);
        },
        dataSrc: 'response.data'
    },
    createdRow: function (row, data, dataIndex) {
        if (data.FINALIZADO == 0) {
            $(row).addClass('bg-warning text-black');
        } else if (data.FINALIZADO == 1) {
        }
    },
    columns: [
        { data: 'FOLIO' },
        {
            data: 'FECHA_INICIO', render: function (data) {
                return formatoFecha2(data, [0, 1, 3, 1]);
            }
        },
        {
            data: 'FECHA_FINAL', render: function (data) {
                return ifnull(formatoFecha2(data, [0, 1, 3, 1]), "N/A");
            }
        },
        {
            data: 'px'
        },
        {
            data: 'FINALIZADO', render: function (data) {
                let html;


                if (data === "0") {
                    html = `<i class="bi bi-x-circle"></i>`
                } else if (data === "1") {
                    html = `<i class="bi bi-check-circle"></i>`
                }

                return html
            }
        }
    ],
    columnDefs: [
        { target: 0, title: 'FOLIO', className: 'all' },
        { target: 1, title: 'FECHA', className: 'all' },
        { target: 2, title: 'Finalizado:', className: 'none' },
        { target: 3, title: 'Realizado por:', className: 'none' },
        { target: 4, title: 'Estatus:', className: 'all ' }

    ],

})

inputBusquedaTable("TablaHistorialCortesCaja", TablaHistorialCortes, [{
    msj: 'Tabla de historial de cortes de caja',
    place: 'top'
}], {
    msj: "Filtre los resultados",
    place: 'top'
}, "col-12")

//Funcion para cambiar el estatus (funcion global)
selectTable('#TablaHistorialCortesCaja', TablaHistorialCortes, {
    unSelect: true, ClickClass: [
        {
            callback: async function (data) {

                console.log(data)


            }, selected: true
        },

    ], dblClick: true, reload: ['col-xl-9']
}, async function (select, data, callback) {
    SelectedHistorialCaja = data

    if (select) {
        fadeDetalleTable("In")
        $("#fecha_corte_selected").html(`(${data['FOLIO']})`)

        BuildHeaderCorte(data)

        id_corte = SelectedHistorialCaja['ID_CORTE']

        dataTablePacientesCaja.id_corte = SelectedHistorialCaja['ID_CORTE']

        TablaPacientesCaja.ajax.reload()
    } else {
        fadeDetalleTable("Out")
    }
})

// ==============================================================================

// ###################### TABLA DETALLES PACIENTES ##############################

// ==============================================================================
dataTablePacientesCaja = {
    api: 9
}

// Tabla de los pacientes que estan en la caja seleccionada
TablaPacientesCaja = $('#TablaPacientesCaja').DataTable({
    language: {
        url: "https://cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json",
    },
    lengthChange: false,
    info: true,
    paging: false,
    sorting: false,
    scrollY: '75vh',
    scrollCollapse: true,
    ajax: {
        dataType: 'json',
        data: function (d) {
            return $.extend(d, dataTablePacientesCaja);
        },
        method: 'POST',
        url: `../../../api/corte_caja_api.php`,
        beforeSend: function () { },
        complete: function () {
            // getResumen(TablaPacientesCaja);
        },
        dataSrc: 'response.data'
    },
    // 
    createdRow: function (row, data, dataIndex) {
        if (!data.ID_TICKET) {
            $(row).addClass('bg-warning');
        }
    },
    columns: [
        { data: 'PACIENTE' },
        { data: 'PREFOLIO' },
        { data: 'NUM_ESTADO_CUENTA' },
        {
            data: 'TOTAL', render: function (data) {
                return `$${parseFloat(ifnull(data, 0)).toFixed(2)}`
            }
        },
        { data: 'FECHA_RECEPCION' },
        { data: 'NOMBRE_COMERCIAL' },
        { data: 'FORMA_PAGO' }
    ],
    columnDefs: [
        { target: 0, className: 'all', title: 'Paciente' },
        // { target: 1, className: 'min-tablet', title: 'Servicios' },
        // { target: 2, className: 'desktop', title: 'Costo' },
        { target: 1, className: 'desktop', title: 'Prefolio' },
        { target: 2, className: 'desktop', title: 'Cuenta' }, //Numero de estado de cuenta
        // { target: 5, className: 'all', title: 'Subtotal', width: '7%' },
        // { target: 6, className: 'all', title: 'IVA', width: '7%' },
        { target: 3, className: 'all', title: 'Total', width: '7%' },
        { target: 4, className: 'none', title: 'Fecha Recepción', width: '12%' },
        { target: 5, className: 'desktop', title: 'Procedencia' },
        { target: 6, className: 'desktop', title: 'Forma de pago' }, // PUE o PPD
        // { target: 11, className: 'desktop', title: 'Tipo-Metodo de pago' },
        // { target: 12, className: 'desktop', title: 'Estado de cuenta' }

    ],

    // rowGroup: {

    // }
})


inputBusquedaTable("TablaPacientesCaja", TablaPacientesCaja, [
    {
        msj: 'Tabla de los pacientes que estan en la caja',
        place: 'top'
    },
    {
        msj: "¡Los pacientes por pagar, se mostrarán en amarillo!",
        place: 'top'
    }
], {
    msj: "Filtre los resultados",
    place: 'top'
}, "col-12")

// ==============================================================================

// ###################### FUNCIONES #############################################

// ==============================================================================

// Funcion para crear la cabecera con la informacion del corte de caja
function BuildHeaderCorte(data) {

    $('#detalle_fecha_corte').html(formatoFecha2(data['FECHA_INICIO'], [0, 0, 0, 0, 1, 1,]))
    $('#detalle_caja_id').html(data['CAJAS_ID'])
    $('#detalle_total').html(` $${ifnull(data['TOTAL'], "00.00")}`)

    // Desglose de todo el monto por tipo de pagos
    // Se desglosa todo el monto recaudado por el tipo de pago
    // $('Efectivo').html(ifnull('Data', '$00.00'))
    // $('Transferencia').html(ifnull('Data', '$00.00'))
    // $('TarjetaCredito').html(ifnull('Data', '$00.00'))
    // $('TarjetaDebito').html(ifnull('Data', '$00.00'))
    // $('Cheques').html(ifnull('Data', '$00.00'))
    // $('Credito').html(ifnull('Data', '$00.00'))


    $('#monto_acumulado').html(data['MONTO']);

    // Se evalua si el corte ya esta finalizado o apenas se inicio
    if (data['FINALIZADO'] === "0") {
        // Como no han cerrado la caja aparecera el usuario en sesion para cerrar la caja *if tiene permiso
        $('#detalle_usuario').html(session['nombre'] + ' ' + session['apellidos'])

        // No ha finalizado aparecera el boton para poder cerrar la caja
        fadeDetalleHeader("Out")
    } else if (data['FINALIZADO'] === "1") {
        // Si la caja ya esta finalizada no se mostrara el boton para cerrar por que por logica ya esta cerrada xd y se mostrara el boton para visualizar el reporte generado al cerrar la caja
        $('#detalle_usuario').html(data['px'])
        $('#detalle_fecha_termino').html(formatoFecha2(data['FECHA_FINAL'], [0, 0, 0, 0, 1, 1,]))

        fadeDetalleHeader("In")
    }
}


function getResumen(tableDetalle) {
    if (!forma_pago.length) {
        alertMensaje('warning', 'No hay tipo de pagos definidos', 'Si ves este error, algo ha pasado.', 'Si');
    }

    let object = tableDetalle.rows().data();
    $('#formas-pago').html('');

    for (const key in object) {

    }
    let datos = tableDetalle.rows().data().toArray();
    console.log(datos)
    calculo['otros'] = 0;
    for (const key in datos) {
        if (Object.hasOwnProperty.call(datos, key)) {
            const element = datos[key];
            calculo[ifnull(element, 'otros', ['ID_PAGO'])] += parseFloat(ifnull(element, 0, ['TOTAL']))
        }
    }

    console.log(calculo)

    for (const key in calculo) {
        if (Object.hasOwnProperty.call(calculo, key)) {
            const element = calculo[key];
            let tipo_pago = forma_pago.filter((pago) => pago.ID_PAGO == key);
            $('#formas-pago').append(`
                <div class="col-12 col-md-4">
                    <span class="fw-bold">${ifnull(tipo_pago, 'Sin pagar', { 0: 'DESCRIPCION' })}:</span>
                    <span>$${element.toFixed(2)}</span>
                </div>
            `)

        }
    }

}

// Function fadeTabla para ocultar o aparecer la primera tabla del menu es decir la de historial de cajas
function fadeTable(type) {
    if (type === "Out") {
        $('#table_historial_corte_caja').fadeOut()
    } else if (type === "In") {
        $('#table_historial_corte_caja').fadeIn()
    }
}

// Function para la columna de detalle donde estan los datos del corte y el detalle del paciente
function fadeDetalleTable(type) {
    if (type === "Out") {
        $('#corte_caja_detalle').fadeOut()
    } else if (type === "In") {
        $('#corte_caja_detalle').fadeIn()
    }
}

// Function para el encabezado donde esta el detalle del corte de caja
function fadeDetalleHeader(type) {
    if (type === "Out") {
        $('#btnCerrarCaja').fadeIn(0)
        $('#fecha_termino').fadeOut(0)
        // $('#btnVisualizarReporte').fadeOut(0)
    } else if (type === "In") {
        $('#btnCerrarCaja').fadeOut(0)
        $('#fecha_termino').fadeIn(0)
        // $('#btnVisualizarReporte').fadeIn(0)
    }
}

// ==============================================================================


// Cambios a realizar si no hay ninguna caja no se muestra nada o  creo que depende del navegador