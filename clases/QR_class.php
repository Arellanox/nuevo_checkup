<?php
require_once '../php/codeqr/vendor/autoload.php';

use chillerlan\QRCode\QRCode;
use chillerlan\QRCode\QROptions;
class QR
{
    private $texto;
    private $version;
    public $qrCode;

    function __construct($texto, $version = 5){
        $this->texto = $texto;
        $this->version = $version;
        $this->qrCode = null;
    }

    public function create(){
        $options = new QROptions([
            'eccLevel' => QRCode::ECC_L,
            'outputType' => QRCode::OUTPUT_IMAGE_PNG,
            'version' => $this->version,
        ]);

        $qr = new QRCode($options);

        $this->qrCode = $qr->render($this->texto);

        return $this->qrCode;
    }
}