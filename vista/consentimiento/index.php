<?php
//Variables dinamicas;
include "../variables.php";
#Aqui se recibe el ID del equipo que llega por la URL 
// $equipo_id = $_GET['equipo'];
$menu = "Consentimiento_paciente";
?>
<!DOCTYPE html>
<html lang="es" dir="ltr">

<head>
    <?php include "../include/head.php"; ?>
    <title>Consentimiento del paciente | Bimo</title>
</head>

<body class="" id="body-controlador"> </body>
<script type="text/javascript">
    vista('<?php echo $menu; ?>', '<?php echo $https . $url . '/' . $appname . '/vista/menu/controlador/controlador.php'; ?>')

    function vista(menu, url) {
        $.post(url, {
            menu: menu,
            tipoUrl: 3
        }, function(html) {
            validar = true;
            $("#body-controlador").html(html);
        });
    }
</script>


</html>