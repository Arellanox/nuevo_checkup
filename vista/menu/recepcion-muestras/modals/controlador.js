$.post("modals/rm-modals.php", function (html) {
    $("#modals-js").html(html);
}).done(function () {
    // Modal para capturar muestras
    $.getScript("modals/js/rp-muestras_estudios.js");
});
