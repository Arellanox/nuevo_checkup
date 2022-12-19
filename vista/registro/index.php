<?php
//Variables dinamicas;
$codigo = isset($_GET['codigo']) ? $_GET['codigo'] : null;
$token = isset($_GET['token']) ? $_GET['token'] : null;
$ant = isset($_GET['ant']) ? $_GET['ant'] : null;
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
  const ant = '<?php echo $ant; ?>';
  let clienteRegistro;

  if (!codigo == token) {
    vista('<?php echo $menu; ?>', '<?php echo $https . $url . '/nuevo_checkup/vista/menu/controlador/controlador.php'; ?>')
  }else{
    redireccionarPrerregistro()
  }


  function vista(menu, url) {
    $.post(url, {
      menu: menu, tipoUrl: 3
    }, function(html) {
      $("#body-controlador").html(html);
    }).done(function(){
      validarToken();
    });
  }

  function validarToken(){
    if (codigo != null) {
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
      // $.ajax({
      //     data: {
      //       token: token,
      //       api: 1
      //     },
      //     url: "../../api/token_api.php",
      //     type: "POST",
      //     success: function(data) {
      //       data = jQuery.parseJSON(data);
      //       if (data.response.data[0]) {
      //         completarCliente(row['ID_CLIENTE'], row['NOMBRE_CLIENTE'])
      //       }else {
      //         redireccionarPrerregistro()
      //       }
      //     },
      //   });
    }else{
      redireccionarPrerregistro()
    }
  }

function completarCliente(id, name){
alert(name)
  $("#procedencia-registro").html(name)
  clienteRegistro = id
  rellenarSelect('#selectSegmentos','segmentos_api', 2,0,'DESCRIPCION', {cliente_id: clienteRegistro});
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
