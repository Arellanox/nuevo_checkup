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

$tipo_cliente = $master->setToNull([$_POST['tipo_cliente']])[0];
$tiene_factura = $master->setToNull([$_POST['tiene_factura']])[0];

#Reportes de ventas
$soloNuevosVentas = $_POST['solo_nuevos'];
$fechaInicioVentas = $_POST['fecha_inicio'];
$fechaFinVentas = $_POST['fecha_fin'];
$obtenerReporte = $_POST['obtener_reporte'];

switch ($api) {
    case 1:
        $response = $master->getByProcedure('sp_reportes_laboratorio', [
            $fecha_inicio,
            $fecha_final,
            $cliente_id,
            $area_id,
            $servicio_id
        ]);
        break;
    case 2: #Obtener reporte de areas checkups
        $response = $master->getByProcedure('sp_obtener_reporte_areas_b', [
            $fecha_inicio,
            $fecha_final,
            $cliente_id,
            $area_id,
            $tipo_cliente,
            $tiene_factura
        ]);
        break;
    case 3: #Obtener reporte de ventas
        if($obtenerReporte == 'obtener_reporte'){
            $response = $master->getByProcedure('sp_obtener_reporte_ventas', [
                $soloNuevosVentas,
                $fechaInicioVentas,
                $fechaFinVentas,
            ]);
        } else if ($obtenerReporte == 'obtener_pdf') {
            $url = $master->reportador($master, $turno_id, -12, 'reporte_ventas');
            $response = ['url' => $url];
        } else $response = ['error' => 'No se pudo obtener el reporte, especifique que desea obtener.'];
        break;
    default:
        # code...
        break;
}


echo $master->returnApi($response);