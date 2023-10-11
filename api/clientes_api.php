<?php
require_once "../clases/master_class.php";
require_once "../clases/token_auth.php";

$tokenVerification = new TokenVerificacion();
$tokenValido = $tokenVerification->verificar();
if (!$tokenValido) {
    // $tokenVerification->logout();
    // exit;
}

$master = new Master();
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
$regimen = $_POST['regimen'];
$convenio = $_POST['convenio'];
$qr = $_POST['qr'];
$cfdi = $_POST['cfdi'];

$parametros = array(
    $id_cliente,
    $regimen,
    $convenio,
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
    $codigo,
    $cfdi
);

# variables para el descuento de los clientes
$descuento_general = $_POST['descuento_general'];
$descuento_area = $_POST['descuento_area'];
$area_id = $_POST['area_id'];
$descuento = $_POST['descuento']; //<- sirve para decirdir en que case entra en el sp


$descuentos = $master->setToNull(array(
    $id_cliente,
    $descuento_general,
    $descuento_area,
    $area_id,
    $descuento
));

$response = "";


switch ($api) {
    case 1:
        $response = $master->insertByProcedure("sp_clientes_g", $parametros);
        break;
    case 2:
        # buscar
        $response = $master->getByProcedure("sp_clientes_b", [$id, $codigo, $qr]);

        // si buscan solo un cliente se le agrega los segmentos disponibles
        if (count($response) == 1) {
            $segmentosResponse = $master->getByProcedure('fillSelect_segmentos', array($response[0]['ID_CLIENTE']));
            if (count($segmentosResponse) > 0) {
                $response[0][] = $segmentosResponse;
                $response['SEGMENTOS'] = $segmentosResponse;
            } else {
                $response[0][] = "Sin segmentos";
                $response[0]['SEGMENTOS'] = "Sin segmentos";
            }
        }
        break;
    case 3:
        # actualizar
        $response = $master->updateByProcedure("sp_clientes_g", $parametros);
        break;
    case 4:
        # desactivar
        $result = $master->deleteByProcedure("sp_clientes_e", [$id]);
        break;
    case 5:
        # creacion de qr de cliente
        #puedes buscar el cliente por codigo o por el id del cliente
        # enviar null para la variable que no se vaya a usar

        $cliente = array($id_cliente, $codigo, $qr);

        $result = $master->getByProcedure('sp_clientes_b', $cliente);
        $nombreCliente = $result[0]['NOMBRE_COMERCIAL'];
        $qr = "https://bimo-lab.com/nuevo_checkup/vista/registro/?codigo=" . $result[0]['QR'];

        $url = $master->generarQRURL("cliente", $qr, $nombreCliente, QR_ECLEVEL_H, 10);
        echo json_encode(array("url" => $url, "url_qr" => $qr, "nombre" => $nombreCliente));
        exit;
    case 6:
        #agregar descuentos para el cliente.
        $response = $master->updateByProcedure("sp_cliente_asignar_descuento", $descuentos);

        break;
    case 7:
        # buscar los descuentos del cliente.
        $response = $master->getByProcedure("sp_clientes_recuperar_descuentos", [$id_cliente]);
        // $h = $master->setToNull($response);
        $g = $master->checkArray($response);
        // print_r($response);

        if (empty($g)) {
            echo json_encode([]);
            exit;
        }
        // $response = $master->decodeJsonRecursively($response);
        break;
    case 8:
        # eliminar descuento
        $response = $master->deleteByProcedure("sp_clientes_eliminar_descuentos", [$id_cliente, $area_id]);
        break;

    default:
        $response = "api no reconocida";
        break;
}

echo $master->returnApi($response);
