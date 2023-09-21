


if (validarVista('FACTURACIÓN')) {
    hasLocation();
    $(window).on("hashchange", function (e) {
        hasLocation();
    });
}


var selectCuenta = false;
function obtenerPacientesContado() {
    obtenerTitulo('Pacientes particulares (Contado)'); //Aqui mandar el nombre de la area
    $.post("contenido/contado.html", function (html) {
        $("#body-js").html(html);
    }).done(function () {
        // Datatable
        $.getScript("contenido/js/contados-tablas.js");
    });
}

//Globales
SelectedPacienteCredito = {}, SelectedGruposCredito = {}, factura = null, grupoPacientesModificar = false;
var TablaGrupos = false, tablaDetallePrecio = false, dataDetallePrecio = { api: 0 };
const detalles_grupo = {
    "subtotal": {
        id: 'info-subtotal',
        target: 'SUBTOTAL',
    },
    "descuento": {
        id: 'info-descuento',
        target: 'DESCUENTO',
    },
    "iva": {
        id: 'info-iva',
        target: 'MONTO_IVA',
    },
    "total": {
        id: 'info-total',
        target: 'TOTAL',
    }
};
function obtenerPacientesCredito() {
    obtenerTitulo('Pacientes (Crédito)'); //Aqui mandar el nombre de la area
    $.post("contenido/credito.html", function (html) {
        $("#body-js").html(html);
    }).done(function () {
        TablaGrupos = false
        // Datatable
        $.getScript("contenido/js/credito-tablas.js");


    });
}


// Botones
$.getScript("contenido/js/contados-botones.js");

//Botones
$.getScript("contenido/js/credito-botones.js");

function hasLocation() {
    var hash = window.location.hash.substring(1);
    $("a").removeClass("navlinkactive");
    $("nav li a[href='#" + hash + "']").addClass("navlinkactive");
    switch (hash) {
        case "CONTADO":
            obtenerPacientesContado();
            break;
        case "CREDITO":
            obtenerPacientesCredito();
            break;
        default:
            window.location.hash = '#';
            break;
    }
}



// function FacturarGruposCredito(facturado = null, id_grupo = null) {

//     let config = {
//         api: 1,
//         num_factura: "",
//         id_grupo: id_grupo,
//         facturado: 1
//     }

//     if (facturado) {
//         config.num_factura = facturado;
//     }

//     ajaxAwait(config, 'admon_grupos_api', { callbackAfter: true }, false, function (response) {
//         let modal = "#ModalTicketCreditoFacturado";
//         $(modal).modal('hide');

//         console.log(response)

//         alertToast("Factura guardada con exito", "success", 3000)

//         TablaGrupos.ajax.reload();

//     })

// }