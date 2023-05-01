$.post("modals/a_modals.php", function (html) {
    $("#modals-js").html(html);
}).done(function () {
    // Modal para agregar estudio
    $.getScript("modals/js/estu_agregar_estudio.js");
    // Modal para editar estudio
    $.getScript("modals/js/estu_editar_estudio.js");
});
