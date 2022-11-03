//Menu predeterminado
hasLocation();
$(window).on("hashchange", function (e) {
  hasLocation();
});

var id, idturno, idconsulta, dataConsulta = new Array;

// Obtener el turno e informacion del paciente a tratar
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
function obtenerContenidoConsulta(id = 1, idturno  = 1, idconsulta = 1, dataConsulta = 1) {
  loader("In")
  $("#titulo-js").html(''); //Vaciar la cabeza de titulo
  $.post("contenido/consultorio_consulta.php", function (html) {
    var idrow;
    $("#body-js").html(html);
    // Datatable
    // $.getScript("contenido/js/estudio-tabla.js");
    // select2('#citas-subsecuente', 'collapseAgendarConsultaTarget');
  }).done(function(){
    // Botones
    $.getScript("contenido/js/consulta-paciente-botones.js");
    // Obtener metodos para el dom
    $.getScript("contenido/js/consulta-paciente.js").done(function(){
      obtenerConsulta(id, idturno, idconsulta);
    });
    loader("Out")
    // select2('#registrar-metodos-estudio', 'card-exploracion-clinica');
  })
}

function obtenerContenidoAntecedentes(id, idTurno) {
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
      // alert("Anter de antecedentes")
      obtenerConsultorio(id, idTurno) //Llama todo el dom
    });
    select2('#citas-subsecuente', 'collapseAgendarConsultaTarget', 'No tiene consultas anteriores');
  });
}

// Rellena la plantilla con metodos de espera Async Await
async function obtenerConsultorio(id, idTurno){
  await obtenerPanelInformacion(id, "pacientes_api", 'paciente')
  await obtenerPanelInformacion(idTurno, "signos-vitales_api", 'signos-vitales', '#signos-vitales');
  // alert("Antes de antecedentes")
  await obtenerAntecedentes('#antecedentes-paciente', idTurno);
  // setValues(idTurno) //llamar los valores para los antecedentes

  // alert("Antes de notas historial")
  await obtenerNotasHistorial(id);
  // alert("Antes de obtenerHistorialConsultas")
  await obtenerHistorialConsultas(id);
  // alert("Funcion terminada")
  loader("Out")
}

async function obtenerConsulta(id, idTurno){
  loader("Out")
}


function agregarNotaConsulta(tittle, date = null, text, appendDiv, classTittle = 'card mt-3', style = 'margin: -1px 30px 20px 30px;'){
  if (date != null) {
    date = '<p style="font-size: 14px;margin-left: 5px;">'+date+'</p>';
  }else{
    date = ''
  }

  let html = '<div class="'+classTittle+'">'+
                '<h4 class="m-3">'+tittle+' <button type="button" class="btn btn-hover me-2" data-bs-id="id"> <i class="bi bi-trash"></i> </button> '+date+'</h4> '+
                '<div style="'+style+'">'+
                  '<p class="none-p">'+text+'<p> </div> </div>';

  $(appendDiv).append(html);
}


function obtenerConsultorioMain(){
  // loader("In")
  obtenerTitulo('Consultorio');
  $.post("contenido/consultorio_main.php", function (html) {
    var idrow;
    $("#body-js").html(html) // Rellenar la plantilla de consulta
  }).done(function() {
    loader("Out")
    // Datatable
    $.getScript("contenido/js/main-tabla.js");
    // // Botones
    // $.getScript("contenido/js/consultorio-paciente-botones.js");
    // // Funciones
    // $.getScript('contenido/js/consultorio-paciente.js')
  });
}

function hasLocation() {
  var hash = window.location.hash.substring(1);
  $("a").removeClass("navlinkactive");
  $("nav li a[href='#" + hash + "']").addClass("navlinkactive");
  switch (hash) {
    case "Perfil":
      obtenerContenidoAntecedentes(18, 18);
      break;
    case "Consultorio":
      obtenerContenidoConsulta();
      break;
    case "Main":
      obtenerConsultorioMain();
      break;
    default:
      // window.location.hash = 'Main';
      // obtenerContenidoEstudios("Estudios");
      break;
  }
}
