if (validarVista("RECURSOS_HUMANOS")) {
  obtenerContenidoRecursosHumanos();
}

async function obtenerContenidoRecursosHumanos() {
  await obtenerTitulo("Recursos Humanos");
  $.post("contenido/recursos_humanos.html", function (html) {
    $("#body-js").html(html);
  }).done(function () {
    // Para cargar modales y scripts necesarios
    $.getScript("contenido/js/recursos_humanos.js");
  });
}

var tableCatDepartamentos;
var tableCatPuestos;
var tableCatPuestosDetalles;
var tableCatMotivos;
var tableCatRequisiciones;
var tableCatBlandas;
var tableCatTecnicas;

dataTableCatRequisiciones = {
  api: 2, // Case 2 para obtener requisiciones
};

dataTableCatDepartamentos = {
  api: 6,
};

// dataTableCatPuestos = {
//   api: 8, // Case 8 para obtener puestos
// };

dataTableCatPuestosDetalles = {
  api: 9, // Case 9 para obtener detalles de puestos
};

dataTableCatMotivos = {
  api: 12,  // Case 12 para obtener motivos
};

dataTableCatBlandas = {
  api: 18, // Case 18 para obtener habilidades blandas
};

dataTableCatTecnicas = {
  api: 21, // Case 19 para obtener habilidades técnicas
};