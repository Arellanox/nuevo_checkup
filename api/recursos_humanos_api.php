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

# Variables existentes
$id_departamento = isset($_POST['id_departamento']) ? (int)$_POST['id_departamento'] : null;
$descripcion = isset($_POST['descripcion']) ? trim($_POST['descripcion']) : '';
$activo = isset($_POST['activo']) ? (int)$_POST['activo'] : 1;
$creado_por = $_SESSION['id'];
$id_puesto = isset($_POST['id_puesto']) ? (int)$_POST['id_puesto'] : null;
$objetivos = isset($_POST['objetivos']) ? trim($_POST['objetivos']) : '';
$competencias = isset($_POST['competencias']) ? trim($_POST['competencias']) : '';
$banda_salarial = isset($_POST['banda_salarial']) ? trim($_POST['banda_salarial']) : '';

# Variables para requisiciones de personal
$id_requisicion = isset($_POST['id_requisicion']) ? (int)$_POST['id_requisicion'] : null;
$id_motivo = isset($_POST['id_motivo']) ? (int)$_POST['id_motivo'] : null;
$departamento = isset($_POST['departamento']) ? (int)$_POST['departamento'] : null;
$usuario_solicitante_id = isset($_POST['usuario_solicitante_id']) ? (int)$_POST['usuario_solicitante_id'] : $_SESSION['id'];
$prioridad = isset($_POST['prioridad']) ? trim($_POST['prioridad']) : 'normal';
$justificacion = isset($_POST['justificacion']) ? trim($_POST['justificacion']) : '';
$estatus = isset($_POST['estatus']) ? trim($_POST['estatus']) : 'borrador';
$puesto = isset($_POST['puesto']) ? (int)$_POST['puesto'] : null;
$tipo_contrato = isset($_POST['tipo_contrato']) ? trim($_POST['tipo_contrato']) : '';
$tipo_jornada = isset($_POST['tipo_jornada']) ? trim($_POST['tipo_jornada']) : '';
$escolaridad_minima = isset($_POST['escolaridad_minima']) ? trim($_POST['escolaridad_minima']) : '';
$experiencia_anos = isset($_POST['experiencia_anos']) ? trim($_POST['experiencia_anos']) : '';
$experiencia_area = isset($_POST['experiencia_area']) ? trim($_POST['experiencia_area']) : null;
$conocimientos_tecnicos = isset($_POST['conocimientos_tecnicos']) ? trim($_POST['conocimientos_tecnicos']) : null;
$habilidades_blandas = isset($_POST['habilidades_blandas']) ? trim($_POST['habilidades_blandas']) : null;
$idiomas = isset($_POST['idiomas']) ? trim($_POST['idiomas']) : null;
$horario_trabajo = isset($_POST['horario_trabajo']) ? trim($_POST['horario_trabajo']) : '';
$rango_salarial = isset($_POST['rango_salarial']) ? trim($_POST['rango_salarial']) : null;

switch ($api) {
    case 1:
        # AGREGAR VALIDACIÓN DEL USUARIO ANTES DE INSERTAR
        if (empty($usuario_solicitante_id)) {
            $response = [
                'code' => 0,
                'message' => 'Error: No se pudo identificar al usuario solicitante.',
                'debug' => [
                    'session_id' => $_SESSION['id'] ?? 'NO_EXISTE',
                    'post_data' => $_POST
                ]
            ];
        } else {
            # Crear/actualizar una requisición de personal
            $response = $master->insertByProcedure('sp_rh_cat_requisiciones_g', [
                $id_requisicion,
                $departamento,
                $id_motivo,
                $usuario_solicitante_id,
                $prioridad,
                $justificacion,
                $estatus,
                $puesto,
                $tipo_contrato,
                $tipo_jornada,
                $escolaridad_minima,
                $experiencia_anos,
                $experiencia_area,
                $conocimientos_tecnicos,
                $habilidades_blandas,
                $idiomas,
                $horario_trabajo,
                $rango_salarial
            ]);
        }
        break;
    case 2:
        # recuperar todas las requisiciones
        $response = $master->getByProcedure('sp_rh_cat_requisiciones_b', []);
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
        
        # Registrar/editar un departamento
        $response = $master->insertByProcedure("sp_rh_cat_departamentos_g", [
            $id_departamento,
            $descripcion,
            $activo
        ]);
        break;
    case 6:
        # recuperar departamentos.
        $response = $master->getByProcedure("sp_rh_cat_departamentos_b", []);
        break;
    case 7:
        # Registrar/editar un puesto
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
    case 11:
        # Registrar un motivo
        $response = $master->insertByProcedure("sp_rh_cat_motivos_g", [
            $id_motivo,
            $descripcion,
            $activo
        ]);
        break;
    case 12:
        # recuperar motivos.
        $response = $master->getByProcedure("sp_rh_cat_motivos_b", []);
        break;
    case 13:
        # DEBUG TEMPORAL: Verificar qué está llegando
        error_log("API 13 - ID Departamento recibido: " . var_export($id_departamento, true));
        error_log("API 13 - POST completo: " . var_export($_POST, true));
        
        # recuperar puestos filtrados por departamento específico
        $response = $master->getByProcedure("sp_rh_cat_puestos_por_departamento_b", [
            $id_departamento
        ]);
        
        # DEBUG TEMPORAL: Ver qué devuelve el SP
        error_log("API 13 - Respuesta del SP: " . var_export($response, true));
        break;
    case 14:
        # eliminar departamentos (desactivar)
        $response = $master->insertByProcedure("sp_rh_cat_departamentos_e", [
            $id_departamento
        ]);
        break;
    case 15:
        # eliminar puestos (desactivar)
        $response = $master->insertByProcedure("sp_rh_cat_puestos_e", [
            $id_puesto
        ]);
        break;
    case 16:
        # eliminar motivos (desactivar)
        $response = $master->insertByProcedure("sp_rh_cat_motivos_e", [
            $id_motivo
        ]);
        break;
    default:
        # default
        $response = "API no definida";
        break;
}

echo $master->returnApi($response);