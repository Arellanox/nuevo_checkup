// if (validarVista('ADMINISTRACIÓN')) {
contenidoSoporteTi()

// }


async function contenidoSoporteTi() {
    await obtenerTitulo("Soporte TI");
    $.post("contenido/vista_tabla_TI.html", function (html) {
        $("#body-js").html(html);
    }).done(function () {

        $.getScript('contenido/js/muestra-tabla.js')// DataTable
    })
}

// Botones
//   $.getScript('contenido/js/muestras-botones.js')