hasLocation();

$(window).on("hashchange", function (e) {
  hasLocation();
});

var idsEstudios, data = {api:2, id_area: 7}, apiurl = '../../../api/servicios_api.php', tablaPrecio, tablaPaquete;
var dataSet = new Array();
var iva, total, subtotalPrecioventa, subtotalCosto;

// Arreglos para la tabla dinamica, para solo costos
  var columnsDefinidas;
  var columnasData;
//

function obtenerContenidoPrecios() {
  obtenerTitulo("Lista de precios"); //Aqui mandar el nombre de la area
    $.post("contenido/listaprecios.php", function (html) {
      var idrow;
      $("#body-js").html(html);
    }).done(function(){
      $('#vista_paquetes-precios').fadeOut(0)
      $('#divSeleccionCliente').fadeOut(0)
      $.getScript('contenido/js/funciones-listaprecios.js').done(function(){
        columnsDefinidas = obtenerColumnasTabla('1.1')
        columnasData = obtenerColumnasTabla('1.2')
        // Datatable
        tablaPrecio = $("#TablaListaPrecios").DataTable({
          language: {
            url: "https://cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json",
          },
          lengthChange: false,
          info: false,
          paging: false,
          columnDefs:columnsDefinidas,
        });
        // obtenertablaListaPrecios(columnsDefinidas, columnasData, apiurl, data)
        $.getScript("contenido/js/precios-tabla.js");
        // Calcula las tablas
        $.getScript("contenido/js/calculos-listaprecios.js");
        // Botones
        $.getScript("contenido/js/precio-botones.js");
      })

    });
}

function obtenertablaListaPrecios(columnDefs, columnsData, urlApi, dataAjax = {api:7, id_area: 7}, response = null){
    console.log(columnDefs);
    console.log(columnsData)
    tablaPrecio.destroy();
    $('#TablaListaPrecios').empty();
    tablaPrecio = $("#TablaListaPrecios").DataTable({
      language: {
        url: "https://cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json",
      },
      lengthChange: false,
      info: false,
      paging: false,
      scrollY: "63vh",
      scrollCollapse: true,
      columnDefs:columnDefs,
      ajax: {
          dataType: 'json',
          data: dataAjax,
          method: 'POST',
          url: urlApi,
          // beforeSend: function () {
          //   loaderDiv("In", "#contenido-lista-precios", "#loader-tabla-precios");
          // },
          // complete: function () {
          //   loaderDiv("Out",  "#contenido-lista-precios", "#loader-tabla-precios");
          // },
          dataSrc:response
      },
      columns:columnsData
    });
}


function obtenerContenidoPaquetes(tabla) {
  obtenerTitulo("Paquetes de clientes"); //Aqui mandar el nombre de la area
  // Funciones js
    $.post("contenido/paquetes.php", function (html) {
      var idrow;
      $("#body-js").html(html);

    }).done(function () {
      $.getScript("contenido/js/funciones-paquetes.js").done(function(){
        contenidoPaquete();
        // Datatable
        $.getScript("contenido/js/paquete-tabla.js");
        // Botones
        $.getScript("contenido/js/paquete-botones.js");
        select2('#seleccion-paquete', 'form-select-paquetes')
        select2('#seleccion-estudio','form-select-paquetes')
      })

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
