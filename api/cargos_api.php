<?php
include "../interfaces/iMetodos.php";
include "../clases/cargos_class.php";

$cargo = new Cargos();

$api = 5;

switch ($api) {
    case 1:
        $new = array("Nuevo Cargo");
        $response = $cargo->insert($new);

        if (is_numeric($response)) {
            echo json_encode(array("response"=>array("code"=>1,"lastId"=>$response)));
        } else {
            echo json_encode(array("response"=>array("code"=>0,"msj"=>$response)));
        }
        
        break;
    case 2:
        $response = $cargo->getAll();

        if(is_array($response)){
            echo json_encode(array("response"=>array("code"=>1,"data"=>$response)));
        } else {
            echo json_encode(array("response"=>array("code"=>0,"msj"=>$response)));
        }
        break;

    case 3:
        $response = $cargo->getById(9);

        if(is_array($response)){
            echo json_encode(array("response"=>array("code"=>1,"data"=>$response)));
        } else {
            echo json_encode(array("response"=>array("code"=>0,"msj"=>$response)));
        }
        break;
    
    case 4:
        $response = $cargo->update(array("Nuevo Cargo Actualizado",9));

        if(is_numeric($response)){
            echo json_encode(array("response"=>array("code"=>1,"affected"=>$response)));
        } else {
            echo json_encode(array("response"=>array("code"=>0,"msj"=>$response)));
        }
        break;

    case 5:
        $response = $cargo->delete(9);

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