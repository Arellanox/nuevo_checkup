<?php
require_once "../clases/master_class.php";
require_once "../clases/token_auth.php";

$tokenVerification = new TokenVerificacion();
$tokenValido = $tokenVerification->verificar();
if (!$tokenValido) {
    $tokenVerification->logout();
    exit;
}

$master = new Master();

$api = $_POST['api'];


switch ($api) {
    case 1:
        //Busca y trae todo lo que se pida en el filtro de reporte de epidemiologia
        $response = $master->getByProcedure("sp_notificacion_epidemiologica_reporte", []);
        break;

    default:
        $response = "api no reconocida";
        break;
}
echo $master->returnApi($response);
