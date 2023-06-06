//Menu predeterminado
$.post("modals/a_modals.php", function (html) {
    $("#modals-js").html(html);
}).done(function () {

    // Modal para Actualizar Cliente
    $.getScript('modals/js/fecha_tabla.js');

});
