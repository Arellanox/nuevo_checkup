var tablaPrincipal, dataList = {}
// Obtener la fecha del primer día del mes anterior
var fechaInicial = new Date();
fechaInicial.setMonth(fechaInicial.getMonth() - 1);
fechaInicial.setDate(1);

// Obtener la fecha del último día del mes anterior
var fechaFinal = new Date();
fechaFinal.setDate(0);

// Formatear las fechas en el formato deseado (por ejemplo, yyyy-mm-dd)
var fechaInicialFormatted = fechaInicial.toISOString().split('T')[0];
var fechaFinalFormatted = fechaFinal.toISOString().split('T')[0];
cargarContenidoReportes();

async function cargarContenidoReportes() {
    await obtenerTitulo(isValid == 0 ? '' : `Reporte de Excel`);

    $.post("contenido/reporte.php", { area }, function (html) {
        $("#body-js").html(html);
    }).done(function () {
        if (isValid == 1) {
            dataList = { api: 1, id_cliente: 0 , area_id: area['id']};
            $.getScript('contenido/js/reporte-tabla.js')
        } else loader("Out", 'bottom')
    });
}