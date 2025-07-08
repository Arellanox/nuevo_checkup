<?php
require_once "../clases/master_class.php";
require_once "../clases/token_auth.php";

$tokenVerification = new TokenVerificacion();
$tokenValido = $tokenVerification->verificar();

$json_data = json_decode(file_get_contents("php://input"), true);

$master = new Master();

$api = $json_data['api'] ?? $_POST['api'] ?? null;
$usuario_id = $_SESSION['id'];

#Para generar notificaciones
$turno_id = $_POST['turno_id'];
$mensaje = $_POST['mensaje'] ?? null;
$vinculo = $_POST['viculo'] ?? null;
$servicio_id = $_POST['servicio_id'];
$id_laboratorio_maquila = $_POST['lab_maquila_id'];

#Para obtener las notificaciones
$remitente = $json_data['user_id'] ?? $_POST['user_id'] ?? null;
$last_notificacion_id = $json_data['ultimo_id'] ?? $_POST['ultimo_id'] ?? null;

#Para marcar notificaciones
$remitente = $json_data['user_id'] ?? $_POST['user_id'] ?? null;
$notificacion_ids = $json_data['ids'] ?? $_POST['ids'] ?? null;

switch ($api){
    case 1: //Obtener todas las notifiaciónes de acuerdo a su cargo
        $response = $master->getByProcedure("sp_notificaciones_obtener_b", [$remitente, $last_notificacion_id]);

        break;
    case 2: //Marcar Notificaciones
        $ids = is_array($notificacion_ids) ? implode(',', $notificacion_ids) : $notificacion_ids;

        $response = $master->insertByProcedure('sp_notificaciones_marcar_e', [
            $remitente, $ids
        ]);
        break;
    case 3: #Generar Notificación Para Aprobación de Maquila
        $cargos_ids = '15,2,20';

        $master->setLog(
            json_encode([$usuario_id, $mensaje, $vinculo, $cargos_ids, $turno_id, $servicio_id, $id_laboratorio_maquila]),
            'notificaciones_api.php'
        );

        $response = $master->insertByProcedure("sp_notificaciones_generar_g", [
            $usuario_id, $mensaje, $vinculo, $cargos_ids, $turno_id, $servicio_id, $id_laboratorio_maquila
        ]);
        break;
    default:
        $response = "API no definida";;
        break;
}

echo $master->returnApi($response);
