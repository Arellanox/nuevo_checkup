$(document).on('click', '#actualizar_tabla', function (event) {
    event.preventDefault();

    dataList['fecha_inicial'] = $('#fecha_inicial').val();
    dataList['fecha_final'] = $('#fecha_final').val();
    dataList['id_cliente'] = $('#cliente').val();

    tablaPrincipal.ajax.reload();

    alertMsj({
        title: 'Cargando',
        text: 'Espere un momento',
        showCancelButton: false,
        icon: 'info',
        timer: 2000,
        timerProgressBar: true,
        confirmButtonText: 'Ok'
    }, false, 1)

    $('#modalFiltrarTabla').modal('hide');
})

// rellenarSelect('#cliente', 'clientes_api',)

rellenarSelect('#cliente', 'clientes_api', 2, 'ID_CLIENTE', 'NOMBRE_COMERCIAL')
