<?php
require_once "../clases/master_class.php";
require_once "../clases/token_auth.php";
require_once "../clases/credenciales_access/database_connect.php";


$tokenVerification = new TokenVerificacion();
$tokenValido = $tokenVerification->verificar();
if (!$tokenValido) {
    $tokenVerification->logout();
    exit;
}

$con = new Database;
$master = new Master;

echo $master->returnApi($con->token_api());