<?php
$menu = $_POST['menu'];
?>

<!-- HTML -->
<header id="header-js"></header>
<body> <div class="container-fluid" id="body-js"> </div> </body>
<div class="" id="modals-js"> <!-- Aqui podrán incluir los modals --> </div>

<script type="text/javascript">
  obtenerHeader('<?php echo $menu ?>');
  function obtenerHeader(menu){
    $.post("<?php echo $https.$url.'/nuevo_checkup/vista/include/header/header.php';?>", {menu: menu}, function(html){
       $("#header-js").html(html);
    });
  }

  // <!-- Aqui controlar e incluir las tablas -->
  $.getScript('modals/controlador.js');
  // <!-- Aqui controlar e incluir los modals -->
  $.getScript('tablas/controlador.js');
</script>
