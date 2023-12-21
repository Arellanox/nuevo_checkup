<?php
require_once "../clases/master_class.php";
$master = new Master();

$asistencia = json_decode(file_get_contents('php://input'), true);

$fecha_inicio = $_POST['fecha_inicial'];
$fecha_final = $_POST['fecha_final'];
$bimer_id = $_POST['bimer_id'];

$asistencia['api'] = isset($asistencia['api'])? $asistencia['api'] : $_POST['api'];


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
        case 4:
            # recuperar los registros de entradas/salidas
            $data = $master->getByProcedure("sp_checador_data", [$fecha_inicio, $fecha_final, $bimer_id]);
            echo "hola3";
            print_r($data);
            exit;
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


# recuperamos la data
$data = $master->getByNext("sp_checador_data", [$fecha_inicio, $fecha_final, $bimer_id]);

$bimers = $data[1];
$records = $data[0];
$dates = $data[2];

$filteredRecords = array();
foreach($dates as $date){
    $fecha = $date['FECHA'];

    $filtered = array_filter($records, function($item) use ($fecha){
        return $item["FECHA"] ==$fecha;
    });

    $filteredRecords[$fecha] = $filtered;
}


print_r($filteredRecords);

