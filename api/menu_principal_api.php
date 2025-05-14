<?php
include_once "../clases/master_class.php";
require_once "../clases/token_auth.php";
include_once "../clases/correo_class.php";

$tokenVerification = new TokenVerificacion();
$tokenValido = $tokenVerification->verificar();
if (!$tokenValido) {
    // $tokenVerification->logout();
    // exit;
}

$master = new Master();
$api = $_POST['api'];
$franquiciaID = $_SESSION['franquiciario'] ? $_SESSION['id_cliente'] : null;
$fecha = $_POST['fecha'];

switch($api){
    case 1:
        #recuperar el status del paciente
        $response= $master->getByProcedure('sp_status_paciente',[$fecha, $franquiciaID]);
        $decoded = array();
        foreach($response as $item){
            $decoded[] = $master->decodeJson($item);
        }
        $response = $decoded;
        break;  
    default:
        break;
}
echo $master->returnApi($response);


