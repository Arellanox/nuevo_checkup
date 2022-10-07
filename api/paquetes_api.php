<?php
require_once "../clases/master_class.php";
require_once "../clases/token_auth.php";

$tokenVerification = new TokenVerificacion();
$tokenValido = $tokenVerification->verificar();
if (! $tokenValido){
    $tokenVerification->logout();
    exit;
}

#api

$api = $_POST['api'];
#buscar


$id_cliente = $_POST['id_cliente'];
#insertar

$id_paquete = $_POST['id'];
$cliente_id = $_POST['cliente_id'];
$concepto_id = $_POST['concepto_id'];
$descripcion = $_POST['descripcion'];
$tipo_paquete = $_POST['tipo_paquete'];
$costo = $_POST['costo'];
$utilidad = $_POST['utilidad'];
$precio_venta = $_POST['precio_venta'];
$iva = $_POST['iva'];

$parametros = array(
    $id_paquete,
    $cliente_id,
    $concepto_id,
    $descripcion,
    $tipo_paquete,
    $costo,
    $utilidad,
    $precio_venta,
    $iva
);

$master = new Master();
switch ($api) {
    case 1:
        # insertar
        $response = $master->insertByProcedure("sp_paquetes_g",$parametros);
        if (is_numeric($response)) {
            echo json_encode(array("response" => array("code" => 1, "affected" => $response)));
        } else {
            echo json_encode(array("response" => array("code" => 0, "msj" => $response)));
        }
        break;
    case 2:
        # buscar
        $resultset = $master->getByProcedure("sp_paquetes_b",[$id_paquete,$id_cliente]);
        if (is_array($resultset)) {
            echo json_encode(array("response" => array("data" => 1, "data" => $resultset)));
        } else {
            echo json_encode(array("response" => array("code" => 0, "msj" => $resultset)));
        }
        break;

    case 3:
        # actualizar
        $response = $master->updateByProcedure("sp_paquetes_g",$parametros);
        if (is_numeric($response)) {
            echo json_encode(array("response" => array("code" => 1, "affected" => $response, "msj" => "Envío exitoso")));
        } else {
            echo json_encode(array("response" => array("code" => 0, "affected" => -1, "msj" => $response)));
        }
        break;
    case 4:
        # desactivr paciente
        $result = $master->deleteByProcedure("sp_paquetes_g",[$id_paciente]);
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
