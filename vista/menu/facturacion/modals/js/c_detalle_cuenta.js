// Rellena todos los campos con los datos seleccionado

function getInfoEstadoCuenta(px, turno) {

    alertToast('Cargando, espere un momento', 'info', 3000)
    $('#PacienteCreditoColumn').html("");

    ajaxAwait({
        api: 1,
        turno_id: turno
    }, "cargos_turnos_api", { callbackAfter: true }, false, function (data) {
        $("#paciente").html(px)
        dataServicios = data.response.data.estudios

        let subtotal = 0;
        for (const data in dataServicios) {
            if (Object.hasOwnProperty.call(dataServicios, data)) {
                const element = dataServicios[data];

                // subtotal += ifnull(parseFloat(element['COSTO']), 0);


                // subtotal con descuento
                subtotal += parseFloat(ifnull(element, 0, ['TOTAL']))

                // totalServicio = ifnull((parseInt(element['CANTIDAD']) * parseFloat(element['PRECIO_VENTA'])).toFixed(2), 0)

                let html = `
                                    <tr>
                                        <td>${element['SERVICIOS']}</td>
                                        <td>E48 -Unidad de
                                            servicio
                                        </td>
                                        <td>${ifnull(element, 0, ['PRECIO_VENTA'])}</td>
                                        <td>${ifnull(element, 1, ['CANTIDAD'])}</td>
                                        <td>$${ifnull(element, 0, ['TOTAL'])}</td>
                                    </tr>
                                    `;

                $('#PacienteCreditoColumn').append(html);

            }
        }

        // let subtotalconiva = parseFloat(subtotal * 0.16).toFixed(2);
        // console.log(subtotal)
        // total = parseFloat(subtotal) + parseFloat(subtotalconiva)

        // $("#subtotal").html(`$${ifnull(subtotal.toFixed(2), 0)}`)
        // $("#Iva").html(`$${ifnull(subtotalconiva, 0)}`)
        $("#total").html(`$${ifnull(subtotal.toFixed(2), 0)}`)

        $("#ModalTicketCredito").modal('show');
    })
}