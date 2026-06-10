<?php
require_once "../clases/master_class.php";
require_once "../clases/token_auth.php";

$tokenVerification = new TokenVerificacion();
$tokenValido = $tokenVerification->verificar();

$master = new Master();
$api = $_POST['api'];

switch($api){
    case 1:
        # datos generales
        $response = $master->insertByProcedure("", []);
        break;
}

echo $master->returnApi($response);