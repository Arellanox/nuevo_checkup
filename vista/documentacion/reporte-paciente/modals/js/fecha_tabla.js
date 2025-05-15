$(document).on('click', '#actualizar_tabla', function (event) {
    event.preventDefault();

    dataList['fecha_inicial'] = $('#fecha_inicial').val();
    dataList['fecha_final'] = $('#fecha_final').val();


    // Asignación condicional de valores
    dataList['id_cliente'] = setConditionalValue('#checkFullClientes', '#cliente');
    dataList['area_id'] = setConditionalValue('#checkFullArea', '#area_list');
    dataList['tipo_cliente'] = setConditionalValue('#checkFullTipCliente', '#tipo_cliente');
    dataList['tiene_factura'] = setConditionalValue('#checkFullFacturado', '#tiene_factura');


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

rellenarOrdenarSelect('#cliente', 'clientes_api', 2, 'ID_CLIENTE', 'NOMBRE_COMERCIAL')
rellenarOrdenarSelect('#area_list', 'areas_api', 2, 'ID_AREA', 'DESCRIPCION')

document.getElementById('fecha_inicial').value = fechaInicialFormatted;
document.getElementById('fecha_final').value = fechaFinalFormatted;

function setConditionalValue(checkSelector, valueSelector) {
    return $(checkSelector).is(':checked') ? null : $(valueSelector).val();
}
