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
$servicio_id = $_POST['servicio_id'];
$motivo_rechazo = $_POST['motivo_rechazo'];

switch($api){
    case 1:
        # recuperara todas las requisiciones
        $response = $master->getByProcedure('sp_reqmaquilas_requisiciones_b', [$id_requisicion]);
        break;
    case 2:
        # cambiar estado de una requisicion
        $response = $master->updateByProcedure("sp_reqmaquilas_requisiciones_cambiar_estado",[$id_requisicion, $estado, $_SESSION['id'], $motivo_rechazo]);
        break;
    case 3:
        # recuperar el detalle de las requisiciones
        $response = $master->getByProcedure('sp_reqmquilas_detalle_requisicion_b',[ $id_requisicion]);
        break;
    case 4:
        # cambiar estado detalle requisicion
        $response = $master->updateByProcedure('sp_reqmaquilas_detalle_requisicion_cambiar_estado', [
            $id_requisicion, 
            $servicio_id, 
            $estado,
            $_SESSION['id']
        ]);
        break;

    default:
        $response = "Api no definida.";
        break;
}

echo $master->returnApi($response);