
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
var dataTableRequisiciones;
var requisicionSelected;


dataTableRequisiciones = {
    api: 1
}
