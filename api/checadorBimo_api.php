<?php
require_once "../clases/master_class.php";
$master = new Master();

$asistencia = json_decode(file_get_contents('php://input'), true);



if (isset($asistencia['api']) && isset($asistencia['nombre'])) {

    switch ($asistencia['api']) {

        case 1:
            #GUARDAMOS LA ASISTENCIA EN LA BASE DE DATOS
            $nombre =  str_replace(array('"', "'"), '', json_encode($asistencia['nombre']));

            $response = $master->getByProcedure('sp_checardor_bimo_g', [$nombre]);

            break;

        case 2:
            #GUARDAMOS LAS NUEVAS CODIFICACIONES DE ROSTROS
            $nombre = json_encode($asistencia['nombre']);
            $codificacion = json_encode($asistencia['codificacion']);

            $response = $master->insertByProcedure('sp_codificar_rostro_g', [$nombre, $codificacion]);


            break;

        case 3:
            #OBTENEMOS TODAS LAS CODIFICACIONES DE ROSTROS QUE TENEMOS ALMACENADA EN LA BASE DE DATOS
            $response = $master->getByProcedure('sp_codificar_rostro_g', [null, null]);

            break;
        default:

            $response = "Api no definida";
    }


    $respuesta = $master->returnApi($response);

    // $fh = fopen("asistencia.txt", 'a');
    // fwrite($fh, $respuesta);
    // fclose($fh);

    echo $respuesta;
}
