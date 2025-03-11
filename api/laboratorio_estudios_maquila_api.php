<?php
include "../clases/master_class.php";
require_once "../clases/token_auth.php";

$tokenVerification = new TokenVerificacion();
$tokenValido = $tokenVerification->verificar();

if (!$tokenValido) {
    $tokenVerification->logout();
    exit;
}

$master = new Master();
$api = $_POST['api'];
$id_laboratorio_maquila = $_POST['LABORATORIO_MAQUILA_ID'];
$turno_id = $_POST['TURNO_ID'];
$servicio_id = $_POST['SERVICIO_ID'];
$usuario_id = $_SESSION['id'];

switch ($api) {
    case 1:
        $response = $master->insertByProcedure('sp_laboratorio_estudios_maquila_g', [
            $turno_id, $servicio_id, $id_laboratorio_maquila, $usuario_id
        ]);

        try {
            $vinculo = '#';
            $procedureName = "sp_notificaciones_generar_g";
            $mensaje =  "Solicitud de aprobación de maquilación generada por ".$_SESSION['nombre'];

            $master->insertByProcedure($procedureName, [$usuario_id, $mensaje, $vinculo, 15]);
            $master->insertByProcedure($procedureName, [$usuario_id, $mensaje, $vinculo, 2]);
            $master->insertByProcedure($procedureName, [$usuario_id, $mensaje, $vinculo, 20]);
        } catch (Exception $exception){
            $this->mis->setLog('Error al generar notificación', 'sp_notificaciones_generar_g');
        }

        break;
    default:
        $response = "API no definida";;
        break;
}

echo $master->returnApi($response);