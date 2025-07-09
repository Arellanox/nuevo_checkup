if (validarVista("ORDEN_COMPRA")) {
  contenidoOrdenCompra();
  console.log(1);
} else {
  avisoArea();
  console.log(2);
}

async function contenidoOrdenCompra() {
  await obtenerTitulo("Ordenes de Compra");

  $.post("contenido/orden_compra.html", function (html) {
    $("#body-js").html(html);
  }).done(function () {
    $.getScript("contenido/js/orden_compra.js");
  });
}

var rowSelected;

var dataTableCatProveedores;
var dataTableCatOrdenesCompra;

console.log(userPermissions);

dataTableCatProveedores = {
  api: 2,
};

dataTableCatOrdenesCompra = {
  api: 1,
};