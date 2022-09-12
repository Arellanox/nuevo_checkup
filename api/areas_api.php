<?php
include "../interfaces/iMetodos.php";
include "../clases/areas_class.php";
include "../clases/usuarios_class.php";

$area = new Areas();
$api = 5;

switch ($api) {
    case 1:
        $newRecord = array(1,"CONSULTORIO 1",1,1);
        $response = $area->insert($newRecord);

        if(is_numeric($response)){
            echo json_encode(array("response"=>array("code"=>1,"lastId"=>$response)));
        } else {
            echo json_encode(array("response"=>array("code"=>2,"msj"=>$response)));
        }
        break;
    case 2:
        $response = $area->getAll();

        if(is_array($response)){
            $dataset = array();
            foreach($response as $value){
                $encargado = new Usuarios();
                $label = $encargado->getById($value['ENCARGADO_ID']);
                $value['ENCARGADO'] = $label;
                $value[] = $label;
                $dataset[] = $value;
            }
            echo json_encode(array("response"=>array("code"=>1,"data"=>$dataset)));
        } else {
            echo json_encode(array("response"=>array("code"=>2,"msj"=>$response)));
        }
        break;
    case 3:
        $response = $area->getById(1);
        if(is_array($response)){
            $dataset = array();
            foreach($response as $value){
                $encargado = new Usuarios();
                $label = $encargado->getById($value['ENCARGADO_ID']);
                $value['ENCARGADO'] = $label;
                $value[] = $label;
                $dataset[] = $value;
            }
            echo json_encode(array("response"=>array("code"=>1,"data"=>$dataset)));
        } else {
            echo json_encode(array("response"=>array("code"=>2,"msj"=>$response)));
        }
        break;
    case 4:
        $response = $area->update($form);

        if(is_numeric($response)){
            echo json_encode(array("response"=>array("code"=>1,"affected"=>$response)));
        } else {
            echo json_encode(array("response"=>array("code"=>2,"msj"=>$response)));
        }
        break;
    case 5:
        $response = $area->delete(1);
        if(is_numeric($response)){
            echo json_encode(array("response"=>array("code"=>1,"affected"=>$response)));
        } else {
            echo json_encode(array("response"=>array("code"=>2,"msj"=>$response)));
        }
        break;
    
    default:
        # code...
        break;
}
?>