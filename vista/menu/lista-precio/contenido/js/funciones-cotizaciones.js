async function mantenimientoPaquete() {
    $('#btn-excel-previa').attr('disabled', false)
    $('#btn-vistaPrevia-cotizacion').attr('disabled', false)
    loader("In");
    await rellenarSelect('#seleccion-paquete', 'clientes_api', 2, 0, 'NOMBRE_COMERCIAL');
    $('#container-select-presupuesto').fadeIn('slow')

    await rellenarSelect("#select-presupuestos", 'cotizaciones_api', 4, 'ID_COTIZACION', 'FOLIO_FECHA', {
        cliente_id: $('#seleccion-paquete').val()
    }, function (data) {
        detalle_paquetes = data;
    });

    tablaContenido(true);


    $('#seleccion-paquete').prop('disabled', false);
    $(".selectDisabled").removeClass("disable-element");
    $("#formPaqueteBotonesArea").addClass("disable-element");
    $("#formPaqueteSelectEstudio").addClass("disable-element");
    $("#informacionPaquete").addClass("disable-element");

    $('input[type=radio][name=selectChecko]:checked').prop('checked', false);
    $("#seleccion-estudio").find('option').remove().end()
    // $('.listaPresupuestos').show();


    //borrar el div para que se vuelva a abrir
    // datosUsuarioCotizacion.empty()
    $('#nombreCotizacionCliente').html('')
    $('#correoCotizacionCliente').html('')
    $('#fiscalCotizacionCliente').html('')
    $('#observacionesCotizacionCliente').html('')


    tablaContenido(true)


    loader("Out");
}

async function contenidoPaquete(select = null) {
    $('#btn-excel-previa').attr('disabled', true)
    $('#btn-vistaPrevia-cotizacion').attr('disabled', true)
    loader("In");
    await rellenarSelect('#seleccion-paquete', 'clientes_api', 2, 0, 'NOMBRE_COMERCIAL');

    $('#container-select-presupuesto').fadeOut();

    $('#seleccion-paquete').prop('disabled', false);
    $("#selectDisabled").removeClass("disable-element");
    $("#formPaqueteBotonesArea").addClass("disable-element");
    $("#formPaqueteSelectEstudio").addClass("disable-element");
    $("#informacionPaquete").addClass("disable-element");

    $('input[type=radio][name=selectChecko]:checked').prop('checked', false);
    $("#seleccion-estudio").find('option').remove().end()
    // $('.listaPresupuestos').hide();

    tablaContenido(true)
}

// Agrega Un nuevo TR a la tabla de paquetes
function meterDato(
    DESCRIPCION, CVE, costo_total, precio_venta,
    CANTIDAD, DESCUENTO, ID_SERVICIO, PAQUETE, tablaContenidoPaquete
) {
    if (DESCUENTO === null) DESCUENTO = ''
    if (costo_total == null) {
        costo_total = 0;
    } else {
        costo_total = costo_total;
    }

    if (precio_venta == null) {
        precio_venta = 0;
    } else {
        precio_venta = precio_venta;
    }

    tablaContenidoPaquete.row.add([
        DESCRIPCION,
        CVE,
        `<div class="input-group"><input type="number" class="form-control input-form cantidad-paquete text-center" name="cantidad-paquete" placeholder="0%" value="${CANTIDAD}"><span class="input-span">ud</span></div>`,
        `<div class="costo-paquete text-center">$${costo_total}</div>`,
        `<div class="costototal-paquete text-center">$${costo_total}</div>`,
        `<div class="input-group"><input type="number" class="form-control input-form descuento-paquete text-center" name="descuento-paquete" placeholder="0%" value="${DESCUENTO}"><span class="input-span">%</span></div>`,
        `<div class="precioventa-paquete text-center">$${precio_venta}</div>`,
        `<div class="subtotal-paquete text-center">$0</div>`, ID_SERVICIO, PAQUETE
    ]).draw();

    calcularFilasTR();
}

// Calular toda la tabla y filas
function calcularFilasTR() {
    subtotalCosto = 0, subtotalPrecioventa = 0, iva = 0, total = 0;
    var paqueteEstudios = [];
    var CotizacionDetalle;

    try {
        $('#TablaListaPaquetes tbody tr').each(function () {
            var arregloEstudios;
            let id_servicio;
            let calculo = caluloFila(this)
            subtotalCosto += calculo[0];
            subtotalPrecioventa += calculo[1];
            tabledata = tablaContenidoPaquete.row(this).data();
            id_servicio = tabledata[8]
            id_paquete = tabledata[9]

            arregloEstudios = {
                'id': id_servicio,
                'paquete_id': id_paquete,
                'cantidad': calculo[2],
                'costo': calculo[3].toFixed(2),
                'costototal': calculo[0].toFixed(2),
                'precioventa': calculo[4].toFixed(2),
                'subtotal': calculo[1].toFixed(2),
                'descuento': calculo[5].toFixed(2),
                'descuento_precio': calculo[6].toFixed(2),
                'subtotal_sin_descuento': calculo[7].toFixed(2)
            }
            paqueteEstudios.push(arregloEstudios)
        });
    } catch (error) {
        console.log(error.message)
    }

    if (!checkNumber(subtotalCosto)) {
        subtotalCosto = 0;
        subtotalCosto_sindescuento = 0;
    } else {
        subtotalCosto = subtotalCosto;
        subtotalCosto_sindescuento = subtotalCosto;
    }

    subtotalPrecioventa_sindescuento = 0;
    if (!checkNumber(subtotalPrecioventa)) {
        subtotalPrecioventa = 0;
        descuento = 0;
        descuentoPorcentaje = parseFloat($('#descuento-paquete').val());

    } else {
        descuentoPorcentaje = parseFloat($('#descuento-paquete').val());
        subtotalPrecioventa_sindescuento = subtotalPrecioventa

        if (descuentoPorcentaje > 0) {
            subtotalPrecioventa = subtotalPrecioventa - (subtotalPrecioventa * descuentoPorcentaje) / 100;
            descuento = subtotalPrecioventa * descuentoPorcentaje / 100;
        } else {
            subtotalPrecioventa = subtotalPrecioventa;
            descuento = 0;
        }
    }

    iva = (subtotalPrecioventa * 16) / 100;
    iva_sindescuento = (subtotalPrecioventa_sindescuento * 16) / 100;

    total = subtotalPrecioventa + iva;
    if (!checkNumber(total))
        total = 0;

    total_sindecuento = subtotalPrecioventa_sindescuento + iva_sindescuento;
    if (!checkNumber(total_sindecuento))
        total_sindecuento = 0;

    $('#sin_descuento-subtotal-costo-paquete').html('$' + subtotalCosto_sindescuento.toFixed(2));
    $('#sin_descuento-subtotal-precioventa-paquete').html('$' + subtotalPrecioventa_sindescuento.toFixed(2));
    $('#sin_descuento-total-paquete').html(`$${total_sindecuento.toFixed(2)}`);

    // $('#subtotal-costo-paquete').html('$' + subtotalCosto.toFixed(2));
    $('#subtotal-precioventa-paquete').html('$' + subtotalPrecioventa.toFixed(2));
    $('#total-paquete').html(`$${total.toFixed(2)}`);
    // console.log(typeof total.toFixed(2))
    CotizacionDetalle = {
        'total': total,
        'subtotal-costo': subtotalCosto,
        'subtotal': subtotalPrecioventa,
        'iva': iva,
        'iva_porcentaje': '16%',
        'cliente_id': $('#seleccion-paquete').val(),
        'descuento': descuento.toFixed(2),
        'descuento_porcentaje': descuentoPorcentaje.toFixed(2),
        'subtotal_sindescuento': subtotalPrecioventa_sindescuento
    }
    return [paqueteEstudios, CotizacionDetalle]
}

function caluloFila(parent_element) {
    // Calcula la fila de una tabla
    let cantidad = parseFloat($(parent_element).find("input[name='cantidad-paquete']").val());
    let descuento = parseFloat($(parent_element).find("input[name='descuento-paquete']").val());
    let costo = parseFloat($(parent_element).find("div[class='costo-paquete text-center']").text().slice(1));
    let precioventa = parseFloat($(parent_element).find("div[class='precioventa-paquete text-center']").text().slice(1));

    // Dar valor a costo total
    let costoTotal = cantidad * costo;
    if (checkNumber(costoTotal)) {
        $(parent_element).find("div[class='costototal-paquete text-center']").html('$' + costoTotal.toFixed(2))
    } else {
        $(parent_element).find("div[class='costototal-paquete text-center']").html('$0')
    }
    let subtotal = cantidad * precioventa;
    if (descuento > 0) {
        subtotal_sin_descuento = subtotal;
        descuento_precio = subtotal * descuento / 100;
        subtotal = subtotal - (subtotal * descuento) / 100
    } else {
        subtotal_sin_descuento = subtotal;
        descuento_precio = 0;
        subtotal = subtotal;
    }
    if (checkNumber(subtotal)) {
        $(parent_element).find("div[class='subtotal-paquete text-center']").html('$' + subtotal.toFixed(2))
    } else {
        $(parent_element).find("div[class='subtotal-paquete text-center']").html('$0')
    }
    return data = [costoTotal, subtotal, cantidad, costo, precioventa, descuento, descuento_precio, subtotal_sin_descuento]
}

// Precargar listado
function cargarpaquetes() {
    tablaPrecio.ajax.url('../../../api/paquetes_api.php').load();
    data = {
        api: 2,
        cliente_id: $('#seleccion-cliente').val()
    };
    tablaPrecio.ajax.reload();
}

// Precargar tabla
function cargarTabla(dataSet) {
    tablaContenidoPaquete.clear();
    tablaContenidoPaquete.rows.add(dataSet);
    tablaContenidoPaquete.draw();
    calcularFilasTR();
}

function checkNumber(x) {

    // check if the passed value is a number
    if (typeof x == 'number' && !isNaN(x)) {

        // check if it is integer
        if (Number.isInteger(x)) {
            return 1
        } else {
            return 1
        }

    } else {
        return 0
    }
}