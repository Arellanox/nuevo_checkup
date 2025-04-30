$.post("modals/modals.php", function(html){
    $("#modals-js").html(html);
}).done(function () {
    $.getScript("modals/js/generar_pdf.js");
});
