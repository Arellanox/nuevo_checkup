$.post("modals/p_modal.php", function (html) {
    $("#modals-js").html(html);
}).done(function () {
    $.getScript('modals/js/m_consentimiento.js');
});
