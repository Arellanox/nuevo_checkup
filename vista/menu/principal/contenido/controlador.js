var tablaEstatusTurnos;

// //Validacion de usuario
switch (session['cargo']) {
    case '18': case 18:
        $(location).attr('href', `${http}${servidor}/${appname}/vista/procedencia/pacientes/#UJAT`);
        destroySession();
        break;
    // return true;
}

function obtenerContenidoPrincipal() {
    obtenerTitulo('Menú bimo Checkup'); //Nombre cambiante, no usar botones

    $.post("contenido/turnos_dia.php", { franquicia: isFranquisiario },
        function (html) {
            $("#body-js").html(html);
        }).done(function () {
            $.getScript("contenido/js/estatus-tabla.js");
        });

}

obtenerContenidoPrincipal()
