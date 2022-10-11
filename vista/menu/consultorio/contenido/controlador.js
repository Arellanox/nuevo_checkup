//Menu predeterminado
hasLocation();
$(window).on("hashchange", function (e) {
  hasLocation();
});


obtenerContenidoConsulta()
function obtenerContenidoConsulta(titulo) {
  $("#titulo-js").html('');
  $.post("contenido/consultorio_consulta.php", function (html) {
    var idrow;
    $("#body-js").html(html);
    // Datatable
    // $.getScript("contenido/js/estudio-tabla.js");
    // Botones
    // $.getScript("contenido/js/estudio-botones.js");
    // select2('#citas-subsecuente', 'collapseAgendarConsultaTarget');
  }).done(function(){
    // select2('#registrar-metodos-estudio', 'card-exploracion-clinica');
  })
}

function obtenerContenidoAntecedentes() {
  obtenerTitulo('Perfil del paciente'); //Aqui mandar el nombre de la area
  $.post("contenido/consultorio_paciente.php", function (html) {
    var idrow;
    $("#body-js").html(html)
  }).done(function() {
    // Datatable
    // $.getScript("contenido/js/estudio-tabla.js");
    // Botones
    // $.getScript("contenido/js/estudio-botones.js");
    select2('#citas-subsecuente', 'collapseAgendarConsultaTarget');
    obtenerPanelInformacion(2, "pacientes_api", 'paciente')
    obtenerPanelInformacion(2, "signos-vitales_api", 'signos-vitales', '#signos-vitales');
    obtenerSignosVitales('#antecedentes-paciente')
  });
}




function obtenerSignosVitales(div){
  $.post(http + servidor + "/nuevo_checkup/vista/include/acordion/signos-vitales.php", function (html) {
    setTimeout(function () {
      $(div).html(html);
    }, 100);

  });
}

function hasLocation() {
  var hash = window.location.hash.substring(1);
  $("a").removeClass("navlinkactive");
  $("nav li a[href='#" + hash + "']").addClass("navlinkactive");
  switch (hash) {
    case "Perfil":
      obtenerContenidoAntecedentes();
      break;
    case "Consultorio":
      obtenerContenidoConsulta();
      break;
    case "Main":
      obtenerContenidoEquipos();
      break;
    default:
      // window.location.hash = 'Main';
      // obtenerContenidoEstudios("Estudios");
      break;
  }
}
