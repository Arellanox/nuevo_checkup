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
$cliente = $_POST['id_cliente'];

#insertar
$id_contacto = $_POST['id_contacto'];
$id_cliente = $_POST['id_cliente'];
$nombre = $_POST['nombre'];
$apellidos = $_POST['apellidos'];
$telefono1 = $_POST['telefono1'];
$telefono2 = $_POST['telefono2'];
$email = $_POST['email'];

$parametros = array(
    $id_contacto,
    $id_cliente,
    $nombre,
    $apellidos,
    $telefono1,
    $telefono2,
    $email
);

$master = new Master();
switch ($api) {
    case 1:
        $response = $master->insertByProcedure("sp_contactos_g", $parametros);
        if (is_numeric($response)) {
            echo json_encode(array("response" => array("code" => 1, "affected" => $response)));
        } else {
            echo json_encode(array("response" => array("code" => 0, "msj" => $response)));
        }
        break;
    case 2:
        # buscar
        $resultset = $master->getByProcedure("sp_contactos_b", [$id, $cliente]);
        if (is_array($resultset)) {
            echo json_encode(array("response" => array("code" => 1, "data" => $resultset)));
        } else {
            echo json_encode(array("response" => array("code" => 0, "msj" => $resultset)));
        }
        break;
    case 3:
        # actualizar
        $response = $master->updateByProcedure("sp_contactos_g", $parametros);
        if (is_numeric($response)) {
            echo json_encode(array("response" => array("code" => 1, "affected" => $response, "msj" => "Envío exitoso")));
        } else {
            echo json_encode(array("response" => array("code" => 0, "affected" => -1, "msj" => $response)));
        }
        break;
    case 4:
        # desactivar
        $result = $master->deleteByProcedure("sp_contactos_e", [$id]);
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
