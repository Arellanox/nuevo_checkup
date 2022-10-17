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
$limite_credito = $_POST['limite'];
$temporalidad_de_credito = $_POST['tiempo_credito'];
$cuenta_contable = $_POST['cuenta_contable'];
$pagina_web = $_POST['confac'];
$facebook = $_POST['Facebook'];
$twitter = $_POST['Twitter'];
$instagram = $_POST['Instagram'];
$codigo = $_POST['Codigo'];

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

$response = "";

$master = new Master();
switch ($api) {
    case 1:
        $response = $master->insertByProcedure("sp_clientes_g", $parametros); 
        break;
    case 2:
        # buscar
        $response = $master->getByProcedure("sp_clientes_b", [$id, $codigo]); 
        break;
    case 3:
        # actualizar
        $response = $master->updateByProcedure("sp_clientes_g", $parametros); 
        break;
    case 4:
        # desactivar
        $result = $master->deleteByProcedure("sp_clientes_e", [$id]); 
        break;

    default:
        $response = "api no reconocida";
        break;
}

echo $master->returnApi($response);
