async function mantenimientoPaquete() {
  $('#btn-excel-previa').attr('disabled', false)
  $('#btn-vistaPrevia-cotizacion').attr('disabled', false)

  loader("In");
  await orderAndFillSelects('#seleccion-paquete', 'paquetes_api', 2, 0, 'DESCRIPCION', {
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
  $('#btn-excel-previa').attr('disabled', true)
  $('#btn-vistaPrevia-cotizacion').attr('disabled', true)

  await orderAndFillSelects('#seleccion-paquete', 'paquetes_api', 2, 0, 'DESCRIPCION', {contenido: 0});

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
function meterDato(DESCRIPCION, CVE, costo_total, precio_venta, CANTIDAD, ID_SERVICIO, ABREVIATURA, tablaContenidoPaquete) {
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

  tablaContenidoPaquete.row.add([
    DESCRIPCION,
    CVE,
    `<div class="input-group"><input type="number" class="form-control input-form cantidad-paquete text-center" name="cantidad-paquete" placeholder="0%" value="${CANTIDAD}"><span class="input-span">ud</span></div>`,
    `<div class="costo-paquete text-center">$${costo_total}</div>`,
    `<div class="costototal-paquete text-center">$${costo_total}</div>`, null,
    `<div class="precioventa-paquete text-center">$${precio_venta}</div>`,
    `<div class="subtotal-paquete text-center">$0</div>`, ID_SERVICIO
  ]).draw();
}

function calcularFilasTR() {
    subtotalCosto = 0, subtotalPrecioventa = 0, iva = 0, total = 0;
    var paqueteEstudios = new Array();
    try {
        $('#TablaListaPaquetes tbody tr').each(function () {
            tabledata = tablaContenidoPaquete.row(this).data();


            var arregloEstudios = new Array();
            let id_servicio;
            let calculo = caluloFila(this)
            subtotalCosto += calculo[0];
            subtotalPrecioventa += calculo[1];
            id_servicio = tabledata[8]
            arregloEstudios = {
                'id': id_servicio,
                'cantidad': calculo[2],
                'costo': calculo[3],
                'costototal': calculo[0],
                'precioventa': calculo[4],
                'subtotal': calculo[1]
            }
            paqueteEstudios.push(arregloEstudios)
        });
    } catch (error) {
        console.warn(error)
    }


  // console.log(paqueteEstudios);
  iva = (subtotalPrecioventa * 16) / 100;
  total = subtotalPrecioventa + iva;
  console.log(subtotalCosto)
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
  $('#subtotal-costo-paquete').html('$' + subtotalCosto.toFixed(2));
  $('#subtotal-precioventa-paquete').html('$' + subtotalPrecioventa.toFixed(2));
  $('#total-paquete').html(`$${total.toFixed(2)}`);
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
    $(parent_element).find("div[class='costototal-paquete text-center']").html('$' + costoTotal.toFixed(2))
    costoTotal = costoTotal.toFixed(2)
  } else {
    $(parent_element).find("div[class='costototal-paquete text-center']").html('$0')
    costoTotal = 0
  }
  let subtotal = cantidad * precioventa;
  if (checkNumber(subtotal)) {
    $(parent_element).find("div[class='subtotal-paquete text-center']").html('$' + subtotal.toFixed(2))
    subtotal = subtotal.toFixed(2);
  } else {
    $(parent_element).find("div[class='subtotal-paquete text-center']").html('$0')
    subtotal = 0
  }
  let row = tablaContenidoPaquete.row(parent_element)
  // Invalida el row modificado en lugar de dibujar toda la tabla
  // row.invalidate();
  row.data({
    0: row.data()[0],
    1: row.data()[1],
    2: `<div class="input-group"><input type="number" class="form-control input-form cantidad-paquete text-center" name="cantidad-paquete" placeholder="0%" value="${cantidad}"><span class="input-span">ud</span></div>`,
    3: `<div class="costo-paquete text-center">$${costo}</div>`,
    4: `<div class="costototal-paquete text-center">$${costoTotal}</div>`,
    5: row.data()[5],
    6: `<div class="precioventa-paquete text-center">$${precioventa}</div>`,
    7: `<div class="subtotal-paquete text-center">$${subtotal}</div>`,
    8: row.data()[8]
  }).invalidate().draw(false);
  return data = [costoTotal, subtotal, cantidad, costo, precioventa]
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

// ASIGNAR PAQUETES A CLIENTES.
orderAndFillSelects('#relacion-paquete', 'clientes_api', 2, 'ID_CLIENTE', 'NOMBRE_COMERCIAL');

$('#asignarPaquete').on('click', function(){
  const paqueteEnAsignacion = $('#seleccion-paquete option:selected').text();

  if(!paqueteEnAsignacion){
    alert("Necesita seleccionar un paquete");
    $('#listaAsignada').html('');
  } else{
    //Cambiar el nombre del paquete en el modal
    $('.titlePaqueteAsignado').text(paqueteEnAsignacion);
    // mostrar los clientes que tiene asignado el paquete actual
    ajaxAwait({
      api: 12,
      id_paquete: $('#seleccion-paquete').val()
    }, "paquetes_api", { callbackAfter: true, WithoutResponseData: true }, false, function(data)
    {
      $('#listaAsignada').html(mostrarClientesAsignados(data));
      $.getScript('contenido/js/eliminar-relacion-paquete.js')
    });

    $('#ModalCrearRelacion').modal('show');
  }
})

$(document).ready(function(){
  $('#formCrearRelacion').off('submit').on('submit',function(event){
    event.preventDefault();

    const datos = {
      id_paquete: $('#seleccion-paquete').val(),
      cliente_id: $('#relacion-paquete').val(),
      api: 11
    };

    ajaxAwait(datos, 'paquetes_api',{ callbackAfter: true, WithoutResponseData: true }, false, function(data){
      alertToast('¡Paquete asignado!', 'success', 4000);
      ajaxAwait({
        api: 12,
        id_paquete: $('#seleccion-paquete').val()
      }, "paquetes_api", { callbackAfter: true, WithoutResponseData: true }, false, function(d){
      
        $('#listaAsignada').html(mostrarClientesAsignados(d));
        $.getScript('contenido/js/eliminar-relacion-paquete.js')
  
      });
  
    });
  });


  $('#formEditarPaquete').off('submit').on('submit', function(e){
    e.preventDefault();
    const send = {
      api: 1,
      id: $('#seleccion-paquete').val(),
      descripcion: $('#nombrePaqEditar').val(),
      tipo_paquete: $('#tipoPaqEditar').val()
    };

    alertMensajeConfirm(
      {
        title: `¿Realmente quieres modificar los datos del paquete ${$('#seleccion-paquete option:selected').text()}?`,
        text: 'No te preocupes, puedes editar de nuevo la información',
        icon: 'warning',
        confirmButtonText: 'Sí, estoy seguro'
      },
      function(){
        // enviar los nuevos datos del paquete
        ajaxAwait(
          send, 'paquetes_api', { callbackAfter: true, WithoutResponseData: true }, false, function(data){
            alertToast('¡Paquete modificado!', 'success', 4000);
            $('#ModalEditarPaquete').modal('hide');
            $('#check-agregar').click();
          }
        )
      },
      1
    );
  });

});

function mostrarClientesAsignados(data){
  let item = '';

  for (let index = 0; index < data.length; index++) {
    item += `
    <div class="col-auto cliente">
      <div class="input-group mb-3">
        <div class="input-group-text">
          <label class="d-flex justify-content-center" for="">${data[index].CLIENTE}</label> 
          <button class="badge text-bg-danger listaClientesPaquetes" data-bs-id="${data[index].ID_CLIENTE}">
            <i class="bi bi-trash3-fill"></i>
          </button>
        </div>
      </div>
    </div>
    `;
  }

  return item;
}

$('#filtroClientes').on('input', function() {
  var filtro = $(this).val().toLowerCase(); // Obtener el texto del filtro en minúsculas
  
  // Iterar sobre los elementos con clase 'cliente'
  $('#listaAsignada .cliente').each(function() {
    var nombreCliente = $(this).find('label').text().toLowerCase(); // Obtener el texto del cliente
    
    // Comprobar si el nombre del cliente contiene el texto del filtro
    if (nombreCliente.includes(filtro)) {
      $(this).removeClass('hidden'); // Mostrar si coincide
    } else {
      $(this).addClass('hidden'); // Ocultar si no coincide
    }
  });
});

$('#editarInfoPaqueteBtn').on('click', function(){
  const idPaquete = $('#seleccion-paquete').val();

  ajaxAwait({
    api: 2,
    id: idPaquete
  }, "paquetes_api", { callbackAfter: true, WithoutResponseData: true}, false, function(data){
    $('#nombrePaqEditar').val(data[0].DESCRIPCION);
    $('#tipoPaqEditar').val(data[0].TIPO_PAQUETE);
  });

  $('#ModalEditarPaquete').modal('show');
});

$("#btnInhabilitarPaquete").click(function(){
  alertMensajeConfirm(
    {
      title: `Se inhabilitará el siguiente paquete: ${$('#seleccion-paquete option:selected').text()}`,
      text: 'No podrás recuperar la información.',
      icon: 'warning',
      confirmButtonText: 'Sí, inhabilitar'
    },
    function(){
      // inhabilitar el paquete seleccionado
      ajaxAwait(
        {
          api: 4,
          id: $('#seleccion-paquete').val()
        },
        "paquetes_api",
        { callbackAfter: true, WithoutResponseData: true },
        false,
        function(data){
          alertToast('Paquete inhabilitado!', 'success', 4000);
          $('#ModalEditarPaquete').modal('hide');
          $('#check-agregar').click();
        }
      );
    },1
  );
});