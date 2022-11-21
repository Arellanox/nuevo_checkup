<?php
//Variables dinamicas;
session_start();
include "../../variables.php";
$menu = "ServiciosLab";
$area = isset($_GET['var'])? $_GET['var']: 0;
// echo $area;
 ?>
<!DOCTYPE html>
<html lang="es" dir="ltr">
 <head>
   <?php include "../../include/head.php"; ?>
   <title><?php echo $menu; ?> | Bimo</title>
 </head>
 <body class="" id="body-controlador"> </body>
 <script type="text/javascript">
  areaActual = "<?php echo $area; ?>";
  // console.log(areaActual);
    vista('<?php echo $menu; ?>', '<?php echo $https.$url.'/nuevo_checkup/vista/menu/controlador/controlador.php'; ?>')
     function vista(menu, url){
       $.post(url, {menu: menu}, function(html){
          $("#body-controlador").html(html);
     	 });
     }
 </script>
</html>
