<?php
include "../interfaces/iMetodos.php";
require_once "../clases/token_auth.php";
include "../clases/segmentos_class.php";

$tokenVerification = new TokenVerificacion();
$tokenValido = $tokenVerification->verificar();
if (! $tokenValido){
    $tokenVerification->logout();
    exit;
}

$slice_update=24;
$slice_insert=$slice_update-1;

$api = $_POST['api'];
$id_paciente = $_POST['id'];
$curp = $_POST['curp'];

$master = new Master();
switch ($api) {
    case 1:
        # insertar un nuevo paciente
        $array_slice = array_slice($_POST, 0, $slice_insert);
        $parametros = $master->getFormValues($array_slice);    
        $response = $master->insertByProcedure("sp_pacientes_g",$parametros);
        if (is_numeric($response)) {
            echo json_encode(array("response" => array("code" => 1, "affected" => $response)));
        } else {
            echo json_encode(array("response" => array("code" => 0, "msj" => $response)));
        }
        break;
    case 2:
        # buscar pacientes
        $resultset = $master->getByProcedure("sp_pacientes_b",[$id_paciente,$curp]);
        if (is_array($resultset)) {
            echo json_encode($resultset);
        } else {
            echo json_encode(array("response" => array("code" => 0, "msj" => $resultset)));
        }
        break;

    case 3:
        /* # actualizar pacientes
        ## Enviar el id del paciente al final del arreglo
        */
        $array_slice = array_slice($_POST, 0, $slice_update);
        $parametros = $master->getFormValues($array_slice);    
        $response = $master->updateByProcedure("sp_pacientes_g",$parametros);
        if (is_numeric($response)) {
            echo json_encode(array("response" => array("code" => 1, "affected" => $response, "msj" => "Envío exitoso")));
        } else {
            echo json_encode(array("response" => array("code" => 0, "affected" => -1, "msj" => $response)));
        }
        break;
    case 4:
        # desactivr paciente
        $result = $master->deleteByProcedure("sp_pacientes_b",[$id_paciente]);
        if (is_numeric($result)) {
            echo json_encode(array("response" => array("code" => 1, "affected" => $result)));
        } else {
            echo json_encode(array("response" => array("code" => 0, "msj" => $result)));
        }
        break;

    default:
            echo json_encode(array("response" => array("code" => 0, "affected" => -1, "msj" => "api no reconocida")));
        break;
}
