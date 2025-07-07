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

const dataTableCatRequisiciones = {
  api: 2, // Case 2 para obtener requisiciones
};

const dataTableCatDepartamentos = {
  api: 6,
};

const dataTableCatPuestos = {
  api: 8, // Case 8 para obtener puestos
};

const dataTableCatPuestosDetalles = {
  api: 9, // Case 9 para obtener detalles de puestos
};

const dataTableCatMotivos = {
  api: 12,  // Case 12 para obtener motivos
};

const dataTableCatBlandas = {
  api: 18, // Case 18 para obtener habilidades blandas
};

const dataTableCatTecnicas = {
  api: 21, // Case 19 para obtener habilidades técnicas
};