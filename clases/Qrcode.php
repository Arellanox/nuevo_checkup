<?php
    require_once '../php/codeqr/vendor/autoload.php';

    use chillerlan\QRCode\QRCode;
    use chillerlan\QRCode\QROptions;

    function generarQRURL($clave, $folio, $url = 'resultados/validar-pdf/'){
        
        $options = new QROptions([
            'eccLevel' => QRCode::ECC_L,
            'outputType' => QRCode::OUTPUT_MARKUP_SVG,
            'version' => 5,
        ]);

        $contenido = 'https://bimo-lab.com/nuevo_checkup/'.$url.'?clave=83704a0987fc6f4860ef13a7340781d1&id=DBML1&modulo=6';

        $qrcode = (new QRCode())->render($contenido);

        return array($contenido, $qrcode);
    }
?>