<?php
//Variables dinamicas;
session_start();
include "../../variables.php";
$menu = "Inventarios";

?>
<!DOCTYPE html>
<html lang="es" dir="ltr">

<head>
    <?php include "../../include/head.php"; ?>
    <title>Inventarios | Bimo</title>
</head>

<body class="" id="body-controlador"> </body>
<script type="text/javascript">
    var edit = <?php echo empty($_SESSION['permisos']['invRegArt']) ? 0 : $_SESSION['permisos']['invRegArt']; ?>;
    var supr = <?php echo empty($_SESSION['permisos']['invEliArt']) ? 0 : $_SESSION['permisos']['invEliArt']; ?>;
    //preguntar si sirve
    var editEntradas = <?php echo empty($_SESSION['permisos']['invRegEnt']) ? 0 : $_SESSION['permisos']['invRegEnt']; ?>;
    var invVerTrans = <?php echo (isset($_SESSION['permisos']['invVerTrans']) && $_SESSION['permisos']['invVerTrans'] == 1) ? 1 : 0; ?>;

    var userPermissions = {
        canEdit: edit === 1,
        canDelete: supr === 1,
        canEditEntradas: editEntradas === 1,
        canViewTransactions: invVerTrans === 1
    }

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