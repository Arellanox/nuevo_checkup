<?php
include "..interfaces/iMetodos.php";
include "../clases/usuarios_class.php";

$usuario = new usuarios_class();

$api = 1;

switch ($api) {
    case 1:
        $form  = $usuario->master->mis->getFormValues($_POST);
        $response = $usuario->insert($form);

        if(is_numeric($response)){
            echo json_encode(array("response"=>array("code"=>1,"lastId"=>$responase)));
        } else {
            echo json_encode(array("response"=>array("code"=>0,"msj"=>$responase)));
        }
        break;
    case 2:
        $response = $usuario->getAll();

        if(is_array($response)){
            echo json_encode(array("response"=>array("code"=>1,"data"=>$response)));
        } else {
            echo json_encode(array("response"=>array("code"=>0,"msj"=>$response)));
        }
        break;

    case 3:
        $response  = $usuario->getById(1);
        if(is_array($response)){
            echo json_encode(array("response"=>array("code"=>1,"data"=>$response)));
        } else {
            echo json_encode(array("response"=>array("code"=>0,"msj"=>$response)));
        }
        break;

    case 4:
        $form = $usuario->master->mis->getFormValues($values);
        $response = $usuario->update($form);

        if(is_numeric($response)){
            echo json_encode(array("response"=>array("code"=>1,"affected"=>$response)));
        } else {
            echo json_encode(array("response"=>array("code"=>0,"msj"=>$response)));
        }
        break;
    case 5:
        $form = $usuario->master->mis->getFormValues($_POST);
        $response = $usuario->update($form);

        if(is_numeric($response)){
            echo json_encode(array("response"=>array("code"=>1,"lastId"=>$responase)));
        } else {
            echo json_encode(array("response"=>array("code"=>0,"msj"=>$responase)));
        }
        break;
    
    default:
        # code...
        break;
}
?>