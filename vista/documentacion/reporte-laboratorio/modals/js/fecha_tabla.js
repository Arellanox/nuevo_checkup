$(document).on('click', '#actualizar_tabla', function (event) {
    event.preventDefault();

    $('#servicios').select2();

    dataList['fecha_inicial'] = $('#fecha_inicial').val();
    dataList['fecha_final'] = $('#fecha_final').val();


    // Asignación condicional de valores
    if(setConditionalValue('#checkFullClientes', '#cliente')){
        dataList['id_cliente'] = setConditionalValue('#checkFullClientes', '#cliente');
    }

    if(setConditionalValue('#checkFullArea', '#area_list')){

        dataList['area_id'] = setConditionalValue('#checkFullArea', '#area_list');
    }

    if(setConditionalValue('#checkFullServicios', '#servicios')){

        dataList['servicio_id'] = setConditionalValue('#checkFullServicios', '#servicios');
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
rellenarSelect('#servicios', 'servicios_api', 2, 'ID_SERVICIO', 'DESCRIPCION')

select2("#servicios", 'modalFiltrarTabla', 'Espere un momento...')


// Establecer los valores de los campos de fecha
document.getElementById('fecha_inicial').value = fechaInicialFormatted;
document.getElementById('fecha_final').value = fechaFinalFormatted;



function setConditionalValue(checkSelector, valueSelector) {
    return $(checkSelector).is(':checked') ? null : $(valueSelector).val();
}
