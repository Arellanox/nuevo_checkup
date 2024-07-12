
var tablaPrincipal, dataList = {}

if (validarVista('REPORTE_LABORATORIO')) {
  contenidoMuestras()
}


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

async function contenidoMuestras() {
  await obtenerTitulo("Reporte de Excel Laboratorios");
  $.post("contenido/reporte_excel.html", function (html) {
    $("#body-js").html(html);
  }).done(function () {
    dataList = { api: 1, id_cliente: 0 };
    // DataTable
    $.getScript('contenido/js/reporte-tabla.js')
  })
}
