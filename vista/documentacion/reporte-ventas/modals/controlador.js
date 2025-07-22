//Menu predeterminado
$.post("modals/modal.php", function (html) {
    $("#modals-js").html(html);
}).done(function () {
    $.getScript('modals/js/modal.js')
});
