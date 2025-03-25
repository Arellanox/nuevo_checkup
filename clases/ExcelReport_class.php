<?php
require 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class ExcelReport {
    private $spreadsheet;
    private $sheet;

    public function __construct() {
        $this->spreadsheet = new Spreadsheet();
        $this->sheet = $this->spreadsheet->getActiveSheet();
    }

    /**
     * Genera un reporte en Excel con los datos proporcionados.
     *
     * @param string $titulo - Título principal del reporte
     * @param string|null $subtitulo - Subtítulo del reporte (opcional)
     * @param array $columnas - Columnas a mostrar (clave => encabezado)
     * @param array $datos - Datos del reporte (arreglo de arreglos)
     */
    public function generarReporte($titulo, $subtitulo = null, $columnas, $datos) {
        // Establecer el título
        $this->sheet->setCellValue('A1', $titulo);
        $this->sheet->mergeCells('A1:' . chr(64 + count($columnas)) . '1'); // Unir celdas para el título
        $this->sheet->getStyle('A1')->getFont()->setBold(true)->setSize(14);
        
        // Establecer el subtítulo si existe
        if ($subtitulo) {
            $this->sheet->setCellValue('A2', $subtitulo);
            $this->sheet->mergeCells('A2:' . chr(64 + count($columnas)) . '2'); // Unir celdas para el subtítulo
            $this->sheet->getStyle('A2')->getFont()->setBold(true)->setSize(12);
        }

        // Encabezados de columna
        $colIndex = 1;
        $rowIndex = $subtitulo ? 4 : 3; // Si hay subtítulo, empezamos en fila 4, sino en 3
        foreach ($columnas as $columna) {
            $this->sheet->setCellValueByColumnAndRow($colIndex, $rowIndex, $columna);
            $this->sheet->getStyleByColumnAndRow($colIndex, $rowIndex)->getFont()->setBold(true);
            $colIndex++;
        }

        // Insertar los datos
        $rowIndex++;
        foreach ($datos as $fila) {
            $colIndex = 1;
            foreach (array_keys($columnas) as $key) { // Solo mostramos las columnas indicadas
                $this->sheet->setCellValueByColumnAndRow($colIndex, $rowIndex, $fila[$key] ?? '');
                $colIndex++;
            }
            $rowIndex++;
        }

        // Ajustar tamaño de columnas
        foreach (range(1, count($columnas)) as $col) {
            $this->sheet->getColumnDimensionByColumn($col)->setAutoSize(true);
        }

        // Descargar el archivo
        $this->descargarExcel("Reporte_" . date("Ymd_His") . ".xlsx");
    }

    /**
     * Descarga el archivo generado
     *
     * @param string $nombreArchivo - Nombre del archivo
     */
    private function descargarExcel($nombreArchivo) {
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="' . $nombreArchivo . '"');
        header('Cache-Control: max-age=0');

        $writer = new Xlsx($this->spreadsheet);
        $writer->save('php://output');
        exit;
    }
}
?>
