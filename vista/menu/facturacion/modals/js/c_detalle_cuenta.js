// Rellena todos los campos con los datos seleccionado
function getInfoEstadoCuenta(px, turno) {

    alertToast('Cargando, espere un momento', 'info', 3000)
    // $('#PacienteCreditoColumn').html("");
    tablaTicketCredito.clear().draw();

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

                // let html = `
                //                     <tr>
                //                         <td>${element['SERVICIOS']}</td>
                //                         <td>E48 -Unidad de
                //                             servicio
                //                         </td>
                //                         <td>${ifnull(element, 0, ['PRECIO_VENTA'])}</td>
                //                         <td>${ifnull(element, 1, ['CANTIDAD'])}</td>
                //                         <td>$${ifnull(element, 0, ['TOTAL'])}</td>
                //                     </tr>
                //                     `;

                tablaTicketCredito.row.add([
                    ifnull(element, 'Servicio Desconocido', ['SERVICIOS']),
                    'E48 -Unidad de servicio',
                    `$${ifnull(element, 0.00, ['PRECIO_VENTA'])}`,
                    ifnull(element, 1, ['CANTIDAD']),
                    `$${ifnull(element, 0.00, ['TOTAL'])}`
                ]).draw();

                // $('#PacienteCreditoColumn').append(html);

            }
        }

        // let subtotalconiva = parseFloat(subtotal * 0.16).toFixed(2);
        // console.log(subtotal)
        // total = parseFloat(subtotal) + parseFloat(subtotalconiva)

        // $("#subtotal").html(`$${ifnull(subtotal.toFixed(2), 0)}`)
        // $("#Iva").html(`$${ifnull(subtotalconiva, 0)}`)
        $("#total").html(`$${ifnull(subtotal.toFixed(2), 0)}`)

        $("#ModalTicketCredito").modal('show');

        setTimeout(() => {
            $.fn.dataTable
                .tables({
                    visible: true,
                    api: true
                })
                .columns.adjust();
        }, 250);
    })
}

// Dibuja los diferentes tipos de pago con los que el cliente pago 
var array_pagos; // <-- Variable donde se guardan el o los pagos que el paciente hizo
function BuildFormasPago(turno, corte_id = null) {
    // Se limpiar el contenedor de los diferentes tipos de pagos
    DelayFormasPagos('Out')
    // Se hace la peticion a la api
    ajaxAwait({
        api: 11,
        turno_id: turno,
        id_corte: corte_id
    }, "corte_caja_api", { callbackAfter: true }, false, function (data) {
        let row = data.response.data;
        // Recorremos todo la data y buscamos la key FORMA_PAGO_MONTO
        for (const key in row) {
            if (Object.hasOwnProperty.call(row, key)) {
                const element = row[key];
                array_pagos = JSON.parse(element['FORMA_PAGO_MONTO']); // <-- Se parsea a JSON para poderlo recorrer
            }
        }

        // Se recorre el array_pagos para acceder a sus elementos y dibujarlos
        for (const key in array_pagos) {
            if (Object.hasOwnProperty.call(array_pagos, key)) {
                const element = array_pagos[key];
                var DESCRIPCION = ifnull(element, "PAGADO", ['FORMA_PAGO']);
                var MONTO = (parseFloat(ifnull(element, "0", ['MONTO']))).toFixed(2)

                let html;
                html = `
                 <div class="col-12 col-xl col-xxl d-flex">
                    <p class="fw-bold">}
                        ${PrimeraLetraMayuscula(DESCRIPCION)}:  
                        <span class='fw-bold text-dark'>$${MONTO}</span>
                    </p>
                 </div>
                `;

                $('#formas_pago').append(html);
            }
        }

        // Se llama a la funcion para que aparezca el contendor despues de que se rellena
        DelayFormasPagos('In')

    })

}

// Aparece y desaparece el contenedor de los tipos de pagos
function DelayFormasPagos(type) {
    if (type === 'In') {
        $('#formas_pago').fadeIn()
    } else if (type === 'Out') {
        $('#formas_pago').html('')
        array_pagos = []
    }
}

// Esta funcion la hizo chat, la primera letra la pone en mayuscula y las demas en minuscula esta mamila
function PrimeraLetraMayuscula(texto) {
    return texto.charAt(0).toUpperCase() + texto.slice(1).toLowerCase();
}

let tablaTicketCredito = $('#TablaTicketCredito').DataTable({
    language: { url: "https://cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json", },
    searching: false,
    lengthChange: false,
    info: false,
    paging: false,
    ordering: false,
    // scrollY: autoHeightDiv(0, 374),
    // scrollCollapse: true,
    // deferRender: true,
    // lengthMenu: [
    //     [20, 25, 30, 35, 40, 45, 50, -1],
    //     [20, 25, 30, 35, 40, 45, 50, "All"]
    // ],
})