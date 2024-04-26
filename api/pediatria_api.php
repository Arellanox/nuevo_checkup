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

$master = new Master();

$antecedentes = $_POST['antecedentes'];
$turno_id = $_POST['turno_id'];

switch($api){
    case 1:
        # insertar/actualizar antecedentes
        $response = $master->insertByProcedure('sp_historia_pediatrica_g', [$turno_id, json_encode($antecedentes)]);
        break;
    case 2:
        # buscar los antecedentes
        $response = $master->getByProcedure("sp_historia_pediatrica_b", []);
        break;
    default:
        $response = "api no reconocida " . $api;
        break;    
}

echo $master->returnApi($response);