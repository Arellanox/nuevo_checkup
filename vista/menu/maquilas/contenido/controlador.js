
if(validarVista('REQUISICION_MAQUILAS')){
    contenidoMaquilas();

} else {
    avisoArea();
}

async function contenidoMaquilas(){
    await obtenerTitulo('Requisición Maquilas');

    $.post("contenido/maquilas.html", function(html){
        $("#body-js").html(html);
    }).done(function(){
        $.getScript("contenido/js/maquilas.js");
    })
}


var tableRequisiciones;
var tableDetalleRequisicion;
var dataTableRequisiciones;
var dataTableDetalleRequisicion;
var requisicionSelected;

var estadoGlobal;
var tipoGlobal; // 1 para requisicion, 2 para detalle de requisicion
var idReqGlobal;
var idServicioGlobal;
var idTurnoGlobal;


dataTableRequisiciones = {
    api: 1
}

dataTableDetalleRequisicion = {
    
}
