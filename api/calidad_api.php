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
$fecha_inicio = $_POST['fecha_inicio'];
$fecha_final = $_POST['fecha_final'];
$resultado = $_POST['resultado'];

switch ($api) {
    case 1:
        //Busca y trae todo lo que se pida en el filtro de reporte de epidemiologia
        $response = $master->getByProcedure("sp_notificacion_epidemiologica_reporte", [$fecha_inicio, $resultado, $fecha_final]);
        break;

    default:
        $response = "api no reconocida";
        break;
}
echo $master->returnApi($response);
