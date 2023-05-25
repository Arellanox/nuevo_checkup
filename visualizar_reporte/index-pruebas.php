<?php

session_start();
require_once "../clases/token_auth.php";
include_once '../clases/master_class.php';
include_once "../clases/Pdf.php";

$master = new Master();
// $tokenVerification = new TokenVerificacion();
// $tokenValido = $tokenVerification->verificar();
// if (!$tokenValido) {
//     // $tokenVerification->logout();
//     // exit;
// }
#Visualizar los reportes de ultrasonido y rayos X aqui
//Recibir las variables codificadas

// var myStr = "I am the string to encode";
// var token = encodeURIComponent(window.btoa(myStr));


$api = mb_convert_encoding(base64_decode(urldecode($_GET['api'])), 'UTF-8');
$turno_id = mb_convert_encoding(base64_decode(urldecode($_GET['turno'])), 'UTF-8');
$area_id = mb_convert_encoding(base64_decode(urldecode($_GET['area'])), 'UTF-8');
$usuario_id = $_SESSION['id'];

// mb_convert_encoding($rePa['paterno'],'UTF-8'));
// Imagenologia --> 8 para rayos y 11 para ultrasonido



// decomentar las siguientes 3 lineas para hacer las pruebas

$api = 'laboratorio';
$turno_id = 800;
// // $area_id = 2;
// // $area_id = 12;
// $turno_id = 742;



// $cliente_id = 1;
// $id_cotizacion = 7;


switch ($api) {
    case 'imagenologia':
        # previsualizar el reporte [el reporte que previsualizan debe ir sin pie de pagina]
        $r = $master->reportador($master, $turno_id, $area_id, 'ultrasonido', $cliente_id, $id_cotizacion, 'mostrar', 1);
        break;
    case 'oftalmo':
        $r = $master->reportador($master, $turno_id, 3, 'oftalmologia', 'mostrar', $cliente_id, $id_cotizacion, 1);
        break;
    case 'laboratorio':
        $r = $master->reportador($master, $turno_id, 6, 'resultados', 'mostrar', $cliente_id, $id_cotizacion, 1, 1);
        break;
    case 'biomolecular':
        $r = $master->reportador($master, $turno_id, 12, 'biomolecular', 'mostrar', $cliente_id, $id_cotizacion, 1);
        break;
    case 'etiquetas':
        $r = $master->reportador($master, $turno_id, 0, "etiquetas", "mostrar", $cliente_id, $id_cotizacion, 1);
        break;
    case 'consultorio':
        $r = $master->reportador($master, $turno_id, 1, 'consultorio', 'mostrar', $cliente_id, $id_cotizacion, 1);
        break;
    case 'electro':
        $r = $master->reportador($master, $turno_id, $area_id, 'electro', 'mostrar', $cliente_id, $id_cotizacion, 1);
        break;
    case 'soma':
        $r = $master->reportador($master, $turno_id, $area_id, 'reporte_masometria', 'mostrar', $cliente_id, $id_cotizacion, 1);
        break;
    case 'cotizacion':
        $r = $master->reportador($master, $turno_id,  $area_id, 'cotizaciones', 'mostrar', $cliente_id, $id_cotizacion, 1);
        break;

    default:
        echo '<script language="javascript">alert("¡URL invalida!"); window.close()</script>';
        break;
}
