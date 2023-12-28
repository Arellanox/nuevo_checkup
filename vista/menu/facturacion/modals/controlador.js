//Menu predeterminado
$.post("modals/a_modals.php", function (html) {
    $("#modals-js").html(html);
    //$.getScript('modals/js/p_rechazar.js');
    // Modal para rechazar
    // $.getScript('modals/js/subir-perfil.js');
}).done(function () {

    $.getScript('modals/js/c_facturado.js');
    $.getScript('modals/js/c_lista_credito.js');
    $.getScript('modals/js/facturar-contado.js');


    $.getScript('modals/js/c_detalle_cuenta.js');


    // $.getScript('modals/js/c_grupo_info.js');
    // $.getScript('modals/js/c_credito_ticket.js');
});
