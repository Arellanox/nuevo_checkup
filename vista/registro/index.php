<?php
//Variables dinamicas;
$codigo = $_GET['cod']?$_GET['cod']:"473nakidsjbd";
include "../variables.php";
$menu = "Preregistro";
 ?>
<!DOCTYPE html>
<html lang="es" dir="ltr">
 <head>
   <?php include "../include/head.php"; ?>
   <title><?php echo $menu; ?> | Bimo</title>
 </head>
 <body class="" id="body-controlador"> </body>
 <script type="text/javascript">
    var logeo = 1;
    vista('<?php echo $menu; ?>', '<?php echo $https.$url.'/nuevo_checkup/vista/menu/controlador/controlador.php'; ?>')
     function vista(menu, url){
       $.post(url, {menu: menu}, function(html){
          $("#body-controlador").html(html);

     	 });
     }

     // $.ajax({
     //   data: {id: '<?php echo $codigo; ?>', api: 6},
     //   url: "../../api/clientes_api.php",
     //   type: "POST",
     //   success: function(data) {
     //     array_selected = jQuery.parseJSON(data);
     //     setTimeout(function(){
     //       $("#procedencia-preregistro").val(array_selected['response']['data'][0]['NOMBRE_SISTEMA']);
     //     }, 1000)
     //   },
     // });
 </script>
</html>
