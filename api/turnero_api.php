<?php
require_once "../clases/master_class.php";
require_once "../clases/token_auth.php";
include_once "../clases/Pdf.php";


$tokenVerification = new TokenVerificacion();
$tokenValido = $tokenVerification->verificar();
if (!$tokenValido) {
    # $tokenVerification->logout();
    # exit;
}

#api
$api = isset($_POST['api']) ? $_POST['api'] : '';

$response = "";
$master = new Master();
switch ($api) {
    case 1:
        $master = new Master();
        #Recuperar info turnos a pasar
        $infoPaciente = $master->getByProcedure('sp_pantalla_turnero', [null]);
        print_r($infoPaciente);
        break;
    
    default:
        $response = "api no reconocida";
        break;
}

echo $master->returnApi($response);