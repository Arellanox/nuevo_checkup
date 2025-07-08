contenidoMaquilas();

async function contenidoMaquilas(){
    await obtenerTitulo('Requisición Maquilas');

    $.post("contenido/maquila.php", function(html){
        $("#body-js").html(html);
    }).done(function(){
        $.getScript("contenido/js/maquilas.js");
    })
}

