<?php

require_once '../php/dompdf/vendor/autoload.php';
require 'View.php';
require 'Qrcode.php';


use Dompdf\Adapter\PDFLib;
use Dompdf\Dompdf;
use Dompdf\Options;

class Reporte{

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
    public function __construct($response, $data, $pie, $archivo, $tipo, $orden){
        $this->response = $response;
        $this->data     = $data;
        $this->pie      = $pie;
        $this->archivo  = $archivo;
        $this->tipo     = $tipo;
        $this->orden    = $orden;
    }

    public function build(){
        $response   = json_decode($this->response);
        $data       = json_decode($this->data); //Esperando la data general
        $pie        = $this->pie;
        $archivo    = $this->archivo;
        $tipo       = $this->tipo;
        $orden      = $this->orden;

        $pdf = new Dompdf();

        $prueba = generarQRURL($pie['clave'], $pie['folio'], $pie['modulo']);

        $path = $archivo['ruta'].$archivo['nombre_archivo'].".pdf";
        // echo $path;

        session_start();
        $view_vars = array(
            "resultados"            => $response,
            "encabezado"            => $data,
            "qr"                    => $prueba,
        );


        // Recibe la orden de que tipo de archivo quiere
        switch ($tipo) {
            case 'etiquetas':
                $template = render_view('invoice/etiquetas.php', $view_vars);
                $pdf->loadHtml($template);
                $pdf->setPaper(array(0, 0, 107, 70), 'portrait');
                // $path    = 'pdf/public/etiquetas/00001.pdf';
                break;

            case 'resultados':
                $template = render_view('invoice/resultados.php', $view_vars);
                $pdf->loadHtml($template);
                $pdf->setPaper('letter', 'portrait');
                // $path    = 'pdf/public/resultados/E-00001.pdf';
                break;

            case 'oftamologia':
                $template = render_view('invoice/oftamologia.php', $view_vars);
                $pdf->loadHtml($template);
                $pdf->setPaper('letter', 'portrait');
                // $path    = 'pdf/public/oftamologia/E-00001.pdf';
                break;

            default:
                $template = render_view('invoice/reportes.php', $view_vars);
                $pdf->loadHtml($template);
                $pdf->setPaper('letter', 'portrait');
                // $path    = 'pdf/public/oftamologia/E00001.pdf';
                break;

        }
        // Recibe la orden de que tipo de  modo de visualizacion quiere
        switch ($orden){
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
                return 'https://bimo-lab.com/nuevo_checkup/'. $path;
                break;
            default:
                $pdf->render();
                return $pdf->stream('documento.pdf', array("Attachment" => false));
                break;
        }
    }
}
