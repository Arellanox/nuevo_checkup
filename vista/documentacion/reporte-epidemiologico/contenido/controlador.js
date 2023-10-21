contenidoMuestras()

var TablaTablaReporteEpidemiologico, dataReporteEpidemiologico = { api: 1 }

async function contenidoMuestras() {
    await obtenerTitulo("Reporte epidemiológico");
    $.post("contenido/reporte_epidemiologico.html", function (html) {
        $("#body-js").html(html);
    }).done(function () {
        // dataList = { api: 3, id_cliente: 0 };
        // // DataTable
        $.getScript('contenido/js/reporte_epidemiologico.js')
    })
}