<?php
include_once "../clases/master_class.php";
include_once "../clases/token_auth.php";

$tokenVerification = new TokenVerificacion();
$tokenValido = $tokenVerification->verificar();
if (!$tokenValido) {
    // $tokenVerification->logout();
    // exit;
}

$master = new Master();
$api = $_POST['api'];

$fecha_inicio = $_POST['fecha_inicial'];
$fecha_final = $_POST['fecha_final'];
$cliente_id = $master->setToNull([$_POST['id_cliente']])[0];
$area_id = $master->setToNull([$_POST['area_id']])[0];
$servicio_id = $master->setToNull([$_POST['servicio_id']])[0];

switch ($api) {
    case 1:
        # reporte laboratorios
        $response = $master->getByProcedure('sp_reportes_laboratorio', [
            $fecha_inicio,
            $fecha_final,
            $cliente_id,
            $area_id,
            $servicio_id
        ]);
        break;
    case 2:
        # reporte de ventas para Talento humano
        $response = $master->getByProcedure('sp_repth_ventas', [$fecha_inicio, $fecha_final]);
        break;
    
    default:
        # code...
        break;
}


echo $master->returnApi($response);