//Menú principal para consultorio
var id, idturno, idconsulta, dataConsulta = [], tablaMain;
var selectPaciente, dataListaPaciente, activoConsultadorTurnero = true;

// Obtener el perfil del paciente (antecedentes);
var pacienteActivo = new GuardarArreglo()
var infoConsultaActivo = new GuardarArreglo();
var tablaRecetas;

obtenerConsultorioMain()

function obtenerContenidoAntecedentes(data) {
    activoConsultadorTurnero = false;
    loader("In")
    obtenerTitulo('Perfil del paciente', 'btn-regresar-vista'); //Aqui mandar el nombre de la area

    $.post("contenido/consultorio_paciente.php", function (html) { $("#body-js").html(html) });

    $.getScript("contenido/js/crear-certificado.js");

    if (session.cargo == 19) $('.medico-coordinador').remove('')
    pacienteActivo = new GuardarArreglo(data)

    // Funciones
    $.getScript("contenido/js/funciones_globales.js").done(function () {
        $.getScript('contenido/js/consultorio-paciente.js').done(function () {
            obtenerConsultorio(
                data['ID_PACIENTE'],
                data['ID_TURNO'],
                pacienteActivo.array['CLIENTE'],
                pacienteActivo.array['CURP']
            ); // Botones

            $.getScript("contenido/js/consultorio-paciente-botones.js");
        });
    })

    select2('#citas-subsecuente', 'collapseAgendarConsultaTarget', 'No tiene consultas anteriores');
}

function obtenerContenidoConsulta(data, idvaloracion) {
    activoConsultadorTurnero = false;
    loader("In")
    // obtenerTitulo('Menú principal'); //Aqui mandar el nombre de la area
    $("#titulo-js").html(''); //Vaciar la cabeza de titulo
    $.post("contenido/consultorio_valoracion.html", function (html) {
        $("#body-js").html(html);
        pacienteActivo = new GuardarArreglo(data)
        pacienteActivo.selectID = idvaloracion;
    }).done(function () {
        $.getScript("contenido/js/funciones_globales.js").done(function () {
            $.getScript("contenido/js/valoracion-paciente.js").done(function () {
                // Botones
                $.getScript("contenido/js/valoracion-paciente-botones.js");
                obtenerValoracion(data, idvaloracion);
            });
        })
  })
}

async function obtenerConsultorioMain() {
    activoConsultadorTurnero = true;

    await obtenerTitulo('Consultorio');

    $.post("contenido/consultorio_main.html", function (html) { $("#body-js").html(html) }).done(function ()
    { // Rellenar la plantilla de consulta
        dataListaPaciente = { api: 5, fecha_busqueda: $('#fechaListadoAreaMaster').val(), area_id: 1 }

        if (session.cargo == 19) dataListaPaciente['cliente_id'] = 16

        $.getScript("contenido/js/main-tabla.js");
    });
}

// METODOS PARA PERFIL DEL PACIENTE
// Rellena la plantilla con metodos de espera Async Await
async function obtenerConsultorio(id, turno, cliente, curp) {
  idturno = turno
  await obtenerPanelInformacion(turno, "pacientes_api", 'paciente', '#panel-informacion', '', 1)
  await obtenerPanelInformacion(turno, "signos-vitales_api", 'signos-vitales', '#signos-vitales');
  await obtenerPanelInformacion(turno, 'consulta_api', 'listado_resultados', '#listado-resultados')

  getConclusionesHistoria(turno);

  await obtenerNotasHistorial(id);
  await consultarConsulta(turno);
  await consultarConsultaMedica(turno);
  await obtenerHistorialConsultas(id);
  await obtenerHistorialConsultaMedica(turno);

  loader("Out")
}

  // Insertar una nueva categoria en el perfil del paciente
  $(document).on('click', '#paciente_categoria', function (event) {
      event.preventDefault();

      alertMensajeConfirm({
        title: '¿Está seguro de guardar su categoría?',
        text: 'Los resultados aún sin reportar se verá reflejado su categoría.',
        icon: 'warning'
      }, function () {
          ajaxAwait({
              id_turno: idturno,
              api: 21,
              categoria_turno: $(`#${'categoria_paciente_input'}`).val()
          }, 'turnos_api', {callbackAfter: true}, false, () => {
              alertToast('Cargando información, espere un momento', 'info', 4000)
              obtenerPanelInformacion(idturno, "pacientes_api", 'paciente', '#panel-informacion', '', 1)
          })
      }, 1)
})

async function obtenerValoracion(data, idconsulta) {
  await obtenerVistaAntecenetesPaciente('#antecedentes-paciente', data['CLIENTE'])
  await ocultarFichaAdmision(data['ID_CLIENTE'])
  await ocultarAntecedentesGinecologicos(data['GENERO'])
  await obtenerPanelInformacion(data['ID_TURNO'], "signos-vitales_api", 'signos-vitales', '#signos-vitales');

  $('#descripcion-antecedentes').html('Antecedentes del paciente actual')
  $('.div-btn-guardarAntPato').append('<button type="button" class="btn btn-confirmar m-1 guardarAnt"> <i class="bi bi-paperclip"></i> Guardar </button>')
  $('.div-btn-guardarAntNoPato').append('<button type="button" class="btn btn-confirmar m-1 guardarAnt"> <i class="bi bi-paperclip"></i> Guardar </button>')
  $('.div-btn-guardarHeredoFami').append('<button type="button" class="btn btn-confirmar m-1 guardarAnt"> <i class="bi bi-paperclip"></i> Guardar </button>')
  $('.div-btn-guardarPsico').append('<button type="button" class="btn btn-confirmar m-1 guardarAnt"> <i class="bi bi-paperclip"></i> Guardar </button>')
  $('.div-btn-guardarAntNutri').append('<button type="button" class="btn btn-confirmar m-1 guardarAnt"> <i class="bi bi-paperclip"></i> Guardar </button>')
  $('.div-btn-guardarAntLabo').append('<button type="button" class="btn btn-confirmar m-1 guardarAnt"> <i class="bi bi-paperclip"></i> Guardar </button>')
  $('.div-btn-guardarAntGine').append('<button type="button" class="btn btn-confirmar m-1 guardarAnt"> <i class="bi bi-paperclip"></i> Guardar </button>')
  $('.div-btn-guardarHistoriaFamiliar').append('<button type="button" class="btn btn-confirmar m-1 guardarHistoriaFam"><i class="bi bi-paperclip"></i> Guardar </button>')
  $('.div-btn-guardarNutAlimentos').append('<button type="button" class="btn btn-confirmar m-1 guardarNutAlimentos"><i class=""></i> Guardar </button>')

  await obtenerAntecedentesPaciente(data['ID_TURNO']);
  await obtenerInformacionPaciente(data)
  await obtenerNutricion(data['ID_TURNO'])
  await obtenerExploracion(data['ID_TURNO'])
  await obtenerAnamnesisApartados(data['ID_TURNO']);
  await obtenerInformacionConsulta(idconsulta);

  await obtenerZonaMarcaje(data['ID_TURNO']); //EXPLORACION SIGMA, MARCAR ZONAS CON LESIONES.
  await rellenarValoracionCondicion(data["ID_TURNO"]);

  autosize(document.querySelectorAll('textarea'))

  loader("Out", 'bottom')
}

function agregarNotaConsulta(tittle, date = null, text, appendDiv, id = null, clase, classTittle = 'card mt-3', style = 'margin: -1px 30px 20px 30px;') {
    if (date != null) date = '<p style="font-size: 14px;margin-left: 5px;">' + date + '</p>'; else date = '';

    let btn = id ? `<button type="button" class="btn btn-hover ${clase}" data-bs-id="${id}"> <i class="bi bi-trash"></i> </button>` : '';

    let html = `
        <div class="${classTittle}" data-db="divDelete">
            <h4 class="m-3">${tittle} 
                ${btn} 
                ${date}
            </h4> 
            <div style="${style}">
                <p class="none-p">${text}<p> 
            </div> 
        </div>
    `;

    $(appendDiv).append(html);
}

function obtenerContenidoCrearCertificadoBimo() {
    activoConsultadorTurnero = false;
    loader("In")

    $.post("modals/html/crear-certificado-bimo.html", function (html) { }).done(function () {
        $.getScript("modals/js/crear-certificado-bimo.js").done(function () { })
    })
}

obtenerContenidoCrearCertificadoBimo();

function obtenerConsultorioConsultaMedica(data, idconsulta) {
    loader("In")
    $("#titulo-js").html(''); //Vaciar la cabeza de titulo

    $.post("contenido/consulta-medica-paciente.html", function (html) {
        $("#body-js").html(html);
        pacienteActivo = new GuardarArreglo(data);
    }).done(function () {
        $.getScript("contenido/js/funciones_globales.js").done(function () {}) // Obtener metodos para el dom
        $.getScript("contenido/js/guardar-consultorio.js").done(function () {}) //guardar datos consultorio
        $.getScript("contenido/js/funciones-get-informacion.js").done(function () {
          obtenerConsultaMedica(data, idconsulta);
        });
    });
}

async function obtenerConsultaMedica(data, idconsulta) {
  await recuperarDatosCampos(idconsulta) // Recuperar datos de la consulta
  await mostrarInformacionPaciente(idconsulta); // Mostrar informacion del paciente en panel  superior (data, dataConsulta)
  await recuperarExploracionFisicaConsulta2(data['ID_TURNO']); //Recupera los datos de exploracion fisica en consultorio
  await obtenerPanelInformacion(data['ID_TURNO'], "signos-vitales_api", 'signos-vitales', '#signos-vitales');
  await obtenerPanelInformacion(data['ID_TURNO'], 'consulta_api', 'listado_resultados', '#listado-resultados');

  autosize(document.querySelectorAll('textarea'))

  loader("Out", 'bottom')
}

function obtenerConsultaRapida(data) { }
function ObtenerVistaConsultaRapida(data) { loader("In") }

$(document).on('click', '#btn-ir-consulta-rapida', function (e) {
    loader("In")

    $("#titulo-js").html(''); //Vaciar la cabeza de titulo
    $.post("contenido/consulta-rapida-paciente.html", function (html) {
        $("#body-js").html(html);
        pacienteActivo = new GuardarArreglo(pacienteActivo.array);
    }).done(function () { // Obtener metodos para el dom
        $.getScript("contenido/js/consulta-rapida-paciente.js").done(function () {
            metodoConsultaRapida(pacienteActivo.array)
        })
    });
})