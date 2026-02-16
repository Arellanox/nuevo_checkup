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
var row2;

// Recuperar el contenido de un paquete en la lista de precios
var idPaquete;
var jsonDetallePaquete = {
    api: 9,
    id_paquete: 0
};
var tablaDetallePaquetes;
var bitDetallePaquete = false;

var formatoMXN = new Intl.NumberFormat('es-MX', {
    style: 'currency',
    currency: 'MXN',
    minimumFractionDigits: 2,
    maximumFractionDigits: 2
});


function inicializarTablaDetalle(){
    if ($.fn.DataTable.isDataTable('#TablaDetallePaquete')) {
        return; // ⛔ ya existe, no reinicializar
    }
    // inicializar la tabla detalle de paquetes
    tablaDetallePaquetes = $("#TablaDetallePaquete").DataTable({
        scrollY: "63vh",
        scrollCollapse: true,
        ajax: {
            dataType: 'json',
            data: function(d){
                d.api = jsonDetallePaquete.api;
                d.id_paquete = jsonDetallePaquete.id_paquete;
            },
            method: 'POST',
            url: '../../../api/paquetes_api.php',
            dataSrc: 'response.data'
        },
        columns: [
            { data: 'SERVICIO' },
            { data: 'ABREVIATURA' },
            { data: 'COSTO_UNITARIO' },
            { data: 'PRECIO_VENTA_UNITARIO' },
            { data: 'PRECIO_REFERENCIA' },
        ],
        columnDefs: [
            { targets: 0, title: "Servicio" },
            { targets: 1, title: "Abreviatura" },
            // { targets: 2, title: "Costo Unitario" },
            // { targets: 3, title: "Precio Venta" },
            // { targets: 4, title: "Precio Referencia" }
            {
                targets: 2,
                title: 'Costo Unitario',
                render: function(data, type, row){
                    // para ordenar y buscar, devuelve solo numeros
                    if(type == "sort" || type == "type"){
                        return parseFloat(data);
                    }

                    // para mostrar en la tabla
                    return formatoMXN.format(parseFloat(data) || 0);
                },
                className: 'text-end'
            },
            {
                targets: 3,
                title: 'Precio Venta',
                render: function(data, type, row){
                    // para ordenar y buscar, devuelve solo numeros
                    if(type == "sort" || type == "type"){
                        return parseFloat(data);
                    }

                    // para mostrar en la tabla
                    return formatoMXN.format(parseFloat(data) || 0);
                },
                className: 'text-end'
            },
            {
                targets: 4,
                title: 'Precio Referencia',
                render: function(data, type, row){
                    // para ordenar y buscar, devuelve solo numeros
                    if(type == "sort" || type == "type"){
                        return parseFloat(data);
                    }

                    // para mostrar en la tabla
                    return formatoMXN.format(parseFloat(data) || 0);
                },
                className: 'text-end'
            }
        ]
    })
}

function destruirTablaDetallePaquete(){
      if ($.fn.DataTable.isDataTable('#TablaDetallePaquete')) {
        tablaDetallePaquetes.clear().destroy();
        tablaDetallePaquetes = null;
        bitDetallePaquete = false;
    }
}

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

            inicializarTablaDetalle();

        })
    });
}

// rellena la tabla con el servicio que se envie
function obtenertablaListaPrecios(columnDefs, columnsData, urlApi, dataAjax = {
    api: 7,
    id_area: 7
}, response = null, detallePaq = false) {
    dataEliminados = []

    //  if ($.fn.DataTable.isDataTable('#TablaListaPrecios')) {
    //     tablaPrecio.destroy(true); // 🔥 elimina eventos también
    //     $('#TablaListaPrecios').empty();
    // }

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

    // poder seleccionar rows de la tabla de paquetes.
    // doSelectableTablePack(tablaPrecio);
    if(detallePaq)    configurarClickFilas();
}

function mostrarDiscoveryPaquetes() {

    const KEY = 'discovery_paquetes_count';
    let veces = parseInt(localStorage.getItem(KEY) || '0');

    // 🔒 solo mostrar máximo 2 veces
    if (veces >= 2) return;

    // incrementar contador
    localStorage.setItem(KEY, veces + 1);

    // 🔥 crear alerta bonita
    const alerta = $(`
        <div id="discovery-paquetes" class="alert alert-info shadow"
             style="
                position: fixed;
                bottom: 20px;
                right: 20px;
                z-index: 2000;
                max-width: 320px;
                display: none;
             ">
            <strong>Tip 👆</strong><br>
            Puedes hacer <b>doble click</b> en un paquete para ver su detalle.
        </div>
    `);

    $('body').append(alerta);

    // animación suave
    alerta.fadeIn(400);

    // auto cerrar
    setTimeout(() => {
        alerta.fadeOut(400, function () {
            $(this).remove();
        });
    }, 5000);
}


function configurarClickFilas() {

    // 🔥 Limpiar eventos anteriores
    $('#TablaListaPrecios tbody').off('click', 'tr');
    $('#TablaListaPrecios tbody').off('dblclick', 'tr');

    $('#TablaListaPrecios tbody').on('click', 'tr', function () {

        // Si ya está seleccionada, no hacer nada
        if ($(this).hasClass('fila-seleccionada')) {
            return;
        }

        // Quitar selección anterior
        $('#TablaListaPrecios tbody tr').removeClass('fila-seleccionada');

        // Agregar selección a la actual
        $(this).addClass('fila-seleccionada');

        // Obtener datos del row
        const data = tablaPrecio.row(this).data();

        if (!data) return;

        idPaquete = data.ID_PAQUETE;

        console.log("Seleccionado:", idPaquete);
    });

    // =========================
    // DOBLE CLICK
    // =========================
    $('#TablaListaPrecios tbody').on('dblclick', 'tr', function () {

        const data = tablaPrecio.row(this).data();
        if (!data) return;

        idPaquete = data.ID_PAQUETE;
        // colocar el titulo al modal
        $("#tituloPaquete").text(data.DESCRIPCION);

        //recuperar el detalle del paquete
        jsonDetallePaquete['id_paquete'] = data.ID_PAQUETE;
        //vaciar la tabla
        $('#TablaDetallePaquete tbody').html(`
            <tr>
                <td colspan="5" class="text-center py-4">
                    <div class="spinner-border text-primary" role="status"></div>
                    <br>
                    Cargando información del paquete...
                </td>
            </tr>
        `);

        tablaDetallePaquetes.ajax.reload(null, false);
        

        // mostrar el modal
        var modal = new bootstrap.Modal(
            document.getElementById("ModalDetallePaquete"),
            {
                backdrop: 'static',
                keyboard: false
            }
        )
        modal.show();
    });
}


function doSelectableTablePack(tablaPrecio){

    // CODIGO PARA HACER SELEECIONABLE LOS ROWS DE LA TABLA
    selectTable("#TablaListaPrecios", tablaPrecio, {
            unSelect: true, ClickClass: [
                {
                    callback: async function (data) {
                        
                        // si no hay nada seleccionado, entonces nuleamos el paquete para no enviar el ultimo seleciconado
                        idPaquete = null;

                    }, selected: true
                },

            ], dblClick: true, reload: ['col-xl-9']
        },
        // un solo click 
        async function (select, data, callback) { 
            // SI NO hay selección → resetear variable global
            if (!select || !data) {
                idPaquete = null;
                // terminar la funcion
                return;
            }
            // SI sí hay selección → asignar datos
    
        }, // doble click
        async function (select, data, callback){

            if(!data) return;

            idPaquete = data.ID_PAQUETE;
            // colocar el titulo al modal
            $("#tituloPaquete").text(data.DESCRIPCION);

            //recuperar el detalle del paquete
            jsonDetallePaquete['id_paquete'] = data.ID_PAQUETE;
            //vaciar la tabla
            $('#TablaDetallePaquete tbody').html(`
                <tr>
                    <td colspan="5" class="text-center py-4">
                        <div class="spinner-border text-primary" role="status"></div>
                        <br>
                        Cargando información del paquete...
                    </td>
                </tr>
            `);

            tablaDetallePaquetes.ajax.reload(null, false);
            

            // mostrar el modal
            var modal = new bootstrap.Modal(
                document.getElementById("ModalDetallePaquete"),
                {
                    backdrop: 'static',
                    keyboard: false
                }
            )
            tablaDetallePaquetes.columns.adjust().draw(false);
            modal.show();
           
        }
    )

}

function mostrarDetallePaquete(id){


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
    dataEliminados = [];

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
            {className: 'min-tablet', width: "90.516px", title: "Referencia", targets: 8, orderable: false},
            {visible: false, title: "?", targets: 9, searchable: false,},
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
            // Funciones de hover
            $.getScript("contenido/js/funcionesHover.js");
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

function mostrarDiscoveryPaquetesPro() {

    const KEY = 'discovery_paquetes_pro_count';
    let veces = parseInt(localStorage.getItem(KEY) || '0');

    // 🔒 solo máximo 2 veces
    if (veces >= 2) return;

    // esperar a que la tabla exista
    const tabla = $('#TablaListaPrecios');
    if (!tabla.length) return;

    localStorage.setItem(KEY, veces + 1);

    // 🔥 overlay
    const overlay = $('<div class="discovery-overlay"></div>');
    $('body').append(overlay);

    // 🎯 spotlight
    tabla.addClass('discovery-spotlight');

    // 📍 calcular posición
    const offset = tabla.offset();

    // 💬 tooltip bonito
    const tooltip = $(`
        <div class="discovery-tooltip card shadow-lg">
            <div class="card-body">
                <div class="fw-bold mb-2">💡 Tip rápido</div>
                <div class="mb-3">
                    Haz <b>doble clic</b> en cualquier paquete
                    para ver su detalle.
                </div>
                <div class="text-end">
                    <button class="btn btn-primary btn-sm" id="btnCerrarDiscovery">
                        Entendido
                    </button>
                </div>
            </div>
        </div>
    `);

    $('body').append(tooltip);

    // posicionar tooltip
    tooltip.css({
        top: offset.top + 40,
        left: offset.left + tabla.outerWidth() - 340
    }).hide().fadeIn(300);

    // cerrar
    $('#btnCerrarDiscovery').on('click', function () {
        tooltip.fadeOut(200, () => tooltip.remove());
        overlay.fadeOut(200, () => overlay.remove());
        tabla.removeClass('discovery-spotlight');
    });

    // 🔥 auto cierre opcional (10s)
    setTimeout(() => {
        if ($('#btnCerrarDiscovery').length) {
            $('#btnCerrarDiscovery').trigger('click');
        }
    }, 10000);
}

$('#ModalDetallePaquete').on('shown.bs.modal', function () {
    if ($.fn.DataTable.isDataTable('#TablaDetallePaquete')) {
        tablaDetallePaquetes.columns.adjust().draw(false);
    }
});
