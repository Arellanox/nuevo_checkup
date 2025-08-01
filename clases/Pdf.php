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
    public $preview;
    public $area;

    /**
     * Create a new instance.
     *
     * @return void
     */
    public function __construct($response, $data, $pie, $archivo, $tipo, $orden, $preview = 0, $area)
    {
        $this->response = $response; //cuerpo
        $this->data     = $data; //Ecabezado
        $this->pie      = $pie; //Footer <-- Se manda folio
        $this->archivo  = $archivo; //Ruta de reporte
        $this->tipo     = $tipo; //Tipo de resultado
        $this->orden    = $orden; //Forma de visualizar
        $this->preview = $preview;
        $this->area = $area;
    }

    public function build(): ?string
    {
        $response = json_decode($this->response);
        $data = json_decode($this->data); //Esperando la data general
        $pie = $this->pie;
        $archivo = $this->archivo;
        $tipo = $this->tipo;
        $orden = $this->orden;
        $preview = $this->preview;
        $area = $this->area;

        switch ($tipo) {
            case 'etiquetas':
                $generator = null;
                $barcode = null;
                // $generator = new Picqer\Barcode\BarcodeGeneratorPNG();
                // $barcode  = base64_encode($generator->getBarcode($response->BARRAS, $generator::TYPE_CODE_128));
                // $barcode  = base64_encode($generator->getBarcode('750169978916', $generator::TYPE_CODE_128));
                break;
            case 'resultados':
            case 'biomolecular':
            case 'oftalmologia':
            case 'ultrasonido':
            case 'rayos': //rayos piu piu
            case 'consultorio':
            case 'electro':
            case 'cotizacion':
            case 'ticket':
            case 'fast_checkup':
            case 'reporte_masometria':
            case 'espirometria': //nuevo case de espirometria
            case 'corte':
            case 'consultorio2': //<--Consultorio2 (Creado Angel) 
            case 'receta': //<--Receta (Creado Angel) 
            case 'solicitud_estudios': //<-- (Creado Angel)
            case 'audiometria':
                $prueba = generarQRURL($pie['clave'], $pie['folio'], $pie['modulo']);
                break;
            case 'envio_muestras':
            case 'form_datos':
            case 'lista-barras':
                $generator = null;
                $barcode = null;
            default:
                $barcode = null;
                break;
        }

        $host = $_SERVER['SERVER_NAME'] == "localhost" ? "http://localhost/nuevo_checkup/" : "https://bimo-lab.com/nuevo_checkup/";
        $path = $archivo['ruta'] . $archivo['nombre_archivo'] . ".pdf";
        // $path    = 'pdf/public/resultados/E-00001.pdf';

        session_start();
        $view_vars = array(
            "resultados" => $response,
            "encabezado" => $data,
            "pie" => isset($pie) ? $pie : null,
            "qr" => isset($prueba) ? $prueba : null,
            "barcode" => isset($barcode) ? $barcode : null,
            "preview" => $preview,
            "area" => isset($area) ? $area : null,
            "validacion" => $host . "resultados/validar-pdf/?clave=" . $pie['clave'] . "&modulo=" . $pie['modulo']
        );

        $pdf = new Dompdf();

        switch ($tipo) { // Recibe la orden de que tipo de archivo quiere
            case 'etiquetas':
                $template = render_view('invoice/etiquetas.php', $view_vars);
                $pdf->loadHtml($template);

                $ancho = (5 / 2.54) * 72;
                $alto = (2.5 / 2.54) * 72;

                $pdf->setPaper(array(0, 0, $ancho, $alto), 'portrait');
                // $path    = 'pdf/public/etiquetas/00001.pdf';
                break;
            case 'resultados':
                $template = render_view('invoice/resultados.php', $view_vars);
                $pdf->loadHtml($template);
                $pdf->setPaper('letter', 'portrait');
                break;
            case 'espirometria':
                $template = render_view('invoice/esp.php', $view_vars);
                $pdf->loadHtml($template);
                $pdf->setPaper('letter', 'portrait');
                break;
            case 'oftalmologia':
                $template = render_view('invoice/oftalmologia.php', $view_vars);
                $pdf->loadHtml($template);
                $pdf->setPaper('letter', 'portrait');
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
            case 'electro':
                $template = render_view('invoice/electro.php', $view_vars);
                $pdf->loadHtml($template);
                $pdf->setPaper('letter', 'portrait');
                break;
            case 'reporte_masometria':
                $template = render_view('invoice/reporte_masometria.php', $view_vars);
                $pdf->loadHtml($template);
                $pdf->setPaper('letter', 'portrait');
                break;
            case 'biomolecular':
                $template = render_view('invoice/biomolecular.php', $view_vars);
                $pdf->loadHtml($template);
                $pdf->setPaper('letter', 'portrait');
                break;
            case 'consultorio':
                $template = render_view('invoice/consultorio.php', $view_vars);
                $pdf->loadHtml($template);
                $pdf->setPaper('letter', 'portrait');
                break;

            case 'sigma_consultorio':
                $template = render_view('invoice/sigma.php', $view_vars);
                $pdf->loadHtml($template);
                $pdf->setPaper('letter', 'portrait');
                break;
            case 'ticket':
                $template = render_view('invoice/ticket.php', $view_vars);
                $pdf->loadHtml($template);
                $pdf->setPaper('letter', 'portrait');
                break;
            case 'cotizaciones':
                $template = render_view('invoice/cotizaciones.php', $view_vars);
                $pdf->loadHtml($template);
                $pdf->setPaper('letter', 'portrait');
                break;
            case 'fast_checkup':
                $template = render_view('invoice/fast_checkup.php', $view_vars);
                $pdf->loadHtml($template);
                $pdf->setPaper('letter', 'portrait');
                break;
            case 'corte':
                $template = render_view('invoice/corte2.php', $view_vars);
                $pdf->loadHtml($template);
                $pdf->setPaper('letter', 'portrait');
                break;
            case 'consultorio2':
                $template = render_view('invoice/consultorio2.php', $view_vars);
                $pdf->loadHtml($template);
                $pdf->setPaper('letter', 'portrait');
                break;
            case 'receta':
                $template = render_view('invoice/receta.php', $view_vars);
                $pdf->loadHtml($template);
                // Convertir centímetros a puntos
                $height = 14 * 28.3465; // 21.59 cm a puntos
                $width = 21.5 * 28.3465;   // 18 cm a puntos
                $pdf->setPaper([0, 0, $width, $height], 'portrait');
                $pdf->setPaper('letter', 'portrait');

                //Marca de agua
                $pdf->getOptions()->setIsHtml5ParserEnabled(true); // Habilita el soporte para CSS3
                $pdf->getOptions()->setIsFontSubsettingEnabled(true); // Habilita la subconjunción de fuentes
                break;
            case 'solicitud_estudios':
                $template = render_view('invoice/solicitud_estudios.php', $view_vars);
                $pdf->loadHtml($template);
                $pdf->setPaper('letter');

                // $height = 14 * 28.3465; // 21.59 cm a puntos
                // $width = 21.5 * 28.3465;   // 18 cm a puntos
                // $pdf->setPaper([0, 0, $width, $height], 'portrait');
                break;
            case 'temperatura':
                $template = render_view('invoice/temperatura_refrigeradores.php', $view_vars);
                $pdf->loadHtml($template);
                $pdf->setPaper('letter', 'landscape');
                break;
            case 'audiometria':
                $template = render_view('invoice/audio.php', $view_vars);
                $pdf->loadHtml($template);
                $pdf->setPaper('letter');
                break;
            case 'envio_muestras':
                $template = render_view('invoice/envio_muestras.php', $view_vars);
                $pdf->loadHtml($template);
                $pdf->setPaper('letter', 'landscape');
                break;
            case 'form_datos':
                # para confirmacion de datos del paciente
                $template = render_view('invoice/form_datos.php', $view_vars);
                $pdf->loadHtml($template);
                $pdf->setPaper('letter');
                break;
            case 'lista-barras':
                # para imprimr la lista de trabajo de laboratorio clinico con codigos de barras
                $template = render_view('invoice/lista-barras.php', $view_vars);
                $pdf->loadHtml($template);
                $pdf->setPaper("letter");
                break;
            case 'estados_cuentas':
                $template = render_view('invoice/estado_cuenta.php', $view_vars);
                $pdf->loadHtml($template);
                $pdf->setPaper('letter', 'landscape');
                //$path    = 'pdf/public/oftalmologia/E00001.pdf';
                break;
            case 'solicitud_maquila_diagnostica':
                $template = render_view('invoice/solicitud_maquila_diagnostica.php', $view_vars);
                $pdf->loadHtml($template);
                $pdf->setPaper('letter');
                break;
            case 'solicitud_maquila_general':
                $template = render_view('invoice/solicitud_maquila_general.php', $view_vars);
                $pdf->loadHtml($template);
                $pdf->setPaper('letter');
                break;
            case "certificado_bimo":
                $template = render_view('invoice/footer_certificado_vinco.php', $view_vars);
                $pdf->loadHtml($template);
                $pdf->setPaper('letter');
                break;
            case "examen_medico":
                $template = render_view('invoice/footer_examen_medico.php', $view_vars);
                $pdf->loadHtml($template);
                $pdf->setPaper('letter');
                break;
            case "reporte_ventas":
                $template = render_view('invoice/reporte_ventas.php', $view_vars);
                $pdf->loadHtml($template);
                $pdf->setPaper('letter', 'landscape');
                break;
            default:
                $template = render_view('invoice/reportes.php', $view_vars);
                $pdf->loadHtml($template);
                $pdf->setPaper('letter');
                break;
        }

        // Recibe la orden de que tipo de  modo de visualizacion quiere
        $pdf->render();

        switch ($orden) {
            case 'descargar':
                file_put_contents('../' . $path, $pdf->output());
                return $pdf->stream();
            case 'url':
                file_put_contents('../' . $path, $pdf->output());
                $http = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https://' : 'http://';
                $servidor = $_SERVER['HTTP_HOST'];
                $current_url = "{$http}{$servidor}/nuevo_checkup/";

                return $current_url. $path;
            default:
                return $pdf->stream('documento.pdf', array("Attachment" => false));
        }

        //session_write_close();
    }
}
