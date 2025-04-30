//Menú principal para consultorio
var id, idturno, idconsulta, dataConsulta = new Array, tablaMain;
var selectPaciente;
var dataListaPaciente;
obtenerConsultorioMain()

var activoConsultadorTurnero = true;

async function obtenerConsultorioMain() {
    activoConsultadorTurnero = true;
    // loader("In")
    await obtenerTitulo('Consultorio');
    $.post("contenido/consultorio_main.html", function (html) {
        var idrow;
        $("#body-js").html(html) // Rellenar la plantilla de consulta
    }).done(function () {
        dataListaPaciente = {
            api: 5,
            fecha_busqueda: $('#fechaListadoAreaMaster').val(),
            area_id: 1
        }

        if (session.cargo == 19)
            dataListaPaciente['cliente_id'] = 16

        // Datatable
        $.getScript("contenido/js/main-tabla.js");
    });
}

// Obtener el perfil del paciente (antecedentes);
var pacienteActivo = new GuardarArreglo()
var infoConsultaActivo = new GuardarArreglo();

function obtenerContenidoAntecedentes(data) {
    activoConsultadorTurnero = false;
    loader("In")
    obtenerTitulo('Perfil del paciente', 'btn-regresar-vista'); //Aqui mandar el nombre de la area
    $.post("contenido/consultorio_paciente.php", function (html) {
        var idrow;
        $("#body-js").html(html) // Rellenar la plantilla de consulta
    }).done(function () {

        if (session.cargo == 19)
            $('.medico-coordinador').remove('')


        pacienteActivo = new GuardarArreglo(data)
        // $.getScript("modals/controlador-perfilPaciente.js");
        // Funciones
        $.getScript("contenido/js/funciones_globales.js").done(function () {
        })

        $.getScript('contenido/js/consultorio-paciente.js').done(function () {
            obtenerConsultorio(data['ID_PACIENTE'], data['ID_TURNO'], pacienteActivo.array['CLIENTE'], pacienteActivo.array['CURP'])
            // Botones
            $.getScript("contenido/js/consultorio-paciente-botones.js");

            // getFormOidosAudiometria(data);
        });
        select2('#citas-subsecuente', 'collapseAgendarConsultaTarget', 'No tiene consultas anteriores');
    });
}

// obtenerContenidoConsulta() --- Valoracion medica ---
var tablaRecetas;

function obtenerContenidoConsulta(data, idvaloracion) {
    activoConsultadorTurnero = false;
    loader("In")
    console.log(data)
    // obtenerTitulo('Menú principal'); //Aqui mandar el nombre de la area
    $("#titulo-js").html(''); //Vaciar la cabeza de titulo
    $.post("contenido/consultorio_valoracion.html", function (html) {
        $("#body-js").html(html);
        pacienteActivo = new GuardarArreglo(data)
        pacienteActivo.selectID = idvaloracion;

        // Datatable
        // $.getScript("contenido/js/estudio-tabla.js");
        // select2('#citas-subsecuente', 'collapseAgendarConsultaTarget');
    }).done(function () {
        $.getScript("contenido/js/funciones_globales.js").done(function () {
        })

        // Obtener metodos para el dom
        $.getScript("contenido/js/valoracion-paciente.js").done(function () {
            // Botones
            $.getScript("contenido/js/valoracion-paciente-botones.js");
            obtenerValoracion(data, idvaloracion);
        });
        // select2('#registrar-metodos-estudio', 'card-exploracion-clinica');
    })
}

// METODOS PARA PERFIL DEL PACIENTE
// Rellena la plantilla con metodos de espera Async Await
async function obtenerConsultorio(id, turno, cliente, curp) {
    idturno = turno
    await obtenerPanelInformacion(turno, "pacientes_api", 'paciente', '#panel-informacion', '', 1)
    await obtenerPanelInformacion(turno, "signos-vitales_api", 'signos-vitales', '#signos-vitales');
    await obtenerPanelInformacion(turno, 'consulta_api', 'listado_resultados', '#listado-resultados')

    getConclusionesHistoria(turno);
    // alert("Antes de antecedentes")
    // setValues(turno) //llamar los valores para los antecedentes

    // alert("Antes de notas historial")
    await obtenerNotasHistorial(id);

    //Verificar si hay consulta actual
    await consultarConsulta(turno);
    await consultarConsultaMedica(turno);

    await obtenerHistorialConsultas(id);
    // alert("Funcion terminada")
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
    // console.log(data, idconsulta)
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
    // console.log("si");
    await obtenerInformacionPaciente(data)
    await obtenerNutricion(data['ID_TURNO'])
    await obtenerExploracion(data['ID_TURNO'])
    await obtenerAnamnesisApartados(data['ID_TURNO']);
    await obtenerInformacionConsulta(idconsulta);
    //EXPLORACION SIGMA, MARCAR ZONAS CON LESIONES.
    await obtenerZonaMarcaje(data['ID_TURNO']);
    await rellenarValoracionCondicion(data["ID_TURNO"]);

    autosize(document.querySelectorAll('textarea'))

    loader("Out", 'bottom')


}

function agregarNotaConsulta(tittle, date = null, text, appendDiv, id = null, clase, classTittle = 'card mt-3', style = 'margin: -1px 30px 20px 30px;') {
    if (date != null) {
        date = '<p style="font-size: 14px;margin-left: 5px;">' + date + '</p>';
    } else {
        date = '';
    }

    let btn = id ? `<button type="button" class="btn btn-hover ${clase}" data-bs-id="${id}"> <i class="bi bi-trash"></i> </button>` : '';

    let html = `<div class="${classTittle}" data-db="divDelete">
    <h4 class="m-3">${tittle} 
      ${btn} 
      ${date}
    </h4> <div style="${style}">
    <p class="none-p">${text}<p> 
    </div> </div>`;
    $(appendDiv).append(html);
}

function obtenerContenidoCrearCertificadoBimo(data) {
    activoConsultadorTurnero = false;
    loader("In")
    $.post("modals/html/crear-certificado-bimo.html", function (html) {

    }).done(function () {
        $.getScript("modals/js/crear-certificado-bimo.js").done(function () {

            console.log('cargado')
        })
        console.log("finalizado")
    })
}

obtenerContenidoCrearCertificadoBimo(null);

//AREA CONSULTA MEDICA
//Posible solucion en ios
// $('#entrarConsultaMedica').css('cursor', 'pointer');
// $(document).on('click', '#entrarConsultaMedica', function (event) {
//   event.preventDefault();
//   obtenerConsultorioConsultaMedica(pacienteActivo.array, idConsultaMedica);
// });
function obtenerConsultorioConsultaMedica(data, idconsulta) {
    loader("In")
    $("#titulo-js").html(''); //Vaciar la cabeza de titulo
    $.post("contenido/consulta-medica-paciente.html", function (html) {
        $("#body-js").html(html);
        pacienteActivo = new GuardarArreglo(data);
    }).done(function () {
        // Obtener metodos para el dom
        $.getScript("contenido/js/funciones_globales.js").done(function () {
        })
        //guardar datos consultorio
        $.getScript("contenido/js/guardar-consultorio.js").done(function () {
        })

        $.getScript("contenido/js/funciones-get-informacion.js").done(function () {
            obtenerConsultaMedica(data, idconsulta);
        });
        // select2('#registrar-metodos-estudio', 'card-exploracion-clinica');
    });
}

async function obtenerConsultaMedica(data, idconsulta) {
    // await obtenerVistaAntecenetesPaciente('#antecedentes-paciente', data['CLIENTE'])

    // Recuperar datos de la consulta
    await recuperarDatosCampos(idconsulta)
    // Mostrar informacion del paciente en panel  superior (data, dataConsulta)
    await mostrarInformacionPaciente(idconsulta);
    //Recupera los datos de exploracion fisica en consultorio
    await recuperarExploracionFisicaConsulta2(data['ID_TURNO'])


    await obtenerPanelInformacion(data['ID_TURNO'], "signos-vitales_api", 'signos-vitales', '#signos-vitales');
    await obtenerPanelInformacion(data['ID_TURNO'], 'consulta_api', 'listado_resultados', '#listado-resultados')


    autosize(document.querySelectorAll('textarea'))
    loader("Out", 'bottom')
}

function obtenerConsultaRapida(data) {
}

function ObtenerVistaConsultaRapida(data) {
    loader("In")
}

$(document).on('click', '#btn-ir-consulta-rapida', function (e) {
    loader("In")
    $("#titulo-js").html(''); //Vaciar la cabeza de titulo
    $.post("contenido/consulta-rapida-paciente.html", function (html) {
        $("#body-js").html(html);
        pacienteActivo = new GuardarArreglo(pacienteActivo.array);
    }).done(function () {
        // Obtener metodos para el dom
        $.getScript("contenido/js/consulta-rapida-paciente.js").done(function () {

            metodoConsultaRapida(pacienteActivo.array)

        })
        // select2('#registrar-metodos-estudio', 'card-exploracion-clinica');
    });
})