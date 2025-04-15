
var tablaPrincipal, dataList = {}



async function contenidoMuestras() {
  await obtenerTitulo("Servicios | Bimo");

  $.post("contenido/precios_particulares.html", function (html) {
    $("#body-js").html(html);
  }).done(function () {
    dataList = { api: 3, id_cliente: 0 };
    $.getScript('contenido/js/reporte-tabla.js')
  })
}

contenidoMuestras()