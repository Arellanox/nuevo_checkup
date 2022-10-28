
<?php

include('../../php/phpqrcode/qrlib.php');

# URL carpeta
$tempDir = 'temp/qr/clientes/';

$codeContents = 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Proin nibh augue, suscipit a';

// generating
QRcode::png($codeContents, $tempDir.'QR_file_ID.png', QR_ECLEVEL_M);

// echo URl
echo "$tempDir.'QR_file_ID.png";

 ?>
