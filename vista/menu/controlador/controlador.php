<?php
$menu = $_POST['menu'];
date_default_timezone_set('America/Mexico_City');
session_start();

?>

<!-- HTML -->
<header id="header-js"></header>
<div  id="titulo-js"></div>
<div class="container-fluid " id="body-js"> </div>
<div class="" id="modals-js"> <!-- Aqui podrán incluir los modals --> </div>

<script type="text/javascript">
  //Variable global para datatable
  var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
  var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
    return new bootstrap.Tooltip(tooltipTriggerEl)
  })
  let http = "http://";
  let servidor = "localhost";
  // let http = "https://";
  // let servidor = "bimo-lab.com";
  // <!-- Aqui controlar e incluir las modals -->
  obtenerHeader('<?php echo $menu ?>');

  function obtenerHeader(menu){
    $.post("<?php echo $https.$url.'/nuevo_checkup/vista/include/header/header.php';?>", {menu: menu}, function(html){
       $("#header-js").html(html);
    });
  }
  function obtenerTitulo(menu, callback = function(){}){ //callback para no tener problema con la fecha
    return new Promise(resolve => {
      $.post("<?php echo $https.$url.'/nuevo_checkup/vista/include/header/titulo.php';?>", {menu: menu}, function(html){
         $("#titulo-js").html(html);
      }).done(function(){
        callback(1)
        resolve(1);
      });
    });
  }


  let array_selected;
  let array_user;
  const session = <?php echo json_encode($_SESSION); ?>;
  $.getScript("<?php echo $https.$url.'/nuevo_checkup/vista/menu/controlador/class.js';?>").done(function() {
    $.getScript("<?php echo $https.$url.'/nuevo_checkup/vista/menu/controlador/funciones.js';?>").done(function() {
      $(function(){

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
  });
</script>
