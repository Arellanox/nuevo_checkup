<?php

require_once '../php/dompdf/vendor/autoload.php';
// require 'class/View.php';
require 'View.php';

use Dompdf\Adapter\PDFLib;
use Dompdf\Dompdf;
use Dompdf\Options;


class Reporte{

    public $response;
    public $tipo;

    /**
     * Create a new instance.
     *
     * @return void
     */
    public function __construct($response, $tipo, $orden){
        $this->response = $response;
        $this->tipo     = $tipo;
        $this->orden    = $orden;
    }


    public function build(){
        $data       = json_decode($this->response);
        $tipo       = $this->tipo;
        $orden      = $this->orden;

        $pdf = new Dompdf();
        
        session_start();
        
        $view_vars = array(
            "data" => $data,
        );

        // Recibe la orden de que tipo de archivo quiere
        switch ($tipo) {
            case 'etiquetas':
                $template = render_view('invoice/etiquetas.php', $view_vars);
                $pdf->loadHtml($template);
                $pdf->setPaper(array(0, 0, 107, 70), 'portrait');
                $path    = $_SERVER['DOCUMENT_ROOT'] . 'nuevo_checkup/pdf/public/etiquetas/E-'. $data->folio . '.pdf';
                break;

            case 'resultados':
                $template = render_view('invoice/resultados.php', $view_vars);
                $pdf->loadHtml($template);
                $pdf->setPaper('letter', 'portrait');
                $path    = $_SERVER['DOCUMENT_ROOT'] . 'nuevo_checkup/pdf/public/resultados/E-'. $data->folio . '.pdf';
                break;

            case 'oftamologia':
                $template = render_view('invoice/oftamologia.php', $view_vars);
                $pdf->loadHtml($template);
                $pdf->setPaper('letter', 'portrait');
                $path    = $_SERVER['DOCUMENT_ROOT'] . 'nuevo_checkup/pdf/public/oftamologia/E-'. $data->folio . '.pdf';
                break;

            default:
                $template = render_view('invoice/reportes.php', $view_vars);
                $pdf->loadHtml($template);
                $pdf->setPaper('letter', 'portrait');
                $path    = $_SERVER['DOCUMENT_ROOT'] . 'nuevo_checkup/pdf/public/oftamologia/E-'. $data->folio . '.pdf';
                break;
                
        }

        // Recibe la orden de que tipo de  modo de visualizacion quiere
        switch ($orden){
            case 'descargar':
                $pdf->render();
                file_put_contents($path, $pdf->output());
                return $pdf->stream();
                break;
            case 'mostrar':
                $pdf->render();
                return $pdf->stream('documento.pdf', array("Attachment" => false));
                break;
            default:
                $pdf->render();
                return $pdf->stream('documento.pdf', array("Attachment" => false));
                break;
        }
    }
}
