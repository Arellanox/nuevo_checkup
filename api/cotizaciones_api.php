<?php
require_once "../clases/master_class.php";
require_once "../clases/token_auth.php";
include_once "../clases/correo_class.php";

$tokenVerification = new TokenVerificacion();
$tokenValido = $tokenVerification->verificar();

$master = new Master();
$api = $_POST['api'];

# datos de la cotizacion
$id_cotizacion = isset($_POST['id_cotizacion']) ? $_POST['id_cotizacion'] : null;
$cliente_id = $_POST['cliente_id'];
$atencion = $_POST['atencion'];
$correo = $_POST['correo'];
$subtotal = $_POST['subtotal'];
$iva = $_POST['iva'];
$descuento = $_POST['descuento'];
$descuento_porcentaje = $_POST['descuento_porcentaje'];
$total = $_POST['total'];
# este es el arreglo de los servicios que contiene la cotizacion 
$detalle = $_POST['detalle'];
$observaciones = $_POST['observaciones'];
$subtotal_sin_descuento = $_POST['subtotal_sin_descuento'];
$fecha_vigencia = $_POST['fecha_vigencia'];
$domicilio_fiscal = $_POST['domicilio_fiscal'];
$idFranquicia = $_SESSION['franquiciario'] ? $_SESSION['id_cliente'] : null;

switch ($api) {
    case 1:
        # guardar cotizacion
        $response = $master->insertByProcedure("sp_cotizaciones_g", [
            $id_cotizacion, $cliente_id, $atencion, $correo, $subtotal, $iva, $descuento, 
            $descuento_porcentaje, $observaciones, $total, $_SESSION['id'], 
            json_encode($detalle), $subtotal_sin_descuento, $fecha_vigencia, $domicilio_fiscal
        ]);

        #Obtemos el ID_COTIZACION para crear el poder crear el PDF
        $id_cotizacion_pdf = $master->getByProcedure('sp_cotizaciones_info_b', [$id_cotizacion]);
        $id_cotizacion_pdf = $id_cotizacion_pdf[0]['ID_COTIZACION'];

        //Guardamos el PDF de la cotizacion
        $url = $master->reportador($master, null, 15, 'cotizaciones', 'url', 0, 0, 0, $cliente_id, $id_cotizacion_pdf);
        $master->updateByProcedure("sp_reportes_actualizar_ruta", ['cotizaciones', 'RUTA_REPORTE', $url, $id_cotizacion_pdf, 15]);
        break;
    case 2:
        # buscar informacion de las cotizaciones
        $dataset = $master->getByNext("sp_cotizaciones_b", [
            $id_cotizacion, $cliente_id
        ]);
        $response = array();

        foreach ($dataset[0] as $set) {
            $set['DETALLE'] = array_filter($dataset[1], function ($obj) use ($set) {
                return $set['ID_COTIZACION'] == $obj['COTIZACION_ID'];
            });

            $response[] = $set;
        }
        break;
    case 3:
        # eliminar cotizacion
        $response = $master->deleteByProcedure("sp_cotizaciones_e", [$id_cotizacion]);
        break;
    case 4:
        # solo cotizacinoes sin detalle.
        $response = $master->getByProcedure("sp_cotizaciones_gral", [$cliente_id]);
        break;
    case 5:
        #Enviar el correo 

        $response = $master->getByProcedure("sp_cotizaciones_info_b", [$id_cotizacion]);
        $correo = $response[0]['CORREO'];
        $reporte = $response[0]['RUTA_REPORTE'];

        $correos = obtenerCorreosValidos($correo);

        if (!empty($response[0])) {
            $mail = new Correo();
            if ($mail->sendEmail('cotizacion', '[bimo] Cotización', $correos, null, [$reporte])) {
                $master->setLog("Correo enviado.", "Reporte de Cotización enviado");
            }
        }

        break;
    case 6:
        # obtener el detalle de la cotizacion sin datos de la cotizacion
        $set = $master->getByNext("sp_cotizaciones_b", [$id_cotizacion, $cliente_id]);

        # obtenemos solo el set que trae el detalle de la cotizacion
        $response = $set[1];
        break;
    case 7:
        # obtener la url de la cotizacion para la descarga
        $response = $master->getByProcedure('sp_cotizaciones_get_pdf', [$id_cotizacion]);
        break;
    case 8:
        # solo cotizacinoes sin detalle.
        $response = $master->getByProcedure("sp_obtener_cotizacion_folio", [
            $id_cotizacion, $_SESSION['id'], $_SESSION['franquiciario'] ? 1 : 0
        ]);
        break;
    default:
        $response = "Api no definida. Api " . $api;
        break;
}

echo $master->returnApi($response);

function obtenerCorreosValidos($input) {
    // Reemplazar comas por punto y coma
    $input = str_replace(',', ';', $input);
    
    // Dividir en un array por ';'
    $emails = explode(';', $input);
    
    // Limpiar espacios y filtrar correos válidos
    $correosValidos = [];
    foreach ($emails as $email) {
        $email = trim($email); // Eliminar espacios en blanco
        if (!empty($email) && filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $correosValidos[] = $email;
        }
    }

    return $correosValidos;
}