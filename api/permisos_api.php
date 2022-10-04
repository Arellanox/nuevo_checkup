<?php
include "../interfaces/iMetodos.php";
require_once "../clases/token_auth.php";
include "../clases/permisos_class.php";

$tokenVerification = new TokenVerificacion();
$tokenValido = $tokenVerification->verificar();
if (! $tokenValido){
    $tokenVerification->logout();
    exit;
}

$permiso = new Permisos();
$api = 2;

switch ($api) {
    case 1:
        // $form = $permiso->master->getFormValues($_POST);
        $newRecord = array("Agregar usuarios al sismtea");
        $response = $permiso->insert($newRecord);

        if(is_numeric($response)){
            echo json_encode(array("response"=>array("code"=>1,"lastId"=>$response)));
        } else {
            echo json_encode(array("response"=>array("code"=>0,"msj"=>$response)));
        }
        break;
    case 2:
        $response = $permiso->getAll();

        if(is_array($response)){
            echo json_encode(array("response"=>array("code"=>1,"data"=>$response)));
        } else {
            echo json_encode(array("response"=>array("code"=>0,"msj"=>$response)));
        }
        break;
    case 3:
        $response = $permiso->getById(1);
        if(is_array($response)){
            echo json_encode(array("response"=>array("code"=>1,"data"=>$response)));
        } else {
            echo json_encode(array("response"=>array("code"=>0,"msj"=>$response)));
        }
        break;
    case 4:
        $updatingRecord = array("Agregar usuarios al sistema",1);
        $response = $permiso->update($updatingRecord);
        if(is_numeric($response)){
            echo json_encode(array("response"=>array("code"=>1,"affected"=>$response)));
        } else {
            echo json_encode(array("response"=>array("code"=>0,"msj"=>$response)));
        }
        break;
    case 5:
        $response = $permiso->delete(1);

        if(is_numeric($response)){
            echo json_encode(array("response"=>array("code"=>1,"affected"=>$response)));
        } else {
            echo json_encode(array("response"=>array("code"=>0,"msj"=>$response)));
        }
        break;
    
    default:
        # code...
        break;
}
?>