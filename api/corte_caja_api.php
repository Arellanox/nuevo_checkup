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

#OBTENCION DE DATOS
$descripcion_caja = $_POST['descripcion_caja'];


switch ($api) {
    case 1:
        # Insertar una nueva caja
        $response = $master->insertByProcedure("sp_cajas_g", [$descripcion_caja]);
        break;
    case 2:
        # Buscar cajas
        $response = $master->getByProcedure("sp_cajas_b", [NULL]);
        break;

    case 3:
        # Actualizar
        break;
    case 4:
        # Eliminar
        break;

    case 5:
        # Buscar usuarios
        $response = $master->getByProcedure("sp_usuarios_b", [null, null]);
        break;

    default:
        # code...
        $response = "API no definida";
        break;
}

echo $master->returnApi($response);
