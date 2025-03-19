select2('#seleccion-paquete', 'form-select-paquetes')
select2('#seleccion-estudio', 'form-select-paquetes')
select2('#select-presupuestos', 'form-select-paquetes')

//Declarar variable para la clase
var selectEstudio, SelectedFolio;
var datosUsuarioCotizacion = $('#datosUsuarioCotizacion');
let correos;

$('#agregar-estudio-paquete').click(function () {
  selectData = selectEstudio.array[$("#seleccion-estudio").prop('selectedIndex')]
  meterDato(
    selectData['SERVICIO'], selectData['ABREVIATURA'], 
    selectData['COSTO'], selectData['PRECIO_VENTA'], 1, null, 
    selectData['ID_SERVICIO'], selectData['ABREVIATURA'], 
    tablaContenidoPaquete
  );
})

$("#formPaqueteBotonesArea").addClass("disable-element");
$("#formPaqueteSelectEstudio").addClass("disable-element");
$("#informacionPaquete").addClass("disable-element");

$("#UsarPaquete").on("click", function () {
  if ($("input[type=radio][name=selectPaquete]:checked").val() == 2) {
    if (!$("#select-presupuestos").val()) {
      alertToast(
        "Necesitas seleccionar un presupuesto de este cliente",
        "error",
        "5000"
      );
      return false;
    } else {
      SelectedFolio = $("#folio-cotizacion").val();
    }
  }

  let id_cotizacion = $("#select-presupuestos").val();

  $(".selectDisabled").addClass("disable-element");
  $("#formPaqueteBotonesArea").removeClass("disable-element");
  $("#card_paq").removeClass("disable-element");
  $("#formPaqueteSelectEstudio").removeClass("disable-element");
  $("#informacionPaquete").removeClass("disable-element");

  calcularFilasTR();

  $("#input-atencion-cortizaciones").val("");
  $("#input-correo-cortizaciones").val("");
  $("#input-domicilio_fiscal").val("");
  $("#input-fecha-vigencia").val("");
  $("#input-observaciones-cortizaciones").val("");

  if ($("input[type=radio][name=selectPaquete]:checked").val() == 2) {
    tablaContenido(true);
    ajaxAwait(
      { id_cotizacion: id_cotizacion, api: 2 },
      "cotizaciones_api",
      { callbackAfter: true },
      false,
      (data) => {

        row = data.response.data[0]['DETALLE'];
        row2 = data.response.data[0];

        const datetimeString = row2["FECHA_VENCIMIENTO"];
        const fechaFormateada = moment(datetimeString).format("YYYY-MM-DD");
        const domicilio_fiscal =
            (row2['DOMICILIO_FISCAL'] && row2['DOMICILIO_FISCAL'].trim() !== '')
                ? row2['DOMICILIO_FISCAL'] :
                `${row2["ESTADO"] ?? 'Estado'}, ` +
                `${row2["MUNICIPIO"] ?? 'Municipio'}, ` +
                `Col. ${row2["COLONIA"] ?? 'Colonia'}, ` +
                `C. ${row2["CALLE"] ?? 'Calle'}, ` +
                `No. Ext. ${row2["NUMERO_EXTERIOR"] ?? 'SN'}, ` +
                `No. Int. ${row2["NUMERO_INTERIOR"] ?? 'SN'}`;

        $("#input-atencion-cortizaciones").val(row2["ATENCION"]);
        $("#input-correo-cortizaciones").val(row2["CORREO"]);
        // $("#hidden-correos").val(response["CORREO"]);
        // cargarCorreos(response)
        $("#input-fecha-vigencia").val(fechaFormateada);
        $("#input-observaciones-cortizaciones").val(row2["OBSERVACIONES"]);
        $("#input-domicilio_fiscal").val(domicilio_fiscal);

        SelectedFolio = row2["FOLIO"];

        //DATOS DEL CLIENTE Y CALCULO DEL PAQUETE
        if (row) {
          //ASIGNAR DATOS DE CLIENTE
          $("#nombreCotizacionCliente").html(row2["ATENCION"]);
          $("#correoCotizacionCliente").html(row2["CORREO"]);
          $("#fiscalCotizacionCliente").html(domicilio_fiscal);
          $("#observacionesCotizacionCliente").html(row2["OBSERVACIONES"]);

          //ASIGNAR CALCULO DE PAQUETE
          $("#descuento-paquete").val(row2["PORCENTAJE_DESCUENTO"]);

          for (const key in row) {
            if (Object.hasOwnProperty.call(row, key)) {
              const element = row[key];
              meterDato(
                row[key]["PRODUCTO"],
                row[key]["ABREVIATURA"],
                row[key]["COSTO_BASE"],
                row[key]["SUBTOTAL_BASE"],
                row[key]["CANTIDAD"],
                row[key]["DESCUENTO_PORCENTAJE"],
                row[key]["ID_SERVICIO"],
                null,
                tablaContenidoPaquete
              );
            }
          }

          calcularFilasTR();
        }
      }
    );
  } else {
    ajaxAwait({id_cotizacion: id_cotizacion, api: 2}, "cotizaciones_api", {callbackAfter: true}, false,
        (data) => {
          if(data.response.data.length > 0){
            const response_register = data.response.data[0];

            const domicilio_fiscal =
                (response_register['DOMICILIO_FISCAL'] && response_register['DOMICILIO_FISCAL'].trim() !== '')
                    ? response_register['DOMICILIO_FISCAL'] :
                    `${response_register["ESTADO"] ?? 'Estado'}, ` +
                    `${response_register["MUNICIPIO"] ?? 'Municipio'}, ` +
                    `Col. ${response_register["COLONIA"] ?? 'Colonia'}, ` +
                    `C. ${response_register["CALLE"] ?? 'Calle'}, ` +
                    `No. Ext. ${response_register["NUMERO_EXTERIOR"] ?? 'SN'}, ` +
                    `No. Int. ${response_register["NUMERO_INTERIOR"] ?? 'SN'}`;

            $("#input-domicilio_fiscal").val(domicilio_fiscal);
            $("#fiscalCotizacionCliente").html(domicilio_fiscal);
          } else {
            $("#fiscalCotizacionCliente").html('Completa los datos del cliente, para autorellenar esta sección.');
          }
        }
    ).then(r => {});
  }
});

$( '#CambiarPaquete').on('click', function () {
  $('#nombreCotizacionCliente').html('')
  $('#correoCotizacionCliente').html('')
  $('#fiscalCotizacionCliente').html('')
  $('#observacionesCotizacionCliente').html('')

  $('#seleccion-paquete').prop('disabled', false);
  $(".selectDisabled").removeClass("disable-element");
  $("#formPaqueteBotonesArea").addClass("disable-element");
  $("#formPaqueteSelectEstudio").addClass("disable-element");
  $("#informacionPaquete").addClass("disable-element");

  $('input[type=radio][name=selectChecko]:checked').prop('checked', false);
  $("#seleccion-estudio").find('option').remove().end()
  tablaContenido(true)
})
// 

$('input[type="radio"][name="selectPaquete"]').change(function () {
  switch ($(this).val()) {
    case '1':
      contenidoPaquete();
      break;
    case '2':
      mantenimientoPaquete();
      break;

  }
});


$('input[type=radio][name=selectChecko]').change(function () {

  if ($(this).val() != 0) {
    // selectData = null;
    rellenarSelect("#seleccion-estudio", "precios_api", 7, 'ID_SERVICIO', 'ABREVIATURA.SERVICIO', {
      area_id: this.value,
      cliente_id: $('#seleccion-paquete').val()
    }, function (listaEstudios) {
      selectEstudio = new GuardarArreglo(listaEstudios);
    }); //Mandar cliente para lista personalizada
  } else {
    rellenarSelect("#seleccion-estudio", "precios_api", 7, 'ID_SERVICIO', 'ABREVIATURA.SERVICIO', {
      area_id: this.value,
      cliente_id: $('#seleccion-paquete').val()
    }, function (listaEstudios) {
      selectEstudio = new GuardarArreglo(listaEstudios);
    });
  }
});

$("#guardar-contenido-paquete").on("click", function () {
  let data = calcularFilasTR();
  // console.log(data);
  let dataAjax = data[0];
  let dataAjaxDetalleCotizacion = data[1];
  let tableData = tablaContenidoPaquete.rows().data().toArray();
  if (tableData.length > 0) {
    alertPassConfirm(
      {
        title: "Ingrese su contraseña para guardar la lista",
        text: "Use su contraseña para confirmar",
        showCancelButton: true,
        confirmButtonText: "Confirmar",
        cancelButtonText: "Cancelar",
        showLoaderOnConfirm: true,
      },
      async function () {
        let datajson = {
          api: 1,
          detalle: dataAjax,
          total: dataAjaxDetalleCotizacion["total"].toFixed(2),
          subtotal: dataAjaxDetalleCotizacion["subtotal"].toFixed(2),

          subtotal_sin_descuento:
            dataAjaxDetalleCotizacion["subtotal_sindescuento"].toFixed(2),

          iva: dataAjaxDetalleCotizacion["iva"].toFixed(2),
          descuento: dataAjaxDetalleCotizacion["descuento"],
          descuento_porcentaje:
            dataAjaxDetalleCotizacion["descuento_porcentaje"],
          cliente_id: dataAjaxDetalleCotizacion["cliente_id"],
          atencion: $("#input-atencion-cortizaciones").val(),
          //correo: $("#input-correo-cortizaciones").val(),
          correo: $("#hidden-correos").val(),
          observaciones: $("#input-observaciones-cortizaciones").val(),
          fecha_vigencia: $("#input-fecha-vigencia").val(),
          domicilio_fiscal: $("#input-domicilio_fiscal").val(),

        };

        if ($("input[type=radio][name=selectPaquete]:checked").val() == 2) {
          datajson["id_cotizacion"] = $("#select-presupuestos").val();
        }

        let data = await ajaxAwait(datajson, "cotizaciones_api");

        if (data) {
          tablaContenidoPaquete.clear().draw();
          dataEliminados = new Array();
          alertMsj({
            //${data.response.data}
            title: "Cotización guardada",
            text: `Tu nuevo cotización ha sido guardada con el siguiente folio: ${
              data.response.data === "1" ? SelectedFolio : data.response.data
            }`,
            icon: "success",
            showCancelButton: false,
            confirmButtonText: "Confirmar",
            confirmButtonColor: "green",
          });

          //borrar el div para que se vuelva a abrir
          // datosUsuarioCotizacion.empty()

          // alertMensaje('success', 'Contenido registrado', 'El contenido se a registrado correctamente :)')
          $("#modalInfoDetalleCotizacion").modal("hide");
          $("#nombreCotizacionCliente").html(row2["CREADO_POR"]);
          $("#correoCotizacionCliente").html(row2["CORREO"]);
          $("#fiscalCotizacionCliente").html(row2["DOMICILIO_FISCAL"]);
          $("#observacionesCotizacionCliente").html(row2["OBSERVACIONES"]);
          //$('#check-editar').click()
        }
      }
    );
  } else {
    alertMensaje(
      "error",
      "¡Faltan datos!",
      "Necesita rellenar la tabla de estudios para continuar"
    );
  }
});

$(document).on(
  "change",
  "input[name='cantidad-paquete'], input[name='descuento-paquete'], #descuento-paquete",
  function () {
    calcularFilasTR();

    if ($(this).attr("id") == "descuento-paquete") {
      if ($(this).val() > 0) {
        $("#precios-con-descuento").fadeIn();
      } else {
        $("#precios-con-descuento").fadeOut();
      }
    }
  }
);

$('#seleccion-paquete').on('change', async function (e) {
  await rellenarSelect("#select-presupuestos", 'cotizaciones_api', 4, 'ID_COTIZACION', 'FOLIO_FECHA', {
    cliente_id: $('#seleccion-paquete').val()
  });
})


// Función que se ejecuta cuando se realiza una acción para obtener un nuevo PDF
function getNewView(url, filename) {
  let adobeDCView = new AdobeDC.View({ clientId: "cd0a5ec82af74d85b589bbb7f1175ce3", divId: "adobe-dc-view" });
  var nuevaURL = url;

  // Agregar un parámetro único a la URL para evitar la caché del navegador
  nuevaURL += "?timestamp=" + Date.now();
  adobeDCView.previewFile({
    content: { location: { url: nuevaURL } },
    metaData: { fileName: filename }
  });
}

$('#btn-vistaPrevia-cotizacion').click(function () {
  // Obtén los parámetros necesarios
  var area_nombre = 'cotizacion';
  var api = encodeURIComponent(window.btoa(area_nombre));
  var area = encodeURIComponent(window.btoa(15));
  var id_cotizacion = encodeURIComponent(window.btoa($('#select-presupuestos').val()));

  // window.open(`${http}${servidor}/${appname}/visualizar_reporte/?api=${api}&id_cotizacion=${id_cotizacion}&area=${area}`, "_blank");
  // Construye la vista y se almacena en la variable url
  var url = `${http}${servidor}/${appname}/visualizar_reporte/?api=${api}&area=${area}&id_cotizacion=${id_cotizacion}`;
  //Se manda la url y se agrega un titulo donde se cargara la vista del pdf
  console.log(url, $('#select-presupuestos').val());
  getNewView(url, 'Vista prevía cotización')

  // Muestra el modal
  $('#modal-cotizacion').modal('show');
});


$('#btn-enviarCorreo-cotizaciones').click(function (e) {
  alertMensajeConfirm({
    title: '',
    html: `<h4 style = "font-weight: bold";>¿Desea enviar está cotización al correo: <span style = "background-color : yellow">${row2['CORREO']}<span> ?</h4 style>
    <br> <small>No podrás cancelar el correo</small>`,
    icon: "info",
  }, function () {

    ajaxAwait({ api: 5, id_cotizacion: $('#select-presupuestos').val() }, 'cotizaciones_api', { callbackAfter: true }, false, (data) => {
      alertToast('¡Cotización Enviada!', 'success', '4000')
      $('#modal-cotizacion').modal('hide');
    })
  }, 1)

})

$('#btn-descargar-cotizacion').click(function (e){
  ajaxAwait({ api: 7, id_cotizacion: $('#select-presupuestos').val() }, 'cotizaciones_api', { callbackAfter: true }, false, (data) => {
    // hacer lo que quieras con el url
    downloadFromUrl(data.response.data[0]['RUTA_REPORTE']);
  })
})



function downloadFromUrl(url) {
  // Extraer el nombre del archivo desde la URL
  const filename = url.split('/').pop();

  fetch(url)
      .then(response => response.blob()) // Convertir la respuesta en Blob
      .then(blob => {
          const a = document.createElement("a");
          const objectURL = URL.createObjectURL(blob);
          a.href = objectURL;
          a.download = filename; // Usar el nombre extraído
          document.body.appendChild(a);
          a.click();
          document.body.removeChild(a);
          URL.revokeObjectURL(objectURL); // Limpiar memoria
      })
      .catch(error => console.error("Error al descargar:", error));
}
