
if (validarVista('RECURSOS_HUMANOS')) {
    obtenerContenidoRecursosHumanos();
}


async function obtenerContenidoRecursosHumanos() {
    await obtenerTitulo('Recursos Humanos');
    $.post("contenido/recursos_humanos.html", function (html) {
        $("#body-js").html(html);
    }).done(function () {
        // Para cargar modales y scripts necesarios
        $.getScript("contenido/js/recursos_humanos.js");
    });
}

var tableCatDepartamentos;
var tableCatPuestos;


const dataTableCatDepartamentos = {
    api: 6
};

const dataTableCatPuestos = {
    api: 8 // Case 8 para obtener puestos
};