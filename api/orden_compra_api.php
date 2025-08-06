<?php
include_once "../clases/master_class.php";
include_once "../clases/token_auth.php";

$tokenVerification = new TokenVerificacion();
$tokenValido = $tokenVerification->verificar();
if (!$tokenValido) {
    $tokenVerification->logout();
    exit;
}

if (empty($_SESSION['id'])) {
    $tokenVerification->logout();
}

$master = new Master();
$api = $_POST['api'];

$id_proveedores = isset($_POST['id_proveedores']) && $_POST['id_proveedores'] !== '' && $_POST['id_proveedores'] !== 'null' ? $_POST['id_proveedores'] : null;
$id_orden_compra = isset($_POST['id_orden_compra']) && $_POST['id_orden_compra'] !== '' && $_POST['id_orden_compra'] !== 'null' ? $_POST['id_orden_compra'] : null;

$host = $master->selectHost($_SERVER['SERVER_NAME']);

switch ($api) {
    case 1:
        #recuperar ordenes de compra
        $response = $master->getByProcedure("sp_inventarios_cat_orden_compra_b", []);
        break;
    case 2:
        #recuperar proveedores
        $response = $master->getByProcedure("sp_inventarios_cat_proveedores_b", []);
        break;
    case 3:
        #registrar proveedor
        $response = $master->insertByProcedure("sp_inventarios_cat_proveedores_g", [
            $id_proveedores,
            $_POST['nombre'],
            $_POST['razon_social'] ?? null,
            $_POST['rfc'] ?? null,
            $_POST['constancia_situacion_fiscal'] ?? null,
            $_POST['caratula_bancaria'] ?? null,
            $_POST['comprobante_domicilio'] ?? null,
            isset($_POST['verificacion_efo']) ? 1 : 0,
            $_POST['contacto'] ?? null,
            $_POST['telefono'] ?? null,
            $_POST['email'] ?? null,
            isset($_POST['activo']) ? 1 : 0
        ]);
        break;
    case 4:
        #eliminar proveedor
        $response = $master->insertByProcedure("sp_inventarios_cat_proveedores_e", [
            $id_proveedores,
        ]);
        break;
    case 5:
        #registrar orden de compra
        $fecha_actual = date('Y-m-d H:i:s');

        // Obtener JSON de detalles de artículos
        $detalles_json = null;
        if (isset($_POST['detalles_articulos']) && !empty($_POST['detalles_articulos'])) {
            // Verificar si es un string JSON válido
            if (is_string($_POST['detalles_articulos'])) {
                $detalles_json = $_POST['detalles_articulos'];
            } else {
                // Si es un array, convertirlo a JSON
                $detalles_json = json_encode($_POST['detalles_articulos']);
            }

            // Validar que el JSON es válido
            json_decode($detalles_json);
            if (json_last_error() !== JSON_ERROR_NONE) {
                $detalles_json = null;
            }
        }

        $response = $master->insertByProcedure("sp_inventarios_cat_orden_compra_g", [
            $id_orden_compra,
            $_POST['fecha_orden'] ?? null,
            $_POST['estado'] ?? null,
            $_POST['id_proveedor'] ?? null,
            $_POST['observaciones'] ?? null,
            $_SESSION['id'] ?? null,
            isset($_POST['activo']) ? 1 : 0,
            $detalles_json // Parámetro JSON de detalles
        ]);
        break;
    case 6:
        #eliminar orden de compra
        $response = $master->insertByProcedure("sp_inventarios_cat_orden_compra_e", [
            $_POST['ID_ORDEN_COMPRA'] ?? null,
        ]);
        break;
    case 7:
        #obtener art para  orden de compra
        $id_almacen = $_POST['id_almacen'] ?? 1;
        $response = $master->getByProcedure("sp_inventarios_articulos_orden_compra_b", [$id_almacen]);
        break;
    case 10:
        #validar nujmm de orden (verificar si ya existe)
        $numero_orden = $_POST['numero_orden'] ?? null;
        $id_orden_actual = isset($_POST['id_orden_compra']) && $_POST['id_orden_compra'] !== '' && $_POST['id_orden_compra'] !== 'null' ? $_POST['id_orden_compra'] : null;

        if ($numero_orden) {
            $conexion = $master->connectDb();

            if ($id_orden_actual) {
                $stmt = $conexion->prepare("SELECT COUNT(*) as existe FROM inventarios_cat_orden_compra WHERE NUMERO_ORDEN = ? AND ID_ORDEN_COMPRA != ?");
                $stmt->execute([$numero_orden, $id_orden_actual]);
            } else {
                $stmt = $conexion->prepare("SELECT COUNT(*) as existe FROM inventarios_cat_orden_compra WHERE NUMERO_ORDEN = ?");
                $stmt->execute([$numero_orden]);
            }

            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            $existe = $result['existe'] > 0;

            $response = [
                'response' => [
                    'code' => 1,
                    'message' => $existe ? 'El número de orden ya existe' : 'Número de orden disponible',
                    'data' => [
                        'existe' => $existe,
                        'numero_orden' => $numero_orden
                    ]
                ]
            ];
        } else {
            $response = [
                'response' => [
                    'code' => 0,
                    'message' => 'Número de orden requerido',
                    'data' => null
                ]
            ];
        }
        break;
    case 11:
        $response = $master->insertByProcedure("sp_inventarios_cat_orden_compra_e", [
            $id_orden_compra,
        ]);
        break;
    case 12: // Aceptar/Rechazar orden de compra
        //aceptar o rechazar ordenes de compra
        $id_orden_compra = isset($_POST['id_orden_compra']) ? $_POST['id_orden_compra'] : null;
        $accion = isset($_POST['accion']) ? $_POST['accion'] : null; // 'aceptar' o 'rechazar'
        $observaciones = isset($_POST['observaciones']) ? $_POST['observaciones'] : null;

        // Validar parámetros obligatorios
        if ($id_orden_compra === null || $accion === null) {
            $response = array(
                'code' => 0,
                'message' => 'ERROR: Faltan parámetros obligatorios (ID orden de compra y acción)',
                'data' => array()
            );
            break;
        }

        // Validar que la acción sea válida
        if (!in_array(strtolower($accion), ['aceptar', 'rechazar'])) {
            $response = array(
                'code' => 0,
                'message' => 'ERROR: Acción no válida. Use "aceptar" o "rechazar"',
                'data' => array()
            );
            break;
        }

        // Validar sesión de usuario
        if (!isset($_SESSION['id']) || empty($_SESSION['id'])) {
            $response = array(
                'code' => 0,
                'message' => 'ERROR: No se ha identificado el usuario en la sesión',
                'data' => array()
            );
            break;
        }

        // Log de debugging
        error_log("API 12 - Parámetros recibidos: " . json_encode([
            'id_orden_compra' => $id_orden_compra,
            'accion' => $accion,
            'usuario_aprobador_id' => $_SESSION['id'],
            'observaciones' => $observaciones
        ]));

        try {
            $response = $master->insertByProcedure("sp_inventarios_cat_orden_compra_aprobar", [
                $id_orden_compra,
                $accion,
                $_SESSION['id'],
                $observaciones
            ]);

            error_log("API 12 - Respuesta del SP: " . json_encode($response));
        } catch (Exception $e) {
            error_log("API 12 - Error en SP: " . $e->getMessage());
            $response = array(
                'code' => 0,
                'message' => 'ERROR: ' . $e->getMessage(),
                'data' => array()
            );
        }
        break;
    case 13:
        // obtener detalles de artículos de una orden de compra específica
        if (!$id_orden_compra) {
            $response = array(
                'response' => array(
                    'code' => 0,
                    'message' => 'ERROR: ID de orden de compra es obligatorio',
                    'data' => array()
                )
            );
            break;
        }

        try {
            $response = $master->getByProcedure("sp_inventarios_cat_orden_compra_detalle_b", [
                $id_orden_compra
            ]);

            error_log("API 13 - Detalles de orden: " . json_encode($response));
        } catch (Exception $e) {
            error_log("API 13 - Error en SP: " . $e->getMessage());
            $response = array(
                'response' => array(
                    'code' => 0,
                    'message' => 'ERROR: ' . $e->getMessage(),
                    'data' => array()
                )
            );
        }
        break;
    default:
        $response = "API no definida.";
}


echo $master->returnApi($response);
