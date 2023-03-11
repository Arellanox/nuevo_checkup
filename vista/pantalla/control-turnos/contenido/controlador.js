
obtenerVistaTurnero();

var tablaControlTurnos, dataTurnos = { api: 4 };

function obtenerVistaTurnero() {
    //obtenerTitulo("Usuarios"); //Aqui mandar el nombre de la area
    $.post("contenido/vista.html", function (html) {
        $("#body-js").html(html);
    }).done(function () {
        setTimeout(() => {
            // Datatable
            $.getScript("contenido/js/control-tabla.js");
            // // Botones
            // $.getScript("contenido/js/usuario-botones.js");
        }, 200);
    });
}