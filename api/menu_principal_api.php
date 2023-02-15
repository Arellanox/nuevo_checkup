<?php
include_once "../clases/master_class.php";
require_once "../clases/token_auth.php";
include_once "../clases/correo_class.php";

$tokenVerification = new TokenVerificacion();
$tokenValido = $tokenVerification->verificar();
if (!$tokenValido) {
    $tokenVerification->logout();
    exit;
}

$master = new Master();
$api = $_POST['api'];

switch($api){
    case 1:
        #recuperar el status del paciente
        
        break;
    default:
        break;
}
?>