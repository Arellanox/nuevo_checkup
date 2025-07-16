
if(validarVista('INVENTARIOS')){
    contenidoInventario();
    console.log(1);
} else {
    avisoArea();
    console.log(2)
}

async function contenidoInventario(){
    await obtenerTitulo('Inventarios');

    $.post("contenido/inventarios.html", function(html){
        $("#body-js").html(html);
    }).done(function(){
        $.getScript("contenido/js/inventarios.js");
        $.getScript("modals/js/movimientos.js");
    })
}

var tableCatArticulos;
var dataTableCatArticulos;
var dataTableCatEntradas;
var dataTableCatTransacciones;
var dataTableCatRequisiciones;
var dataTableCatTipos;
var dataTableCatMarcas;
var dataTableCatUnidades;
var dataTableCatMotivos;
var dataTableCatProveedores;


var rowSelected;


console.log(userPermissions);

dataTableCatArticulos = {
    api: 3
}

dataTableCatEntradas = {
    api: 4
}

dataTableCatDetallesEntradas = {
    api: 7
}

dataTableCatTransacciones = {
    api: 8
}

dataTableCatTipos = {
    api: 2
}

dataTableCatMarcas = {
    api: 9
}

dataTableCatUnidades = {
    api: 12
}

dataTableCatMotivos = {
    api: 15
}

dataTableCatProveedores = {
    api: 16
}

dataTableCatRequisiciones = {
    api: 25
}

dataTableCatEntradasEstable = {
    api: 4
}