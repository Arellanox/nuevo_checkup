<?php
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class ExcelFileManagerClass {
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
