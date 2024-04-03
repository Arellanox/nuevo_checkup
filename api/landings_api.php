<?php

$datos = json_decode(file_get_contents('php://input'), true);

header("Access-Control-Allow-Origin: https://bimo.com.mx");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization");
// Asegúrate de incluir cualquier otro método o cabecera que tu API necesite
require_once "../clases/master_class.php";

$master = new Master;
$api = $datos['api'];
$codigo = $datos['codigo'];

switch($api){
    case 1:
        $response = $datos;
        break;

    default:
        $response = "Servicio no disponible";
}

echo $master->returnApi($response);
