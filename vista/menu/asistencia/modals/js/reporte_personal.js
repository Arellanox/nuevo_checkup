dataAjax = {
    api: 1,
    // 
}
reportes_anteriores_personal = $('#reportes_anteriores_personal').DataTable({
    language: {
        url: "https://cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"
    },
    lengthChange: false,
    info: false,
    paging: false,
    scrollY: '75vh',
    scrollCollapse: true,
    ajax: {
        dataType: 'json',
        data: function (d) {
            return $.extend(d, dataAjax);
        },
        method: 'POST',
        url: '../../../api/**.php',
        dataSrc: 'response.data'
    },
    columns: [
        { data: 'COUNT' },
        { data: 'FECHA_RANGO' },
        // {defaultContent: 'En progreso...'}
    ],
    columnDefs: [
        { "width": "10px", "targets": 0, title: '#', className: 'all' },
        { targets: 1, title: 'FECHA', className: 'all' }
    ],

})

inputBusquedaTable('reportes_anteriores_personal', reportes_anteriores_personal, [], [], 'col-12')

selectTable('#reportes_anteriores_personal', reportes_anteriores_personal, { unSelect: true }, async (selectTR, data, callback) => {
    if (selectTR == 1) {
        // Aqui llamarias al reporte
        // Ejemplo: data.REPORTE_PERSONAL
        callback('In')
    } else {
        callback('Out')
    }
})

