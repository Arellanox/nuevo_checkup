$.post("modals/c_modal.php", function (html) {
    $("#modals-js").html(html);
    //$.getScript('modals/js/p_rechazar.js');
    // Modal para rechazar
    // $.getScript('modals/js/subir-perfil.js');
}).done(function () {
    // Modal para aceptar
    $.getScript('modals/js/corte_caja1.js');

});
