//Menu predeterminado
hasLocation();
$(window).on("hashchange", function (e) {
  hasLocation();
});
loader("In")



// obtenerContenidoConsulta()
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
    $.getScript("contenido/js/consultorio-paciente-botones.js");
    $.getScript('contenido/js/form-antecedentes.js').done(function(){
        obtenerAntecedentes('#antecedentes-paciente')
    })
    select2('#citas-subsecuente', 'collapseAgendarConsultaTarget');
    obtenerPanelInformacion(2, "pacientes_api", 'paciente')
    obtenerPanelInformacion(2, "signos-vitales_api", 'signos-vitales', '#signos-vitales');
    setTimeout(function () {
      loader("Out")
    }, 1000);
  });
}




function obtenerAntecedentes(div){
  $.post(http + servidor + "/nuevo_checkup/vista/include/acordion/antecedentes-paciente.php", function (html) {
    setTimeout(function () {
      $(div).html(html);
      setValues(1)
    }, 100);

  }).done(function(){
    loader("Out")
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
