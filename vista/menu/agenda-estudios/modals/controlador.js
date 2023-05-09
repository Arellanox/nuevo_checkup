$.post("modals/modals.php", function (html) {
    $("#modals-js").html(html);
}).done(function () {
    //Modal agendar
    $.getScript('modals/js/nueva-agenda.js');
});