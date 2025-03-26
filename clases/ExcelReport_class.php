<?php
require_once 'PhpSpreadsheet/vendor/autoload.php';
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
class ExcelReport {
    private Spreadsheet $spreadsheet;
    private string $titulo;
    private string $subtitulo;
    private array $columnas;
    private array $data;

    public function __construct(string $titulo, string $subtitulo, array $columnas, array $data) {
        $this->spreadsheet = new Spreadsheet();
        $this->titulo = $titulo;
        $this->subtitulo = $subtitulo;
        $this->columnas = $columnas;
        $this->data = $data;
    }

    public function generar(): void {
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
        $filaActual++;
        foreach ($this->data as $fila) {
            $colIndex = 1;
            foreach ($this->columnas as $campo => $nombre) {
                $sheet->setCellValueByColumnAndRow($colIndex, $filaActual, $fila[$campo] ?? '');
                $colIndex++;
            }
            $filaActual++;
        }

        // Ajustar tamaño de columnas
        foreach (range(1, count($this->columnas)) as $col) {
            $sheet->getColumnDimensionByColumn($col)->setAutoSize(true);
        }
    }

    public function getSpreadsheet(): Spreadsheet {
        return $this->spreadsheet;
    }

    private function columnaLetra($num): string {
        return \PhpOffice\PhpSpreadsheet\Cell\Coordinate::stringFromColumnIndex($num);
    }
}

class ExcelFileManager {
    public static function guardar(Spreadsheet $spreadsheet, string $rutaArchivo): void {
        $writer = new Xlsx($spreadsheet);
        $writer->save($rutaArchivo);
    }

    public static function descargar(Spreadsheet $spreadsheet, string $nombreArchivo): void {
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="' . $nombreArchivo . '"');
        header('Cache-Control: max-age=0');

        $writer = new Xlsx($spreadsheet);
        $writer->save('php://output');
        exit;
    }
}