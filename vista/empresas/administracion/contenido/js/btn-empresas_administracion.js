//Boton que abre el modal de las facturas
$('.btn-facturas').on('click', function () {

    // TablaFacturas()
    tablaFacturas.clear().draw()
    tablaFacturas.ajax.reload();

    setTimeout(() => {
        $('#modalFacturas').modal('show');
        setTimeout(() => {
            $.fn.dataTable
                .tables({
                    visible: true,
                    api: true
                })
                .columns.adjust();
        }, 300);
    }, 500);


})

//Boton que abre la lista de precios
$('.btn-lista_precios').on('click', function () {
    tablaListaFacturas.clear().draw();
    tablaListaFacturas.ajax.reload();

    setTimeout(() => {
        $('#modalListaFacturas').modal('show');
        setTimeout(() => {
            $.fn.dataTable
                .tables({
                    visible: true,
                    api: true
                })
                .columns.adjust();
        }, 300);
    }, 500);
})
