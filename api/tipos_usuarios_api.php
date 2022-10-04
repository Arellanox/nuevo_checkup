<?php
include "../interfaces/iMetodos.php";
require_once "../clases/token_auth.php";
include "../clases/tipos_usuarios_class.php";

$tokenVerification = new TokenVerificacion();
$tokenValido = $tokenVerification->verificar();
if (! $tokenValido){
    $tokenVerification->logout();
    exit;
}

$tipo = new TiposUsuarios();
$api = $_POST['api'];
switch ($api) {
    case 1:
        $new = array("Tipo 1");
        $response = $tipo->insert($new);

        if (is_numeric($response)) {
            echo json_encode(array("response"=>array("code"=>1,"lastId"=>$response)));
        } else {
            echo json_encode(array("response"=>array("code"=>0,"msj"=>$response)));
        }

        break;
    case 2:

        $response = $tipo->getAll();
        if(is_array($response)){
            echo json_encode(array("response"=>array("code"=>1,"data"=>$response)));
        } else {
            echo json_encode(array("response"=>array("code"=>0,"msj"=>$response)));
        }
        break;

    case 3:
        $response = $tipo->getById(1);

        if(is_array($response)){
            echo json_encode(array("response"=>array("code"=>1,"data"=>$response)));
        } else {
            echo json_encode(array("response"=>array("code"=>0,"msj"=>$response)));
        }
        break;

    case 4:
        $response = $tipo->update(array("Tipo 1 actualizado",1));

        if (is_numeric($response)) {
            echo json_encode(array("response"=>array("code"=>1,"affected"=>$response)));
        } else {
            echo json_encode(array("response"=>array("code"=>0,"msj"=>$response)));
        }

        break;

    case 5:
        $response = $tipo->delete(1);

        if(is_numeric($response)){
            echo json_encode(array("response"=>array("code"=>1,"affected"=>$response)));
        } else {
            echo json_encode(array("response"=>array()));
        }
        break;
    default:
        # code...
        break;
}
?>
