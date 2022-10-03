<?php
include "../interfaces/iMetodos.php";
include "../clases/direcciones_class.php";
include "../clases/clientes_class.php";

$tokenVerification = new TokenVerificacion();
$tokenValido = $tokenVerification->verificar();
if (! $tokenValido){
    $tokenVerification->logout();
    exit;
}

$direccion = new Direcciones();

$api = 5;

switch ($api) {
    case 1:
        $new = array(1,"calle,",10,null,86029,"Tierra colorada","Villahermosa,","Centro","Tabasco","México");
        $response = $direccion->insert($new);

        if(is_numeric($response)){
            echo json_encode(array("response"=>array("code"=>1,"lastId"=>$response)));
        } else {
            echo json_encode(array("response"=>array("code"=>0,"msj"=>$response)));
        }
        break;

        case 2:
            $response = $direccion->getAll();

            if (is_array($response)) {
                echo json_encode(array("response"=>array("code"=>1,"data"=>$response)));
            } else {
                echo json_encode(array("response"=>array("code"=>0,"msj"=>$response)));
            }
            
            break;

            case 3:
                $response =  $direccion->getById(1);

                if (is_array($response)) {
                    echo json_encode(array("response"=>array("code"=>1,"data"=>$response)));
                } else {
                    echo json_encode(array("response"=>array("code"=>0,"msj"=>$response)));
                }
                break;

            case 4:
                $new = array(1,"calle",10,null,86029,"Tierra colorada","Villahermosa,","Centro","Tabasco","México",1);
                $response = $direccion->update($new);

                if(is_numeric($response)){
                    echo json_encode(array("response"=>array("code"=>1,"affected"=>$response)));
                } else {
                    echo json_encode(array("response"=>array("code"=>0,"msj"=>$response)));
                }
                break;
            case 5:
                $response = $direccion->delete(1);

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