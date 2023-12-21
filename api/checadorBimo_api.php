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

# bimers que aparecen en los registros (solo una vez).
$records = $data[1];

# dataset de los registros de entradas y salidas.
$data = $data[0];

$bimerRecords = array();
foreach($records as $record){
    $fecha = $record['FECHA'];
    $bimers = array_filter($data,function($registro) use($fecha){
        return $registro['FECHA'] == $fecha;
    });
    

    $bimerRecords[$fecha] = $bimers;
}

print_r($bimerRecords);