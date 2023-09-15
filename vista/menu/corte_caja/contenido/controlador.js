
async function obtenerVistaCorteCaja() {
    await obtenerTitulo("Corte de caja");
    $.post("contenido/corte_caja.html", function (html) {
        $("#body-js").html(html);
    }).done(function () {
      
        // DataTable
        $.getScript('contenido/js/historial-tabla-cortes.js')
        // // Botones
        $.getScript('contenido/js/corte_botones.js')
    });
}

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
