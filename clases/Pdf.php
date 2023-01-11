<?php

require_once '../php/dompdf/vendor/autoload.php';
require 'View.php';
require 'Qrcode.php';


use Dompdf\Adapter\PDFLib;
use Dompdf\Dompdf;
use Dompdf\Options;

class Reporte
{

    public $response;
    public $data;
    public $pie;
    public $archivo;
    public $tipo;
    public $orden;

    /**
     * Create a new instance.
     *
     * @return void
     */
    public function __construct($response, $data, $pie, $archivo, $tipo, $orden)
    {
        $this->response = $response;
        $this->data     = $data;
        $this->pie      = $pie;
        $this->archivo  = $archivo;
        $this->tipo     = $tipo;
        $this->orden    = $orden;
    }

    public function build()
    {
        $response   = json_decode($this->response);
        $data       = json_decode($this->data); //Esperando la data general
        $pie        = $this->pie;
        $archivo    = $this->archivo;
        $tipo       = $this->tipo;
        $orden      = $this->orden;

        switch ($tipo) {
            case 'etiquetas':
                $generator = new Picqer\Barcode\BarcodeGeneratorPNG();
                $barcode  = base64_encode($generator->getBarcode($response->BARRAS, $generator::TYPE_CODE_128));
                // $barcode  = base64_encode($generator->getBarcode('750169978916', $generator::TYPE_CODE_128));
                break;
            case 'resultados':
                // Qrcode
                $prueba = generarQRURL($pie['clave'], $pie['folio'], $pie['modulo']);
                break;
            case 'oftamologia':
                // Qrcode
                $prueba = generarQRURL($pie['clave'], $pie['folio'], $pie['modulo']);
                break;
            case 'ultrasonido':
                // Ultrasonidos
                $prueba = generarQRURL($pie['clave'], $pie['folio'], $pie['modulo']);
                break;
            case 'rayos':
                // Ultrasonidos //rayos piu piu
                $prueba = generarQRURL($pie['clave'], $pie['folio'], $pie['modulo']);
                break;
            default:
                $barcode = null;
                return $barcode;
                break;
        }

        $host =  isset($_SERVER['SERVER_NAME']) ? "http://localhost/nuevo_checkup/" : "https://bimo-lab.com/nuevo_checkup/";
        // Path del dominio
        $path = $archivo['ruta'] . $archivo['nombre_archivo'] . ".pdf";
        // $path    = 'pdf/public/resultados/E-00001.pdf';
        // echo $path;
        // print_r($path);

        session_start();
        $view_vars = array(
            "resultados"            => $response,
            "encabezado"            => $data,
            "qr"                    => isset($prueba) ? $prueba : null,
            "barcode"               => isset($barcode) ? $barcode : null,
        );



        $pdf = new Dompdf();
        // Recibe la orden de que tipo de archivo quiere
        switch ($tipo) {
            case 'etiquetas':
                $template = render_view('invoice/etiquetas.php', $view_vars);
                $pdf->loadHtml($template);

                $ancho = (5.1 / 2.54) * 72;
                $alto  = (2.5 / 2.54) * 72;

                $pdf->setPaper(array(0, 0, $ancho, $alto), 'portrait');
                // $pdf->setPaper('letter', 'portrait');
                // $path    = 'pdf/public/etiquetas/00001.pdf';
                break;

            case 'resultados':
                $template = render_view('invoice/resultados.php', $view_vars);
                $pdf->loadHtml($template);
                $pdf->setPaper('letter', 'portrait');
                // $path    = 'pdf/public/resultados/E-00001.pdf';
                // return $path;
                break;

            case 'oftamologia':
                $template = render_view('invoice/oftamologia.php', $view_vars);
                $pdf->loadHtml($template);
                $pdf->setPaper('letter', 'portrait');
                // $path    = 'pdf/public/oftamologia/E-00001.pdf';
                break;

            case 'ultrasonido':
                $template = render_view('invoice/ultrasonidos.php', $view_vars);
                $pdf->loadHtml($template);
                $pdf->setPaper('letter', 'portrait');
                break;

            case 'rayos':
                $template = render_view('invoice/rayos.php', $view_vars);
                $pdf->loadHtml($template);
                $pdf->setPaper('letter', 'portrait');
                break;

            default:
                $template = render_view('invoice/reportes.php', $view_vars);
                $pdf->loadHtml($template);
                $pdf->setPaper('letter', 'portrait');
                // $path    = 'pdf/public/oftamologia/E00001.pdf';
                break;
        }
        // Recibe la orden de que tipo de  modo de visualizacion quiere
        switch ($orden) {
            case 'descargar':
                $pdf->render();
                file_put_contents('../' . $path, $pdf->output());
                return $pdf->stream();
                break;
            case 'mostrar':
                $pdf->render();
                return $pdf->stream('documento.pdf', array("Attachment" => false));
                break;
            case 'url':
                $pdf->render();
                file_put_contents('../' . $path, $pdf->output());
                // return 'https://bimo-lab.com/nuevo_checkup/'. $path;
                return $host . $path;
                // echo $path;
                // return $path;
                break;
            default:
                $pdf->render();
                return $pdf->stream('documento.pdf', array("Attachment" => false));
                break;

                // session_write_close();
                session_destroy();
        }
    }
}
