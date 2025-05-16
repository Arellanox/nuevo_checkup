select2('#seleccion-paquete', 'form-select-paquetes')
select2('#seleccion-estudio', 'form-select-paquetes')
select2('#select-presupuestos', 'form-select-paquetes')

//Declarar variable para la clase
var selectEstudio, SelectedFolio;
var datosUsuarioCotizacion = $('#datosUsuarioCotizacion');
let correos;

$('#agregar-estudio-paquete').click(function () {
    const value = $('input[type=radio][name=selectChecko]:checked').val()

    if (parseInt(value) === 13) {
        selectData = selectEstudio.array[$("#seleccion-estudio").prop('selectedIndex')]

        meterDato(
            selectData['DESCRIPCION'], '-----',
            selectData['COSTO'], selectData['PRECIO_VENTA'], 1, null,
            null, selectData['ID_PAQUETE'],
            tablaContenidoPaquete
        );
    } else {
        selectData = selectEstudio.array[$("#seleccion-estudio").prop('selectedIndex')]
        meterDato(
            selectData['SERVICIO'], selectData['ABREVIATURA'],
            selectData['COSTO'], selectData['PRECIO_VENTA'], 1, null,
            selectData['ID_SERVICIO'], null,
            tablaContenidoPaquete
        );
    }
})

$("#formPaqueteBotonesArea").addClass("disable-element");
$("#formPaqueteSelectEstudio").addClass("disable-element");
$("#informacionPaquete").addClass("disable-element");

$("#UsarPaquete").on("click", function () {
    if ($("input[type=radio][name=selectPaquete]:checked").val() === 2) {
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

    const id_cotizacion = $("#select-presupuestos").val();
    const value = $('input[type=radio][name=selectPaquete]:checked').val()

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

    if (parseInt(value) === 2) {
        tablaContenido(true);
        ajaxAwait(
            {id_cotizacion: id_cotizacion, api: 2},
            "cotizaciones_api",
            {callbackAfter: true},
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
                            meterDato(
                                row[key]["PRODUCTO"] !== null ? row[key]["PRODUCTO"] : row[key]["PAQUETE"],
                                row[key]["ABREVIATURA"] !== null ? row[key]["ABREVIATURA"] : '-----',
                                row[key]["COSTO_BASE"],
                                row[key]["SUBTOTAL_BASE"],
                                row[key]["CANTIDAD"],
                                row[key]["DESCUENTO_PORCENTAJE"],
                                row[key]["ID_SERVICIO"],
                                row[key]["ID_PAQUETE"],
                                tablaContenidoPaquete
                            );
                        }
                    }

                    calcularFilasTR();
                }
            }
        );
    }
});

$('#CambiarPaquete').on('click', function () {
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
    var value = parseInt($(this).val());
    var clienteId = $('#seleccion-paquete').val();

    if (value !== 0 && value !== 13) {
        rellenarSelect("#seleccion-estudio", "precios_api", 7, 'ID_SERVICIO', 'ABREVIATURA.SERVICIO', {
            area_id: value,
            cliente_id: clienteId
        }, function (listaEstudios) { selectEstudio = new GuardarArreglo(listaEstudios); });
    } else if (value === 13) {
        rellenarSelect("#seleccion-estudio", "paquetes_api", 2, "ID_PAQUETE", "DESCRIPCION", {
            cliente_id: clienteId
        }, function (listaPaquetes) { selectEstudio = new GuardarArreglo(listaPaquetes) })
    } else {
        rellenarSelect("#seleccion-estudio", "precios_api", 7, 'ID_SERVICIO', 'ABREVIATURA.SERVICIO', {
            area_id: value,
            cliente_id: clienteId
        }, function (listaEstudios) { selectEstudio = new GuardarArreglo(listaEstudios); });
    }
});

$("#guardar-contenido-paquete").on("click", function () {
    let data = calcularFilasTR();
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
                    subtotal_sin_descuento: dataAjaxDetalleCotizacion["subtotal_sindescuento"].toFixed(2),
                    iva: dataAjaxDetalleCotizacion["iva"].toFixed(2),
                    descuento: dataAjaxDetalleCotizacion["descuento"],
                    descuento_porcentaje: dataAjaxDetalleCotizacion["descuento_porcentaje"],
                    cliente_id: dataAjaxDetalleCotizacion["cliente_id"],
                    atencion: $("#input-atencion-cortizaciones").val(),
                    correo: $("#input-correo-cortizaciones").val(),
                    observaciones: $("#input-observaciones-cortizaciones").val(),
                    fecha_vigencia: $("#input-fecha-vigencia").val(),
                    domicilio_fiscal: $("#input-domicilio_fiscal").val(),
                };

                console.log(dataAjaxDetalleCotizacion["descuento_porcentaje"])

                if ($("input[type=radio][name=selectPaquete]:checked").val() == 2) {
                    datajson["id_cotizacion"] = $("#select-presupuestos").val();
                }

                let data = await ajaxAwait(datajson, "cotizaciones_api");

                if (data) {
                    tablaContenidoPaquete.clear().draw();
                    dataEliminados = [];

                    alertMsj({
                        title: "Cotización guardada",
                        text: `Tu nuevo cotización ha sido guardada con el siguiente folio: ${
                            data.response.data === "1" ? SelectedFolio : data.response.data
                        }`,
                        icon: "success",
                        showCancelButton: false,
                        confirmButtonText: "Confirmar",
                        confirmButtonColor: "green",
                    });

                    $("#modalInfoDetalleCotizacion").modal("hide");
                    $("#nombreCotizacionCliente").html(row2["CREADO_POR"]);
                    $("#correoCotizacionCliente").html(row2["CORREO"]);
                    $("#fiscalCotizacionCliente").html(row2["DOMICILIO_FISCAL"]);
                    $("#observacionesCotizacionCliente").html(row2["OBSERVACIONES"]);
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

        if ($(this).attr("id") === "descuento-paquete") {
            if ($(this).val() > 0) {
                $("#precios-con-descuento").fadeIn();
            } else {
                $("#precios-con-descuento").fadeOut();
            }
        }
    }
);

$('#seleccion-paquete').on('change', async function () {
    await rellenarSelect("#select-presupuestos", 'cotizaciones_api', 4, 'ID_COTIZACION', 'FOLIO_FECHA', {
        cliente_id: $('#seleccion-paquete').val()
    });
})

// Función que se ejecuta cuando se realiza una acción para obtener un nuevo PDF
//LOCAL HOST: 3867b556792e429084f3e9253d3ea45c
//PRODUCTION: cd0a5ec82af74d85b589bbb7f1175ce3
function getNewView(url, filename) {
    var clientId = isLocalHost ? '3867b556792e429084f3e9253d3ea45c' : 'cd0a5ec82af74d85b589bbb7f1175ce3';
    let adobeDCView = new AdobeDC.View({clientId: clientId, divId: "adobe-dc-view"});
    var nuevaURL = url + "?timestamp=" + Date.now();

    adobeDCView.previewFile({
        content: {location: {url: nuevaURL}},
        metaData: {fileName: filename}
    });
}

$('#btn-vistaPrevia-cotizacion').click(function () {
    // Obtén los parámetros necesarios
    var area_nombre = 'cotizacion';
    var api = encodeURIComponent(window.btoa(area_nombre));
    var area = encodeURIComponent(window.btoa(15));
    var id_cotizacion = encodeURIComponent(window.btoa($('#select-presupuestos').val()));

    // Construye la url se manda y se agrega un titulo donde se cargara la vista del pdf
    var url = `${http}${servidor}/${appname}/visualizar_reporte/?api=${api}&area=${area}&id_cotizacion=${id_cotizacion}`;
    getNewView(url, 'Vista prevía cotización')

    // Muestra el modal
    $('#modal-cotizacion').modal('show');
});

$('#btn-enviarCorreo-cotizaciones').click(function () {
    alertMensajeConfirm({
        title: '',
        html: `<h4 style = "font-weight: bold">¿Desea enviar está cotización al correo: <span style = "background-color : yellow">${row2['CORREO']}<span> ?</h4 style>
    <br> <small>No podrás cancelar el correo</small>`,
        icon: "info",
    }, function () {

        ajaxAwait({
            api: 5,
            id_cotizacion: $('#select-presupuestos').val()
        }, 'cotizaciones_api', {callbackAfter: true}, false, () => {
            alertToast('¡Cotización Enviada!', 'success', '4000')
            $('#modal-cotizacion').modal('hide');
        })
    }, 1)

})

$('#btn-descargar-cotizacion').click(function () {
    ajaxAwait({
        api: 7,
        id_cotizacion: $('#select-presupuestos').val()
    }, 'cotizaciones_api', {callbackAfter: true}, false, (data) => {
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