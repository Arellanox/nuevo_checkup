//Menu predeterminado
hasLocation();
$(window).on("hashchange", function (e) {
  hasLocation();
});

// Obtener id del pacientes

function obtenerSiguientePaciente(){
  $.ajax({
    url: http + servidor + "/nuevo_checkup/api/turnos_api.php",
    type: "POST",
    datatype: "json",
    data: { id: id, api: 7 },
    success: function (data) {

    }
  });
}

// obtenerContenidoConsulta()
function obtenerContenidoConsulta(titulo) {
  loader("In")
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
    loader("Out")
    // select2('#registrar-metodos-estudio', 'card-exploracion-clinica');
  })
}

function obtenerContenidoAntecedentes() {
  loader("In")
  obtenerTitulo('Perfil del paciente'); //Aqui mandar el nombre de la area
  $.post("contenido/consultorio_paciente.php", function (html) {
    var idrow;
    $("#body-js").html(html) // Rellenar la plantilla de consulta
  }).done(function() {
    // Datatable
    // $.getScript("contenido/js/estudio-tabla.js");
    // Botones
    $.getScript("contenido/js/consultorio-paciente-botones.js");
    // Funciones
    $.getScript('contenido/js/consultorio-paciente.js').done(function(){
      obtenerConsultorio(2) //Llama todo el dom
    });
    select2('#citas-subsecuente', 'collapseAgendarConsultaTarget', 'No tiene consultas anteriores');
  });
}

// Rellena la plantilla con metodos de espera Async Await
async function obtenerConsultorio(id){
  await obtenerPanelInformacion(id, "pacientes_api", 'paciente')
  await obtenerPanelInformacion(id, "signos-vitales_api", 'signos-vitales', '#signos-vitales');
  await obtenerAntecedentes('#antecedentes-paciente');
  // setValues(id)
  await obtenerNotasHistorial(id);
  await obtenerHistorialConsultas(id);
  // alert("Funcion terminada")
  loader("Out")
  
}


function agregarNotaConsulta(tittle, date = null, text, appendDiv, classTittle = 'card mt-3', style = 'margin: -1px 30px 20px 30px;'){
  if (date != null) {
    date = '<p style="font-size: 14px;margin-left: 5px;">'+date+'</p>';
  }

  let html = '<div class="'+classTittle+'">'+
                '<h4 class="m-3">'+tittle+' '+date+'</h4>'+
                '<div style="'+style+'">'+
                  '<p class="none-p">'+text+'<p> </div> </div>';

  $(appendDiv).append(html);
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
