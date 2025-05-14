<?php
//Variables dinamicas;
include "../../variables.php";

// Configuración de areas
$menu = "lista_servicios";

if ($_GET['filter'] == '[6,12]') {
  header('Location: https://bit.ly/45eBno8');
  exit;
}

?>
<!DOCTYPE html>
<html lang="es" dir="ltr">

<head>
  <?php include "../../include/head.php"; ?>
  <title>Servicios | Bimo</title>
</head>

<body class="" id="body-controlador"> </body>
<script type="text/javascript">
  // Definir el objeto que mapea los números de áreas a los nombres de áreas
  const areasMap = {
    1: "CONSULTORIO",
    2: "SOMATOMETRÍA",
    3: "OFTALMOLOGÍA",
    4: "AUDIOMETRÍA",
    5: "ESPIROMETRÍA",
    6: "LABORATORIO CLÍNICO",
    7: "IMAGENOLOGÍA",
    8: "RAYOS X",
    9: "PRUEBA DE ESFUERZO",
    10: "ELECTROCARDIOGRAMA",
    11: "ULTRASONIDO",
    12: "LABORATORIO BIOMOLECULAR",
    13: "CITOLOGÍA",
    14: "NUTRICIÓN",
    15: "COTIZACIONES",
    16: "TICKET",
    17: "CORTE",
    18: "CARDIOLOGÍA",
    19: "CHECKUPS"
  };

  // Obtener la cadena de consulta de la URL
  const url = window.location.search;
  const urlParams = new URLSearchParams(url);

  // Obtener el valor de la variable desde los parámetros
  const filter = urlParams.get("filter");

  let strings = [];

  // Verificar si la filter no es null ni está vacía
  if (filter) {
    // Convierte la cadena en un arreglo utilizando JSON.parse()
    strings = JSON.parse(filter);
  }

  // Mapear los números de áreas a nombres de áreas en un nuevo arreglo
  const areasString = strings.map(areaNumber => areasMap[areaNumber]);

  // Si no hay áreas seleccionadas, llenar el arreglo con todos los nombres de áreas
  if (areasString.length === 0) {
    areasString.push(...Object.values(areasMap));
  }

  vista('<?php echo $menu; ?>', '<?php echo $https . $url . '/' . $appname . '/vista/menu/controlador/controlador.php'; ?>')

  function vista(menu, url) {
    $.post(url, {
      menu: menu,
      tipoUrl: 3,
    }, function(html) {
      $("#body-controlador").html(html);
    });
  }
</script>

</html>