obtenerTitulo("CIMMO");

if(validarVista("CIMMO")){
     $.post("contenido/cimmo.html", function (html) {
        $("#body-js").html(html);
    }).done(function () {
       // $.getScript("contenido/js/reportes.js");
    })
} else {
    avisoArea()
}
