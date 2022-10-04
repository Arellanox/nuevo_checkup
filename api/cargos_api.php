<?php
include "../interfaces/iMetodos.php";
require_once "../clases/token_auth.php";
include "../clases/cargos_class.php";

$tokenVerification = new TokenVerificacion();
$tokenValido = $tokenVerification->verificar();
if (! $tokenValido){
    $tokenVerification->logout();
    exit;
}

$cargo = new Cargos();

$api = $_POST['api'];

switch ($api) {
    case 1:
        // $new = array("Nuevo Cargo");
        $array_slice = array_slice($_POST,0,1);
        $a = $cargo->master->mis->getFormValues($array_slice);
        $response = $cargo->insert($a);

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
