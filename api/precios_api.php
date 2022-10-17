<?php
include "../interfaces/iMetodos.php";
require_once "../clases/token_auth.php";
include "../clases/precios_class.php";
include "../clases/clientes_class.php";
include "../clases/servicios_class.php";
include_once "../clases/master_class.php";

$tokenVerification = new TokenVerificacion();
$tokenValido = $tokenVerification->verificar();
if (! $tokenValido){
    $tokenVerification->logout();
    exit;
}


$master = new Master();
$api = $_POST['api'];

switch ($api) {
    case 1:
        $precios = $_POST['precios'];
        for ($i=0; $i < count($precios); $i++) {
          $new = $precios[$i];
          $response = $master->updateByProcedure('sp_servicios_lista_de_precios_g',$new);

          if(is_numeric($response)){
              echo json_encode(array("response"=>array("code"=>1,"lastId"=>$response)));
          } else {
              echo json_encode(array("response"=>array("code"=>2,"msj"=>$response)));
          }
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
