 
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
$api = isset($_POST['api']) ?  $_POST['api'] : (isset($_GET['api']) ? $_GET['api'] : 2);

#buscar
$id = $_POST['id']; 

#insertar 
$id_metodo = $_POST['id_metodo'];
$descripcion = $_POST['descripcion'];

$parametros = array(
    $id_metodo,
    $descripcion
);
$master = new Master();
switch ($api) {
    case 1:
        # insertar
        $response = $master->insertByProcedure("sp_laboratorio_medidas_g", $parametros);
        if (is_numeric($response)) {
            echo json_encode(array("response" => array("code" => 1, "affected" => $response)));
        } else {
            echo json_encode(array("response" => array("code" => 0, "msj" => $response)));
        }
        break;
    case 2:
        # buscar
        $resultset = $master->getByProcedure("sp_laboratorio_medidas_b", [$id]);
        if (is_array($resultset)) {
            echo json_encode(array("response"=>array("code"=>1,"data"=>$response)));
        } else {
            echo json_encode(array("response" => array("code" => 0, "msj" => $resultset)));
        }
        break;

    case 3:
        # actualizar
        $response = $master->updateByProcedure("sp_laboratorio_medidas_g", $parametros);
        if (is_numeric($response)) {
            echo json_encode(array("response" => array("code" => 1, "affected" => $response, "msj" => "Envío exitoso")));
        } else {
            echo json_encode(array("response" => array("code" => 0, "affected" => -1, "msj" => $response)));
        }
        break;
    case 4:
        # desactivar

        $result = $master->deleteByProcedure("sp_laboratorio_medidas_e", [$id]);
        if (is_numeric($result)) {
            echo json_encode(array("response" => array("code" => 1, "affected" => $result)));
        } else {
            echo json_encode(array("response" => array("code" => 0, "msj" => $result)));
        }
        break;
    // case -1:
    //     echo json_encode(array("response" => array("code" => 1, "affected" => $_POST)));
    //     break;
    default:
        echo json_encode(array("response" => array("code" => 0, "affected" => -1, "msj" => "api no reconocida")));
        break;
}
