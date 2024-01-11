<?php
require_once "../clases/master_class.php";
require_once "../clases/token_auth.php";


$tokenVerification = new TokenVerificacion();
$tokenValido = $tokenVerification->verificar();
if (!$tokenValido) {
    // $tokenVerification->logout();
    // exit;
}

$master = new Master();

$fecha_inicio = $_POST['fecha_inicial'];
$fecha_final = $_POST['fecha_final'];
$bimer_id = isset($_POST['bimer_id']) ? $_POST['bimer_id'] : null;


$vacaciones = isset($_POST['vacaciones']) ? $_POST['vacaciones'] : 0;
$permisosCGS = isset($_POST['permisosCGS']) ? $_POST['permisosCGS']: 0;
$incapacidad = isset($_POST['incapacidad']) ? $_POST['incapacidad'] : 0;
$faltaInjustificada = isset($_POST['faltaInjustificada']) ? $_POST['faltaInjustificada'] : 0;
$hrsExtras = isset($_POST['hrsExtras']) ? $_POST['hrsExtras'] : 0;
$permisoSGS = isset($_POST['permisoSGS']) ? $_POST['permisoSGS'] : 0;

$creado_por  = $_SESSION['id'];



$asistencia = json_decode(file_get_contents('php://input'), true);

$api = isset($asistencia['api']) ? $asistencia['api'] : $_POST['api'];


if ((isset($asistencia['api']) && isset($asistencia['nombre'])) || (isset($_POST['api']))) {

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
            $data = $master->getByProcedure("sp_checador_data", [$fecha_inicio, $fecha_final, $bimer_id, 0]);

            $registros = array();
            $registros['REGISTROS'] = $data;

            $response = $registros;

            break;
        case 5:

            #RECUPERAMOS LA DATA PARA LA VISTA
            $response = $master->getByProcedure('sp_checador_data', [$fecha_inicio, null, null, 1]);

            break;
        case 6:

            #RECUPERAMOS LA DATA PARA LA VISTA
            $response = $master->getByProcedure('sp_checador_data', [$fecha_inicio, $fecha_final, $bimer_id, 0]);

            break;
        case 7:
            #Guardamos los datos del reporte personal

            $preview = ['FECHA_INICIO' => $fecha_inicio, 'FECHA_FINAL' => $fecha_final];
            $url = $master->reportador($master, $bimer_id, -6, "asistencia", 'url', $preview);
            

            $data = array(
                $bimer_id,
                $vacaciones, 
                $permisosCGS,
                $incapacidad,
                $faltaInjustificada,
                $hrsExtras,
                $permisoSGS,
                $creado_por,
                $url
            );

            $response = $master->getByProcedure('sp_reporte_checadorBimo_g', $data);


            break;
        case 8:
            
            #Mostrar todos los reporte que tiene el bimer_id
            $response = $master->getByProcedure('sp_reporte_checadorBimo_b', [$bimer_id]);


            break;
        case 9:

            $response = $master->getByProcedure("sp_reporte_checadorBimo_excel_b", [null, null, null, 1]);

            break;
        
        case 10:

            $response = $master->getByProcedure("sp_reporte_checadorBimo_excel_b", [$bimer_id, $fecha_inicio, $fecha_final, 0]);

            break;
        default:

            $response = "Api no definida";
    }

    $respuesta = $master->returnApi($response);

    echo $respuesta;
}
