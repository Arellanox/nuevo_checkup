<?php
//Variables dinamicas;

include "../../variables.php";
$menu = "Recepción";
 ?>
<!DOCTYPE html>
<html lang="es" dir="ltr">
 <head>
   <?php include "../../include/head.php"; ?>
   <title><?php echo $menu; ?> | Bimo</title>
 </head>
 <div class="" id="body-controlador"> </div>
 <script type="text/javascript">
    vista('<?php echo $menu; ?>', '<?php echo $https.$url.'/nuevo_checkup/vista/menu/controlador/controlador.php'; ?>')
     function vista(menu, url){
       $.post(url, {menu: menu}, function(html){
          $("#body-controlador").html(html);
     	 });
     }
 </script>
</html>
