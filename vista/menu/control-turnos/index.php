<?php
//Variables dinamicas;
include "../../variables.php";
$menu = "PrincipalMenu";
?>
<!DOCTYPE html>
<html lang="es" dir="ltr">

<head>
    <?php include "../../include/head.php"; ?>
    <title>Bienvenido a bimo </title>
</head>


<body class="" id="body-controlador"> </body>
<script type="text/javascript">
    registroAgendaRecepcion = 1;
    nombreCliente = null;
    ant = false; // registro
    tip = "pie"; // registro-agenda
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