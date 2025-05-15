<?php
require_once 'PhpSpreadsheet/vendor/autoload.php';
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;

class ExcelReport {
    private $spreadsheet;
    private $titulo;
    private $subtitulo;
    private $columnas;
    private $data;
    private $columnasMoneda;
    private $columnasSumar;

    public function __construct($titulo, $subtitulo, $columnas, $data, $columnasMoneda = [], $columnasSumar = []) {
        $this->spreadsheet = new Spreadsheet();
        $this->titulo = $titulo;
        $this->subtitulo = $subtitulo;
        $this->columnas = $columnas;
        $this->data = $data;
        $this->columnasMoneda = $columnasMoneda;
        $this->columnasSumar = $columnasSumar;
    }

    public function generar() {
        $sheet = $this->spreadsheet->getActiveSheet();

        // Agregar título
        $sheet->setCellValue('A1', $this->titulo);
        $sheet->mergeCells('A1:' . $this->columnaLetra(count($this->columnas)) . '1');
        $sheet->getStyle('A1')->getFont()->setSize(14)->setBold(true);
        $sheet->getStyle('A1')->getAlignment()->setHorizontal('center');

        // Agregar subtítulo si existe
        if (!empty($this->subtitulo)) {
            $sheet->setCellValue('A2', $this->subtitulo);
            $sheet->mergeCells('A2:' . $this->columnaLetra(count($this->columnas)) . '2');
            $sheet->getStyle('A2')->getFont()->setSize(12)->setBold(true);
            $sheet->getStyle('A2')->getAlignment()->setHorizontal('center');
        }

        $filaActual = empty($this->subtitulo) ? 3 : 4;

        // Agregar encabezados de columnas
        $colIndex = 1;
        foreach ($this->columnas as $campo => $nombre) {
            $sheet->setCellValueByColumnAndRow($colIndex, $filaActual, $nombre);
            $sheet->getStyleByColumnAndRow($colIndex, $filaActual)->getFont()->setBold(true);
            $colIndex++;
        }

        // Agregar datos
        $filaInicioDatos = $filaActual + 1;
        $filaActual = $filaInicioDatos;

        foreach ($this->data as $fila) {
            $colIndex = 1;
            foreach ($this->columnas as $campo => $nombre) {
                $sheet->setCellValueByColumnAndRow($colIndex, $filaActual, isset($fila[$campo]) ? $fila[$campo] : '');
                // Aplicar formato de moneda si está en la lista
                if (in_array($campo, $this->columnasMoneda)) {
                    $sheet->getStyleByColumnAndRow($colIndex, $filaActual)
                          ->getNumberFormat()->setFormatCode('"$"#,##0.00');
                }
                $colIndex++;
            }
            $filaActual++;
        }

        // Ajustar tamaño de columnas
        foreach (range(1, count($this->columnas)) as $col) {
            $sheet->getColumnDimensionByColumn($col)->setAutoSize(true);
        }

        // Agregar filas de sumatorias después de una fila en blanco
        $filaSumatoria = $filaActual + 1; // Primera fila de sumatoria

        foreach ($this->columnas as $campo => $nombre) {
            if (in_array($campo, $this->columnasSumar)) {
                // Obtener la letra correcta de la columna que contiene los valores a sumar
                $colLetra = $this->columnaLetra(array_search($campo, array_keys($this->columnas)) + 1); 

                // Colocar el nombre de la columna en la primera celda
                $sheet->setCellValue("E" . $filaSumatoria, $nombre);
                $sheet->getStyle("E" . $filaSumatoria)->getFont()->setBold(true)->setSize(14);

                // Calcular correctamente la sumatoria usando la columna adecuada
                $sheet->setCellValue("F" . $filaSumatoria, "=SUM(" . $colLetra . $filaInicioDatos . ":" . $colLetra . ($filaActual - 1) . ")");
                $sheet->getStyle("F" . $filaSumatoria)->getFont()->setBold(true)->setSize(14);

                // Aplicar formato de moneda si es necesario
                if (in_array($campo, $this->columnasMoneda)) {
                    $sheet->getStyle("F" . $filaSumatoria)->getNumberFormat()->setFormatCode('"$"#,##0.00');
                }

                // Aplicar fondo de color D6DCE4 a las celdas B y C
                $sheet->getStyle("E" . $filaSumatoria . ":F" . $filaSumatoria)->getFill()
                    ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                    ->getStartColor()->setARGB('D6DCE4');

                // Pasar a la siguiente fila para la siguiente sumatoria
                $filaSumatoria++;
            }
        }


        // Ajustar tamaño de columnas
        foreach (range(1, count($this->columnas)) as $col) {
            $sheet->getColumnDimensionByColumn($col)->setAutoSize(true);
        }

    }

    public function getSpreadsheet() {
        return $this->spreadsheet;
    }

    private function columnaLetra($num) {
        return \PhpOffice\PhpSpreadsheet\Cell\Coordinate::stringFromColumnIndex($num);
    }
}


class ExcelFileManager {
    /**
     * @throws \PhpOffice\PhpSpreadsheet\Writer\Exception
     */
    public static function guardar($spreadsheet, $rutaArchivo) {
        $writer = new Xlsx($spreadsheet);
        $writer->save($rutaArchivo);
    }

    public static function descargar($spreadsheet, $filename = 'reporte.xlsx') {
        // Limpiar cualquier salida previa
        ob_end_clean();

        // Crear el escritor de Excel
        $writer = new Xlsx($spreadsheet);
        
        // Encabezados HTTP para la descarga
        header("Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");
        header("Content-Disposition: attachment; filename=reporte.xlsx");
        header("Pragma: no-cache");
        header("Expires: 0");
        
        // Enviar el archivo al navegador
        $writer->save('php://output');
        exit;
    }
}
