$.post("modals/modals.php", function (html) {
    $("#modals-js").html(html);
}).done(function () {
    $.getScript('modals/js/fecha_tabla.js');
});
