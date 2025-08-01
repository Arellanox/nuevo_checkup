<?php
include_once "../clases/master_class.php";
include_once "../clases/token_auth.php";
include_once "../clases/ExcelReport_class.php";
include_once "../clases/ExcelFileManager_class.php";
include_once "../clases/Pdf.php";

$tokenVerification = new TokenVerificacion();
$tokenValido = $tokenVerification->verificar();

$master = new Master();

$api = $_POST['api'];
$host = $master->selectHost($_SERVER['SERVER_NAME']);

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
        if($obtenerReporte == 'obtener_reporte')
        {
            $response = $master->getByProcedure('sp_obtener_reporte_ventas', [
                $soloNuevosVentas,
                $fechaInicioVentas,
                $fechaFinVentas,
            ]);
        }
        else if ($obtenerReporte == 'obtener_pdf') #Descargar pdf reporte ventas
        {
            $url = $master->reportador($master, $turno_id, -12, 'reporte_ventas');
            $response = ['url' => $url];
        }
        else if ($obtenerReporte == 'obtener_excel') #Descargar excel reporte ventas
        {
            $response = $master->getByProcedure('sp_obtener_reporte_ventas', [
                $soloNuevosVentas,
                $fechaInicioVentas,
                $fechaFinVentas,
            ]);

            $columnas = [
                "PREFOLIO" => "PREFOLIO",
                "PACIENTE" => "PACIENTE",
                "AREA" => "ÁREA",
                "NUM_PROVEEDOR" => "PROVEEDOR",
                "FACTURA" => "FACTURA",
                "COSTO" => "COSTO",
                "PRECIO_VENTA" => "PRECIO VENTA",
                "PROCEDENCIA" => "PROCEDENCIA"
            ];

            $columnasMoneda = [
                "COSTO",
                "PRECIO_VENTA"
            ];

            $columnasSumatorias = [
                "COSTO",
                "PRECIO_VENTA"
            ];

            $reporte = new ExcelReport(
                'DIAGNOSTICO BIOMOLECUAR SA DE CV',
                'Reporte de Ventas',
                $columnas,
                $response,
                $columnasMoneda,
                $columnasSumatorias
            );

            $reporte->generar();

            $nombreArchivo = 'reporte_ventas_'.$_SESSION['id'].".xlsx";
            $rutaFisica = '../reportes/excel/reporte_ventas/' . $nombreArchivo;

            try {
                ExcelFileManagerClass::guardar($reporte->getSpreadsheet(), $rutaFisica);

                $urlDescarga = $host . 'reportes/excel/reporte_ventas/' . $nombreArchivo;
                $response = ['url' => $urlDescarga];
            } catch (\PhpOffice\PhpSpreadsheet\Writer\Exception $e) {
                $response = ['msj' => $e->getMessage()];
                $master->mis->setLog(json_encode($response), 'Error de generación del excel para el reporte de ventas: ');
                return;
            }
        }
        else $response = ['error' => 'No se pudo obtener el reporte, especifique que desea obtener.'];
        break;
    default:
        $response = "Apino definida";
        break;
}

echo $master->returnApi($response);