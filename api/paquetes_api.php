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
        $response = $master->getByProcedure("sp_paquetes_b", [$id_paquete, $cliente_id]);
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
        $response = $master->getByProcedure('sp_paquetes_sin_clientes', array());

        break;
    case 6:
        #detalles de un paquete
        $detalle = $_POST['paquete_detalle'];
        //print_r($detalle);
        # obtiene el arreglo del final
        $info_paquete = array_slice($detalle, count($detalle) - 1, 1);
        #quita la informacion del paquete, solo deja los detalles
        $detalle_final = array_pop($detalle);
        #variables para verificar si se insertaron todos los detalles del paquete,
        $len_detalle = count($detalle);
        $oks = 0;
        //print_r($detalle);
        //print_r($info_paquete);
        foreach ($detalle as $det) {
            $newDet = array(
                null,
                $info_paquete[0]['id_paquete'],
                $det['id'],
                $det['cantidad'],
                $det['costo'],
                $det['costototal'],
                $det['precioventa'],
                $det['subtotal']
            );
            $response =  $master->returnApi($master->insertByProcedure('sp_detalle_paquete_g', $newDet));

            $response = json_decode($response, true);

            if ($response['response']['code'] == 1) {
                # agrega un insertado con exito al mensaje
                $oks++;
                //echo $response['response']['code'];
            }
        }

        if ($oks == $len_detalle) {
            echo json_encode(array('response' => array('code' => 1, 'msj' => "Se insertaron todos los servicios.")));
        } else {
            echo json_encode(array('response' => array('code' => 2, 'msj' => "Es posible que se hayn omitido algunos servicios..")));
        }

        return;
        break;
    case 7:
        $precioPaquetes = $_POST['paquetes'];

        foreach($precioPaquetes as $paquete){
            /* $id = $paquete['id'];
            $costo = $paquete['costo'];
            $utilidad = $paquete['utilidad'];
            $precio_venta = $paquete['precio_venta'];

            $x = array($id,$costo,$utilidad,$precio_venta); */

            $response = $master->updateByProcedure("sp_paquetes_actualizar_costo", $paquete);
        }
        echo $master->returnApi($response);
        exit;
        break;
    default:
        print_r($_GET);
        $response = "api no reconocida " . $api;
        break;
}

echo $master->returnApi($response);
