$.post("modals/a_modals.php", function (html) {
    $("#modals-js").html(html);
  
    // Modal para ver las facturas
    $.getScript('modals/js/m-facturas.js');

    // Modal para ver la lista de precios
    $.getScript('modals/js/m-lista_precios.js');

    // Modal para consultar los lotes enviado
    $.getScript('modals/js/c-lotes_enviados.js');


  
  });
  