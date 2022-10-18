<?php
require_once "../clases/master_class.php";
require_once "../clases/token_auth.php";

$tokenVerification = new TokenVerificacion();
$tokenValido = $tokenVerification->verificar();
if (!$tokenValido) {
    //$tokenVerification->logout();
    //exit;
}

#api

$api = $_POST['api'];
#buscar


//$id_cliente = $_POST['id_cliente'];
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

$response = "";

$master = new Master();
switch ($api) {
    case 1:
        # insertar
        // print_r($parametros);
        $response = $master->insertByProcedure("sp_paquetes_g", $parametros);
        break;
    case 2:
        # buscar
        $resultset = $master->getByProcedure("sp_paquetes_b", [$id_paquete, $cliente_id]);
        break;

    case 3:
        # actualizar
        $response = $master->updateByProcedure("sp_paquetes_g", $parametros);
        break;
    case 4:
        # desactivar
        $response = $master->updateByProcedure("sp_paquetes_e", $parametros);
        break;

    case 5:
        # encontrar los paquetes que no han sido asigandos a algun cliente.
        $response = $master->getByProcedure('sp_paquetes_sin_clientes',array());

        break;
    case 6:
        #detalles de un paquete
        $response = $master->getByProcedure('sp_detalles_paquetes_b',[$id_paquete, $cliente_id]);
        echo $master->returnApi($response);

    default:
        $response = "api no reconocida";
        break;
}

echo $master->returnApi($response);
