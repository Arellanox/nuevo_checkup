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
$id = $_POST['id'];

#insertar
$id_direccion = $_POST['id_direccion'];
$cliente_id = $_POST['cliente_id'];
$calle = $_POST['calle'];
$num_exterior = $_POST['num_exterior'];
$num_interior = $_POST['num_interior'];
$cp = $_POST['cp'];
$colonia = $_POST['colonia'];
$ciudad = $_POST['ciudad'];
$municipio = $_POST['municipio'];
$estado = $_POST['estado'];
$pais = $_POST['pais'];

$parametros = array(
    $id_direccion,
    $cliente_id,
    $calle,
    $num_exterior,
    $num_interior,
    $cp,
    $colonia,
    $ciudad,
    $municipio,
    $estado,
    $pais
);

$master = new Master();
switch ($api) {
    case 1:
        $response = $master->insertByProcedure("sp_direcciones_g", $parametros);
        if (is_numeric($response)) {
            echo json_encode(array("response" => array("code" => 1, "affected" => $response)));
        } else {
            echo json_encode(array("response" => array("code" => 0, "msj" => $response)));
        }
        break;
    case 2:
        # buscar
        $resultset = $master->getByProcedure("sp_direcciones_b", [$id]);
        if (is_array($resultset)) {
            echo json_encode(array("response" => array("code" => 1, "data" => $resultset)));
        } else {
            echo json_encode(array("response" => array("code" => 0, "msj" => $resultset)));
        }
        break;
    case 3:
        # actualizar
        $response = $master->updateByProcedure("sp_direcciones_g", $parametros);
        if (is_numeric($response)) {
            echo json_encode(array("response" => array("code" => 1, "affected" => $response, "msj" => "Envío exitoso")));
        } else {
            echo json_encode(array("response" => array("code" => 0, "affected" => -1, "msj" => $response)));
        }
        break;
    case 4:
        # desactivar
        $result = $master->deleteByProcedure("sp_direcciones_e", [$id]);
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
