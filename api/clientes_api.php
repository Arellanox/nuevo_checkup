<?php
require_once "../clases/master_class.php";
require_once "../clases/token_auth.php";

// Autenticación del token
$tokenVerification = new TokenVerificacion();
$tokenValido = $tokenVerification->verificar();

$master = new Master();
$api = $_POST['api'] ?? null;

// Variables para buscar clientes
$id = $_POST['id'] ?? null;
$codigo = $_POST['codigo'] ?? null;
$qr = $_POST['qr'] ?? null;

// Variables para insertar/actualizar clientes
$parametros = [
    $_POST['id_cliente'] ?? null,
    $_POST['nombre_comercial'] ?? null,
    $_POST['tipo_contribuyente'] ?? null,
    $_POST['calle_fiscal'] ?? null,
    $_POST['numero_exterior'] ?? null,
    $_POST['numero_interior'] ?? null,
    $_POST['colonia_fiscal'] ?? null,
    $_POST['codigo_postal'] ?? null,
    $_POST['estado_fiscal'] ?? null,
    $_POST['municipio_fiscal'] ?? null,
    $_POST['referencia_direccion'] ?? null,
    $_POST['correo_fiscal'] ?? null,
    $_POST['lada_numero_fiscal'] ?? null,
    $_POST['numero_fiscal'] ?? null,
    null, // PDF CIF (se actualizará después)
    null, // PDF Convenio
    null, // PDF Lista de precios
    $_POST['comentarios_cliente'] ?? null,
    $_POST['razon_social'] ?? null,
    $_POST['nombre_sistema'] ?? null,
    $_POST['rfc'] ?? null,
    $_POST['curp'] ?? null,
    $_POST['abreviatura'] ?? null,
    $_POST['limite'] ?? null,
    $_POST['tiempo_credito'] ?? null,
    $_POST['cuenta_contable'] ?? null,
    $_POST['pagina_web'] ?? null,
    $_POST['facebook'] ?? null,
    $_POST['twitter'] ?? null,
    $_POST['instagram'] ?? null,
    $_POST['regimen'] ?? null,
    $_POST['convenio'] ?? null,
    $_POST['indicaciones'] ?? null,
    $_POST['cfdi'] ?? null,
];

// Carpeta de destino para archivos
$razon_social = $_POST['razon_social'] ?? "default";
$destination = "../archivos/clientes/$razon_social/";
$master->createDir($destination); // Crea la carpeta si no existe

// Definir archivos permitidos y sus nombres
$archivos = [
    "pdf_situacion_fiscal" => "CIF",
    "pdf_convenios" => "CONVENIO",
    "pdf_lista_precio" => "LISTA_PRECIOS"
];

// Procesar archivos si es una operación de inserción o actualización
if ($api == 1 || $api == 3) {
    $archivos_guardados = guardarMultiplesArchivos($master, $archivos, $destination, $razon_social);

    // Asignar archivos si existen o conservar los valores previos
    $parametros[14] = $archivos_guardados["pdf_situacion_fiscal"] ?? $_POST['pdf_situacion_fiscal'] ?? null;
    $parametros[15] = $archivos_guardados["pdf_convenios"] ?? $_POST['pdf_convenios'] ?? null;
    $parametros[16] = $archivos_guardados["pdf_lista_precio"] ?? $_POST['pdf_lista_precio'] ?? null;
}

// Variables para manejo de descuentos
$descuentos = $master->setToNull([
    $_POST['id_cliente'] ?? null,
    $_POST['descuento_general'] ?? null,
    $_POST['descuento_area'] ?? null,
    $_POST['area_id'] ?? null,
    $_POST['descuento'] ?? null
]);

$response = "";

// Procesar la API solicitada
switch ($api) {
    case 1: // Insertar cliente
        $response = $master->insertByProcedure("sp_clientes_g", $parametros);
        break;

    case 2: // Buscar cliente
        $response = $master->getByProcedure("sp_clientes_b", [$id, $codigo, $qr, $_SESSION['id']]);

        // Si solo se encuentra un cliente, añadir segmentos y cuestionarios
        if (count($response) == 1) {
            $segmentos = $master->getByProcedure('fillSelect_segmentos', [$response[0]['ID_CLIENTE']]);
            $response[0]['SEGMENTOS'] = !empty($segmentos) ? $segmentos : "Sin segmentos";
            $response[0]['CUESTIONARIOS'] = $master->decodeJson([$response[0]['CUESTIONARIOS']])[0];
        }
        break;

    case 3: // Actualizar cliente
        $response = $master->updateByProcedure("sp_clientes_g", $parametros);
        break;

    case 4: // Desactivar cliente
        $response = $master->deleteByProcedure("sp_clientes_e", [$id]);
        break;

    case 5: // Generar QR para cliente
        $cliente = [$id, $codigo, $qr, $_SESSION['id']];
        $result = $master->getByProcedure('sp_clientes_b', $cliente);

        if (!empty($result)) {
            $nombreCliente = $result[0]['NOMBRE_COMERCIAL'];
            $qr = "https://bimo-lab.com/nuevo_checkup/vista/registro/?codigo=" . $result[0]['QR'];
            $url = $master->generarQRURL("cliente", $qr, $nombreCliente, QR_ECLEVEL_H, 10);
            echo json_encode(["url" => $url, "url_qr" => $qr, "nombre" => $nombreCliente]);
            exit;
        }
        break;

    case 6: // Asignar descuentos
        $response = $master->updateByProcedure("sp_cliente_asignar_descuento", $descuentos);
        break;

    case 7: // Recuperar descuentos del cliente
        $response = $master->getByProcedure("sp_clientes_recuperar_descuentos", [$_POST['id_cliente'] ?? null]);
        $response = $master->checkArray($response) ?: [];
        break;

    case 8: // Eliminar descuento
        $response = $master->deleteByProcedure("sp_clientes_eliminar_descuentos", [$_POST['id_cliente'] ?? null, $_POST['area_id'] ?? null]);
        break;

    case 9: // Obtener catálogo de conversiones
        $response = $master->getByProcedure('sp_tipo_conversiones_b', []);
        break;

    default:
        $response = "API no reconocida";
}

// Función para guardar múltiples archivos
function guardarMultiplesArchivos($master, $archivos, $destination, $razon_social): array
{
    $archivos_subidos = [];

    foreach ($archivos as $campo => $prefijo) {
        if (!empty($_FILES[$campo]['name'][0])) {
            $nombreArchivo = "{$prefijo}_{$razon_social}";
            $rutaArchivo = $destination . $nombreArchivo;

            // Eliminar archivo anterior si existe
            if (file_exists($rutaArchivo)) {
                unlink($rutaArchivo);
            }

            // Subir nuevo archivo
            $subida = $master->guardarFiles($_FILES, $campo, $destination, $nombreArchivo);
            if ($subida) {
                $archivos_subidos[$campo] = $subida[0]['url'];
            }
        }
    }

    return $archivos_subidos;
}

// Retornar la respuesta de la API
echo $master->returnApi($response);