<?php
define('SECRET_KEY', '74j21mmoCMmw2JhhCp58HdcgrooXDKBiPf2ZwXv3oRvPWtOfonLv8Bj3NIBjIudG');
require_once "../clases/master_class.php";

$master = new Master();

$response = $master->insertByProcedure("sp_generar_token_externo", [
    'CHAT IA USUARIO', generateToken()
]);

// Generar token simple: hash de usuario + clave + timestamp + salt
function generateToken(): string {
    $timestamp = time();
    $token = SECRET_KEY;
    $salt = bin2hex(random_bytes(8));
    return hash('sha256', $token . $timestamp . $salt);
}

echo $master->returnApi($response);