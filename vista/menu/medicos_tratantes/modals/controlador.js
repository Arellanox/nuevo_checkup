$.post("modals/m_medicos.php", function (html) {
    $("#modals-js").html(html);
}).done(function () {
    // Modal para agregar o actualizar el usuario de un medico
    $.getScript('modals/js/m_medicos.js');

    //Modal para filtrar pacientes
    $.getScript('modals/js/m_btn_filtrar.js');


    // Modal para visualizar los estudios cargados del paciente
    $.getScript('modals/js/m_estudios_paciente.js');

})