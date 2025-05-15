

var turno;

var tabla, dataListaPaciente = {}, selectLista;

// ObtenerTabla o cambiar

if (validarVista('CURSOS BIMO')) {
    obtenerContenidoCursosBimo();
}


async function obtenerContenidoCursosBimo() {
    await obtenerTitulo('Cursos bimo');
    $.post("contenido/cursos_main.html", function (html) {
        $("#body-js").html(html);
    }).done(function () {
        // dataListaPaciente = { api: 5, area_id: 1, fecha_busqueda: $('#fechaListadoAreaMaster').val() };
        // Botones
        $.getScript("contenido/js/cursos-botones.js");
        // Botones
        $.getScript("contenido/js/cursos-tabla.js");
    });
}

