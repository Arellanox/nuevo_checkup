<?php
    include "../../variables.php";
    $menu = "cimmo";
?>
<!DOCTYPE html>
<html lang="es" dir="ltr">

<head>
    <?php include "../../include/head.php"; ?>
    <title>CIMMO</title>
</head>

<body class="" id="body-controlador"> </body>
<script type="text/javascript">
    vista('<?php echo $menu; ?>', '<?php echo $https . $url . '/' . $appname . '/vista/menu/controlador/controlador.php'; ?>')

    function vista(menu, url) {
        $.post(url, {
            menu: menu
        }, function(html) {
            validar = true;
            $("#body-controlador").html(html);
        });
    }
</script>


</html>