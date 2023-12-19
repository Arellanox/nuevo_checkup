$.post("modals/c_modal.php", function (html) {
    $("#modals-js").html(html);
    //$.getScript('modals/js/p_rechazar.js');
    // Modal para rechazar
    // $.getScript('modals/js/subir-perfil.js');
}).done(function () {

    $.getScript('modals/js/admin_cajas.js');

    $.getScript('modals/js/caja_detalle_paciente.js');

    $.getScript(`${http}${servidor}/${appname}/vista/menu/facturacion/modals/js/c_detalle_cuenta.js`);
});
