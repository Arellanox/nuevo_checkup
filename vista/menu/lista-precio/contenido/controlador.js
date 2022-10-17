hasLocation();
contenidoPaquete();
$(window).on("hashchange", function (e) {
  hasLocation();
});

var idsEstudios, data ={api:2, id_area: 7}, apiurl = '../../../api/servicios_api.php', tablaPrecio, tablaPaquete;
var dataSet = new Array();
function obtenerContenidoPrecios() {
  obtenerTitulo("Lista de precios"); //Aqui mandar el nombre de la area
  $.post("contenido/listaprecios.php", function (html) {
    var idrow;
    $("#body-js").html(html);

    // Datatable
    $.getScript("contenido/js/precios-tabla.js");
    // Botones
    $.getScript("contenido/js/precio-botones.js");
  });
}


function obtenerContenidoPaquetes(tabla) {
  obtenerTitulo("Paquetes de clientes"); //Aqui mandar el nombre de la area
  $.post("contenido/paquetes.php", function (html) {
    var idrow;
    $("#body-js").html(html);

  }).done(function () {
       // Datatable
    $.getScript("contenido/js/paquete-tabla.js");
    // Botones
    $.getScript("contenido/js/paquete-botones.js");
    select2('#seleccion-paquete', 'form-select-paquetes')
    select2('#seleccion-estudio','form-select-paquetes')
  });

}

function hasLocation() {
  var hash = window.location.hash.substring(1);
  $("a").removeClass("navlinkactive");
  $("nav li a[href='#" + hash + "']").addClass("navlinkactive");
  switch (hash) {
    case "PreciosEstudios":
      obtenerContenidoPrecios();
      break;
    case "PaquetesClientes":
      obtenerContenidoPaquetes();
      break;
    default:
      obtenerContenidoPrecios();
      break;
  }
}


async function mantenimientoPaquete(){
  loader("In");
  await rellenarSelect('#seleccion-paquete','paquetes_api', 2,0,'DESCRIPCION');
  loader("Out");
}

async function contenidoPaquete(){
  loader("In");
  await rellenarSelect('#seleccion-paquete','paquetes_api', 5,0,'DESCRIPCION');
  loader("Out");
}

function meterDato (DESCRIPCION,CVE,COSTO_TOTAL,PRECIO_VENTA, ID_ESTUDIO, ABREVIATURA){
let longitud = dataSet.length+1;
  dataSet.push({
    'COUNT':  longitud,
    'DESCRIPCION': DESCRIPCION,
    'CVE':CVE,
    'CANTIDAD':1,
    'COSTO': COSTO_TOTAL,
    'COSTO_TOTAL': COSTO_TOTAL,
    'PRECIO_VENTA':PRECIO_VENTA,
    'SUBTOTAL': 0,
    'ID_ESTUDIO': ID_ESTUDIO,
    'LIST': ABREVIATURA+''+Math.random()*10
  })
  cargarTabla(dataSet);
}

function calcularFilasTR(){
  $('#TablaListaPaquetes tr').each(function() {
      caluloFila(this)
  });
}

function caluloFila(parent_element){
  let cantidad = parseFloat($(parent_element).find("input[name='cantidad-paquete']").val());
  let costo = parseFloat($(parent_element).find("div[class='costo-paquete text-center']").text().slice(1));
  let precioventa = parseFloat($(parent_element).find("div[class='precioventa-paquete text-center']").text().slice(1));
  // Dar valor a costo total
  let costoTotal= cantidad*costo;
  if (Number.isInteger(costoTotal)) {
    $(parent_element).find("div[class='costototal-paquete text-center']").html('$'+costoTotal)
  }else{
    $(parent_element).find("div[class='costototal-paquete text-center']").html('$0')
  }
  let subtotal= cantidad*precioventa;
  if (Number.isInteger(subtotal)) {
    $(parent_element).find("div[class='subtotal-paquete text-center']").html('$'+subtotal)
  }else{
    $(parent_element).find("div[class='subtotal-paquete text-center']").html('$0')
  }
}

function cargarpaquetes(){
  tablaPrecio.ajax.url( '../../../api/paquetes_api.php' ).load();
  data.api = 2;
  data.cliente_id = $('#seleccion-cliente').val();
  data.id_area = null;
  tablaPrecio.ajax.reload();
}

function cargarTabla(dataSet){
  tablaPaquete.clear();
  tablaPaquete.rows.add(dataSet);
  tablaPaquete.draw();
  calcularFilasTR();
}
