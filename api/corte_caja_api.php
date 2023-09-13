<?php

require_once "../clases/master_class.php";
require_once "../clases/token_auth.php";
include_once "../clases/Pdf.php";
//include_once "../clases/correo_class.php";

$tokenVerification = new TokenVerificacion();
$tokenValido = $tokenVerification->verificar();
if (!$tokenValido) {
    // $tokenVerification->logout();
    // exit;
}

$master = new Master();

#OBTENEMOS LA API POR MEDIO DEL POST
$api = $_POST['api'];

switch ($api) {
    case 1:
        # Insertar
        $response = $master->insertByProcedure("sp", $parametros);
        break;
    case 2:
        # Buscar
        $response = $master->getByProcedure("sp", [$si]);
        break;
    case 3:
        # Actualizar
        break;
    case 4:
        # Eliminar
        break;
    default:
        # code...
        $response = "API no definida";
        break;
}

echo $master->returnApi($response);
