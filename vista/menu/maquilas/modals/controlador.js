$.post("modals/modals.php", function(html){
    $("#modals-js").html(html);
}).done(function () { });
