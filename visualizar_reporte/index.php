<?php
session_start();
require_once "../clases/token_auth.php";
include_once '../clases/master_class.php';
include_once "../clases/Pdf.php";

$master = new Master();
$tokenVerification = new TokenVerificacion();
$tokenValido = $tokenVerification->verificar();
if (!$tokenValido) {
    $tokenVerification->logout();
    exit;
}
#Visualizar los reportes de ultrasonido y rayos X aqui
//Recibir las variables codificadas

// var myStr = "I am the string to encode";
// var token = encodeURIComponent(window.btoa(myStr));


$api = mb_convert_encoding(base64_decode(urldecode($_GET['api'])), 'UTF-8');
$turno_id = mb_convert_encoding(base64_decode(urldecode($_GET['turno'])), 'UTF-8');
$area_id = mb_convert_encoding(base64_decode(urldecode($_GET['area'])), 'UTF-8');

#variables directas si es necesario testearlo
//$api = laboratorio
//$turno_id = 167;
//$area_id = 6


// mb_convert_encoding($rePa['paterno'],'UTF-8'));
switch ($api) {
    case 'imagenologia':
        # previsualizar el reporte [el reporte que previsualizan debe ir sin pie de pagina]
        $r = $master->reportador($master, $turno_id, $area_id, 'ultrasonido', 'mostrar', 1);
        break;
    case 'oftalmo':
        $r = $master->reportador($master, $turno_id, 3, 'oftalmologia', 'mostrar', 1, 1 /* Este uno te regresa todo el arreglo sin generar el pdfxd */);
        #Usar para imprimir el arreglo y verlo en postman
        print_r($r);
        break;

    case 'laboratorio':
        $r = $master->reportador($master, $turno_id, 6, 'resultados', 'mostrar', 1);
        break;

    default:
        echo "reporte no existente";
        break;
}
