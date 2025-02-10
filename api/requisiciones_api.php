<?php
include_once "../clases/master_class.php";
require_once "../clases/token_auth.php";

$tokenVerification = new TokenVerificacion();
$tokenValido = $tokenVerification->verificar();
if (!$tokenValido) {
    $tokenVerification->logout();
    exit;
}

$master = new Master();
$api = $_POST['api'];

$id_requisicion = $_POST['id_requisicion'];

switch($api){
    case 1:
        $response = $master->getByProcedure('sp_reqmaquilas_requisiciones_b', [$id_requisicion]);
        break;

    default:
        $response = "Api no definida.";
        break;
}

echo $master->returnApi($response);