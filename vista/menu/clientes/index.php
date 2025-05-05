<?php
    include "../../variables.php";
    $menu = "Clientes";
?>
<!DOCTYPE html>
<html lang="es" dir="ltr">

<head>
  <?php include "../../include/head.php"; ?>
  <title><?php echo $menu; ?> | Bimo</title>
    <style>
        .pdf-uploads > label {
            width: 100%;
            color: #5a5a5a;
        }
        .view-pdf-btn{
            margin-top: 2px;
            border: 2px solid #004f5a !important;
        }
        .hidden{
            display: none !important;
        }
        .subtitle{
            color: #004f5a !important;
            font-weight: 600 !important;
            font-size: 20px !important;
            margin-bottom: 2px;
        }
    </style>
</head>

<body class="" id="body-controlador"> </body>

<script type="text/javascript">
  vista('<?php echo $menu; ?>', '<?php echo $https . $url . '/' . $appname . '/vista/menu/controlador/controlador.php'; ?>')

  function vista(menu, url) {
    $.post(url, {
      menu: menu
    }, function(html) {
      $("#body-controlador").html(html);
    });
  }
</script>

</html>