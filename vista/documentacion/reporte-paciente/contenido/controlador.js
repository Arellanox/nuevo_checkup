
var tablaPrincipal, dataList = {}

if (validarVista('LABORATORIO_MUESTRA_1')) {
  contenidoMuestras()
}

let fecha_actual = new Date();

var dia = fecha_actual.getDate();
var mes = fecha_actual.getMonth() + 1;
var ano = fecha_actual.getFullYear();

var fechaActual = `${ano}-${mes}-${dia}`;

async function contenidoMuestras() {
  await obtenerTitulo("Reporte de Excel");
  $.post("contenido/reporte_excel.html", function (html) {
    $("#body-js").html(html);
  }).done(function () {
    dataList = { api: 3 };
    // DataTable
    $.getScript('contenido/js/reporte-tabla.js')
  })
}
