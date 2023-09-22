

async function obtenerVistaCorteCaja() {
    await obtenerTitulo("Corte de caja");
    $.post("contenido/corte_caja.html", function (html) {
        $("#body-js").html(html);
    }).done(async function () {

        // Rellenar Select
        await rellenarSelect("#cajas", "corte_caja_api", 2, "ID_CAJAS", "DESCRIPCION", {}, function () {
            switchCajasSelect(false)
        })

        await ajaxAwait({ api: 2 }, 'formas_pago_api', { callbackAfter: true }, false, (data) => {
            forma_pago = data.response.data;
            for (const key in forma_pago) {
                if (Object.hasOwnProperty.call(forma_pago, key)) {
                    const element = forma_pago[key];
                    calculo[element.ID_PAGO] = 0;
                }
            }

            calculoDef = calculo;
        })

        // DataTable
        $.getScript('contenido/js/historial-tabla-cortes.js').done(function () {
        })
    });
}

// Botones
$.getScript('contenido/js/corte_botones.js').done(function () {

})


// Variables globales locales
var forma_pago = [], calculo = [], calculoDef = [];
var index_caja_id;
var dataTablaHistorialCortes;
var SelectedHistorialCaja;
var dataTablePacientesCaja;
var id_corte;

hasLocation()
$(window).on("hashchange", function (e) {
    hasLocation();
});

function hasLocation() {
    var hash = window.location.hash.substring(1);
    $("a").removeClass("navlinkactive");
    $("nav li a[href='#" + hash + "']").addClass("navlinkactive");

    switch (hash) {
        case "CORTECAJA":
            obtenerVistaCorteCaja();
            break;
        default: avisoArea(); break;
    }

}
