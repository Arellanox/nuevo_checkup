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

# Obtener y sanitizar variables de entrada
$id_departamento = isset($_POST['id_departamento']) ? (int)$_POST['id_departamento'] : null;
$descripcion = isset($_POST['descripcion']) ? trim($_POST['descripcion']) : '';
$activo = isset($_POST['activo']) ? (int)$_POST['activo'] : 1;
$creado_por = $_SESSION['id'];
$id_puesto = isset($_POST['id_puesto']) ? (int)$_POST['id_puesto'] : null;
$objetivos = isset($_POST['objetivos']) ? trim($_POST['objetivos']) : '';
$competencias = isset($_POST['competencias']) ? trim($_POST['competencias']) : '';
$banda_salarial = isset($_POST['banda_salarial']) ? trim($_POST['banda_salarial']) : '';

switch ($api) {
    case 1:
        # Crear/actualizar una vacante
        $response = $master->insertByProcedure('sp_rh_cat_requisiciones_g', [
            $id_requisicion,
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
        // # Eliminar una caja
        // $response = $master->deleteByProcedure("sp_caja_chica_e", [
        //     $id_caja, 
        //     $_SESSION['id']
        // ]);
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
        # Debug temporal - quitar después
        error_log("Debug - Valores recibidos:");
        error_log("id_departamento: " . ($id_departamento ?? 'NULL'));
        error_log("descripcion: " . ($descripcion ?? 'NULL'));
        error_log("activo: " . ($activo ?? 'NULL'));
        error_log("activo tipo: " . gettype($activo));
        
        # Registrar un departamento
        $response = $master->insertByProcedure("sp_rh_cat_departamentos_g", [
            $id_departamento,
            $descripcion,
            (int)$activo  // Forzar conversión a entero
        ]);
        break;
    case 6:
        # recuperar departamentos.
        $response = $master->getByProcedure("sp_rh_cat_departamentos_b", []);
        break;
    case 7:
        # Registrar un puesto
        $response = $master->insertByProcedure("sp_rh_cat_puestos_g", [
            $id_puesto,
            $descripcion,
            $id_departamento,
            $activo
        ]);
        break;
    case 8:
        # recuperar puestos.
        $response = $master->getByProcedure("sp_rh_cat_puestos_b", []);
        break;
    case 9:
        # recuperar detalles de puestos (con filtro opcional por puesto)
        $response = $master->getByProcedure("sp_rh_cat_puestos_detalles_b", [
            $id_puesto
        ]);
        break;
    case 10:
        # actualizar detalles de puesto
        $response = $master->updateByProcedure("sp_rh_cat_puestos_detalles_u", [
            $id_puesto,
            $objetivos,
            $competencias,
            $banda_salarial
        ]);
        break;
    default:
        # default
        $response = "API no definida";
        break;
}

echo $master->returnApi($response);