tablaSignos = $('#TablaListaCursos').DataTable({
    language: {
        url: "https://cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"
    },
    lengthChange: false,
    info: false,
    paging: false,
    scrollY: autoHeightDiv(0, 330),
    scrollCollapse: true,
    columnDefs: [
        { "width": "10px", "targets": 0 },
    ],

})