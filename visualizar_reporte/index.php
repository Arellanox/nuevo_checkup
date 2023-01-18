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


// mb_convert_encoding($rePa['paterno'],'UTF-8'));
switch ($api) {
    case 'imagenologia':
        # previsualizar el reporte [el reporte que previsualizan debe ir sin pie de pagina]
        $r = crearReporteImageonologia($turno_id, $area_id, 'ultrasonido', "mostrar");

        break;

    default:
        echo "reporte no existente";
        break;
}



function crearReporteImageonologia($turno_id, $area_id, $reporte, $viz = 'url')
{
    $master = new Master();
    #Recuperar info paciente
    $infoPaciente = $master->getByProcedure('sp_informacion_paciente', [$turno_id]);
    $infoPaciente = [$infoPaciente[count($infoPaciente) - 1]];

    switch ($area_id) {
        case 8:
        case '8':
            $infoPaciente[0]['TITULO'] = 'Reporte de rayos x';
            $infoPaciente[0]['SUBTITULO'] = 'Datos del paciente';
            break;
        case 11:
        case '11':
            $infoPaciente[0]['TITULO'] = 'Reporte de ultrasonido';
            $infoPaciente[0]['SUBTITULO'] = 'Datos del paciente';
            break;
    }



    #recuperar la informacion del Reporte de interpretacion de ultrasonido
    $response = array();
    # recuperar los resultados de ultrasonido
    // $area_id = $area_id; #11 es el id para ultrasonido.
    $response1 = $master->getByNext('sp_imagenologia_resultados_b', [null, $turno_id, $area_id]);
    // print_r($response1);
    $arrayimg = [];

    for ($i = 0; $i < count($response1[1]); $i++) {

        $servicio = $response1[1][$i]['SERVICIO'];
        $hallazgo = $response1[1][$i]['HALLAZGO'];
        $interpretacion = $response1[1][$i]['INTERPRETACION_DETALLE'];
        $comentario = $response1[1][$i]['COMENTARIO'];
        $tecnica = $response1[1][$i]['TECNICA'];
        $array1 = array(
            "ESTUDIO" => $servicio,
            "HALLAZGO" => $hallazgo,
            "INTERPRETACION" => $interpretacion,
            "COMENTARIO" => $comentario,
            "TECNICA" => $tecnica

        );
        array_push($arrayimg, $array1);
    }

    $arregloPaciente = array(
        'NOMBRE' => $infoPaciente[0]['NOMBRE'],
        "EDAD" => $infoPaciente[0]['EDAD'],
        'SEXO' => $infoPaciente[0]['SEXO'],
        'FOLIO' => $infoPaciente[0]['FOLIO_IMAGEN'],
        'FECHA_RESULTADO' => $response1[1][0]['FECHA_RESULTADO'],
        'ESTUDIOS' => $arrayimg
    );

    # pie de pagina
    $fecha_resultado = $infoPaciente[0]['FECHA_CARPETA_IMAGEN'];
    $nombre_paciente = $infoPaciente[0]['NOMBRE'];
    $nombre = str_replace(" ", "_", $nombre_paciente);

    $ruta_saved = "reportes/modulo/ultrasonido/$fecha_resultado/$turno_id/";

    # Crear el directorio si no existe
    $r = $master->createDir("../" . $ruta_saved);
    $archivo = array("ruta" => $ruta_saved, "nombre_archivo" => $nombre . "-" . $infoPaciente[0]['ETIQUETA_TURNO'] . '-' . $fecha_resultado);

    $pie_pagina = array("clave" => $infoPaciente[0]['CLAVE_IMAGEN'], "folio" => $infoPaciente[0]['FOLIO_IMAGEN'], "modulo" => 11);
    // print_r($infoPaciente);
    $pdf = new Reporte(json_encode($arregloPaciente), json_encode($infoPaciente[0]), $pie_pagina, $archivo, $reporte, $viz, 1);
    return $pdf->build();

    // print_r($arregloPaciente);
}
