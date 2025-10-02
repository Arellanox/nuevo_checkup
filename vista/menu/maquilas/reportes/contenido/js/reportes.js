var laboratorioSelect = fecha_inicio = fecha_final = null;

$('#btn-filtro-modal').on('click', function () {
    rellenarOrdenarSelect('#select_laboratorios', 'laboratorio_maquila_api', 2, 'ID_LABORATORIO', 'DESCRIPCION');
    $('#select_laboratorios').append(new Option('Todos', null, true));
    $('#modalFiltrarMaquilas').modal('show');
})

