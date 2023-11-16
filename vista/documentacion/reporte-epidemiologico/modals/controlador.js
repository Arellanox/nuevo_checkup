$.post("modals/a_modals.php", function (html) {
    $("#modals-js").html(html);
}).done(function () {
    // Modal para filtrar el reporte de epidemioligco
    $.getScript('modals/js/filtrar-reporte.js');

})