

obtenerContenidoConsulta()

function obtenerContenidoConsulta(titulo) {
  obtenerTitulo('Perfil del paciente'); //Aqui mandar el nombre de la area
  $.post("contenido/consultorio_consulta.php", function (html) {
    var idrow;
    $("#body-js").html(html);
    // Datatable
    // $.getScript("contenido/js/estudio-tabla.js");
    // Botones
    // $.getScript("contenido/js/estudio-botones.js");
    select2('#citas-subsecuente', 'collapseAgendarConsultaTarget');
  });
}

obtenerPanelInformacion(2, "pacientes_api", 'paciente')
obtenerPanelInformacion(2, "signos-vitales_api", 'signos-vitales', '#signos-vitales');

obtenerSignosVitales('#antecedentes-paciente')
function obtenerSignosVitales(div){
  $.post(http + servidor + "/nuevo_checkup/vista/include/acordion/signos-vitales.php", function (html) {
    setTimeout(function () {
      $(div).html(html);
    }, 100);

  });
}
