<?php
require_once "../clases/master_class.php";
require_once "../clases/token_auth.php";

$tokenVerification = new TokenVerificacion();
$tokenValido = $tokenVerification->verificar();

$master = new Master();
$json_data = json_decode(file_get_contents("php://input"), true);
$api = $json_data['api'] ?? $_POST['api'] ?? null;
$user_id = $json_data['user_id'] ?? $_POST['user_id'] ?? null;
$ultimo_id = $json_data['ultimo_id'] ?? $_POST['ultimo_id'] ?? null;

switch ($api){
    case 1:
        $response = ($user_id != null && $ultimo_id != null)
            ? [$master->getByProcedure("sp_obtener_notificaciones_b", [$user_id, $ultimo_id])]
            : [];
        break;
    default:
        $response = [];
        break;
}

echo $master->returnApi($response);
