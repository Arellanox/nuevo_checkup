<?php
require_once "../clases/master_class.php";

$master = new Master;
$api = $_POST['api'];
$codigo = $_POST['codigo'];

switch($api){
    case 1:
        $response = $_POST;
        break;

    default:
        $response = "Servicio no disponible";
}

echo $master->returnApi($response);
