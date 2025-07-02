<?php
    //Variables dinamicas;
    include "../../../variables.php";
    include "../validator.php";

    // Validar área antes de usarla
    $validacion = AreaValidator::validarArea();
    $menu = "Reportes de Excel Dinamicos";
?>
<!DOCTYPE html>
<html lang="es" dir="ltr">

<head>
    <?php include "../../../include/head.php"; ?>
    <title>Reportes | Checkup</title>
</head>

<body class="" id="body-controlador"> </body>
    <script type="text/javascript">
        vista('<?= $menu; ?>', '<?= $https . $url . '/' . $appname . '/vista/menu/controlador/controlador.php'; ?>')

        var isValid = <?= $validacion['valida'] ?>;
        var area = {
            valida: isValid,
            area: '<?= addslashes($validacion['area'] ?? ''); ?>',
            id: <?= $validacion['id'] ?? 'null'; ?>,
            normalizada: '<?= addslashes($validacion['normalizada'] ?? ''); ?>'
        }

        function vista(menu, url) {
            $.post(url, {menu: menu, isValid: isValid, area: area}, function(html) {
                $("#body-controlador").html(html);
            });
        }
    </script>
</html>