$.post("modals/c_modal.php", function (html) {
    $("#modals-js").html(html);
    //$.getScript('modals/js/p_rechazar.js');
    // Modal para rechazar
    // $.getScript('modals/js/subir-perfil.js');
}).done(function () {

    $.getScript('modals/js/modals_recursos_humanos.js');

});
