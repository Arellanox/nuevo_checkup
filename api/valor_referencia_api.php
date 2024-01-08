<?php
require_once "../clases/master_class.php";
require_once "../clases/token_auth.php";
include_once "../clases/Pdf.php";
include "../clases/correo_class.php";


$tokenVerification = new TokenVerificacion();
$tokenValido = $tokenVerification->verificar();
if (!$tokenValido) {
    # $tokenVerification->logout();
    # exit;
}

$master = new Master();
$api = $_POST['api'];
$id_servicio = $_POST['id_servicio'];

switch($api){
    case 1:
        $response = $master->getByProcedure("sp_valores_referencia_b2", [ $id_servicio ]);
        break;
}

echo $master->returnApi($response);

?>