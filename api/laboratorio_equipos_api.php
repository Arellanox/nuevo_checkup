<?php
session_start();
include "../clases/master_class.php";

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
            $response = $equipo->getAll();

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
            $response = $equipo->getById($id);
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
            $values = $equipo->master->getFormValues($_POST);
            $response = $equipo->update($values);
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
            $response = $equipo->delete($id);
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
