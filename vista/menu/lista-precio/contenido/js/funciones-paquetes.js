async function mantenimientoPaquete() {
  loader("In");
  await rellenarSelect('#seleccion-paquete', 'paquetes_api', 2, 0, 'DESCRIPCION.CLIENTE', {
    contenido: 1
  });
  tablaContenido();
  $('#seleccion-paquete').prop('disabled', false);
  $("#selectDisabled").removeClass("disable-element");
  $("#formPaqueteBotonesArea").addClass("disable-element");
  $("#formPaqueteSelectEstudio").addClass("disable-element");
  $("#informacionPaquete").addClass("disable-element");

  $('input[type=radio][name=selectChecko]:checked').prop('checked', false);
  $("#seleccion-estudio").find('option').remove().end()
  loader("Out");
}

async function contenidoPaquete(select = null) {
  loader("In");
  await rellenarSelect('#seleccion-paquete', 'paquetes_api', 2, 0, 'DESCRIPCION.CLIENTE', {
    contenido: 0
  });
  $('#seleccion-paquete').prop('disabled', false);
  $("#selectDisabled").removeClass("disable-element");
  $("#formPaqueteBotonesArea").addClass("disable-element");
  $("#formPaqueteSelectEstudio").addClass("disable-element");
  $("#informacionPaquete").addClass("disable-element");

  $('input[type=radio][name=selectChecko]:checked').prop('checked', false);
  $("#seleccion-estudio").find('option').remove().end()
  tablaContenido()
}

// Agrega Un nuevo TR a la tabla de paquetes
function meterDato(DESCRIPCION, CVE, costo_total, precio_venta, ID_SERVICIO, ABREVIATURA, tablaContenidoPaquete) {
  let longitud = dataSet.length + 1;
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
  console.log(DESCRIPCION)
  tablaContenidoPaquete.row.add([
    DESCRIPCION,
    CVE,
    '<input type="number" class="form-control input-form cantidad-paquete text-center" name="cantidad-paquete" placeholder="" value="1" style="margin: 0;padding: 0;height: 35px;">',
    '<div class="costo-paquete text-center">$' + costo_total + '</div>',
    '<div class="costototal-paquete text-center">$' + costo_total + '</div>',
    '<div class="precioventa-paquete text-center">$' + precio_venta + '</div>',
    '<div class="subtotal-paquete text-center">$0</div>', ID_SERVICIO
  ]).draw();
  // $('#TablaListaPaquetes tbody').append(html);

  calcularFilasTR();
}

// Calular toda la tabla y filas
function calcularFilasTR() {
  subtotalCosto = 0, subtotalPrecioventa = 0, iva = 0, total = 0;
  var paqueteEstudios = new Array();
  $('#TablaListaPaquetes tbody tr').each(function () {
    var arregloEstudios = new Array();
    let id_servicio;
    let calculo = caluloFila(this)
    subtotalCosto += calculo[0];
    subtotalPrecioventa += calculo[1];
    tabledata = tablaContenidoPaquete.row(this).data();
    // console.log(tabledata);
    // console.log(tabledata['ID_SERVICIO']);
    if (typeof tabledata['ID_SERVICIO'] === "undefined") {
      id_servicio = tabledata[7]
    } else {
      id_servicio = tabledata['ID_SERVICIO']
    }

    arregloEstudios = {
      'id': id_servicio,
      'cantidad': calculo[2],
      'costo': calculo[3],
      'costototal': calculo[0],
      'precioventa': calculo[4],
      'subtotal': calculo[1]
    }
    // console.log(arregloEstudios)
    paqueteEstudios.push(arregloEstudios)
  });
  // console.log(paqueteEstudios);
  iva = (subtotalPrecioventa * 16) / 100;
  total = subtotalPrecioventa + iva;

  if (!checkNumber(subtotalCosto)) {
    subtotalCosto = 0;
  } else {
    subtotalCosto = subtotalCosto;
  }
  if (!checkNumber(subtotalPrecioventa)) {
    subtotalPrecioventa = 0;
  } else {
    subtotalPrecioventa = subtotalPrecioventa;
  }
  if (!checkNumber(total)) {
    total = 0;
  } else {
    total = total;
  }
  $('#subtotal-costo-paquete').html('$' + subtotalCosto);
  $('#subtotal-precioventa-paquete').html('$' + subtotalPrecioventa);
  $('#total-paquete').html('$' + total);
  paqueteEstudios.push({
    'total': total,
    'subtotal-costo': subtotalCosto,
    'subtotal.precioventa': subtotalPrecioventa,
    'iva': iva,
    'id_paquete': $('#seleccion-paquete').val()
  })
  return paqueteEstudios
}

function caluloFila(parent_element) {
  // Calcula la fila de una tabla
  let cantidad = parseFloat($(parent_element).find("input[name='cantidad-paquete']").val());
  let costo = parseFloat($(parent_element).find("div[class='costo-paquete text-center']").text().slice(1));
  let precioventa = parseFloat($(parent_element).find("div[class='precioventa-paquete text-center']").text().slice(1));
  // Dar valor a costo total
  let costoTotal = cantidad * costo;
  if (checkNumber(costoTotal)) {
    $(parent_element).find("div[class='costototal-paquete text-center']").html('$' + costoTotal)
  } else {
    $(parent_element).find("div[class='costototal-paquete text-center']").html('$0')
  }
  let subtotal = cantidad * precioventa;
  if (checkNumber(subtotal)) {
    $(parent_element).find("div[class='subtotal-paquete text-center']").html('$' + subtotal)
  } else {
    $(parent_element).find("div[class='subtotal-paquete text-center']").html('$0')
  }
  return data = [costoTotal, subtotal, cantidad, costo, precioventa]
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