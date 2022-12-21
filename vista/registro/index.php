<?php
//Variables dinamicas;
$codigo = isset($_GET['codigo']) ? $_GET['codigo'] : null;
$token = isset($_GET['token']) ? $_GET['token'] : null;
$tip = isset($_GET['tip']) ? $_GET['tip'] : null;
include "../variables.php";
$menu = "Prerregistro";
?>

<!DOCTYPE html>
<html lang="es" dir="ltr">

<head>
  <?php include "../include/head.php"; ?>
  <title><?php echo $menu; ?> | Bimo</title>
</head>

<body class="" id="body-controlador"> </body>
<script type="text/javascript">
  var logeo = 1, registroAgendaProcedencia = 0;
  const codigo = '<?php echo $codigo; ?>';
  const token = '<?php echo $token; ?>';
  console.log(token)
  let tip = '<?php echo $tip; ?>';
  let clienteRegistro, nombreCliente, ant;
  console.log(codigo);
  if (codigo != token) {
    validarToken()
  }else{
    redireccionarPrerregistro()
  }


  function vista(menu, url, tip) {
    $.post(url, {
      menu: menu, tipoUrl: 3, tip: tip
    }, function(html) {
      $("#body-controlador").html(html);
    }).done(function(){
      // validarToken();
    });
  }

  function validarToken(){
    if (codigo != null && codigo != '') {
        $.ajax({
          data: {
            qr: codigo,
            api: 2
          },
          url: "../../api/clientes_api.php",
          type: "POST",
          success: function(data) {
            data = jQuery.parseJSON(data);
            row = data.response.data[0];
            // console.log(row);
            if (data.response.data[0]) {
              completarCliente(row['ID_CLIENTE'], row['NOMBRE_COMERCIAL'])
            }else {
              redireccionarPrerregistro()
            }

          },
        });
    }else if (token != null) {
      console.log(token);
      $.ajax({
          data: {
            token: token,
            api: 2
          },
          url: "../../api/preregistro_correo_token_api.php",
          type: "POST",
          success: function(data) {
            data = jQuery.parseJSON(data);
            if (data.response.data[0]) {
              completarCliente(1, 'PARTICULAR')
            }else {
              // redireccionarPrerregistro()
            }
          },
        });
    }else{
      alert(1);
      redireccionarPrerregistro()
      return;
    }
  }
  
  function completarCliente(id, name){
    // alert(name)
    nombreCliente = name
    clienteRegistro = id
    
    if(id == 1)
    ant = true;
    
    //Mostrar Vista
    vista('<?php echo $menu; ?>', '<?php echo $https . $url . '/nuevo_checkup/vista/menu/controlador/controlador.php'; ?>', '<?php echo $tip; ?>')
}

function redireccionarPrerregistro(){
  $('#body-controlador').html('');
  alert('No tienes acceso a este sitio');
  window.location.href = 'https://www.google.com';
}

  // else if (codigo != null) {

  // } else if (token != null) {
  //
  //
  // } else {
  //   alert('No tienes acceso 4')
  // }
</script>

</html>
