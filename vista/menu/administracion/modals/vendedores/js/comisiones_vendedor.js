


dataVistaPeriodos = { api: 6, id_vendedor: 0 };
tablaPeriodosVendedor = $('#tablaPeriodosVendedor').DataTable({
    language: {
        url: "https://cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"
    },
    lengthChange: false,
    info: false,
    paging: false,
    scrollY: '73vh',
    scrollCollapse: true,
    ajax: {
        dataType: 'json',
        data: function (d) {
            return $.extend(d, dataVistaPeriodos);
        },
        method: 'POST',
        url: '../../../api/vendedores_api.php',
        complete: function () {
            $.fn.dataTable
                .tables({
                    visible: true,
                    api: true
                })
                .columns.adjust();

            // Hacer clic en la primera fila
            if (!isMovil()) {
                var firstRow = tablaPeriodosVendedor.row(0).node(); // La fila 0 es la primera fila
                $(firstRow).click(); // Simula un clic en la fila
            }
        },
        dataSrc: 'response.data'
    },

    createdRow: function (row, data, dataIndex) {
        if (data.PAGADO === "0") {
            $(row).addClass('bg-warning');
        }
    },


    columns: [
        { data: 'COUNT' },
        {
            data: 'FECHA_INICIAL', render: function (data, type, row) {
                return `${formatoFecha2(data, [0, 1, 5, 2, 2, 2, 0], ['FECHA_INICIAL'])} <br/> ${formatoFecha2(data, [0, 1, 5, 2, 2, 2, 0], ['FECHA_FINAL'])}`;
            }
        },
        {
            data: 'TOTAL_ACUMULADO', render: function (data) {
                try {
                    let total = parseInt(data, 10);
                    if (typeof total === 'number') {
                        total = total.toFixed(2)
                        return `$${total}`;
                    } else {
                        return `Sin total`;
                    }
                } catch (error) {
                    return ``;
                }
            }
        },
        {
            data: 'PAGADO', render: function (data) {
                return (ifnull(data, 'number')) == 1 ? 'PAGADO' : 'PERIODO EN PROCESO';
            }, className: 'text-end'
        }

    ],
    columnDefs: [
        { target: 0, title: '#', className: 'all', width: '5px' },
        { target: 1, title: 'Periodo', className: 'all' },
        { target: 2, title: 'Comision', className: 'desktop' },
        { target: 3, title: 'Pagado', className: 'none' },
        // { target: 4, title: ''}
    ]

})

// Modifica visualmente el input
inputBusquedaTable('tablaPeriodosVendedor', tablaPeriodosVendedor, [{
    msj: 'Filtra las concidencias de todos los periodos que registrados',
    place: 'top'
}], [], 'col-12')


// Solo para eliminar o obtener comisiones
var dataPeriodo = [];
selectTable('#tablaPeriodosVendedor', tablaPeriodosVendedor, { unSelect: true, movil: true, divPadre: '#content-periodos' },
    async function (select, data, callback) {
        infoPeriodo([]);


        // Verifica si va visualizar una nueva vista
        if (select) {
            // Guardamos datos del periodo para poder pagar la comision
            dataPeriodo = data;

            // Mostramos información importante
            infoPeriodo(data);

            // Cargamos los pacientes que hay en el periodo
            dataVistaPacientesPeriodos['id_periodo'] = data.ID_PERIODO;
            tablaPacientesPeriodos.ajax.reload();

            setTimeout(() => {
                callback('In');
            }, 300);
        } else {

            // Reseteamos
            dataPeriodo = [];
            callback('Out');
        }
    }
)



// Muestra información del periodo
function infoPeriodo(data) {
    $('#info_periodo_fecha_inicial').html(
        ifnull(
            data,
            'Desconocido',
            ['FECHA_INICIAL']
        )
    );
    $('#info_periodo_fecha_final').html(
        ifnull(
            data,
            'Sin Pagar',
            ['FECHA_FINAL']
        )
    );
    $('#info_periodo_comsion_totals').html(
        ifnull(
            data,
            '',
            ['TOTAL_ACUMULADO']
        )
    );

}




dataVistaPacientesPeriodos = { api: 6, id_periodo: 0 };
tablaPacientesPeriodos = $('#tablaPacientesPeriodos').DataTable({
    language: {
        url: "https://cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"
    },
    lengthChange: false,
    info: false,
    paging: false,
    scrollY: '73vh',
    scrollCollapse: true,
    ajax: {
        dataType: 'json',
        data: function (d) {
            return $.extend(d, dataVistaPacientesPeriodos);
        },
        method: 'POST',
        url: '../../../api/vendedores_api.php',
        complete: function () {
            $.fn.dataTable
                .tables({
                    visible: true,
                    api: true
                })
                .columns.adjust();

            // Hacer clic en la primera fila
            if (!isMovil()) {
                var firstRow = tablaPacientesPeriodos.row(0).node(); // La fila 0 es la primera fila
                $(firstRow).click(); // Simula un clic en la fila
            }
        },
        dataSrc: 'response.data'
    },
    columns: [
        { data: 'COUNT' },
        { data: 'NOMBRE_COMPLETO' },
        { data: 'NOMBRE_MEDICO' },
        {
            data: 'FECHA_RECEPCION', render: function (data) {
                return formatoFecha2(data, [0, 1, 5, 2, 2, 2, 0])
            }, className: 'text-center'
        },
        {
            data: 'TOTAL', render: function (data) {
                try {
                    let total = parseInt(data, 10);
                    if (typeof total === 'number') {
                        total = total.toFixed(2)
                        return `$${total}`;
                    } else {
                        return `Sin total`;
                    }
                } catch (error) {
                    return ``;
                }
            }, className: 'text-end'
        },
        { data: 'DIAGNOSTICO' }

    ],
    columnDefs: [
        { target: 0, title: '#', className: 'all', width: '5px' },
        { target: 1, title: 'Paciente', className: 'all' },
        { target: 2, title: 'Médico', className: 'desktop' },
        { target: 3, title: 'Recepción', className: 'desktop' },
        { target: 4, title: 'Total', className: 'all' },
        { target: 5, title: 'Diagnóstico', className: 'none' },
        // { target: 4, title: ''}
    ]

})


// Modifica visualmente el input
inputBusquedaTable('tablaPacientesPeriodos', tablaPacientesPeriodos, [{
    msj: 'Filtra las concidencias de la tabla',
    place: 'top'
}], [], 'col-12')





// Para terminar vender
$(document).on('click', '#btn_pagar_periodo', function (e) {
    e.preventDefault();

    // Verificar si el periodo ya fue terminado (igual back debe comprobar);
    const row = dataPeriodo;
    console.log(row.length, row, dataPeriodo)
    if (row) {
        if (row['PAGADO'] === 1) {
            // Verificar si ha seleccionado el ultimo periodo o que no ha sido pagado
            alertToast('Este periodo ya ha sido pagado', 'info', 4000);
        } else {
            //
            alertMensajeConfirm({
                title: '¿Está seguro de terminar este periodo?',
                text: 'Los nuevos pacientes se harán en un nuevo periodo.',
                icon: 'info'
            }, () => {

                ajaxAwait({
                    api: 7, id_periodo: dataPeriodo.ID_PERIODO
                }, 'vendedores_api', { callbackAfter: true }, false, () => {
                    alertMensaje('success', 'Comisión pagada', 'el nuevo periodo ha sido pagado :)');
                    tablaPeriodosVendedor.ajax.reload();
                })

            }, 1)

        }
    } else {
        // No ha seleccionado periodo
        alertToast('No hay periodo ahora')
    }

})