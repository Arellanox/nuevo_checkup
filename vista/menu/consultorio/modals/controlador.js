$.post("modals/a_modals.php", function (html) {
  $("#modals-js").html(html);


  $.getScript('modals/js/modal_consulta.js')
});
