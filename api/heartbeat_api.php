<?php
require_once "../clases/master_class.php";

$master = new Master();

// Leer la entrada JSON
$inputData = file_get_contents('php://input');
$datos = json_decode($inputData, true);

// recibir datos en variables
$server_id = $datos["server_id"];
$timestamp = date("Y-m-d H:i:s");

$response = $master->getByNext("sp_heartbeats_g", [$server_id]);


if(is_numeric($response[0][0]["LAST"])){
    // Devolver señal...
    echo json_encode(["status" => "OK", "received_at" => $response[1][0]["ULTIMA_SENIAL"]]);
} else {
    echo json_encode(["status" => "ERROR", "received_at" => $timestamp]);
}