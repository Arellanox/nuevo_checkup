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
$estado = $_POST['estado'];

switch($api){
    case 1:
        # recuperara todas las requisiciones
        $response = $master->getByProcedure('sp_reqmaquilas_requisiciones_b', [$id_requisicion]);
        break;
    case 2:
        # cambiar estado de una requisicion
        $response = $master->updateByProcedure("sp_reqmaquilas_requisiciones_cambiar_estado",[$id_requisicion, $estado, $_SESSION['id']]);
        break;

    default:
        $response = "Api no definida.";
        break;
}

echo $master->returnApi($response);