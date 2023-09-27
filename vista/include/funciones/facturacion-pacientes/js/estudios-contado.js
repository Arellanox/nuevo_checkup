// ==============================================================================

// ###################### Variables #############################################

// ==============================================================================

//Variable globales
var tipo_pago = false, tipo_factura = false
var dataPaciente, dataPrecios = {};
var formasPagos = []; // Array para guardar las formas de pago
var array_pagos = []; // Array para guardar los pagos generados
var array_data = [] // Array para guardar la informacion del cliente que viene de cargos_turnos_api
var total_cliente; // Total que debe pagar el cliente

// ==============================================================================

// ###################### Eventos y Botones #####################################

// ==============================================================================

// Boton para terminar el proceso de carga
$(document).on('click', '#terminar-proceso-cargo', function (event) {
    event.preventDefault()

    // Seteamos y armamos el array de los diferentes metodos de pagos que se hicieron
    AlmacenarFormasPago()

    // Validar si el monto que se esta ingresando concuerda con el total que se muestra en el modal
    // Si no es asi entonces no puede continuar por que el pago no esta completo
    if (array_pagos.length === 0) {
        idPago = $("#contado-tipo-pago").val()
        array_pagos = [
            {
                id_pago: idPago,
                monto: total_cliente
            }
        ]
    } else {
        if (!monto()) {
            return false;
        }
    }

    //Pregunta al usuario el tipo de factura
    alertMensajeConfirm({
        title: '¿El paciente requiere factura?', text: 'Verifique que el tipo de dato sea correcto', icon: '',
        confirmButtonText: 'Facturar',
        denyButtonText: `No Facturar`,
        denyButtonColor: 'gray',
        showDenyButton: true,
        cancelButtonText: 'Facturar después',
        cancelButtonColor: 'rgb(247, 190, 000)'
    }, function () {
        //Si fue si, abrir el modal de factura
        $('#modalEstudiosContado').modal('hide')
        configurarFactura(dataPaciente)

    }, 1, function () {
        $('#modalEstudiosContado').modal('hide')//Si fue no, terminar el proceso con el tipo de pago contado...
        metodo()
    }, function () {
        metodo(2);
    })

})

// Formulario para facturar un paciente 
$(document).on('submit', '#formularioPacienteFactura', function (event) {
    event.preventDefault()

    alertMensajeConfirm({
        title: '¿Esta seguro que todos los datos están correctos',
        text: '¡No puedes cambiar estos datos después!',
        icon: 'warning',
        confirmButtonText: 'Si, estoy seguro'
    }, function () {
        //envio de datos (factura y tipo de pago_datos)
        let dataJson = {
            api: 1, turno_id: dataPaciente['ID_TURNO'],
            requiere_factura: 1, metodo_pago: 1
        }

        if (!onlyFactura) {
            dataJson.descuento_porcentaje = dataPrecios['descuento_porcentaje']
            dataJson.descuento = dataPrecios['descuento']
            dataJson.total_cargos = dataPrecios['total_cargos']
            dataJson.subtotal = dataPrecios['subtotal']
            dataJson.iva = dataPrecios['iva']
            dataJson.total = dataPrecios['total']
            dataJson.pago = $('#contado-tipo-pago').val()
            dataJson.referencia = $('#referencia-contado').val()

        }

        ajaxAwaitFormData(dataJson, 'tickets_api', 'formularioPacienteFactura', { callbackAfter: true }, false, function (data) {
            finalizarProcesoRecepcion(dataPaciente)
            FinalizarPago()
            alertTicket(data, 'Factura y ticket guardado')
        })
    }, 1)

    event.preventDefault()
})

// Boton para agregar formas de pago
$(document).on('click', '#agregarformapago', async function (e) {
    e.preventDefault();

    var tipoDePago = $("#contado-tipo-pago").val()

    if (tipoDePago) {
        var tipoDePagoEncontrado = formasPagos.find(function (tipo) {
            return tipo.ID_PAGO === tipoDePago;
        });

        if (tipoDePagoEncontrado) {
            armarTiposPagos(tipoDePagoEncontrado);
            MontoFaltante()
        } else {
            alertToast('Tipo de pago no encontrado.', 'error', 4000)
        }
    } else {
        alertToast('Selecciona un tipo de pago válido.', 'error', 4000)
    }
})

// Boton para eliminar el tipo de pago
$(document).on('click', '.eliminarformapago', function (e) {
    e.stopPropagation();

    var id_pago = $(this).attr("data_id")
    var html = $(`#pago_${id_pago}`);

    array_pagos = array_pagos.filter(function (formaPago) {
        return formaPago.ID_PAGO !== id_pago
    })

    html.remove()
    MontoFaltante()
})

// ==============================================================================

// ###################### FUNCIONES #############################################

// ==============================================================================

//Vista de estudios que se le hicieron al paciente
function configurarModal(data) {
    //Estatus en proceso
    OcultarTablas()
    tipo_pago = $('#contado-tipo-pago').val()
    tipo_factura = false

    onlyFactura = false

    dataPaciente = data
    $('#nombre-paciente-contado').html(`${data['NOMBRE_COMPLETO']}`)
    //Mensaje de espera al usuario
    alertToast('Espere un momento', 'info', 4000)

    rellenarSelect('#contado-tipo-pago', 'formas_pago_api', '2', 'ID_PAGO', 'DESCRIPCION', {}, function (data) {
        formasPagos = data;
        // console.log(formasPagos)
    })

    ajaxAwait({
        api: 1,
        turno_id: data['ID_TURNO'],
    }, 'cargos_turnos_api', { callbackAfter: true, returnData: false }, false, function (data) {
        //El arreglo debe contener tanto un arreglo de los estudios como el total de precio de los estudios
        //let row = data.response.data // todos los datos

        data = data.response.data //Todos los datos para el detalle
        array_data = data;

        //Quitar duplicidad
        if (data['FACTURADO'] == 1) {
            alertMensaje('warning', '¡Paciente Facturado!', 'Este paciente ya tiene factura, no puedes volver a tomar estos datos...');
            return false;
        }


        let row = data['estudios'] // <-- Listas de estudios en bruto

        $('.contenido-estudios').html('')

        for (const key in row) {
            if (Object.hasOwnProperty.call(row, key)) {
                const element = row[key]

                //Crea la fila de la tabla, Nombre del servicio, cantidad, y precio antes de iva
                let html = `<tr>
                                <th>${element['SERVICIOS']}</th> 
                                <td>${ifnull(element['CANTIDAD'], 0)}</td>
                                <td>$${ifnull(element['TOTAL'], 0)}</td>
                            </tr>`

                //Adjunta a las tablas la area correspondiente
                if (element['AREA_ID'] == '11' || element['AREA_ID'] == '12' || element['AREA_ID'] == '6' || element['AREA_ID'] == '8') {
                    $(`#cargos-estudios-${element['AREA_ID']}`).append(html)
                    $(`#container-estudios-${element['AREA_ID']}`).fadeIn(0)
                } else {
                    $(`#cargos-estudios-0`).append(html)
                    $(`#container-estudios-0`).fadeIn(0)
                }

            }
        }


        let total_cargos = data['TOTAL_CARGO']



        let subtotal = total_cargos
        $('#precio-subtotal').html(`$${subtotal.toFixed(2)}`)

        let iva = subtotal * 0.16
        $('#precio-iva').html(`$${iva.toFixed(2)}`)

        let total = subtotal + iva
        $('#precio-total').html(`$${total.toFixed(2)}`)

        total_cliente = total.toFixed(2);

        dataPrecios = {
            descuento_porcentaje: 0,
            descuento: 0,
            total_cargos: total_cargos,
            subtotal: subtotal,
            iva: iva, total: total

        }


        $(document).on('change, keyup', '#descuento', function () {
            let total_cargos = data['TOTAL_CARGO']
            let porcentaje_descuento = $(this).val()
            let descuento = porcentaje_descuento / 100 * total_cargos

            $('#precio-descuento').html(`$${descuento.toFixed(2)}`)

            let subtotal = total_cargos - descuento
            $('#precio-subtotal').html(`$${subtotal.toFixed(2)}`)

            let iva = subtotal * 0.16
            $('#precio-iva').html(`$${iva.toFixed(2)}`)

            let total = subtotal + iva
            $('#precio-total').html(`$${total.toFixed(2)}`)

            total_cliente = total.toFixed(2)

            dataPrecios = {
                descuento_porcentaje: porcentaje_descuento,
                descuento: descuento,
                total_cargos: total_cargos,
                subtotal: subtotal,
                iva: iva, total: total

            }


        })



        //Lista de precio, total de estudios, detalle fuera
        $('#precio-total-cargo').html(`$${ifnull(data['TOTAL_CARGO'].toFixed(2))}`) //CHECAR LA FUNCION ifnull PARA RECIBIR DATOS NUMERICOS :)
        // $('#precio-descuento').html(`$${ifnull(data['DESCUENTO'])}`)
        // $('#precio-subtotal').html(`$${ifnull(data['SUBTOTAL'])}`)
        // $('#precio-iva').html(`$${ifnull(data['IVA'])}`)
        // $('#precio-total').html(`$${ifnull(data['TOTAL'])}`)


        $('#modalEstudiosContado').modal('show')

    })


}

//Vista de factura (faltan datos)
function configurarFactura(data) {
    tipo_factura = true

    dataPaciente = data;

    $('#nombre-paciente-factura').html(`${data['NOMBRE_COMPLETO']}`)

    //Mensaje de espera al usuario
    alertToast('Espere un momento', 'info', 4000)

    rellenarSelect('#regimen_fiscal-factura', 'sat_regimen_api', 1, 'ID_REGIMEN', 'REGIMEN_FISCAL')
    rellenarSelect('#uso-factura', 'cfdi_api', 1, 'ID_CFDI', 'CLAVE.DESCRIPCION')

    $('#rfc-factura').val(data['RFC'])

    $('#modalFacturaPaciente').modal('show')

}

//No requiere factura o el mensaje de factura le dio que no
function metodo(factura = 0) {
    //Termina el proceso del paciente con las llamadas que hizo el usuario
    finalizarProcesoRecepcion(dataPaciente)
    FinalizarPago()

    ajaxAwait({
        api: 1, turno_id: dataPaciente['ID_TURNO'],
        descuento_porcentaje: dataPrecios['descuento_porcentaje'],
        descuento: dataPrecios['descuento'], total_cargos: dataPrecios['total_cargos'],
        subtotal: dataPrecios['subtotal'], iva: dataPrecios['iva'], total: dataPrecios['total'],
        pago: $('#contado-tipo-pago').val(), referencia: $('#referencia-contado').val(), requiere_factura: factura
    }, 'tickets_api', { callbackAfter: false }, function (data) {
        alertTicket(data, 'Ticket guardado')
    })
}

function alertTicket(data, textAlert) {
    data = data.response.data

    // alertMsj({
    //     title: textAlert,
    //     text: 'Se ha generado el ticket',
    //     icon: 'success',
    //     html: ` <p>Se ha generado el ticket, dale click aqui: </p>
    //     <a href="${data['url_ticket']}" type="button" class="btn btn-cancelar" target="_blank">
    //         <i class="bi bi-file-earmark-pdf"></i> Ticket
    //     </a>
    //     `
    // })

    alertMensaje('success', textAlert, 'Se ha generado el ticket');

    $('#modalEstudiosContado').modal('hide')

    $('#modalFacturaPaciente').modal('hide')
}

// Configura las configuraciones para hacer hacer el ingreso de dos formas de pagos
function ConfigurarFormasPago(type) {
    if (type === "Out") {
        $('#TipoPago1').removeClass('disable-element');
        $('#eliminarformapago').fadeOut(0);
    } else if (type === "In") {
        $('#TipoPago1').addClass('disable-element');
        $('#eliminarformapago').fadeIn(0);
    }
}

// Arma todo el esquelo HTML de los tipos de pago con el input de monto
function armarTiposPagos(tipoDePagoEncontrado) {

    let html = `
    <div class="row" id='pago_${tipoDePagoEncontrado.ID_PAGO}'>
        <div class="col-4">
            <label class="form-label" for="tipo_pago">${tipoDePagoEncontrado.DESCRIPCION}:</label>
        </div>
        <div class="col-4">
            <div class="input-group flex-nowrap">
                <span class="input-group-text input-span">$</span>
                <input type="number" placeholder="Monto:" id='id_pago_${tipoDePagoEncontrado.ID_PAGO}' value='0' class="form-control input-form" onkeyup="MontoFaltante()">
            </div>
        </div>
        <div class="col-4">
            <button class="btn eliminarformapago" data_id='${tipoDePagoEncontrado.ID_PAGO}' id="">
                <i class="bi bi-trash me-2"></i>
                Eliminar
            </button>
        </div>
    </div>
    `;
    $('#formasPagoDiv').append(html)
}

// Crear el array con los tipos de pago que se crearon junto con su ID y MONTO
function AlmacenarFormasPago() {
    array_pagos = [];

    // FormasPagos = [
    //     {
    //         tipo: "Efectivo",
    //         monto: "120.00"
    //     },
    //     {
    //         tipo: "Tarjeta",
    //         monto: "120.00"
    //     }
    // ]


    $("#formasPagoDiv > div").each(function () {
        var idPago = $(this).find(".eliminarformapago").attr("data_id")
        var tipo = $(this).find("label").text().replace(":", "").trim()
        var monto = $(this).find("input").val()

        array_pagos.push({
            id_pago: idPago,
            tipo: tipo,
            monto: parseFloat(ifnull(monto, 0)).toFixed(2)
        })
    })

    // console.log(array_pagos)


    return array_pagos
}

// Valida si el monto que se ingreso concuerda con el total calculado del paciente
function monto() {
    var sumaMontos = 0;
    var total = total_cliente

    $.each(array_pagos, function (index, formaPago) {
        var monto = parseFloat(formaPago.monto);
        if (!isNaN(monto)) {
            sumaMontos += monto;
        }
    });



    var total2 = (parseFloat(total)).toFixed(2)

    // console.log(typeof (sumaMontos))
    // console.log(typeof (total2))
    // console.log(sumaMontos.toFixed(2))
    // console.log(total2)


    if (sumaMontos.toFixed(2) === total2) {
        return true
    } else if (sumaMontos.toFixed(2) < total2) {
        console.log('entro al menor')
        alertToast('No se puede continuar por que la cantidad ingresada es menor al total.', 'error', 4000)
        return false;
    } else if (sumaMontos.toFixed(2) > total2) {
        console.log('entro al mayor')
        alertToast('No se puede continuar por que la cantidad ingresada es mayor al total.', 'error', 4000)
        return false;
    }
}

function FinalizarPago() {
    ajaxAwait({
        api: 1,
        formas_pagos_ticket, array_pagos
    }, 'tickets_api')
}

// Oculta todas las tablas
function OcultarTablas() {
    $('#container-estudios-11').fadeOut()
    $('#container-estudios-8').fadeOut()
    $('#container-estudios-6').fadeOut()
    $('#container-estudios-0').fadeOut()
}

function MontoFaltante() {
    const Array = AlmacenarFormasPago()
    let Suma = 0;
    let residuo = 0;

    if (array_pagos.length > 0) {
        for (const key in Array) {
            if (Object.hasOwnProperty.call(Array, key)) {
                const element = Array[key];

                Suma += parseFloat(ifnull(element, 0, ['monto']));
            }
        }

        console.log(parseFloat(total_cliente), Suma)

        residuo = parseFloat(total_cliente) - Suma

        if (residuo !== 0) {
            $('#precio-faltante').html(`$${residuo.toFixed(2)}`)
        } else {
            $('#precio-faltante').html('Pago listo')
        }
    } else {
        $('#precio-faltante').html('Pago listo')
    }
}
// ==============================================================================

// ###################### Otras cosas ###########################################

// ==============================================================================

select2('#regimen_fiscal-factura', 'modalFacturaPaciente', 'Espere un momento')
select2('#uso-factura', 'modalFacturaPaciente', 'Espere un momento')