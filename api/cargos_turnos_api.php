<?php
include "../clases/master_class.php";
require_once "../clases/token_auth.php";
include_once "../clases/ExcelReport_class.php";
include_once "../clases/ExcelFileManager_class.php";
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
$area_id = $_POST['area_id'];
$tipo_cliente = $_POST['tipo_cliente']; # 1 contado, 2 credito
$tiene_factura = $_POST['tiene_factura']; #1 tiene, 0 no tiene, null todas

$detallado = $_POST['detallado']; # indica el tipo de reporte que quieren ver
$incluir = $_POST['incluir'] ?? 0;

switch ($api) {
    case "estados_cuentas":
    case 1:
        $response = $master->getByNext('sp_cargos_turnos_b', [$turno_id, $id_cliente]);
        $total_cargos = 0;

        if (!isset($response[1][0]) || empty($response[1])) {
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

        #Seleccionamos la columnas para el reporte
        $columnas = [
            "PACIENTE" => "Paciente",
            "AREA" => "Área",
            "SERVICIOS" => "Servicios",
            "MEDICO_TRATANTE" => "Médico Tratante",
            "EQUIPO" => "Equipo",
            "PREFOLIO" => "Prefolio",
            "CANTIDAD" => "Cantidad",
            "COSTO_BASE" => "Costo",
            "PRECIO_UNITARIO" => "Unitario",
            "SUBTOTAL" => "Subtotal",
            "IVA" => "IVA",
            "TOTAL" => "Total",
            "FECHA_RECEPCION" => "Fecha Recepción",
            "MES" => "Mes",
            "DIA" => "Dia",
            "ANIO" => "Año",
            "FORMA_PAGO" => "Forma de Pago",
            "FACTURA" => "Factura",
            "PROCEDENCIA" => "Procedencia",
            "US_INTERPRETADO_POR" => "Interpretó",

            "CLAVE_BENEFICIARIO" => "Clave Beneficiario",
            "PARENTESCO" => "Parentesco",
            "NUM_PASE" => "Pase",
            "URES" => "URES",
            "CATEGORIA" => "Categoría",
            "NUM_TRABAJADOR" => "Num Trabajador",
            "NUM_PROVEEDOR" => "Proveedor",
            "TRABAJADOR" => "Trabajador",
            "VERIFICACION" => "Verificación (URL)"

        ];

        # columnas de beneficiario
        if ($incluir == 1){
            $columnasBeneficiario = [
                "CLAVE_BENEFICIARIO" => "Clave Beneficiario",
                "PARENTESCO" => "Parentesco",
                "NUM_PASE" => "Pase",
                "URES" => "URES",
                "CATEGORIA" => "Categoría",
                "NUM_TRABAJADOR" => "Num Trabajador",
                "NUM_PROVEEDOR" => "Proveedor",
                "FACTURA" => "Factura",
                "TRABAJADOR" => "Trabajador",
                "VERIFICACION" => "Verificación (URL)"
            ];

            $columnas = array_merge($columnas, $columnasBeneficiario);
        }

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

        # Cada exportación usa una URL propia para evitar que el navegador entregue una descarga anterior.
        $nombreArchivo = 'reporte_pacientes_' . date('Ymd_His') . '_' . bin2hex(random_bytes(8)) . ".xlsx";
        $directorioReportes = __DIR__ . '/../reportes/excel/reporte_pacientes';
        $rutaFisica = $directorioReportes . DIRECTORY_SEPARATOR . $nombreArchivo;

        # Guardar archivo en la carpeta
        try {
            if (!is_dir($directorioReportes) && !mkdir($directorioReportes, 0775, true) && !is_dir($directorioReportes)) {
                throw new RuntimeException('No se pudo crear el directorio de reportes.');
            }

            ExcelFileManagerClass::guardar($reporte->getSpreadsheet(), $rutaFisica);

            $urlDescarga = $host . 'reportes/excel/reporte_pacientes/' . $nombreArchivo;
            $response = ['url' => $urlDescarga];
        } catch (Throwable $e) {
            $response = ['msj' => $e->getMessage()];
            $master->mis->setLog($response, 'Error de Generación de reporte: ');
            return;
        }
        break;
    case 9:
        # Generar PDF con los mismos filtros y datos que el reporte Excel.
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

        $columnasPdf = [
            'PACIENTE' => 'Paciente',
            'AREA' => 'Área',
            'SERVICIOS' => 'Servicios',
            'MEDICO_TRATANTE' => 'Médico Tratante',
            'EQUIPO' => 'Equipo',
            'PREFOLIO' => 'Prefolio',
            'CANTIDAD' => 'Cantidad',
            'COSTO_BASE' => 'Costo',
            'PRECIO_UNITARIO' => 'Unitario',
            'SUBTOTAL' => 'Subtotal',
            'IVA' => 'IVA',
            'TOTAL' => 'Total',
            'FECHA_RECEPCION' => 'Fecha Recepción',
            'MES' => 'Mes',
            'DIA' => 'Dia',
            'ANIO' => 'Año',
            'FORMA_PAGO' => 'Forma de Pago',
            'FACTURA' => 'Factura',
            'PROCEDENCIA' => 'Procedencia',
            'US_INTERPRETADO_POR' => 'Interpretó',
            'CLAVE_BENEFICIARIO' => 'Clave Beneficiario',
            'PARENTESCO' => 'Parentesco',
            'NUM_PASE' => 'Pase',
            'URES' => 'URES',
            'CATEGORIA' => 'Categoría',
            'NUM_TRABAJADOR' => 'Num Trabajador',
            'NUM_PROVEEDOR' => 'Proveedor',
            'TRABAJADOR' => 'Trabajador',
            'VERIFICACION' => 'Verificación (URL)'
        ];

        $sumatoriasPdf = ['SUBTOTAL' => 0, 'IVA' => 0, 'TOTAL' => 0];
        foreach ($response as $fila) {
            foreach ($sumatoriasPdf as $campo => $total) {
                $importe = str_replace([',', '$', ' '], '', (string) ($fila[$campo] ?? 0));
                $sumatoriasPdf[$campo] += is_numeric($importe) ? (float) $importe : 0;
            }
        }

        $meses = [
            1 => 'ENERO', 2 => 'FEBRERO', 3 => 'MARZO', 4 => 'ABRIL',
            5 => 'MAYO', 6 => 'JUNIO', 7 => 'JULIO', 8 => 'AGOSTO',
            9 => 'SEPTIEMBRE', 10 => 'OCTUBRE', 11 => 'NOVIEMBRE', 12 => 'DICIEMBRE'
        ];
        $formatearFechaReporte = static function ($fecha) use ($meses) {
            $date = new DateTime($fecha);
            return $date->format('d') . ' DE ' . $meses[(int) $date->format('n')] . ' DEL ' . $date->format('Y');
        };
        $logoBimo = base64_encode(file_get_contents(__DIR__ . '/../pdf/public/assets/logotipo.png'));
        $subtituloReporte = 'ESTADO DE CUENTA | HOSPITAL NUESTRA SEÑORA DE GUADALUPE | DEL '
            . $formatearFechaReporte($ujat_inicial) . ' AL ' . $formatearFechaReporte($ujat_final);

        $html = '<html><head><meta charset="UTF-8"><style>'
            . 'body{font-family:DejaVu Sans,sans-serif;font-size:6px;margin:25px 30px}'
            . '.report-header{margin-bottom:20px}.report-header td{border:0;vertical-align:middle;padding:0}'
            . '.logo-cell{width:20%;text-align:left}.logo-cell img{width:105px;height:auto}'
            . '.heading-cell{width:80%;text-align:center}.heading-cell h1{font-size:15px;margin:0 0 8px}'
            . '.heading-cell p{font-size:10px;margin:0}'
            . 'p{font-size:9px}table{border-collapse:collapse;width:100%}th,td{border:1px solid #999;padding:3px;vertical-align:top}'
            . 'th{background:#e8eef2}thead{display:table-header-group}tr{page-break-inside:avoid}'
            . '.summary{width:225px;margin:18px 0 0 auto;font-size:9px}.summary td{padding:5px 8px}'
            . '.summary-label{font-weight:bold;background:#e8eef2}.summary-value{text-align:right}'
            . '</style></head><body><table class="report-header"><tbody><tr>'
            . '<td class="logo-cell"><img src="data:image/png;base64,' . $logoBimo . '" alt="Bimo"></td>'
            . '<td class="heading-cell"><h1>DIAGNOSTICO BIOMOLECULAR SA DE CV</h1><p>'
            . htmlspecialchars($subtituloReporte, ENT_QUOTES, 'UTF-8')
            . '</p></td></tr></tbody></table><table><thead><tr>';

        foreach ($columnasPdf as $tituloColumna) {
            $html .= '<th>' . htmlspecialchars($tituloColumna, ENT_QUOTES, 'UTF-8') . '</th>';
        }

        $html .= '</tr></thead><tbody>';
        foreach ($response as $fila) {
            $html .= '<tr>';
            foreach ($columnasPdf as $campo => $tituloColumna) {
                $valor = $fila[$campo] ?? '';
                $html .= '<td>' . htmlspecialchars((string) $valor, ENT_QUOTES, 'UTF-8') . '</td>';
            }
            $html .= '</tr>';
        }
        $html .= '</tbody></table><table class="summary"><tbody>';
        foreach (['SUBTOTAL' => 'Subtotal', 'IVA' => 'IVA', 'TOTAL' => 'TOTAL'] as $campo => $etiqueta) {
            $importe = number_format($sumatoriasPdf[$campo], 2, '.', ',');
            $html .= '<tr><td class="summary-label">' . $etiqueta . '</td><td class="summary-value">$'
                . $importe . '</td></tr>';
        }
        $html .= '</tbody></table></body></html>';

        $pdf = new \Dompdf\Dompdf();
        $pdf->loadHtml($html, 'UTF-8');
        $pdf->setPaper('legal', 'landscape');
        $pdf->render();

        $nombreArchivo = 'reporte_pacientes_' . date('Ymd_His') . '_' . bin2hex(random_bytes(8)) . '.pdf';
        $directorioReportes = __DIR__ . '/../reportes/excel/reporte_pacientes';
        if (!is_dir($directorioReportes) && !mkdir($directorioReportes, 0775, true) && !is_dir($directorioReportes)) {
            $response = ['msj' => 'No se pudo crear el directorio de reportes.'];
            break;
        }

        if (file_put_contents($directorioReportes . DIRECTORY_SEPARATOR . $nombreArchivo, $pdf->output()) === false) {
            $response = ['msj' => 'No se pudo guardar el reporte PDF.'];
            break;
        }

        $response = ['url' => $host . 'reportes/excel/reporte_pacientes/' . $nombreArchivo];
        break;
    default:
        $response = "Apino definida";
}

# regresamos el resultado el formato json
echo $master->returnApi($response);
