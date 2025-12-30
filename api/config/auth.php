<?php
require_once __DIR__ . "/../../clases/master_class.php";

function requireAuth(): Master {
    $master = new Master();
    $token = getBearerToken();

    if (!$token || !validateToken($token, $master)) {
        http_response_code(401);
        echo json_encode([
            "response" => [
                "message" => "No autorizado",
                "data" => [],
                "code" => 401
            ]
        ]);
        exit;
    }

    return $master;
}

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


