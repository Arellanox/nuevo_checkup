
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
        { target: 0, title: '#', className: 'all' },
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

        dataTablePacientesCaja.id_corte = SelectedHistorialCaja['ID_CORTE']

        TablaPacientesCaja.ajax.reload()
    } else {
        fadeDetalleTable("Out")
    }
})
dataTablePacientesCaja = {
    api: 9,
    id_caja: null,
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
        },
        dataSrc: 'response.data'
    },
    columns: [

    ],
    columnDefs: [
        { target: 0, className: 'all', title: 'Paciente' },
        { target: 1, className: 'min-tablet', title: 'Servicios' },
        { target: 2, className: 'desktop', title: 'Costo' },
        { target: 3, className: 'desktop', title: 'Prefolio' },
        { target: 4, className: 'min-tablet', title: 'Unitario', width: '7%' },
        { target: 5, className: 'all', title: 'Subtotal', width: '7%' },
        { target: 6, className: 'all', title: 'IVA', width: '7%' },
        { target: 7, className: 'all', title: 'Total', width: '7%' },
        { target: 8, className: 'none', title: 'Fecha Recepción', width: '12%' },
        { target: 9, className: 'desktop', title: 'Procedencia' }
    ],

    // rowGroup: {

    // }
})


inputBusquedaTable("TablaPacientesCaja", TablaPacientesCaja, [{
    msj: 'Tabla de los pacientes que estan en la caja',
    place: 'top'
}], {
    msj: "Filtre los resultados",
    place: 'top'
}, "col-12")


// Funcion para crear la cabecera con la informacion del corte de caja
function BuildHeaderCorte(data) {

    $('#detalle_fecha_corte').html(formatoFecha2(data['FECHA_FINAL'], [0, 0, 0, 0, 1, 1,]))
    $('#detalle_usuario').html(session['nombre'] + ' ' + session['apellidos'])
    $('#detalle_caja_id').html(data['CAJAS_ID'])
    $('#detalle_total').html(`MXN ${data['TOTAL']}`)

    if (data['FINALIZADO'] === "0") {
        $('#btnCerrarCaja').fadeIn(0)
    } else if (data['FINALIZADO'] === "1") {
        $('#btnCerrarCaja').fadeOut(0)
    }
}


// Function fadeTabla
function fadeTable(type) {
    if (type === "Out") {
        $('#table_historial_corte_caja').fadeOut()
    } else if (type === "In") {
        $('#table_historial_corte_caja').fadeIn()
    }
}

// Function para la columna de detalle 
function fadeDetalleTable(type) {
    if (type === "Out") {
        $('#corte_caja_detalle').fadeOut()
    } else if (type === "In") {
        $('#corte_caja_detalle').fadeIn()
    }
}