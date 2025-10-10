var datosCargaodsPaciente = null;
var selectedEstudiosCargadosPacientes; // <- Aqui se guardan toda la información del estudio que seleccione

if (validarVista('MEDICOS_TRATANTES')) {
    hasLocation();
    $(window).on("hashchange", function (e) {
        hasLocation();
    });
}

var TablaVistaMedicosTratantes, dataMedicosTratantes = { api: 2 }
async function contenidoMedicosTratantes() {
    await obtenerTitulo("Médicos Tratantes");
    $.post("contenido/medicos_tratantes.php", function (html) {
        $("#body-js").html(html);
    }).done(function () {

        select2('#select-usuarios-medicos-tratantes', null, 'Selecciona un médico tratante');
        rellenarSelect('#select-usuarios-medicos-tratantes', 'usuarios_api', 2, 'ID_USUARIO', 'nombrecompleto', 'Seleccione un usuario')

        $.getScript("contenido/js/btn-medicos-tratantes.js");
        $.getScript("contenido/js/tabla-medicos-tratantes.js");

    })
}

var tablaPacientesTratantes, dataPacientesTratantes = { api: 4, fecha_inicio: obtenerFechaActualYMD(), fecha_fin: obtenerFechaActualYMD(), todos: 0 }
dataJsonTablaEstudiosPaciente = {
    api: 6, fecha_inicio: obtenerFechaActualYMD(), fecha_fin: obtenerFechaActualYMD(), todos: 0
}
// console.log('Valida el paciente')
// console.log(validarPermiso('filPacientes'))

function obtenerFechaActualYMD() {
    const hoy = new Date(); // 1. Obtiene la fecha y hora actual

    // 2. Extrae el año, mes y día
    const anio = hoy.getFullYear();
    // Los meses van de 0 (Enero) a 11 (Diciembre), se suma 1
    const mes = hoy.getMonth() + 1;
    const dia = hoy.getDate();

    // 3. Formatea el mes y el día para que tengan siempre dos dígitos (ej: 09 en vez de 9)
    const mesFormato = String(mes).padStart(2, '0');
    const diaFormato = String(dia).padStart(2, '0');

    // 4. Une las partes con guiones
    return `${anio}-${mesFormato}-${diaFormato}`;
}

async function contenidoPacientesTratantes() {
    await obtenerTitulo("Pacientes Tratantes");
    $.post("contenido/pacientes_tratantes.php", function (html) {
        $("#body-js").html(html);
    }).done(function () {
        $.getScript("contenido/js/tabla-pacientes-tratantes.js");
    })
}

function hasLocation() {
    var hash = window.location.hash.substring(1);
    $("a").removeClass("navlinkactive");
    $("nav li a[href='#" + hash + "']").addClass("navlinkactive");

    switch (hash) {
        case "MEDICOS":
            contenidoMedicosTratantes()
            break;
        case "PACIENTES":
            contenidoPacientesTratantes()
            break;
        default:
            window.location.hash = '#';
            break;
    }
}