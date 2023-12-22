<?php


include_once "../clases/master_class.php";
$master = new Master();

$fecha_inicio = $_POST['fecha_inicial'];
$fecha_final = $_POST['fecha_final'];
$bimer_id = $asistencia['bimer_id'];

// $asistencia = json_decode(file_get_contents('php://input'), true);


// $asistencia['api'] = isset($asistencia['api']) ? $asistencia['api'] : $_POST['api'];
$api = isset($asistencia['api']) ? $asistencia['api'] : $_POST['api'];



// if (isset($asistencia['api']) && isset($asistencia['nombre'])) {

switch ($api) {

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
        # recuperamos la data
        $data = $master->getByNext("sp_checador_data", [$fecha_inicio, $fecha_final, $bimer_id]);

        $bimers = $data[1];
        $records = $data[0];
        $dates = $data[2];

        $filteredRecords = array();
        foreach ($dates as $date) {
            $fecha = $date['FECHA'];

            $filtered = array_filter($records, function ($item) use ($fecha) {
                return $item["FECHA"] == $fecha;
            });

            $filteredRecords[$fecha] = $filtered;
        }

        $response = $filteredRecords;


     

        break;
    default:

        $response = "Api no definida";
        
    }

        $respuesta = $master->returnApi($response);

        echo $respuesta;


// }

