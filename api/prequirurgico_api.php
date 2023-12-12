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
$antecedentes = $_POST['antecedentes'];#array
$exploracion_fisica = $_POST['exploracion_fisica'];
$electro_derivaciones = $_POST['electro_derivaciones'];
$radio = $_POST['radiografia_torax'];
$riesgo = $_POST['riesgo']; #array
$recomendacion = $_POST['recomendacio']; #array


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
        echo json_encode($antecedentes);
        exit;

    default:
        $response = "Api no definida";
};


echo $master->returnApi($response);
