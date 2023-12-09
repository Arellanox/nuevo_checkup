<?php

require_once "../clases/master_class.php";
require_once "../clases/token_auth.php";

$tokenVerification = new TokenVerificacion();
$tokenValido = $tokenVerification->verificar();
if (!$tokenValido) {
    $tokenVerification->logout();
    exit;
}

//Api
$api = $_POST['api'];

$response = "";
$master = new Master();

switch($api){
    case 1:
        break;
    default:
        $response = "api no reconocida " . $api;
        break;    
}

echo $master->returnApi($response);