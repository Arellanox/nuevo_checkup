$.post("modals/m_tracking.php ", function (html) {
    $("#modals-js").html(html);
}).done(function () {
    // Modal para agregar o actualizar el usuario de un medico
    $.getScript('modals/js/m_traking_detallePacientes.js');

})