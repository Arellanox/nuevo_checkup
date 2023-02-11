//Menú principal para consultorio
var id, idturno, idconsulta, dataConsulta = new Array,
  tablaMain;
obtenerConsultorioMain()

function obtenerConsultorioMain() {
  // loader("In")
  obtenerTitulo('Historia Clinica');
  $.post("contenido/consultorio_main.html", function (html) {
    var idrow;
    $("#body-js").html(html) // Rellenar la plantilla de consulta
  }).done(function () {
    // Datatable
    $.getScript("contenido/js/main-tabla.js");
    // // Botones
    // $.getScript("contenido/js/consultorio-paciente-botones.js");
    // // Funciones
    // $.getScript('contenido/js/consultorio-paciente.js')
  });
}
//



// Obtener el perfil del paciente (antecedentes);
var pacienteActivo = new GuardarArreglo()
var infoConsultaActivo = new GuardarArreglo();

function obtenerContenidoAntecedentes(data) {
  loader("In")
  obtenerTitulo('Perfil del paciente', 'btn-regresar-vista'); //Aqui mandar el nombre de la area
  $.post("contenido/consultorio_paciente.html", function (html) {
    var idrow;
    $("#body-js").html(html) // Rellenar la plantilla de consulta
  }).done(function () {
    pacienteActivo = new GuardarArreglo(data)
    // $.getScript("modals/controlador-perfilPaciente.js");
    // Funciones
    $.getScript('contenido/js/consultorio-paciente.js').done(function () {
      obtenerConsultorio(data['ID_PACIENTE'], data['ID_TURNO'], pacienteActivo.array['CLIENTE'], pacienteActivo.array['CURP'])
      // Botones
      $.getScript("contenido/js/consultorio-paciente-botones.js");
    });
    select2('#citas-subsecuente', 'collapseAgendarConsultaTarget', 'No tiene consultas anteriores');
  });
}
//


var tablaRecetas;
// obtenerContenidoConsulta()
function obtenerContenidoConsulta(data, idconsulta) {
  loader("In")
  console.log(data)
  // obtenerTitulo('Menú principal'); //Aqui mandar el nombre de la area
  $("#titulo-js").html(''); //Vaciar la cabeza de titulo
  $.post("contenido/consultorio_consulta.html", function (html) {
    var idrow;
    $("#body-js").html(html);
    pacienteActivo = new GuardarArreglo(data)
    pacienteActivo.selectID = idconsulta;
    // Datatable
    // $.getScript("contenido/js/estudio-tabla.js");
    // select2('#citas-subsecuente', 'collapseAgendarConsultaTarget');
  }).done(function () {
    // Obtener metodos para el dom
    $.getScript("contenido/js/consulta-paciente.js").done(function () {
      // Botones
      $.getScript("contenido/js/consulta-paciente-botones.js");
      obtenerConsulta(data, idconsulta);
    });
    // select2('#registrar-metodos-estudio', 'card-exploracion-clinica');
  })
}
//





// METODOS
// Rellena la plantilla con metodos de espera Async Await
async function obtenerConsultorio(id, idTurno, cliente, curp) {
  await obtenerPanelInformacion(id, "pacientes_api", 'paciente')
  await obtenerPanelInformacion(idTurno, "signos-vitales_api", 'signos-vitales', '#signos-vitales');
  // alert("Antes de antecedentes")
  // setValues(idTurno) //llamar los valores para los antecedentes

  // alert("Antes de notas historial")
  await obtenerNotasHistorial(id);

  //Verificar si hay consulta actual
  await consultarConsulta(idTurno);

  await obtenerHistorialConsultas(id);
  // alert("Funcion terminada")
  ontooltip();
  loader("Out")
}

async function obtenerConsulta(data, idconsulta) {
  console.log(data, idconsulta)
  await obtenerVistaAntecenetesPaciente('#antecedentes-paciente', data['CLIENTE'])
  $('#descripcion-antecedentes').html('Antecedentes del paciente actual')
  $('.div-btn-guardarAntPato').append('<button type="button" class="btn btn-confirmar m-1 guardarAnt"> <i class="bi bi-paperclip"></i> Guardar </button>')
  $('.div-btn-guardarAntNoPato').append('<button type="button" class="btn btn-confirmar m-1 guardarAnt"> <i class="bi bi-paperclip"></i> Guardar </button>')
  $('.div-btn-guardarHeredoFami').append('<button type="button" class="btn btn-confirmar m-1 guardarAnt"> <i class="bi bi-paperclip"></i> Guardar </button>')
  $('.div-btn-guardarPsico').append('<button type="button" class="btn btn-confirmar m-1 guardarAnt"> <i class="bi bi-paperclip"></i> Guardar </button>')
  $('.div-btn-guardarAntNutri').append('<button type="button" class="btn btn-confirmar m-1 guardarAnt"> <i class="bi bi-paperclip"></i> Guardar </button>')
  $('.div-btn-guardarAntLabo').append('<button type="button" class="btn btn-confirmar m-1 guardarAnt"> <i class="bi bi-paperclip"></i> Guardar </button>')
  await obtenerAntecedentesPaciente(data['ID_TURNO']);
  console.log("si");
  await obtenerInformacionPaciente(data)
  await obtenerNutricion(data['ID_TURNO'])
  await obtenerExploracion(data['ID_TURNO'])
  await obtenerAnamnesisApartados(data['ID_TURNO']);
  await obtenerInformacionConsulta(idconsulta)
  loader("Out")
  let altura = $(document).height();
  $("html, body").animate({ scrollTop: altura + "px" });
}

function agregarNotaConsulta(tittle, date = null, text, appendDiv, id, clase, classTittle = 'card mt-3', style = 'margin: -1px 30px 20px 30px;') {
  if (date != null) {
    date = '<p style="font-size: 14px;margin-left: 5px;">' + date + '</p>';
  } else {
    date = '';
  }
  let html = '<div class="' + classTittle + '" data-db="divDelete">' +
    '<h4 class="m-3">' + tittle + ' <button type="button" class="btn btn-hover ' + clase + '" data-bs-id="' + id + '"> <i class="bi bi-trash"></i> </button> ' + date + '</h4> ' +
    '<div style="' + style + '">' +
    '<p class="none-p">' + text + '<p> </div> </div>';
  $(appendDiv).append(html);
}