hasLocation();

$(window).on("hashchange", function (e) {
  hasLocation();
});

let idsEstudios, data = {api:2, id_area: 7}, apiurl = 'servicios_api', tablaPrecio, tablaPaquete, tablaContenidoPaquete;
let dataSet = new Array();
let iva, total, subtotalPrecioventa, subtotalCosto;

// Arreglos para la tabla dinamica, para solo costos
  let columnsDefinidas;
  let columnasData;
//

//Cambia la vista a la lista de precios
function obtenerContenidoPrecios() {
  obtenerTitulo("Lista de precios"); //Aqui mandar el nombre de la area
    $.post("contenido/listaprecios.php", function (html) {
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

// rellena la tabla con el servicio que se envie
function obtenertablaListaPrecios(columnDefs, columnsData, urlApi, dataAjax = {api:7, id_area: 7}, response = null){
    // console.log(columnDefs);
    // console.log(columnsData)
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
          url: '../../../api/'+urlApi+'.php',
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

var tablePaquetesHTML;
//Cambia la vista para paquetes
function obtenerContenidoPaquetes(tabla) {
  obtenerTitulo("Paquetes de clientes"); //Aqui mandar el nombre de la area
  // Funciones js
    $.post("contenido/paquetes.php", function (html) {
      $("#body-js").html(html);

    }).done(function () {
      tablePaquetesHTML = $("#TablaListaPaquetes")
      $.getScript("contenido/js/funciones-paquetes.js").done(function(){
        tablaContenidoPaquete = $("#TablaListaPaquetes").DataTable()
        contenidoPaquete(1)
        // Datatable
        $.getScript("contenido/js/paquete-tabla.js");
        // Botones
        $.getScript("contenido/js/paquete-botones.js");
      })

    });

}

//Vacia la tabla, para el poder rellenar
function tablaContenido(){
  tablaContenidoPaquete.destroy();
  $('#TablaListaPaquetes').empty();
  tablaContenidoPaquete = $("#TablaListaPaquetes").DataTable({
    lengthChange: false,
    // info: false,
    paging: false,
    scrollY: "63vh",
    scrollCollapse: true,
    columnDefs: [
      { width: "213.266px",  title: "Descripción", targets: 0},
      { width: "80.75px",  title: "CVE", targets: 1},
      { width: "90.516px",  title: "Cantidad", targets: 2, orderable: false },
      { width: "80.8438px",  title: "Costo", targets: 3 },
      { width: "102.484px",  title: "Costo Total", targets: 4 },
      { width: "99.344px",  title: "Precio Venta", targets: 5 },
      { width: "64.75px",  title: "Subtotal", targets: 6 },
      { visible: false,  title: "?", targets: 7, searchable: false, },
    ],
    language: {
      url: "https://cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json",
    },
  });
  loader("Out");
}

//Tabla para cargar los servicios de un paquete y modificarlos
function tablaMantenimiento(url = 'paquetes_api'){
  tablaContenidoPaquete.destroy();
  $('#TablaListaPaquetes').empty();
  tablaContenidoPaquete = $("#TablaListaPaquetes").DataTable({
    language: {
      url: "https://cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json",
    },
    lengthChange: false,
    info: false,
    paging: false,
    scrollY: "63vh",
    scrollCollapse: true,
    columnDefs: [
      { width: "213.266px",  title: "Descripción", targets: 0},
      { width: "80.75px",  title: "CVE", targets: 1},
      { width: "90.516px",  title: "Cantidad", targets: 2, orderable: false },
      { width: "80.8438px",  title: "Costo", targets: 3 },
      { width: "102.484px",  title: "Costo Total", targets: 4 },
      { width: "99.344px",  title: "Precio Venta", targets: 5 },
      { width: "64.75px",  title: "Subtotal", targets: 6 },
      { visible: false,  title: "?", targets: 7, searchable: false, },
    ],
    ajax: {
        dataType: 'json',
        data: {
          id_paquete: $('#seleccion-paquete').val(),
          api:9
        },
        method: 'POST',
        url: http + servidor + "/nuevo_checkup/api/"+url+".php",
        complete: function(){ loader("Out") },
        dataSrc:'response.data'
    },
    columns:[
        {data: 'SERVICIO'},
        {data: 'ABREVIATURA'},
        {data: 'CANTIDAD'},
        {data: 'COSTO_UNITARIO'},
        {data: 'COSTO_TOTAL'},
        {data: 'PRECIO_VENTA_UNITARIO'},
        {data: 'SUBTOTAL'},
        {data: 'ID_SERVICIO'},
        // {defaultContent: 'En progreso...'}
    ],
  });
}

//Cambia la vista de la pagina
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
