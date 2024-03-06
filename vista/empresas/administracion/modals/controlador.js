$.post("modals/a_modals.php", function (html) {
    $("#modals-js").html(html);
  
    // Modal para crear consulta
    $.getScript('modals/js/m-facturas.js');
  
  });
  