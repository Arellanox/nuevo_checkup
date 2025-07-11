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
        $response = $master->insertByProcedure("sp_inventarios_cat_orden_compra_g", [
            $id_orden_compra,
            $_POST['numero_orden'] ?? null,
            $_POST['fecha_orden'] ?? null,
            $_POST['estado'] ?? null,
            $_POST['id_proveedor'] ?? null,
            $_POST['subtotal'] ?? null,
            $_POST['iva'] ?? null,
            $_POST['total'] ?? null,
            $_POST['observaciones'] ?? null,
            $_SESSION['id'] ?? null,
            isset($_POST['activo']) ? 1 : 0
        ]);
        break;
    case 6:
        #eliminar orden de compra
        $response = $master->insertByProcedure("sp_inventarios_cat_orden_compra_e", [
            $_POST['ID_ORDEN_COMPRA'] ?? null,
        ]);
        break;
    case 7:
        #obtener artículos para orden de compra
        $id_almacen = $_POST['id_almacen'] ?? 1;
        $response = $master->getByProcedure("sp_inventarios_articulos_orden_compra_b", [$id_almacen]);
        break;
    case 8:
        #guardar detalles de orden de compra
        $response = $master->insertByProcedure("sp_inventarios_orden_compra_detalle_g", [
            $_POST['id_orden_compra'],
            $_POST['detalles_json']
        ]);
        break;
    case 9:
        #obtener detalles de orden de compra
        $response = $master->getByProcedure("sp_inventarios_orden_compra_detalle_b", [
            $_POST['id_orden_compra']
        ]);
        break;
    case 10:
        #validar número de orden (verificar si ya existe)
        $numero_orden = $_POST['numero_orden'] ?? null;
        $id_orden_actual = isset($_POST['id_orden_compra']) && $_POST['id_orden_compra'] !== '' && $_POST['id_orden_compra'] !== 'null' ? $_POST['id_orden_compra'] : null;
        
        if ($numero_orden) {
            // Crear un SP simple para verificar duplicados
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
    default:
        $response = "API no definida.";
}


echo $master->returnApi($response);
