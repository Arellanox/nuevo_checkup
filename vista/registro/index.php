<?php
//Variables dinamicas;
$codigo = isset($_POST['code']) ? $_POST['code'] : null;
$token = isset($_POST['token']) ? $_POST['token'] : null;
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
  let codigo = '<?php echo $codigo; ?>';
  let token = '<?php echo $token; ?>';


  if (codigo == token) {
    alert('No tienes acceso')
  } else if (codigo != null) {


    $.ajax({
      data: {
        codigo: '<?php echo $codigo; ?>',
        api: 6
      },
      url: "../../api/clientes_api.php",
      type: "POST",
      success: function(data) {
        data = jQuery.parseJSON(data);
        if (data.response.data != null) {
          row = data.response.data[0]
          $("#procedencia-registro").html(row['NOMBRE_CLIENTE'])
        } else {
          alert("No tienes Accesso")
        }
      },
    });
  } else if (token != null) {



    $.ajax({
      data: {
        token: '<?php echo $token; ?>',
        api: 1
      },
      url: "../../api/token_api.php",
      type: "POST",
      success: function(data) {
        data = jQuery.parseJSON(data);
        if (data.response.data != null) {
          $("#procedencia-registro").html('PARTICULAR')
        } else {
          alert("No tienes Accesso")
        }
      },
    });

  } else {
    alert('No tienes acceso')
  }

  vista('<?php echo $menu; ?>', '<?php echo $https . $url . '/nuevo_checkup/vista/menu/controlador/controlador.php'; ?>')

  function vista(menu, url) {
    $.post(url, {
      menu: menu
    }, function(html) {
      $("#body-controlador").html(html);

    });
  }
</script>

</html>