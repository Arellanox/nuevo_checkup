$.post("modals/m_recepcion.php", function (html) {
  $("#modals-js").html(html);
}).done(function () {
  // Modal para aceptar
  $.getScript('modals/js/p_aceptar.js');
  // Modal para rechazar
  $.getScript('modals/js/p_rechazar.js');
  // Modal para reagendar
  $.getScript('modals/js/p_reagendar.js');
  // Modal para rechazar
  $.getScript('modals/js/subir-perfil.js');
  // Modal para solicitud
  $.getScript('modals/js/p_solicitud.js');
  // // Modal para registar una agenda
  $.getScript('modals/js/p_registro.js');
  $.getScript(http + servidor + "/nuevo_checkup/vista/include/modal/js/registrar-agenda.js");
  $.getScript(http + servidor + "/nuevo_checkup/vista/include/modal/js/registrar-paciente.js");
});