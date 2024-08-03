<?php
require_once "../clases/token_auth.php";
include_once '../clases/master_class.php';


$tokenVerification = new TokenVerificacion();
$tokenValido = $tokenVerification->verificar();
if (!$tokenValido) {
    $tokenVerification->logout();
    exit;
}

$master = new Master();
$api = $_POST['api'];

$id_caja = $_POST['id_caja'];
$descripcion = $_POST['descripcion_caja'];
$responsable = $_POST['responsableCaja'];
$creado_por = $_SESSION['id'];

#data transacciones
$tipo_transaccion = $_POST['tipo'];
$monto_transaccion = $_POST['monto'];
$quien_autoriza = $_POST['quien_autoriza'];
$observaciones = $_POST['observaciones'];
$num_cheque = $_POST['num_cheque'];
$fecha_registro = $_POST['fecha_registro'];
$concepto = $_POST['concepto'];


switch ($api) {
    case 1:
        # Crear/actualizar una caja chica
        $response = $master->insertByProcedure('sp_caja_chica_g', [
            $id_caja,
            $descripcion,
            $creado_por,
            $responsable
        ]);
        break;
    case 2:
        # recuperar todas las cajas o caja asignada.
        $response = $master->getByProcedure('sp_caja_chica_b', [
            $_SESSION['id']
        ]);
        break;
    case 3:
        # Eliminar una caja
        $response = $master->deleteByProcedure("sp_caja_chica_e", [
            $id_caja, 
            $_SESSION['id']
        ]);
        break;
    case 4:
        # cambiar el responsable de la caja chica
        $response = $master->updateByProcedure("sp_caja_chica_cambiar_responsable", [
            $responsable,
            $_SESSION["id"],
            $id_caja
        ]);
        break;
    case 5:
        # Registrar una transaccion
        $response = $master->insertByProcedure('sp_caja_chica_transacciones_g', [
            $tipo_transaccion,
            $monto_transaccion,
            $_SESSION['id'],
            $quien_autoriza,
            $observaciones,
            $num_cheque,
            $id_caja,
            $concepto
        ]);
        break;
    case 6:
        # recuperar transacciones de caja chica.
        $response = $master->getByProcedure("sp_caja_chica_transacciones_b", [
            $id_caja,
            $fecha_registro,
            $quien_autoriza,
            $tipo_transaccion
        ]);
        break;
    case 7:
        # recuperar responsables de cajas chicas.
        $response = $master->getByProcedure("sp_caja_chica_responsables_b", [$id_caja]);
        break;
    case 8:
        # recuperar las personas que pueden autorizar una salida
        $response = $master->getByProcedure('sp_caja_chica_autoridades_b', []);
        break;
    default:
        # default
        $response = "API no definida";
        break;
}

echo $master->returnApi($response);