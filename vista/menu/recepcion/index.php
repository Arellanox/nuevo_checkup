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

<body class="" id="body-controlador"> </body>
<script type="text/javascript">
  registroAgendaRecepcion = 1;
  nombreCliente = null;
  language = '';
  let clienteRegistro = 0; //<-- Oculta los segmentos de registro de paciente.


  ant = false; // registro
  espiro = false;

  tip = "pie"; // registro-agenda
  vista('<?php echo $menu; ?>', '<?php echo $https . $url . '/' . $appname . '/vista/menu/controlador/controlador.php'; ?>')

  function vista(menu, url) {
    $.post(url, {
      menu: menu
    }, function(html) {
      validar = true;
      $("#body-controlador").html(html);
    });
  }
</script>


</html>