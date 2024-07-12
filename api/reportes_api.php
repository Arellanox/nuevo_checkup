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
$cliente_id = $master->setToNull($_POST['id_cliente']);
$area_id = $master->setToNull($_POST['area_id']);
$servicio_id = $master->setToNull($_POST['servicio_id']);

switch ($api) {
    case 1:
        # reporte laboratorios
        // var_dump( [
        //     $fecha_inicio,
        //     $fecha_final,
        //     $cliente_id,
        //     $area_id,
        //     $servicio_id
        // ]);
        $response = $master->getByProcedure('sp_reportes_laboratorio', [
            $fecha_inicio,
            $fecha_final,
            $cliente_id,
            $area_id,
            $servicio_id
        ]);
        break;
    
    default:
        # code...
        break;
}


echo $master->returnApi($response);