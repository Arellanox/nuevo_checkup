<?php
    include "../variables.php";
    $codigo = $_GET['codigo'] ?? null;

    $menu = "Validar Certificación";
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <?php include "../include/head.php"; ?>
    <title><?php echo $menu; ?> | Bimo</title>
</head>

<body class="" id="body-controlador"></body>

<script type="text/javascript">
    const codigo = "<?= $codigo ?>";

    vista(
        '<?php echo $menu; ?>',
        '<?php echo $current_url . '/vista/menu/controlador/controlador.php'; ?>'
    );

    function vista(menu, url) {
        $.post(url, {menu: menu, tipoUrl: 3}, function (html) {
            $("#body-controlador").html(html);
        });
    }
</script>
</html>