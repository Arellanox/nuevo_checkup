
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
    })
}

var tableCatArticulos;
var dataTableCatArticulos;
var rowSelected;

console.log(userPermissions);

dataTableCatArticulos = {
    api: 3
}
