<?php
//Variables dinamicas;

session_start();
include "../../variables.php";
$menu = "Usuarios";
 ?>
<!DOCTYPE html>
<html lang="es" dir="ltr">
 <head>
   <?php include "../../include/head.php"; ?>
   <title>Administración | Bimo</title>
 </head>
 <body class="" id="body-controlador"> </body>
 <script type="text/javascript">
    vista('<?php echo $menu; ?>', '<?php echo $https.$url.'/nuevo_checkup/vista/menu/controlador/controlador.php'; ?>')
     function vista(menu, url){
       $.post(url, {menu: menu}, function(html){
          $("#body-controlador").html(html);
     	 });
     }


     // Verificar logeo :)
     $.getScript('<?php echo $https.$url.'/nuevo_checkup/vista/login/contenido/verificar.js';?>' ).done(function(){
       logginAdmin();
     });

 </script>
</html>
