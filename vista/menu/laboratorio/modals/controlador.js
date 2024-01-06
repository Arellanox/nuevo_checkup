$.post("modals/m_laboratorio.php", function (html) {
   $("#modals-js").html(html);
}).done(function () {
   $.getScript("modals/js/cap_microscopio.js");
});
