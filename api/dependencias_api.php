<?php
include "../interfaces/iMetodos.php";
include "../clases/dependencias_class.php";

# Cambiar a los valores reales
# dinamicos

$dependencia = new Dependencias();
$api = 5;
switch ($api) {
    case 1:
        $new = array(1,5);
        $response =  $dependencia->insert($new);

        if ($response>0) {
            echo json_encode(array("response"=>array("code"=>1,"lastId"=>$response)));
        } else {
            echo json_encode(array("response"=>array("code"=>0,"msj"=>$response)));
        }
        break;
    case 2:
        $response = $dependencia->getAll();

        if (is_array($response)) {
            echo json_encode(array("response"=>array("code"=>1,"data"=>$response)));
        } else {
            echo json_encode(array("response"=>array("code"=>0,"msj"=>$response)));
        }
        break;
    case 3:
        $response = $dependencia->getById(1);

        if (is_array($response)) {
            echo json_encode(array("response"=>array("code"=>1,"data"=>$response)));
        } else {
            echo json_encode(array("response"=>array("code"=>0,"msj"=>$response)));
        }
        break;

    case 4:
        $response = $dependencia->update($values);

        if(is_numeric($response)){
            echo json_encode(array("response"=>array("code"=>1,"affected"=>$response)));
        } else {
            echo json_encode(array("response"=>array("code"=>0,"msj"=>$response)));
        }
        break;

    case 5:
        $response = $dependencia->delete(1);

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
