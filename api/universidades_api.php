<?php
include "../clases/master_class.php";
require_once "../clases/token_auth.php";

$tokenVerification = new TokenVerificacion();
$tokenValido = $tokenVerification->verificar();
if (!$tokenValido) {
    $tokenVerification->logout();
    exit;
}

$master = new Master();
$api = $_POST['api'];

$id_universidad = $_POST['id_universidad'];
$descripcion = $_POST['descripcion'];

switch ($api) {
    case 1:
        #inserta y actualiza cuando le envias el id de la universidad.
        $response = $master->insertByProcedure("sp_universidades_g", [$id_universidad, $descripcion]);
        break;
    case 2:
        # buscar
        $response = $master->getByProcedure("sp_universidades_b", [$id_universidad]);
        break;
    case 4:
        #eliminar
        $response = $master->deleteByProcedure("sp_universidades_e", [$id_universidad]);

    default:
        $response = "API no definida.";
        break;
}

echo $master->returnApi($response);
?>