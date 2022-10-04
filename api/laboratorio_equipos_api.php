<?php
session_start();
include "../clases/master_class.php";
require_once "../clases/token_auth.php";

$tokenVerification = new TokenVerificacion();
$tokenValido = $tokenVerification->verificar();
if (! $tokenValido){
    $tokenVerification->logout();
    exit;
}

$master = new Master();
$api = $_POST['api'];

/* if(!$master->checkStartedSession()){
    echo "NO TIENES UNA SESION INICIADA";

}else { */
    switch ($api) {
        case 1:
            $array_slice = array_slice($_POST, 0, 15);
            $values = $master->mis->getFormValues($array_slice);

            $response = $master->insertByProcedure('sp_laboratorio_equipos_g',$values);
            if(is_numeric($response)){
                echo json_encode(array("response"=>array(
                    "code"=>1,
                    "lastId"=>$response
                )));
            } else {
                echo json_encode(array("response"=>array(
                    "code"=>2,
                    "msj"=>$response
                )));
            }
            break;
        case 2:
            $response = $master->getByProcedure('sp_laboratorio_equipos_b',array(null));

            if (is_array($response)) {
                echo json_encode(array("response"=>array(
                    "code"=>1,
                    "data"=> $response
                )));
            } else {
                echo json_encode(array("response"=>array(
                    "code"=>1,
                    "msj" => $response
                )));
            }

            break;
        case 3:
            $values = $master->mis->getFormValues(array_slice($_POST,0,1));
            $response = $master->getByProcedure('sp_laboratorio_equipos_b',$values);
            if (is_array($response)) {
                echo json_encode(array("response"=>array(
                    "code"=>1,
                    "data"=> $response
                )));
            } else {
                echo json_encode(array("response"=>array(
                    "code"=>1,
                    "msj" => $response
                )));
            }
            break;
        case 4:
            $values = $master->mis->getFormValues(array_slice($_POST,0,16));
            $response = $master->updateByProcedure('sp_laboratorio_equipos_g',$values);
            if (is_numeric($response)) {
                echo json_encode(array("response"=>array(
                    "code"=>1,
                    "affected"=> $response
                )));
            } else {
                echo json_encode(array("response"=>array(
                    "code"=>1,
                    "msj" => $response
                )));
            }
            break;
        case 5:
            $values = $master->mis->getFormValues(array_slice($_POST,0,1));
            $response = $master->deleteByProcedure('sp_laboratorio_equipos_e',$values);
            if (is_numeric($response)) {
                echo json_encode(array("response"=>array(
                    "code"=>1,
                    "affected"=> $response
                )));
            } else {
                echo json_encode(array("response"=>array(
                    "code"=>1,
                    "msj" => $response
                )));
            }
            break;
        default:
            break;
    }
#}
?>
