<?php
include "../clases/master_class.php";
require_once "../clases/token_auth.php";

$tokenVerification = new TokenVerificacion();
$tokenValido = $tokenVerification->verificar();
if (!$tokenValido) {
    // $tokenVerification->logout();
    // exit;
}

$master = new Master();

$datos = $_POST['datos'];
$api = $_POST['api'];
$antecedentes = $datos['antecedentes'];
$exploracion = $datos['exploracion_fisica'];
$electro = $datos[''];

$cliente_id = $_POST['cliente_id'];

# datos para guardar
$antecedentes = $_POST['antecedentes']; #array
$cirugia_programada = $_POST['cirugia_programada'];
$exploracion_fisica = $_POST['exploracion_fisica'];
$electro_derivaciones = $_POST['electro_derivaciones'];
$radio = $_POST['radiografia_torax'];
$asa = $_POST['ASA'];
$golman = $_POST['GOLDMAN'];
$gupta_respiratorio = $_POST['gupta_respiratorio'];
$gupta_neumonia = $_POST['gupta_neumonia'];
$gupta_cardiovascular = $_POST['gupta_cardiovascular'];
$geneva = $_POST['GENEVA'];
$caprini = $_POST['CAPRINI'];
$stop_bang = $_POST['STOP-BAN'];
$recomendaciones_texto = $_POST['recomendaciones_texto']; 
$recomendaciones_josn = $_POST['recomendacion_json'];
$turno_id = $_POST['turno_id'];
$confirmado = isset($_POST['confirmado']) ? $_POST['confirmado'] : 0;


$data_g = array(

    json_encode($antecedentes),
    $cirugia_programada,
    $exploracion_fisica,
    $electro_derivaciones,
    $radio,
    $asa,
    $golman,
    $gupta_respiratorio,
    $gupta_neumonia,
    $gupta_cardiovascular,
    $geneva,
    $caprini,
    $stop_bang,
    $recomendaciones_texto,
    json_encode($recomendaciones_josn),
    $turno_id,
    $confirmado

);

switch ($api) {

    case 1:
        # para recuperar la lista de trabajo.
        # paciente que tengan por procedencia CLINICA DEL DR CASTILLO
        # o que tengan cargados los paquetes de prequirurgico.
        $area = $_POST['area_id'];
        $fecha = isset($_POST['fecha_busqueda']) ?  $_POST['fecha_busqueda'] : NULL;
        $response = $master->getByProcedure("sp_prequirurgico_b", [$fecha, $area, null, $_SESSION['id'], $cliente_id]);

        break;
    case 2:
        # guardar los datos.
        
        $response =  $master->getByProcedure('sp_prequirurgico_g', $data_g );

        break;
    case 3:
        #confimamos el reporte
        $response = $master->getByProcedure('sp_prequirurgico_pdf_g', [$turno_id, $_SESSION['id'], null, $confirmado]);

        $url = $master->reportador($master, $turno_id,-5,"prequirurgico");
        $response = $master->updateByProcedure("sp_reportes_actualizar_ruta", ["prequirurgico_pdf","RUTA_REPORTE", $url, $turno_id, null]);


        break;

    default:
        $response = "Api no definida";
};


echo $master->returnApi($response);
