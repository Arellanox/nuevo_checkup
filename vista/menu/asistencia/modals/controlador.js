$.post("modals/a_modal.php", function (html) {
    $("#modals-js").html(html);
    //$.getScript('modals/js/p_rechazar.js');
    // Modal para rechazar
    // $.getScript('modals/js/subir-perfil.js');
}).done(function () {
    $.getScript('modals/js/ver_rostros.js');
    $.getScript('modals/js/reporte_personal.js');
});
