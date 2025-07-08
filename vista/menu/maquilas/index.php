<?php
    //Variables dinamicas;
    include "../../variables.php";
    $menu = "Maquilas";
?>

<!DOCTYPE html>
<html lang="es" dir="ltr">

<head>
    <?php include "../../include/head.php"; ?>
    <title>Maquilas | Bimo</title>
</head>

<body class="" id="body-controlador"> </body>
<script type="text/javascript">
    vista('<?= $menu; ?>', '<?= $https . $url . '/' . $appname . '/vista/menu/controlador/controlador.php'; ?>')

    function vista(menu, url) {
        $.post(url, {menu: menu}, function(html) {
            $("#body-controlador").html(html);
        });
    }
</script>

</html>