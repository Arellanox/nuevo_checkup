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

$id_alta = $_POST['id_alta'];
$id_turno = $_POST['id_turno'];
$bit_solitudes = $_POST['bit_solitudes'];
$bit_muestras = $_POST['bit_muestras'];

switch ($api) {
    case 1:
        # recuperar pacientes por estado
        $response = $master->getByProcedure('sp_franquicia_maquilas_detalles_b', [
            $fecha, $_SESSION['id_cliente']
        ]);
        $response = $master->decodeJsonRecursively($response);
        break;
    case 2:
        # recuperar pacientes para envio de muestras
        # que no esten dentro de un lote de envio.

        #$bit_solicitudes: 0 es los que no tienen lote, 1 para los que si tienen lote

        $response = $master->getByProcedure("sp_franquicia_maquilas_altas_pacientes_b", [
            $id_alta, $id_turno, $bit_solitudes, $bit_muestras, $_SESSION['id_cliente']
        ]);
        $response = $master->decodeJsonRecursively($response);
        break;

    default:
        $response = "API no reconocida";
        break;
}

echo $master->returnApi($response);
