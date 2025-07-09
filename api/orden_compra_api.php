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
            $_POST['NUMERO_ORDEN_COMPRA'] ?? null,
            $_POST['FECHA_ORDEN_COMPRA'] ?? null,
            $_POST['ESTADO'] ?? null,
            $_POST['ID_PROVEEDOR'] ?? null,
            $_POST['SUBTOTAL'] ?? null,
            $_POST['IVA'] ?? null,
            $_POST['TOTAL'] ?? null,
            $_POST['OBSERVACIONES'] ?? null,
            $_SESSION['id'] ?? null,
            isset($_POST['ACTIVO']) ? 1 : 0
        ]);
        break;
    case 6:
        #eliminar orden de compra
        $response = $master->insertByProcedure("sp_inventarios_cat_orden_compra_e", [
            $_POST['ID_ORDEN_COMPRA'] ?? null,
        ]);
        break;
    default:
        $response = "API no definida.";
}


echo $master->returnApi($response);
