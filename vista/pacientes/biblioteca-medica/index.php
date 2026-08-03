<?php
include "../../variables.php";

// Se reutiliza el encabezado público de Servicios disponibles.
$menu = "lista_servicios";
?>
<!DOCTYPE html>
<html lang="es" dir="ltr">

<head>
  <?php include "../../include/head.php"; ?>
  <title>Biblioteca médica | Bimo</title>
</head>

<body id="body-controlador"></body>

<script type="text/javascript">
  vista('<?php echo $menu; ?>', '<?php echo $https . $url . '/' . $appname . '/vista/menu/controlador/controlador.php'; ?>');

  function vista(menu, url) {
    $.post(url, {
      menu: menu,
      tipoUrl: 3,
    }, function (html) {
      $("#body-controlador").html(html);
    });
  }
</script>

</html>
