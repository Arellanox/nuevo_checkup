contenidoMaquilaReportes()

async function contenidoMaquilaReportes() {
    await obtenerTitulo('Reporte de Maquilas');
    
    $.post("contenido/reporte.php", function (html) {
        $("#body-js").html(html);
    }).done(function () {
        $.getScript("contenido/js/reportes.js");
    })
}