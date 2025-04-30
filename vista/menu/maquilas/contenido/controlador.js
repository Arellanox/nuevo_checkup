if(validarVista('REQUISICION_MAQUILAS')){
    contenidoMaquilas().then(r => {});
} else avisoArea();

async function contenidoMaquilas(){
    await obtenerTitulo('Requisición Maquilas');

    $.post("contenido/maquilas.php", function(html){
        $("#body-js").html(html);
    }).done(function(){
        $.getScript("contenido/js/maquilas.js");
    })
}

