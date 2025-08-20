<?php
    include "../variables.php";
    $menu = "NONE";
    session_unset();
    session_destroy();
?>
<!DOCTYPE html>
<html lang="es" dir="ltr">

<head>
    <?php include "../include/head.php"; ?>
    <title>Presentación | Bimo</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <style type="text/tailwindcss">
        @theme {
            --color-clifford: #da373d;
            --color-lab-dark: #004e59;
            --color-lab-accent: #ffc107;
        }
    </style>
</head>

<body id="body-controlador" style="background: oklch(96.7% 0.003 264.542) !important; padding-top: 20px; padding-bottom: 20px"> </body>
<script type="text/javascript">
    vista('<?php echo $menu; ?>', '<?php echo $https . $url . '/' . $appname . '/vista/menu/controlador/controlador.php'; ?>')

    function vista(menu, url) {
        $.post(url, {
            menu: menu,
            tipoUrl: 3
        }, function(html) {
            $("#body-controlador").html(html);
        });
    }
</script>
</html>