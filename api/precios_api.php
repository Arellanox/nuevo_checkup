<?php
include "../interfaces/iMetodos.php";
require_once "../clases/token_auth.php";
include "../clases/precios_class.php";
include "../clases/clientes_class.php";
include "../clases/servicios_class.php";

$tokenVerification = new TokenVerificacion();
$tokenValido = $tokenVerification->verificar();
if (! $tokenValido){
    $tokenVerification->logout();
    exit;
}

$precio = new Precios();
$api = 1;

switch ($api) {
    case 1:
        $new = array(1,1,350.0,100.0,450.0);
        $response = $precio->insert($new);

        if(is_numeric($response)){
            echo json_encode(array("response"=>array("code"=>1,"lastId"=>$response)));
        } else {
            echo json_encode(array("response"=>array("code"=>2,"msj"=>$response)));
        }
        break;
    case 2:
        $response = $precio->getAll();

        if(is_array($response)){
            $dataset = array();
            foreach($response as $data){
                $cliente = new Clientes();
                $servicio = new Servicios();

                $labelCliente = $cliente->getById($data['CLIENTE_ID']);
                $labelServicio = $servicio->getById($data['SERVICIO_ID']);

                $data['CLIENTE'] = $labelCliente;
                $data[] = $labelCliente;
                $data['SERVICIO'] = $labelServicio;
                $data[] = $labelServicio;

                $dataset[] = $data;
            }
            echo json_encode(array("response"=>array("code"=>1,"data"=>$dataset)));
        } else {
            echo json_encode(array("response"=>array("code"=>2,"msj"=>$response)));
        }
        break;
    case 3:
        $response = $precio->getById(1);
        if(is_array($response)){
            $dataset = array();
            foreach($response as $data){
                $cliente = new Clientes();
                $servicio = new Servicios();

                $labelCliente = $cliente->getById($data['CLIENTE_ID']);
                $labelServicio = $servicio->getById($data['SERVICIO_ID']);

                $data['CLIENTE'] = $labelCliente;
                $data[] = $labelCliente;
                $data['SERVICIO'] = $labelServicio;
                $data[] = $labelServicio;

                $dataset[] = $data;
            }
            echo json_encode(array("response"=>array("code"=>1,"data"=>$dataset)));
        } else {
            echo json_encode(array("response"=>array("code"=>2,"msj"=>$response)));
        }
        break;
    case 4:
        $response = $precio->update($values);

        if(is_numeric($response)){
            echo json_encode(array("response"=>array("code"=>1,"affected"=>$response)));
        } else {
            echo json_encode(array("response"=>array("code"=>2,"msj"=>$response)));
        }
        break;

    case 5:
        $response = $precio->delete(1);
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