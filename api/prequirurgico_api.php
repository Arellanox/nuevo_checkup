<?php
include "../clases/master_class.php";
require_once "../clases/token_auth.php";

$tokenVerification = new TokenVerificacion();
$tokenValido = $tokenVerification->verificar();
if (!$tokenValido) {
    // $tokenVerification->logout();
    // exit;
}

$master = new Master();

$api = $_POST['api'];

$cliente_id = $_POST['cliente_id'];


switch ($api) {

    case 1:
        $area = $_POST['area_id'];
        $fecha = isset($_POST['fecha_busqueda']) ?  $_POST['fecha_busqueda'] : NULL;
        $response = $master->getByProcedure("sp_prequirurgico_b", [$fecha, $area, null, $_SESSION['id'], $cliente_id]);

        break;

    default:
        $response = "Api no definida";
};


echo $master->returnApi($response);
