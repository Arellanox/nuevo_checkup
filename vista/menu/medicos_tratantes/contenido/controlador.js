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

var tablaPacientesTratantes, dataPacientesTratantes = { api: 4 }
dataJsonTablaEstudiosPaciente = {
    api: 6,

}
// console.log('Valida el paciente')
// console.log(validarPermiso('filPacientes'))

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