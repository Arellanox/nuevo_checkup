<?php
require_once "../clases/master_class.php";

$master = new Master();

$json = file_get_contents('php://input');
$request = json_decode($json, true);
$token = getBearerToken();

if (!$token || !validateToken($token, $master)) {
    http_response_code(401);
    echo json_encode(["response" => ["message" => 'No tienes permiso para realizar esto', "data" => [], "code" => 401]]);
    exit;
}

$api = $request['api'];
$code = 200;
$message = '';

switch ($api) {
    case 1:
        $area = $request['area'] ?? null;
        $response = $master->getByProcedure('sp_clientes_particulares_servicios_b', [1, $area]);
        break;
    default:
        $code = 400;
        $response = [];
        $message = 'Error API no definida';
        break;
}

http_response_code($code);

echo json_encode(["response" => ["message" => $message, "data" => $response, "code" => $code]]);

function validateToken(string $token, $master): bool {
    $token = $master->getByProcedure('sp_validar_token_externo', [$token]);

    if (!$token) return false;
    return true;
}
function getBearerToken(): ?string {
    $headers = null;

    if (function_exists('apache_request_headers')) {
        $requestHeaders = apache_request_headers();
        if (!empty($requestHeaders['Authorization'])) {
            $headers = trim($requestHeaders['Authorization']);
        }
    }

    if (!$headers && isset($_SERVER['HTTP_AUTHORIZATION'])) {
        $headers = trim($_SERVER['HTTP_AUTHORIZATION']);
    }

    if ($headers && stripos($headers, 'Bearer ') === 0) {
        return substr($headers, 7);
    }

    return null;
}