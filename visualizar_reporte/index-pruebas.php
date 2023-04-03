<?php

session_start();
require_once "../clases/token_auth.php";
include_once '../clases/master_class.php';
include_once "../clases/Pdf.php";

$master = new Master();
$tokenVerification = new TokenVerificacion();
$tokenValido = $tokenVerification->verificar();
if (!$tokenValido) {
    // $tokenVerification->logout();
    // exit;
}
#Visualizar los reportes de ultrasonido y rayos X aqui
//Recibir las variables codificadas

// var myStr = "I am the string to encode";
// var token = encodeURIComponent(window.btoa(myStr));


$api = mb_convert_encoding(base64_decode(urldecode($_GET['api'])), 'UTF-8');
$turno_id = mb_convert_encoding(base64_decode(urldecode($_GET['turno'])), 'UTF-8');
$area_id = mb_convert_encoding(base64_decode(urldecode($_GET['area'])), 'UTF-8');
// $usuario_id = $_SESSION['id'];

// mb_convert_encoding($rePa['paterno'],'UTF-8'));
// Imagenologia --> 8 para rayos y 11 para ultrasonido



// decomentar las siguientes 3 lineas para hacer las pruebas

$api = 'biomolecular';
$turno_id = 381;
// $area_id =2;

$review = 10;
$tipoView = 'url';

switch ($api) {
    case 'imagenologia':
        # previsualizar el reporte [el reporte que previsualizan debe ir sin pie de pagina]
        $r = $master->reportador($master, $turno_id, $area_id, 'ultrasonido', $tipoView, $review);
        break;
    case 'oftalmo':
        $r = $master->reportador($master, $turno_id, 3, 'oftalmologia', $tipoView, $review);
        break;
    case 'laboratorio':
        $r = $master->reportador($master, $turno_id, 6, 'resultados', $tipoView, $review);
        break;
    case 'biomolecular':
        $r = $master->reportador($master, $turno_id, 12, 'biomolecular', $tipoView, $review);
        break;
    case 'etiquetas':
        $r = $master->reportador($master, $turno_id, 0, "etiquetas", $tipoView, $review);
        break;
    case 'consultorio':
        $r = $master->reportador($master, $turno_id, 1, 'consultorio', $tipoView, $review);
        break;
    case 'electro':
        $r = $master->reportador($master, $turno_id, $area_id, 'electro', $tipoView, $review);
        break;
    case 'soma':
        $r = $master->reportador($master, $turno_id, $area_id, 'reporte_masometria', $tipoView, $review);
        break;

    default:
        echo '<script language="javascript">alert("¡URL invalida!"); window.close()</script>';
        break;
}
