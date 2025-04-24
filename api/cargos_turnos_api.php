<?php
include "../clases/master_class.php";
require_once "../clases/token_auth.php";
include_once "../clases/ExcelReport_class.php";
include_once "../clases/Pdf.php";

$tokenVerification = new TokenVerificacion();
$tokenValido = $tokenVerification->verificar();

$master = new Master();

$api = $_POST['api'];
$turno_id = $_POST['turno_id'];
$num_factura = $_POST['num_factura'];
$host = $master->selectHost($_SERVER['SERVER_NAME']);

#variables para el reporte de la ujat
$ujat_inicial = $_POST['fecha_inicial'];
$ujat_final = $_POST['fecha_final'];
$id_cliente = $_POST['id_cliente'];
$area_id    = $_POST['area_id'];
$tipo_cliente = $_POST['tipo_cliente']; # 1 contado, 2 credito
$tiene_factura = $_POST['tiene_factura']; #1 tiene, 0 no tiene, null todas

$detallado = $_POST['detallado']; # indica el tipo de reporte que quieren ver

switch ($api) {
    case "estados_cuentas":
    case 1:
        $response = $master->getByNext('sp_cargos_turnos_b', [$turno_id, $id_cliente]);
        $total_cargos = 0;
        
        if(!isset($response[1][0]) || empty($response[1])){
            foreach ($response[0] as $e) {
                $total_cargos = $total_cargos + $e['PRECIO_VENTA'];
            }
        } else {
            $total_cargos = $response[1][0]['SUBTOTAL'];
        }

        $response['estudios'] = $response[0];
        $response['TOTAL_CARGO'] = $total_cargos;

        break;
    case 2:
        # facturar un paciente particular
        $response = $master->insertByProcedure("sp_facturados_g", [$turno_id, $num_factura, $_SESSION['id']]);
        break;
    case 3:
        # reporte de ujat
        $params = $master->setToNull([
            $ujat_inicial,
            $ujat_final,
            $id_cliente,
            $area_id,
            $tipo_cliente,
            $tiene_factura,
            'es_franquiciario' => $_SESSION['franquiciario'] ? $_SESSION['id'] : null
        ]);

        $response = ($detallado == 1)
            ? $master->getByProcedure("sp_reporte_ujat", $params)
            : $master->getByProcedure("sp_reporte_ujat_prueba", $params);
        break;
    case 4:
        # Crear un grupo de facturas

        break;
    case 5:
        # recuperar el paquete que se le cargo al turno.
        $response = $master->getByProcedure("sp_recuperar_nombre_paquete", [$turno_id]);
        break;
    case 6:
        # descargar reporte excel con subtotales
        $params = $master->setToNull([$ujat_inicial, $ujat_final, $id_cliente, $area_id, $tipo_cliente, $tiene_factura]);

        $response = ($detallado == 1)
            ? $master->getByProcedure("sp_reporte_ujat", $params)
            : $master->getByProcedure("sp_reporte_ujat_prueba", $params);

        #Seleccionamos la columnas para el reporte
        $columnas =[
            "PACIENTE"=>"Paciente",
            "AREA" => "Área",
            "SERVICIOS" => "Servicios",
            "PREFOLIO" => "Prefolio",
            "CANTIDAD" => "Cantidad",
            "PRECIO_UNITARIO" => "Unitario",
            "SUBTOTAL" => "Subtotal",
            "IVA" => "IVA",
            "TOTAL" => "Total",
            "FECHA_RECEPCION" => "Fecha Recepción",
            "FACTURA" => "Factura"
        ];

        $columnasMoneda = [
            'PRECIO_UNITARIO',
            'SUBTOTAL',
            'IVA',
            'TOTAL'
        ];

        $columnasSumatorias = [
            'SUBTOTAL',
            'IVA',
            'TOTAL'
        ];

        #creamos instancia de excel
        $reporte = new ExcelReport(
            'DIAGNOSTICO BIOMOLECULAR SA DE CV', 
            'ESTADO DE CUENTA', 
            $columnas, 
            $response,
            $columnasMoneda,
            $columnasSumatorias
        );
        $reporte->generar();

        # Se requiere esperficar una ruta o desencadena un error
        $rutaArchivo = 'ReportesExcel/reporte_pacientes_'.$_SESSION['id'].".xlsx";

        # Guardar archivo en la carpeta
        try {
            ExcelFileManager::guardar($reporte->getSpreadsheet(), $rutaArchivo);
        } catch (\PhpOffice\PhpSpreadsheet\Writer\Exception $e) {
            $response = $e->getMessage();
            return;
        }

        $urlBase = "{$host}api";  // Reemplaza con tu dominio o IP pública
        $urlArchivo = "$urlBase/$rutaArchivo";
        $response = [ $urlArchivo ];
        break;
    case 9:
        #Generar PDF
        $url = $master->reportador($master, $turno_id, -9, 'estados_cuentas', 'url');
        $response = ['url' => $url];
        break;
    default:
        $response = "Apino definida";
}

# regresamos el resultado el formato json
echo $master->returnApi($response);
