<?php

// include_once '../../vista/variables.php';



date_default_timezone_set('America/Mexico_City');
// session_start();
// session_unset();
// session_destroy();


$clave = isset($_GET['clave']) ? $_GET['clave'] : null;
// echo $clave;
$area = isset($_GET['modulo']) ?  $_GET['modulo'] : null;

// folio
// $explode = preg_split("/(\d+)/", $id, -1, PREG_SPLIT_DELIM_CAPTURE);
// $folio_etiqueta = $explode[0];
// $folio_numero = $explode[1];
// $master = new Master();

$url1 = "http://localhost/nuevo_checkup/api/qr_api.php";
// Los datos de enviados
$datos = [
    "api" => 4,
    "fecha_inicial" => "2023-10-28",
    "fecha_final" => "2023-11-03",
];

// Crear opciones de la petición HTTP
$opciones = array(
    "http" => array(
        "header" => "Content-type: application/x-www-form-urlencoded\r\n",
        "method" => "POST",
        "content" => http_build_query($datos), # Agregar el contenido definido antes
    ),
);
# Preparar petición
$contexto = stream_context_create($opciones);
# Hacerla
$json = file_get_contents($url1, false, $contexto);

$res = json_decode($json, true);



$array = $res['response']['data'][0];

print_r($json);
echo '<pre>';
var_dump($json);
echo '</pre>';
exit;
