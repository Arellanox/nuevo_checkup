hasLocation()

$(window).on("hashchange", function (e) { hasLocation(); });

var idsEstudios, data = {api: 2, id_area: 7};
var apiurl = 'servicios_api', tablaPrecio, tablaPaquete, tablaContenidoPaquete;
var iva, total, subtotalPrecioventa, subtotalCosto;
var dataEliminados = []; //Lista para cuando eliminen un servicio
var dataSet = [];

// Arreglos para la tabla dinamica, para solo costos
var columnsDefinidas;
var columnasData;

//Personalizar la tabla de excel de cotizaciones y paquetes
var VistaExcelurl = '';
var tablePaquetesHTML;
var dataVistaPq = {};
var cliente_id;
var row2

//Cambia la vista a la lista de precios
function obtenerContenidoPrecios() {
    obtenerTitulo("Lista de precios"); //Aqui mandar el nombre de la area

    $.post("contenido/listaprecios.php", {franquicia: isFranquisiario}, function (html) {
        $("#body-js").html(html);
    }).done(function () {
        $('#vista_paquetes-precios').fadeOut(0)
        $('#divSeleccionCliente').fadeOut(0)
        $.getScript('contenido/js/funciones-listaprecios.js').done(function () {
            columnsDefinidas = obtenerColumnasTabla('1.1')
            columnasData = obtenerColumnasTabla('1.2')
            // Datatable
            tablaPrecio = $("#TablaListaPrecios").DataTable({
                language: {
                    url: "https://cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json",
                },
                // lengthChange: false,
                // info: false,
                // paging: true,
                columnDefs: columnsDefinidas,
            });

            inputBusquedaTable('TablaListaPrecios', tablaPrecio, [], [], 'col-12')

            // obtenertablaListaPrecios(columnsDefinidas, columnasData, apiurl, data)
            $.getScript("contenido/js/precios-tabla.js");
            // Calcula las tablas
            $.getScript("contenido/js/calculos-listaprecios.js");
            // Botones
            $.getScript("contenido/js/precio-botones.js");

            $('#check-Precios').click();
            setTimeout(() => {
                columnsDefinidas = obtenerColumnasTabla('2.1')
                columnasData = obtenerColumnasTabla('2.2')
                $('.vista_estudios-precios').fadeIn(100)
                $('#divSeleccionCliente').fadeIn(100)
                tablaPrecio.destroy();
                $('#TablaListaPrecios').empty();
                tablaPrecio = $("#TablaListaPrecios").DataTable({
                    language: {
                        url: "https://cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json",
                    },
                    // lengthChange: false,
                    // info: false,
                    // paging: false,
                    columnDefs: columnsDefinidas
                });
                inputBusquedaTable('TablaListaPrecios', tablaPrecio, [], [], 'col-12')
                $('input[type=radio][name=selectChecko]:checked').prop('checked', false);
            }, 200);
        })
    });
}

// rellena la tabla con el servicio que se envie
function obtenertablaListaPrecios(columnDefs, columnsData, urlApi, dataAjax = {
    api: 7,
    id_area: 7
}, response = null) {
    dataEliminados = []
    tablaPrecio.destroy();
    $('#TablaListaPrecios').empty();
    tablaPrecio = $("#TablaListaPrecios").DataTable({
        scrollY: "63vh",
        scrollCollapse: true,
        columnDefs: columnDefs,
        ajax: {
            dataType: 'json',
            data: dataAjax,
            method: 'POST',
            url: '../../../api/' + urlApi + '.php',
            dataSrc: response
        },
        columns: columnsData
    });

    inputBusquedaTable('TablaListaPrecios', tablaPrecio, [], [], 'col-12')
}

//Cambia la vista para paquetes
function obtenerContenidoPaquetes(tabla) {
    obtenerTitulo("Paquetes de clientes"); //Aqui mandar el nombre de la area
    // Funciones js
    $.post("contenido/paquetes.php", function (html) {
        $("#body-js").html(html);

    }).done(function () {

        dataVistaPq = {api: 9, id_paquete: $('#seleccion-paquete').val()}
        VistaExcelurl = `${http}${servidor}/${appname}/api/paquetes_api.php`

        tablePaquetesHTML = $("#TablaListaPaquetes")
        $.getScript("contenido/js/funciones-paquetes.js").done(function () {
            tablaContenidoPaquete = $("#TablaListaPaquetes").DataTable()
            contenidoPaquete(1)
            // Datatable
            $.getScript("contenido/js/paquete-tabla.js");
            // Botones
            $.getScript("contenido/js/paquete-botones.js");
        })

    });
}

//Vacia la tabla, para el poder rellenar en paquetes
function tablaContenido(descuento = false) {
    var hash = window.location.hash.substring(1);

    columns_visible = {
        costo: true,
        costo_total: true
    }

    switch (hash) {
        case "COTIZACIONES_ESTUDIOS":
            columns_visible['costo'] = false;
            columns_visible['costo_total'] = false;
            break;

        default:
            break;
    }

    tablaContenidoPaquete.destroy();
    $('#TablaListaPaquetes').empty();
    dataEliminados = new Array()
    tablaContenidoPaquete = $("#TablaListaPaquetes").DataTable({
        lengthChange: false,
        // info: false,
        paging: false,
        scrollY: "50vh",
        scrollCollapse: true,
        columnDefs: [
            {className: 'all', width: "213.266px", title: "Descripción", targets: 0},
            {className: 'desktop', width: "80.75px", title: "CVE", targets: 1},
            {className: 'min-tablet', width: "90.516px", title: "Cantidad", targets: 2, orderable: false},
            {className: 'all', width: "80.8438px", title: "Costo", targets: 3, visible: columns_visible['costo']},
            {
                className: 'desktop',
                width: "102.484px",
                title: "Costo Total",
                targets: 4,
                visible: columns_visible['costo_total']
            },
            {
                className: 'min-tablet',
                width: "90.516px",
                title: "Descuento",
                targets: 5,
                orderable: false,
                visible: descuento
            },
            {className: 'desktop', width: "99.344px", title: "Precio Venta", targets: 6},
            {className: 'all', width: "64.75px", title: "Subtotal", targets: 7},
            {visible: false, title: "?", targets: 8, searchable: false,},
        ],
        language: {
            url: "https://cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json",
        },
    });

    inputBusquedaTable('TablaListaPaquetes', tablaContenidoPaquete, [], [], 'col-12')
    loader("Out");
}

async function obtenerContenidoCotizaciones() {
    await obtenerTitulo("Cotizaciones de estudios"); //Aqui mandar el nombre de la area
    // Funciones js
    $.post("contenido/cotizaciones.php", {franquicia: isFranquisiario}, function (html) {
        $("#body-js").html(html);
    }).done(function () {
        VistaExcelurl = `${http}${servidor}/${appname}/api/cotizaciones_api.php`
        dataVistaPq = {api: 9, id_paquete: $('#seleccion-paquete').val()}

        tablePaquetesHTML = $("#TablaListaPaquetes")
        $.getScript("contenido/js/funciones-cotizaciones.js").done(function () {
            tablaContenidoPaquete = $("#TablaListaPaquetes").DataTable()
            contenidoPaquete(1)
            // Datatable
            $.getScript("contenido/js/cotizaciones-tabla.js");
            // Botones
            $.getScript("contenido/js/cotizaciones-botones.js");
        })
    });
}

//Cambia la vista de la pagina
function hasLocation() {
    var hash = window.location.hash.substring(1);
    $("a").removeClass("navlinkactive");
    $("nav li a[href='#" + hash + "']").addClass("navlinkactive");

    if (validarVista(hash)) {
        switch (hash) {
            case "LISTA_PRECIOS":
                obtenerContenidoPrecios();
                break;
            case "PAQUETES_ESTUDIOS":
                obtenerContenidoPaquetes();
                break;
            case "COTIZACIONES_ESTUDIOS":
                obtenerContenidoCotizaciones();
                break;
            default:
                avisoArea();
                break;
        }

    }
}

$(document).on('click', 'button.toggle-vis', function (e) {
    e.preventDefault();
    // Get the column API object

    var hash = window.location.hash.substring(1);
    var column_costo;
    var column_utilidad;

    switch (hash) {
        case "LISTA_PRECIOS":
            column_costo = tablaPrecio.column(3);
            column_utilidad = tablaPrecio.column(4);

            // Toggle the visibility
            column_costo.visible(!column_costo.visible());
            column_utilidad.visible(!column_utilidad.visible());
            break;
        case "COTIZACIONES_ESTUDIOS":
            // Get the column API object
            column_costo = tablaContenidoPaquete.column(3);
            column_utilidad = tablaContenidoPaquete.column(4);


            // Toggle the visibility
            column_costo.visible(!column_costo.visible());
            column_utilidad.visible(!column_utilidad.visible());
            break;
        default:
            break;
    }

    $.fn.dataTable
        .tables({
            visible: true,
            api: true
        })
        .columns.adjust();

    $(this).removeClass('span-info');
    if (column_costo.visible()) $(this).addClass('span-info');
});
