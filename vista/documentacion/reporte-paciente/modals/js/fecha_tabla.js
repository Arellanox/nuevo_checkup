$(document).on('click', '#actualizar_tabla', function (event) {
    event.preventDefault();

    dataList['fecha_inicial'] = $('#fecha_inicial').val();
    dataList['fecha_final'] = $('#fecha_final').val();

    if ($('#checkFullClientes').is(':checked')) {
        dataList['id_cliente'] = null;
    } else {
        dataList['id_cliente'] = $('#cliente').val();
    }

    if ($('#checkFullArea').is(':checked')) {
        dataList['area_id'] = null;
    } else {
        dataList['area_id'] = $('#area_list').val();
    }



    tablaPrincipal.ajax.reload();

    alertMsj({
        title: 'Cargando',
        text: 'Espere un momento',
        showCancelButton: false,
        icon: 'info',
        timer: 1500,
        timerProgressBar: true,
        confirmButtonText: 'Ok'
    }, () => { }, 1)

    $('#modalFiltrarTabla').modal('hide');
})

// rellenarSelect('#cliente', 'clientes_api',)

rellenarSelect('#cliente', 'clientes_api', 2, 'ID_CLIENTE', 'NOMBRE_COMERCIAL')
rellenarSelect('#area_list', 'areas_api', 2, 'ID_AREA', 'DESCRIPCION')


// Establecer los valores de los campos de fecha
document.getElementById('fecha_inicial').value = fechaInicialFormatted;
document.getElementById('fecha_final').value = fechaFinalFormatted;