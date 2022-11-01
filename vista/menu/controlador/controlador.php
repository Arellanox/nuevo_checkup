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

  let http = "http://";
  let servidor = "localhost";
  // <!-- Aqui controlar e incluir las modals -->
  obtenerHeader('<?php echo $menu ?>');

  function obtenerHeader(menu){
    $.post("<?php echo $https.$url.'/nuevo_checkup/vista/include/header/header.php';?>", {menu: menu}, function(html){
       $("#header-js").html(html);
    });
  }
  function obtenerTitulo(menu){
    return new Promise(resolve => {
      $.post("<?php echo $https.$url.'/nuevo_checkup/vista/include/header/titulo.php';?>", {menu: menu}, function(html){
         $("#titulo-js").html(html);
      }).done(function(){
        resolve(1);
      });
    });
  }

  $.getScript("<?php echo $https.$url.'/nuevo_checkup/vista/menu/controlador/funciones.js';?>").done(function() {
    $(function(){
      let array_selected;
      let array_user;
      const session = <?php echo json_encode($_SESSION); ?>;
      session['id'] = '';
      session['token'] = '';
      // console.log(session)
      // <!-- Aqui controlar e incluir las modals -->
      $.getScript('modals/controlador.js');
      // <!-- Aqui controlar e incluir los tablas -->
      $.getScript('contenido/controlador.js');
    })
    // console.log(session);
  });
</script>
