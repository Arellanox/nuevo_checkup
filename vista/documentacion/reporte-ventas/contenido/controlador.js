var tablaPrincipal, dataList = {}, ventasNuevas = 0;

if (validarVista('FACTURACION_EXCEL')) {
    contenidoMuestras()
}

// Obtener la fecha del primer día del mes anterior
var fechaInicial = new Date();
fechaInicial.setMonth(fechaInicial.getMonth() - 1);
fechaInicial.setDate(1);

// Obtener la fecha del último día del mes anterior
var fechaFinal = new Date();
fechaFinal.setMonth(fechaFinal.getMonth() + 1);
fechaFinal.setDate(0);

// Formatear las fechas en el formato deseado (por ejemplo, yyyy-mm-dd)
var fechaInicialFormatted = fechaInicial.toISOString().split('T')[0];
var fechaFinalFormatted = fechaFinal.toISOString().split('T')[0];

async function contenidoMuestras() {
    await obtenerTitulo("Reporte de Excel");
    $.post("contenido/reporte_ventas.php", function (html) {
        $("#body-js").html(html);
    }).done(function () {
        dataList = {
            api: 3,
            obtener_reporte: 'obtener_reporte',
            fecha_inicio: fechaInicialFormatted,
            fecha_fin: fechaFinalFormatted,
            solo_nuevos: ventasNuevas
        };
        // DataTable
        $.getScript('contenido/js/reporte-tabla.js')
    })
}
