<?php
//Variables dinamicas;
include "../../variables.php";
$menu = "CursosBimo";
?>
<!DOCTYPE html>
<html lang="es" dir="ltr">

<head>
    <?php include "../../include/head.php"; ?>
    <title>Cursos | Bimo</title>
</head>

<body class="" id="body-controlador"> </body>
<script type="text/javascript">
    vista('<?php echo $menu; ?>', '<?php echo $https . $url . '/' . $appname . '/vista/menu/controlador/controlador.php'; ?>')

    function vista(menu, url) {
        $.post(url, {
            menu: menu
        }, function(html) {
            $("#body-controlador").html(html);
        });
    }
</script>

</html>