// Tabla de asistencia
dataAsistencia = {
    api: 1
}

TablaAsistencia = $('#TablaAsistencia').DataTable({
    language: {
        url: "https://cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json",
    },
    lengthChange: false,
    info: true,
    paging: false,
    sorting: false,
    scrollY: '68vh',
    scrollCollapse: true,
    ajax: {
        dataType: 'json',
        data: function (d) {
            return $.extend(d, dataAsistencia);
        },
        // data: { api: 2, equipo: id_equipos },
        method: 'POST',
        url: '../../../api/corte_caja_api.php',
        beforeSend: function () {
            // loader("In")
            // fadeTable('Out')
            // fadeDetalleTable("Out")
        },
        complete: function () {
            //Para ocultar segunda columna
            // loader("Out", 'bottom')
            // fadeTable("In")

            $.fn.dataTable
                .tables({
                    visible: true,
                    api: true
                })
                .columns.adjust();


            // Hacer clic en la primera fila
            if (!isMovil()) {
                var firstRow = TablaHistorialCortes.row(0).node(); // La fila 0 es la primera fila
                $(firstRow).click(); // Simula un clic en la fila
            }
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
        { target: 2, title: 'Finalizado:', className: 'tablet' },
        { target: 3, title: 'Realizado por:', className: 'tablet' },
        { target: 4, title: 'Estatus:', className: 'all ' }

    ],

})