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
$tipo_contribuyente = $_POST['tipo_contribuyente'];
$calle = $_POST['calle_fiscal'];
$numero_exterior = $_POST['numero_exterior'];
$numero_interior = $_POST['numero_interior'];
$colonia = $_POST['colonia_fiscal'];
$codigo_postal = $_POST['codigo_postal'];
$estado = $_POST['estado_fiscal'];
$municipio = $_POST['municipio_fiscal'];
$referencias = $_POST['referencia_direccion'];
$correo_electronico = $_POST['correo_fiscal'];
$telefono_lada = $_POST['lada_numero_fiscal'];
$telefono = $_POST['numero_fiscal'];
$pdf_cif = $_POST['pdf_situacion_fiscal'];
$pdf_convenio = $_POST['pdf_convenios'];
$pdf_lista_precios = $_POST['pdf_lista_precio'];
$comentarios = $_POST['comentarios_cliente'];
$razon_social = $_POST['razon_social'];
$nombre_sistema = $_POST['nombre_sistema'];
$rfc = $_POST['rfc'];
$curp = $_POST['curp'];
$abreviatura = $_POST['abreviatura'];
$limite_credito = $_POST['limite'];
$temporalidad_de_credito = $_POST['tiempo_credito'];
$cuenta_contable = $_POST['cuenta_contable'];
$pagina_web = $_POST['pagina_web'];
$facebook = $_POST['facebook'];
$twitter = $_POST['twitter'];
$instagram = $_POST['instagram'];
$regimen = $_POST['regimen'];
$convenio = $_POST['convenio'];
$qr = $_POST['qr'];
$codigo = $_POST['indicaciones'];
$cfdi = $_POST['cfdi'];

$parametros = array(
    $id_cliente,
    $nombre_comercial,
    $tipo_contribuyente,
    $calle,
    $numero_exterior,
    $numero_interior,
    $colonia,
    $codigo_postal,
    $estado,
    $municipio,
    $referencias,
    $correo_electronico,
    $telefono_lada,
    $telefono,
    $pdf_cif,
    $pdf_convenio,
    $pdf_lista_precios,
    $comentarios,
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
    $regimen,
    $convenio,
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

            $response[0]['CUESTIONARIOS'] = $master->decodeJson([$response[0]['CUESTIONARIOS']]);
            $response[0]['CUESTIONARIOS'] = $response[0]['CUESTIONARIOS'][0];
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

    case 9:
        # catalogo de tipo de conversiones
        $response = $master->getByProcedure('sp_tipo_conversiones_b',[]);
        break;

    default:
        $response = "api no reconocida";
        break;
}

echo $master->returnApi($response);
