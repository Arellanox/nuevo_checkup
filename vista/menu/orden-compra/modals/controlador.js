$.post("modals/c_modal.php", function (html) {
  $("#modals-js").html(html);
}).done(function () {
  $.getScript("modals/js/modal_orden_compra.js");
});
