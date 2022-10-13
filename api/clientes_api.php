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
$codigo = $_POST['codigo'];

#insertar
$id_cliente = $_POST['id_cliente'];
$nombre_comercial = $_POST['nombre_comercial'];
$razon_social = $_POST['razon_social'];
$nombre_sistema = $_POST['nombre_sistema'];
$rfc = $_POST['rfc'];
$curp = $_POST['curp'];
$abreviatura = $_POST['abreviatura'];
$limite_credito = $_POST['limite_credito'];
$temporalidad_de_credito = $_POST['temporalidad_de_credito'];
$cuenta_contable = $_POST['cuenta_contable'];
$pagina_web = $_POST['pagina_web'];
$facebook = $_POST['facebook'];
$twitter = $_POST['twitter'];
$instagram = $_POST['instagram'];
$codigo = $_POST['codigo'];

$parametros = array(
    $id_cliente,
    $nombre_comercial,
    $razon_social,
    $nombre_sistema,
    $rfc,
    $curp,
    $abreviatura,
    $limite_credito,
    $temporalidad_de_credito,
    $cuenta_contable,
    $pagina_web,
    $facebook,
    $twitter,
    $instagram,
    $codigo
);

$master = new Master();
switch ($api) {
    case 1:
        $response = $master->insertByProcedure("sp_clientes_g", $parametros);
        if (is_numeric($response)) {
            echo json_encode(array("response" => array("code" => 1, "affected" => $response)));
        } else {
            echo json_encode(array("response" => array("code" => 0, "msj" => $response)));
        }
        break;
    case 2:
        # buscar
        $resultset = $master->getByProcedure("sp_clientes_b", [$id,$codigo]);
        if (is_array($resultset)) {
            echo json_encode(array("response" => array("code" => 1, "data" => $resultset)));
        } else {
            echo json_encode(array("response" => array("code" => 0, "msj" => $resultset)));
        }
        break;
    case 3:
        # actualizar
        $response = $master->updateByProcedure("sp_clientes_g", $parametros);
        if (is_numeric($response)) {
            echo json_encode(array("response" => array("code" => 1, "affected" => $response, "msj" => "Envío exitoso")));
        } else {
            echo json_encode(array("response" => array("code" => 0, "affected" => -1, "msj" => $response)));
        }
        break;
    case 4:
        # desactivar
        $result = $master->deleteByProcedure("sp_clientes_e", [$id]);
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
