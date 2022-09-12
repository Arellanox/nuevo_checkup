<?php
$menu = $_POST['menu'];
session_start();

?>

<!-- HTML -->
<header id="header-js"></header>
<div  id="titulo-js"></div>
<div class="container-fluid " id="body-js"> </div>
<div class="" id="modals-js"> <!-- Aqui podrán incluir los modals --> </div>

<script type="text/javascript">
  //Variable global para datatable
  var array_selected;
  var array_user;
  // <!-- Aqui controlar e incluir las modals -->
  $.getScript('http://localhost/nuevo_checkup/vista/menu/controlador/funciones.js');


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

  session = <?php echo json_encode($_SESSION); ?>;
  // console.log(session);
</script>
