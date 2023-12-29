<?php
include_once '../clases/master_class.php';
include_once '../clases/token_auth.php';
include "../clases/correo_class.php";

$master = new Master();
$api = $_POST['api'];

//Datos a enviar
$nombre_completo = $_POST['nombre_completo'];
$fecha_nacimiento = $_POST['fecha_nacimiento'];
$telefon = $_POST['telefon'];
$orden_medica = $_POST['orden_medica'];


switch ($api) {
    case 1:
        // Envia los datos al correo
        // $response = $master->insertByProcedure('sp_valores_referencia_g', $insert_datos);
        break;


    default:
        $response = "API no definida";
        break;
}

echo $master->returnApi($response);
