contenidoMedicosTratantes()

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