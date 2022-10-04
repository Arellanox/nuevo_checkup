<?php
include "../interfaces/iMetodos.php";
require_once "../clases/token_auth.php";
include "../clases/dependencias_class.php";
include "../clases/segmentos_class.php";

$tokenVerification = new TokenVerificacion();
$tokenValido = $tokenVerification->verificar();
if (! $tokenValido){
    $tokenVerification->logout();
    exit;
}

$tokenVerification = new TokenVerificacion();
$tokenValido = $tokenVerification->verificar();
if (! $tokenValido){
    $tokenVerification->logout();
    exit;
}

# Cambiar a los valores reales
# dinamicos

$dependencia = new Dependencias();
$api = $_POST['api'];
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
    case 6:
        $response = $dependencia->getByCliente($cliente);

        if(is_array($response)){
            $dataset = array();
            foreach ($variable as $key => $value) {
                $segmento = new Segmentos();
                $label = $segmento->getById($value['SEGMENTO_ID']);
                $value['SEGMENTO'] = $label;
                $value[] = $label;
                $dataset[] = $value;
            }

            echo json_encode(array("response"=>array("code"=>1,"data"=>$dataset)));
        } else {
            echo json_encode(array("response"=>array("code"=>0,"msj"=>$response)));
        }
        break;

    default:
        # code...
        break;
}
?>
