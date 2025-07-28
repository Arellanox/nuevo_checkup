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
    $.getScript("contenido/js/reclu_select.js");
  });
}

var dataTableCatDepartamentos;
var dataTableCatPuestos;
var dataTableCatPuestosDetalles;
var dataTableCatMotivos;
var dataTableCatRequisiciones;
var dataTableCatBlandas;
var dataTableCatTecnicas;
var dataTableRequisicionesAprobadas;
var dataTableHistorialPublicaciones;
var dataTableGestionPostulantes;

dataTableCatRequisiciones = {
  api: 2, // Case 2 para obtener requisiciones
};

dataTableCatDepartamentos = {
  api: 5,
};

// dataTableCatPuestos = {
//   api: 8, // Case 8 para obtener puestos
// };

dataTableCatPuestosDetalles = {
  api: 8, // Case 9 para obtener detalles de puestos
};

dataTableCatMotivos = {
  api: 11,  // Case 12 para obtener motivos
};

dataTableCatBlandas = {
  api: 16, // Case 18 para obtener habilidades blandas
};

dataTableCatTecnicas = {
  api: 19, // Case 21 para obtener habilidades técnicas
};

dataTableRequisicionesAprobadas = {
  api: 9,
}; 

dataTableHistorialPublicaciones = {
  api: 29,
}

dataTableGestionPostulantes = {
  api: 31,
}