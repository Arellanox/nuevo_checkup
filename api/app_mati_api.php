<?php
// --- CORS ---
$allowedOrigins = [
    'https://bimo.com.mx',
    'http://localhost:3000', // provisional
    'http://localhost:3001',
    'https://www.bimo.com.mx' // provisional
];

if (isset($_SERVER['HTTP_ORIGIN']) && in_array($_SERVER['HTTP_ORIGIN'], $allowedOrigins, true)) {
    header("Access-Control-Allow-Origin: {$_SERVER['HTTP_ORIGIN']}");
    header("Access-Control-Allow-Credentials: true");
    header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
    header("Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With");
    header("Vary: Origin");
}

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(204);
    exit;
}
// --- END CORS ---

require_once "../clases/master_class.php";

$master = new Master();
$token = getBearerToken();

if (!$token || !validateToken($token, $master)) {
    http_response_code(401);
    echo json_encode(["response" => ["message" => 'No tienes permiso para realizar esto', "data" => [], "code" => 401]]);
    exit;
}

// ---    REQUEST DATA   ---
$json = file_get_contents('php://input');
$request = json_decode($json, true);
$api = $request['api'];
$area = $request['area'] ?? null;
// --- END REQUEST DATA  ---

switch ($api) {
    case 1: // Servicios Disponibles
        $response = $master->getByProcedure('ia_servicios_precios', [$area]);
        $message = '';
        $code = 200;
        break;
    case 2: // Promociones Disponibles
        $response = $master->getByProcedure('ia_promociones', [1]);
        $message = '';
        $code = 200;
        break;
    default:
        $code = 400;
        $response = [];
        $message = 'ERROR PARAMETROS INVALIDOS.';
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