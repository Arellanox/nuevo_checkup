

async function obtenerVistaCajaChica() {
    await obtenerTitulo("Caja chica");
    $.post("contenido/caja_chica.html", function (html) {
        $("#body-js").html(html);
    }).done(async function () {



        // await ajaxAwait({ api: 2 }, 'formas_pago_api', { callbackAfter: true }, false, (data) => {
        //     forma_pago = data.response.data;
        //     for (const key in forma_pago) {
        //         if (Object.hasOwnProperty.call(forma_pago, key)) {
        //             const element = forma_pago[key];
        //             calculo[element.ID_PAGO] = 0;
        //             calculoDef[element.ID_PAGO] = 0;
        //         }
        //     }
        // })

        await switchCajasSelect(false, true);

        // DataTable
        $.getScript('contenido/js/historial-tabla-cortes.js')
    });
}

// Botones
$.getScript('contenido/js/corte_botones.js').done(function () {
    hasLocation()
});


// Variables globales locales
var forma_pago = [], calculo = [], calculoDef = [];
var index_caja_id;
var dataTablaHistorialCortes;
var SelectedHistorialCaja;
let dataTablePacientesCaja;
var id_corte;
var TablaHistorialCortes; //Tabla

var filename, title

$(window).on("hashchange", function (e) {
    hasLocation();
});

function hasLocation() {
    var hash = window.location.hash.substring(1);
    $("a").removeClass("navlinkactive");
    $("nav li a[href='#" + hash + "']").addClass("navlinkactive");

    switch (hash) {
        case "CAJACHICA":
            obtenerVistaCajaChica();
            break;
        default: avisoArea(); break;
    }

}
