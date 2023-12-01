$.post("modals/a_modals.php", function (html) {
    $("#modals-js").html(html);
  }).done(() => {
    
    // Modal para certificado SLB
    $.getScript("modals/js/mo_btn_global.js");
  
  });