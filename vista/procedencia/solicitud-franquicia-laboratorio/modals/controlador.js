$.post("modals/modals.php", function (html) {
    $("#modals-js").html(html);
}).done(function () {
    $.getScript("modals/js/enviar_muestras.js");
    $.getScript("modals/js/tomar_muestras.js");
});
