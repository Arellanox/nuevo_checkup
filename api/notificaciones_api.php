<?php
require_once "../clases/master_class.php";
require_once "../clases/token_auth.php";

$tokenVerification = new TokenVerificacion();
$tokenValido = $tokenVerification->verificar();

$json_data = json_decode(file_get_contents("php://input"), true);

$master = new Master();

$api = $json_data['api'] ?? $_POST['api'] ?? null;
$remitente_user_id = $json_data['user_id'] ?? $_POST['user_id'] ?? null;
$ultima_notificacion_id = $json_data['ultimo_id'] ?? $_POST['ultimo_id'] ?? null;
$mensaje = $_POST['mensaje'] ?? null;
$vinculo = $_POST['vinculo'] ?? null;
$cargos_id = $_POST['cargos'] ?? null;
$notificacion_id = $_POST['notificacion_id'] ?? null;

switch ($api){
    case 1: //Obtener todas las notifiaciónes de acuerdo a su cargo
        $response = ($remitente_user_id != null && $ultima_notificacion_id != null)
            ? [$master->getByProcedure("sp_notificaciones_obtener_b",
                [$remitente_user_id, $ultima_notificacion_id])]
            : [];
        break;
    case 2: //Marcar Notificaciones
        $success = true;
        $ids = !is_array($notificacion_id) ? [$notificacion_id] : $notificacion_id;

        foreach($ids as $id){
            $insertResult = $master->insertByProcedure('sp_notificaciones_marcar_e', [$remitente_user_id, $id]);

            if (!$insertResult) {
                $success = false;
                break;
            }
        }

        $response  = $success
            ? ['status' => 'success', 'message' => 'Notificaciones marcadas correctamente.']
            :['status' => 'error', 'message' => 'Hubo un error al marcar las notificaciones.'];

        break;
    case 3: //Registrar una nueva notificación
        $success = true;
        $ids = !is_array($cargos_id) ? [$cargos_id] : $cargos_id;

        foreach($ids as $id){
            $insertResult = $response = $master->insertByProcedure("sp_notificaciones_generar_g", [
                $remitente_user_id, $mensaje, $vinculo, $id
            ]);

            if (!$insertResult) {
                $success = false;
                break;
            }
        }

        $response  = $success
            ? ['status' => 'success', 'message' => 'Notificaciones marcadas correctamente.']
            :['status' => 'error', 'message' => 'Hubo un error al marcar las notificaciones.'];
        break;
    default:
        $response = "API no definida";;
        break;
}

echo $master->returnApi($response);
