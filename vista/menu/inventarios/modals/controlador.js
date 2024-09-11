$.post("modals/c_modal.php", function (html) {
    $("#modals-js").html(html);
}).done(function () {

    $.getScript('modals/js/modal_inventarios.js');
    $.getScript(`${http}${servidor}/${appname}/vista/menu/facturacion/modals/js/c_detalle_cuenta.js`);
});
