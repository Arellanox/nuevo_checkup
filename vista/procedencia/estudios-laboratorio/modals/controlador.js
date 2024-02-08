$.post("modals/m_franquicias.php", function (html) {
    $("#modals-js").html(html);
}).done(function () {
    // Modal para aceptar
    $.getScript('modals/js/franq_agregar_paciente.js');
    $.getScript('modals/js/franq_enviar_lotes.js')
});