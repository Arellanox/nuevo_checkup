$('.btn-facturas').on('click', function(){

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