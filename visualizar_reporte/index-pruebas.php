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

$api = '1';
$turno_id = 0;
// $area_id =2;

$review = 1;
$tipoView = 'url';

switch ($api) {
    case 'imagenologia':
        # previsualizar el reporte [el reporte que previsualizan debe ir sin pie de pagina]
        $r = $master->reportador($master, $turno_id, $area_id, 'ultrasonido', $cliente_id, $id_cotizacion, $tipoView, $review,);
        break;
    case 'oftalmo':
        $r = $master->reportador($master, $turno_id, 3, 'oftalmologia', $cliente_id, $id_cotizacion, $tipoView, $review,);
        break;
    case 'laboratorio':
        $r = $master->reportador($master, $turno_id, 6, 'resultados',  $cliente_id, $id_cotizacion, $tipoView, $review,);
        break;
    case 'biomolecular':
        $r = $master->reportador($master, $turno_id, 12, 'biomolecular',  $cliente_id, $id_cotizacion, $tipoView, $review,);
        break;
    case 'etiquetas':
        $r = $master->reportador($master, $turno_id, 0, "etiquetas",  $cliente_id, $id_cotizacion, $tipoView, $review,);
        break;
    case 'consultorio':
        $r = $master->reportador($master, $turno_id, 1, 'consultorio', $cliente_id, $id_cotizacion, $tipoView, $review,);
        break;
    case 'electro':
        $r = $master->reportador($master, $turno_id, $area_id, 'electro', $cliente_id, $id_cotizacion, $tipoView, $review,);
        break;
    case 'soma':
        $r = $master->reportador($master, $turno_id, $area_id, 'reporte_masometria', $cliente_id, $id_cotizacion, $tipoView, $review,);
        break;

    default:
        echo '<script language="javascript">alert("¡URL invalida!"); window.close()</script>';
        break;
}
