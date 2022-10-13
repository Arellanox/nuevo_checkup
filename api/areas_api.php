<?php
require_once "../clases/master_class.php";
require_once "../clases/token_auth.php";

$tokenVerification = new TokenVerificacion();
$tokenValido = $tokenVerification->verificar();
if (!$tokenValido) {
    $tokenVerification->logout();
    exit;
}

#api
$api = $_POST['api'];
#buscar

$id = 1; #TESTER_TEMP $_POST['id'];
#insertar
$id_area = $_POST['id'];
$encargado_id = $_POST['encargado_id'];
$descripcion = $_POST['descripcion'];
$esta_libre = $_POST['esta_libre'];
$prioridad = $_POST['prioridad'];
$activo = $_POST['activo'];

$parametros = array(
    $id_area,
    $encargado_id,
    $descripcion,
    $esta_libre,
    $prioridad
);

$master = new Master();
switch ($api) {
    case 1:
        $response = $master->insertByProcedure("sp_areas_g", $parametros);
        if (is_numeric($response)) {
            echo json_encode(array("response" => array("code" => 1, "affected" => $response)));
        } else {
            echo json_encode(array("response" => array("code" => 0, "msj" => $response)));
        }
        break;
    case 2:
        # buscar
        $resultset = $master->getByProcedure("sp_areas_b", [$id]);
        if (is_array($resultset)) {
            echo json_encode(array("response"=>array("code"=>1,"data"=>$resultset)));        
        } else {
            echo json_encode(array("response" => array("code" => 0, "msj" => $resultset)));
        }
        break;
    case 3:
        # actualizar
        $response = $master->updateByProcedure("sp_areas_g", $parametros);
        if (is_numeric($response)) {
            echo json_encode(array("response" => array("code" => 1, "affected" => $response, "msj" => "Envío exitoso")));
        } else {
            echo json_encode(array("response" => array("code" => 0, "affected" => -1, "msj" => $response)));
        }
        break;
    case 4:
        # desactivar
        $result = $master->deleteByProcedure("sp_areas_e", [$id]);
        if (is_numeric($result)) {
            echo json_encode(array("response" => array("code" => 1, "affected" => $result)));
        } else {
            echo json_encode(array("response" => array("code" => 0, "msj" => $result)));
        }
        break;

    default:
        echo json_encode(array("response" => array("code" => 0, "affected" => -1, "msj" => "api no reconocida")));
        break;
}
?>
