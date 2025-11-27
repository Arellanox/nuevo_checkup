obtenerTitulo("CIMMO");

if(validarVista("CIMMO")){
     $.post("contenido/cimmo.html", function (html) {
        $("#body-js").html(html);
    }).done(function () {
       $.getScript("contenido/js/cimmo.js");
    })
} else {
    avisoArea()
}


var tablaPacientes;
var dataTablePacientes = { api: 3 };
var id_cimmo; // para enviar las peticiones al seleccionar un paciente de la lista