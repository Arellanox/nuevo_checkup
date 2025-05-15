if (validarVista('CLIENTES')) {
  obtenerContenidoCliente("Clientes");
}

let datacontactos = {api: 2, id_cliente: 0};
let tablaContacto;
let selectContacto;


let dataSegmento = { api: 2, cliente_id: 0 }, tablaSegmentos, selectSegmento;
let dataDescuentoTable = { api: 7, id_cliente: 0 };
function obtenerContenidoCliente(titulo) {
  obtenerTitulo(titulo); //Aqui mandar el nombre de la area
  $.post("contenido/clientes.php", function (html) {
    $("#body-js").html(html);
  }).done(function () {
    // Datatable
    $.getScript("contenido/js/cliente-tabla.js");
    // Botones
    $.getScript("contenido/js/botones-cliente.js");
    obtenerListaContactos();
    obtenerContenidoSegmentos("Segmentos");
  })
}

function obtenerContenidoSegmentos(titulo) {
  // obtenerTitulo(titulo); //Aqui mandar el nombre de la area
  $.post("contenido/segmentos.php", function (html) {
    $('#informacion-cliente').html(html);
  }).done(function () {
    // Datatable
    $.getScript("contenido/js/segmentos-tabla.js");
    // Botones
    $.getScript("contenido/js/botones-segmento.js");
  });
}

function obtenerListaContactos() {
  $.post("contenido/contactos.php", function (html) {
    $('#informacion-segmento').html(html);
  }).done(function () {
    // Datatable
    $.getScript("contenido/js/contactos-tabla.js");
    // Botones
    $.getScript("contenido/js/botones-contacto.js");

  })
}