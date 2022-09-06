<?php




$menu = $_POST['menu'];
require_once "funciones.php";
?>

<!-- HTML -->
<header id="header-js"></header>
<div  id="titulo-js"></div>
<div class="container-fluid " id="body-js"> </div>
<div class="" id="modals-js"> <!-- Aqui podrán incluir los modals --> </div>

<script type="text/javascript">
  obtenerHeader('<?php echo $menu ?>');
  function obtenerHeader(menu){
    $.post("<?php echo $https.$url.'/nuevo_checkup/vista/include/header/header.php';?>", {menu: menu}, function(html){
       $("#header-js").html(html);
    });
  }
  function obtenerTitulo(menu){
    $.post("<?php echo $https.$url.'/nuevo_checkup/vista/include/header/titulo.php';?>", {menu: menu}, function(html){
       $("#titulo-js").html(html);
    });
  }
  // <!-- Aqui controlar e incluir las modals -->
  $.getScript('modals/controlador.js');

  // <!-- Aqui controlar e incluir los tablas -->
  $.getScript('contenido/controlador.js');

</script>
