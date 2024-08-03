// ==============================================================================

// ###################### TABLA HISTORIAL DE CORTES DE CAJA #####################

// ==============================================================================

// Tabla historial de cortes de caja
TablaListaCajasChicas = $('#ListaCajasChicas').DataTable({
    language: {
        url: "https://cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json",
    },
    lengthChange: false,
    info: true,
    paging: false,
    sorting: false,
    scrollY: '68vh',
    scrollCollapse: true,
    ajax: {
        dataType: 'json',
        data: function (d) {
            return $.extend(d, dataTablaHistorialCortes);
        },
        // data: { api: 2, equipo: id_equipos },
        method: 'POST',
        url: '../../../api/caja_chica_api.php',
        beforeSend: function () {
            // loader("In")
            // fadeTable('Out')
            // fadeDetalleTable("Out")
        },
        complete: function () {
            //Para ocultar segunda columna
            // loader("Out", 'bottom')
            // fadeTable("In")

            $.fn.dataTable
                .tables({
                    visible: true,
                    api: true
                })
                .columns.adjust();


            // Hacer clic en la primera fila
            if (!isMovil()) {
                var firstRow = TablaListaCajasChicas.row(0).node(); // La fila 0 es la primera fila
                $(firstRow).click(); // Simula un clic en la fila
            }
        },
        error: function (jqXHR, textStatus, errorThrown) {
            alertErrorAJAX(jqXHR, textStatus, errorThrown);
        },
        dataSrc: 'response.data'
    },
    createdRow: function (row, data, dataIndex) {
        if (data.FINALIZADO == 0) {
            $(row).addClass('bg-warning text-black');
        } else if (data.FINALIZADO == 1) {
        }
    },
    columns: [
        { data: 'DESCRIPCION' },
        { data: 'MONTO_ACTUAL' },
        {
            data: 'FECHA_CREACION', render: function (data) {
                return formatoFecha2(data, [0, 1, 3, 1]);
            }
        },
        {
            data: 'RESPONSABLE_NOMBRE'
        }
       
    ],
    columnDefs: [
        { target: 0, title: 'CAJA', className: 'all' },
        { target: 1, title: 'MONTO ACTUAL', className: 'all' },
        { target: 2, title: 'CREACIÓN', className: 'none' },
        { target: 3, title: 'RESPONSABLE', className: 'none' },


    ],

})

setTimeout(() => {
    inputBusquedaTable("ListaCajasChicas", ListaCajasChicas, [{
        msj: 'Lista de cajas chicas',
        place: 'top'
    }], {
        msj: "Filtre los resultados",
        place: 'top'
    }, "col-12")
}, 100);

// rellenar select de responsables
rellenarSelect('#responsableCaja', 'usuarios_api', 2, 'ID_USUARIO', 'nombrecompleto')
select2("#responsableCaja", 'ModalAdministrarCajas', 'Espere un momento...')

rellenarSelect("#autoriza", 'caja_chica_api', 8, 'ID_USUARIO', 'NOMBRE')
rellenarSelect("#quienAutoriza", 'caja_chica_api', 8, "ID_USUARIO", "NOMBRE")

//Funcion para cambiar el estatus (funcion global)
selectTable('#ListaCajasChicas', TablaListaCajasChicas, {
    unSelect: true, ClickClass: [
        {
            callback: async function (data) {

                console.log(data)


            }, selected: true
        },

    ], dblClick: true, reload: ['col-xl-9'],
    movil: true, divPadre: '#vistaGruposFactura', "tab-default": 'Detalle',
    tabs: [
        {
            title: 'Cajas',
            element: '#tab-caja_cortes',
            class: 'active',
        },
        {
            title: 'Detalle',
            element: '#tab-datos_corte',
            class: 'disabled tab-select'
        },
    ],
}, async function (select, data, callback) {
    SelectedHistorialCaja = data
    dataTablePacientesCaja['id_caja'] = SelectedHistorialCaja.ID_CAJA
    
    TablaPacientesCaja.ajax.reload()

    if (select) {
        DestruirDesglosePrecios(); // <-- No quitar
        fadeDetalleTable("In")
        $("#fecha_corte_selected").html(`(${data['FOLIO']})`)

        BuildHeaderCorte(data)
        // ConstruirDesglosePrecios(SelectedHistorialCaja['ID_CORTE'])

        // id_corte = SelectedHistorialCaja['ID_CORTE']

        // dataTablePacientesCaja.id_corte = SelectedHistorialCaja['ID_CORTE']
        // dataTablePacientesCajaDetalle.id_corte = SelectedHistorialCaja['ID_CORTE']

        // TablaPacientesCaja.ajax.reload()
        // TablaPacientesCajaDetalle.ajax.reload()
        callback('In')
    } else {
        callback('Out')
        DestruirDesglosePrecios()
        fadeDetalleTable("Out")
    }
})

// ==============================================================================

// ###################### TABLA DETALLES PACIENTES ##############################

// ==============================================================================
dataTablePacientesCaja = {
    api: 6,
    id_caja: 0
}

// Tabla de las transacciones de la caja seleccionada
TablaPacientesCaja = $('#TablaPacientesCaja').DataTable({
    language: {
        url: "https://cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json",
    },
    lengthChange: false,
    info: true,
    paging: false,
    sorting: false,
    scrollY: '50vh',
    scrollCollapse: true,
    ajax: {
        dataType: 'json',
        data: function (d) {
            return $.extend(d, dataTablePacientesCaja);
        },
        method: 'POST',
        url: `../../../api/caja_chica_api.php`,
        beforeSend: function () { 
       
        },
        complete: function () {
            // getResumen(TablaPacientesCaja);
        },
        dataSrc: 'response.data'
    },
    // 
    createdRow: function (row, data, dataIndex) {
        if (data.TIPO_TRANSACCION == "SALIDA") {
            $(row).addClass('bg-danger text-white');
        }
    },
    columns: [
        { data: 'FECHA_TRANSACCION' },
        { data: 'TIPO_TRANSACCION' },
        { data: 'NUM_CHEQUE' },
        { data: 'CONCEPTO' },
        {
            data: 'MONTO_TRANSACCION', render: function (data) {
                return `$${parseFloat(ifnull(data, 0)).toFixed(2)}`
            }
        },
        { data: 'OBSERVACIONES' },
        { data: 'AUTORIZA' },
        { data: 'REGISTRA' },
        // { data: 'FORMA_PAGO' }
    ],
    columnDefs: [
        { target: 0, className: 'all', title: 'Fecha Mov.' },
        { target: 1, className: 'all', title: 'Tipo' },
        { target: 2, className: 'all', title: 'Núm. Cheque/Factura' }, //Numero de estado de cuenta
        { target: 3, className: 'all', title: 'Concepto'},
        { target: 4, className: 'all', title: 'Monto' },
        { target: 5, className: 'all', title: 'Observaciones' },
        { target: 6, className: 'none', title: 'Autorizado Por' },
        { target: 7, className: 'none', title: 'Registrado Por' },

    ],
})


inputBusquedaTable("TablaPacientesCaja", TablaPacientesCaja, [
    {
        msj: 'Tabla de los pacientes que estan en la caja',
        place: 'top'
    },
    {
        msj: "¡Los pacientes por pagar, se mostrarán en amarillo!",
        place: 'top'
    }
], {
    msj: "Filtre los resultados",
    place: 'top'
}, "col-12")

selectTable('#TablaPacientesCaja', TablaPacientesCaja, {
    OnlyData: true, divPadre: '#false',
    ClickClass: [
        {
            class: 'PacienteInfoCargo',
            callback: function (data) {

            }
        }
    ]
})

// ==============================================================================

// ###################### FUNCIONES #############################################

// ==============================================================================

// Funcion para crear la cabecera con la informacion del corte de caja
function BuildHeaderCorte(data) {

    $('#detalle_fecha_corte').html(formatoFecha2(data['FECHA_INICIO'], [0, 0, 0, 0, 1, 1,]))
    $('#detalle_caja_id').html(data['DESCRIPCION'])
    $('#detalle_total').html(` $${ifnull(data['TOTAL'], "00.00")}`)

    // Desglose de todo el monto por tipo de pagos
    // Se desglosa todo el monto recaudado por el tipo de pago
    // $('Efectivo').html(ifnull('Data', '$00.00'))
    // $('Transferencia').html(ifnull('Data', '$00.00'))
    // $('TarjetaCredito').html(ifnull('Data', '$00.00'))
    // $('TarjetaDebito').html(ifnull('Data', '$00.00'))
    // $('Cheques').html(ifnull('Data', '$00.00'))
    // $('Credito').html(ifnull('Data', '$00.00'))

    // Se evalua si el corte ya esta finalizado o apenas se inicio
    if (data['FINALIZADO'] === "0") {
        // Como no han cerrado la caja aparecera el usuario en sesion para cerrar la caja *if tiene permiso
        $('#detalle_usuario').html(session['nombre'] + ' ' + session['apellidos'])

        // No ha finalizado aparecera el boton para poder cerrar la caja
        fadeDetalleHeader("Out")
    } else if (data['FINALIZADO'] === "1") {
        // Si la caja ya esta finalizada no se mostrara el boton para cerrar por que por logica ya esta cerrada xd y se mostrara el boton para visualizar el reporte generado al cerrar la caja
        $('#detalle_usuario').html(data['px'])
        $('#detalle_fecha_termino').html(formatoFecha2(data['FECHA_FINAL'], [0, 0, 0, 0, 1, 1,]))

        fadeDetalleHeader("In")
    }
}

function getResumen(tableDetalle) {
    if (!forma_pago.length) {
        alertMensaje('warning', 'No hay tipo de pagos definidos', 'Si ves este error, algo ha pasado.', 'Si');
    }

    let object = tableDetalle.rows().data();
    $('#formas-pago').html('');

    for (const key in object) {

    }
    let datos = tableDetalle.rows().data().toArray();
    console.log(datos)
    // calculo = calculoDef;
    for (const key in calculo) {
        if (Object.hasOwnProperty.call(calculo, key)) {
            const element = calculo[key];
            calculo[key] = 0;
        }
    }
    calculo['otros'] = 0;
    for (const key in datos) {
        if (Object.hasOwnProperty.call(datos, key)) {
            const element = datos[key];
            calculo[ifnull(element, 'otros', ['ID_PAGO'])] += parseFloat(ifnull(element, 0, ['TOTAL']))
        }
    }

    console.log(calculo)

    for (const key in calculo) {
        if (Object.hasOwnProperty.call(calculo, key)) {
            const element = calculo[key];
            let tipo_pago = forma_pago.filter((pago) => pago.ID_PAGO == key);
            $('#formas-pago').append(`
                <div class="col-12 col-md-4">
                    <p class="fw-bold">
                        ${ifnull(tipo_pago, 'Sin pagar', { 0: 'DESCRIPCION' })}:  
                        <span class='fw-bold text-dark'>$${element.toFixed(2)}</span>
                    </p>
                </div>
            `)

        }
    }

}

// Function fadeTabla para ocultar o aparecer la primera tabla del menu es decir la de historial de cajas
function fadeTable(type) {
    if (type === "Out") {
        $('#table_historial_corte_caja').fadeOut()
    } else if (type === "In") {
        $('#table_historial_corte_caja').fadeIn()
    }
}

// Function para la columna de detalle donde estan los datos del corte y el detalle del paciente
function fadeDetalleTable(type) {
    if (type === "Out") {
        $('#corte_caja_detalle').fadeOut(0)
    } else if (type === "In") {
        $('#corte_caja_detalle').fadeIn(0)
    }
}

// Function para el encabezado donde esta el detalle del corte de caja
function fadeDetalleHeader(type) {
    if (type === "Out") {
        $('#btnCerrarCaja').fadeIn(0)
        $('#fecha_termino').fadeOut(0)
        // $('#btnVisualizarReporte').fadeOut(0)
    } else if (type === "In") {
        $('#btnCerrarCaja').fadeOut(0)
        $('#fecha_termino').fadeIn(0)
        // $('#btnVisualizarReporte').fadeIn(0)
    }
}

// // Function para mostrar los desglose de los precios por corte de caja
// function ConstruirDesglosePrecios(corte_id) {
//     // Se hace la peticion a la api
//     ajaxAwait({
//         api: 9,
//         id_corte: corte_id
//     }, "corte_caja_api", { callbackAfter: true }, false, function (data) {
//         let row = data.response.data[1];

//         for (const key in row) {
//             if (Object.hasOwnProperty.call(row, key)) {
//                 const element = row[key];
//                 var DESCRIPCION = element['TIPO_PAGO'];
//                 var TOTAL = (parseFloat(element['TOTAL'])).toFixed(2);


//                 let html = ` 
//                 <div class="col-12 col-md-4">
//                     <p class="fw-bold">
//                         ${ifnull(DESCRIPCION, 'N/A')}:  
//                         <span class='fw-bold text-dark'>$${ifnull(TOTAL, '0.00')}</span>
//                     </p>
//                 </div>`;


//                 $('#formas-pago').append(html);
//             }
//         }
//     })
// }


function DestruirDesglosePrecios() {
    $('#formas-pago').html("");
}
// ==============================================================================   


// abril modal para registrar una entrada de dinero a la caja chica
$("#registrarEntradaBtn").click(function(){
    $('#registrarEntradaModal').modal('show')
})


// enviar formulario con los datos de la entrada.
$('#registrarEntradaForm').submit(function(event){
    event.preventDefault();
    var datos = {
        api: 5,
        tipo: 1,
        monto: $("#cantidadEntrada").val(),
        observaciones: $('#observacionesEntrada').val(),
        num_cheque: $('#numeroCheque').val(),
        id_caja: SelectedHistorialCaja['ID_CAJA']
    }
    alertMensajeConfirm({
        title: "¿Está a punto de registrar una entrada?",
        text: "Aumentará el monto del caja chica seleccionada.",
        icon: "question"
    },
    function(){
        ajaxAwait(
            datos,
            'caja_chica_api',
            { callbackAfter: true },
            false,
            function(data){
                alertToast("Entrada registrada!", "success", 4000)
                $('#registrarEntradaForm')[0].reset()
                $('#registrarEntradaModal').modal('hide')

                TablaListaCajasChicas.ajax.reload()
                // Falta actualizar la tabla historial de transacciones
                TablaPacientesCaja.ajax.reload()
            }
        )
    },1)
})


// abrir el modal para registrar salida de cajas chicas
$("#registrarSalidaBtn").click(function(){
    $('#registrarSalidaModal').modal('show')
})

// enviar formulario para registrar salida
$('#registrarSalidaForm').submit(function(event){
    event.preventDefault();

    var datos ={
        api: 5,
        tipo: 2,
        monto: $("#cantidadSalida").val(),
        observaciones: $('#observacionesSalida').val(),
        concepto: $('#concepto').val(),
        id_caja: SelectedHistorialCaja['ID_CAJA'],
        num_cheque: $('#numFactura').val()

    }

    alertMensajeConfirm({
        title: "¿Está a punto de registrar una SALIDA?",
        text: "Disminuirá el monto del caja chica seleccionada.",
        icon: "question"
    },
    function(){
        ajaxAwait(
            datos,
            'caja_chica_api',
            { callbackAfter: true },
            false,
            function(data){
                alertToast("Salida registrada!", "success", 4000)
                $('#registrarSalidaForm')[0].reset()
                $('#registrarSalidaModal').modal('hide')

                TablaListaCajasChicas.ajax.reload()
                // Falta actualizar la tabla historial de transacciones
                TablaPacientesCaja.ajax.reload()
            }
        )
    },1)
})

$("#filtroBtn").click(function(){
    $('#filtrarTransaccionesForm')[0].reset()
    $('#filtrarTransaccionesModal').modal('show')
})

$('#filtrarTransaccionesForm').submit(function(event){
    event.preventDefault();

    var datos = {
        api: 6,
        id_caja: SelectedHistorialCaja['ID_CAJA'],
    }
    
    dataTablePacientesCaja['id_caja'] = SelectedHistorialCaja['ID_CAJA']

    if($('#ignorarFechaMovimiento').prop('checked')){
        delete dataTablePacientesCaja.fecha_registro
    } else {
        dataTablePacientesCaja['fecha_registro'] = $("#fechaMovimiento").val()
    }

    if($('#ignorarQuienAutoriza').prop('checked')){
        delete dataTablePacientesCaja.quien_autoriza
    } else {
        dataTablePacientesCaja['quien_autoriza'] = $('#quienAutoriza').val()
    }

    if($("#ignorarTipoMov").prop('checked')){
        delete dataTablePacientesCaja.tipo
    } else {
        dataTablePacientesCaja['tipo'] = $('#tipoMov').val()
    }

    TablaPacientesCaja.ajax.reload()

    $('#filtrarTransaccionesModal').modal('hide')
    
})