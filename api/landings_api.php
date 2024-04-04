<?php

$datos = json_decode(file_get_contents('php://input'), true);

header("Access-Control-Allow-Origin: https://bimo.com.mx");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization");
// Asegúrate de incluir cualquier otro método o cabecera que tu API necesite
require_once "../clases/master_class.php";

$master = new Master;
$api = $datos['api'];
$id_area = $datos['id_area'];
$nombre = $datos['nombre'];
$email = $datos['email'];
$telefono = $datos['telefono'];

switch($api){
    case 1:
        $response = $master->insertByProcedure('sp_landings_g', [
            $nombre,
            $email,
            $telefono,
            $id_area
        ]);
        break;

    default:
        $response = "Servicio no disponible";
}

echo $master->returnApi($response);
