<?php
require_once "../clases/master_class.php";
require_once "../clases/token_auth.php";

$tokenVerification = new TokenVerificacion();
$tokenValido = $tokenVerification->verificar();
if (!$tokenValido) {
    // $tokenVerification->logout();
    // exit;
}

$master = new Master();


$api = $_POST['api'];
$turno_id = $_POST['turno_id'];







switch ($api) {
    case 1:
        $response = $master->getByProcedure("sp_consentimiento_formato_b", [$turno_id]);
        break;

    default:
        $response = "api no reconocida";
        break;
}

echo $master->returnApi($response);
