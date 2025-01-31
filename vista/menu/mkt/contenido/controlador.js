
if(validarVista('MKT_Y_VENTAS')){
    contenidoInventario();
} else {
    avisoArea();
    
}

async function contenidoInventario(){
    await obtenerTitulo('Marketing y ventas');

    $.post("contenido/mkt.html", function(html){
        $("#body-js").html(html);
    }).done(function(){
        $.getScript("contenido/js/mkt.js");
    })
}


var tableListaOportunidades;
var tableListaEmpresas;

var dataListaOportunidades;
var dataListaEmpresas;

var rowSelected;


dataListaOportunidades = {
    api: 2
}

dataListaEmpresas = {
    api: 3
}