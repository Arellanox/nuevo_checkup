<?php
require_once "../clases/master_class.php";
require_once "../clases/token_auth.php";

$tokenVerification = new TokenVerificacion();
$tokenValido = $tokenVerification->verificar();
if (!$tokenValido) {
    $tokenVerification->logout();
    exit;
}

$master = new Master();
$api = $_POST['api'];

$usuario_franquicia_id = $_SESSION['franquiciario'] ? $_SESSION['id'] : null;

switch ($api) {
    case 1:
        # recuperar pacientes por estado
            $response = $master->getByProcedure('sp_franquicia_maquilas_detalles_b', [
            $fecha, $_SESSION['id_cliente'], $usuario_franquicia_id
        ]);
        $response = $master->decodeJsonRecursively($response);
        break;
    default:
        $response = "API no reconocida";
        break;
}

echo $master->returnApi($response);
