$.post("modals/modals.php", function (html) {
   $("#modals-js").html(html);
}).done(function () {
   $.getScript("modals/js/cap_microscopio.js");
   $.getScript("modals/js/estudios_pendientes.js");
});