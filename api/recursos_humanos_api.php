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

# Variables de catalogos - UNIFICADAS
$id_departamento = isset($_POST['id_departamento']) && $_POST['id_departamento'] !== '' ? (int)$_POST['id_departamento'] : null;
$id_puesto = isset($_POST['id_puesto']) && $_POST['id_puesto'] !== '' ? (int)$_POST['id_puesto'] : null;
$id_motivo = isset($_POST['id_motivo']) && $_POST['id_motivo'] !== '' ? (int)$_POST['id_motivo'] : null;
$id_blanda = isset($_POST['id_blanda']) && $_POST['id_blanda'] !== '' ? $_POST['id_blanda'] : null;
$id_tecnica = isset($_POST['id_tecnica']) && $_POST['id_tecnica'] !== '' ? $_POST['id_tecnica'] : null;
$activo = isset($_POST['activo']) ? (int)$_POST['activo'] : 1;
$descripcion = isset($_POST['descripcion']) ? trim($_POST['descripcion']) : '';

# Variables de filtros para puestos
$filtro_estado = null;
$filtro_departamento = null;

// Manejar filtro de estado
if (isset($_POST['filtro_estado'])) {
    if ($_POST['filtro_estado'] !== '' && $_POST['filtro_estado'] !== null) {
        $filtro_estado = (int)$_POST['filtro_estado'];
    }
    // Si es cadena vacía, significa "todos", entonces filtro_estado queda null
}

// Manejar filtro de departamento
if (isset($_POST['filtro_departamento']) && $_POST['filtro_departamento'] !== '' && $_POST['filtro_departamento'] !== null) {
    $filtro_departamento = (int)$_POST['filtro_departamento'];
}

# Variables para requisiciones de personal - RENOMBRADAS PARA CONSISTENCIA
$id_requisicion = isset($_POST['id_requisicion']) ? (int)$_POST['id_requisicion'] : null;

// MANEJO MEJORADO del usuario solicitante
$usuario_solicitante_id = null;
if (isset($_POST['usuario_solicitante_id']) && !empty($_POST['usuario_solicitante_id'])) {
    $usuario_solicitante_id = (int)$_POST['usuario_solicitante_id'];
} elseif (isset($_SESSION['id']) && !empty($_SESSION['id'])) {
    $usuario_solicitante_id = (int)$_SESSION['id'];
}

$prioridad = isset($_POST['prioridad']) ? trim($_POST['prioridad']) : 'normal';
$tipo_modalidad = isset($_POST['tipo_modalidad']) ? trim($_POST['tipo_modalidad']) : '';
$justificacion = isset($_POST['justificacion']) ? trim($_POST['justificacion']) : '';
$estatus = isset($_POST['estatus']) ? trim($_POST['estatus']) : 'borrador';
$tipo_contrato = isset($_POST['tipo_contrato']) ? trim($_POST['tipo_contrato']) : '';
$tipo_jornada = isset($_POST['tipo_jornada']) ? trim($_POST['tipo_jornada']) : '';
$escolaridad_minima = isset($_POST['escolaridad_minima']) ? trim($_POST['escolaridad_minima']) : '';
$experiencia_anios = isset($_POST['experiencia_anios']) ? trim($_POST['experiencia_anios']) : '';
$idiomas = isset($_POST['idiomas']) ? trim($_POST['idiomas']) : null; //por definir

// Campos de horario actualizados
    $dias_trabajo = isset($_POST['dias_trabajo']) ? trim($_POST['dias_trabajo']) : '';
    $dias_personalizados = isset($_POST['dias_personalizados']) ? trim($_POST['dias_personalizados']) : null;
    $hora_inicio = isset($_POST['hora_inicio']) ? trim($_POST['hora_inicio']) : '';
    $hora_fin = isset($_POST['hora_fin']) ? trim($_POST['hora_fin']) : '';
    
    // Campos de salario actualizados (opcionales)
    $salario_min = isset($_POST['salario_min']) && $_POST['salario_min'] !== '' ? (float)$_POST['salario_min'] : null;
    $salario_max = isset($_POST['salario_max']) && $_POST['salario_max'] !== '' ? (float)$_POST['salario_max'] : null;

# Variable para la editar requisición de personal
$usuario_aprobador_id = isset($_POST['usuario_aprobador_id']) && $_POST['usuario_aprobador_id'] !== '' ? (int)$_POST['usuario_aprobador_id'] : null;
$observaciones_aprobacion = isset($_POST['observaciones_aprobacion']) ? trim($_POST['observaciones_aprobacion']) : null;

# Variables adicionales para puestos (detalles)
$objetivos = isset($_POST['objetivos']) ? trim($_POST['objetivos']) : '';
$competencias = isset($_POST['competencias']) ? trim($_POST['competencias']) : '';
$banda_salarial = isset($_POST['banda_salarial']) ? trim($_POST['banda_salarial']) : '';
// $conocimientos_tecnicos = isset($_POST['conocimientos_tecnicos']) ? trim($_POST['conocimientos_tecnicos']) : null;
// $habilidades_blandas = isset($_POST['habilidades_blandas']) ? trim($_POST['habilidades_blandas']) : null;



switch ($api) {
    case 1:
        # VALIDACIÓN MEJORADA
        if (empty($usuario_solicitante_id) || $usuario_solicitante_id <= 0) {
            $response = [
                'code' => 0,
                'message' => 'Error: No se pudo identificar al usuario solicitante.',
                'debug' => [
                    'session_id' => $_SESSION['id'] ?? 'NO_EXISTE',
                    'post_usuario_solicitante_id' => $_POST['usuario_solicitante_id'] ?? 'NO_EXISTE',
                    'usuario_final' => $usuario_solicitante_id,
                ]
            ];
        } elseif (empty($id_motivo) || $id_motivo <= 0) {
            $response = [
                'code' => 0,
                'message' => 'Error: Debe seleccionar un motivo válido.',
                'debug' => [
                    'post_id_motivo' => $_POST['id_motivo'] ?? 'NO_EXISTE',
                    'id_motivo_final' => $id_motivo,
                ]
            ];
        } elseif (empty($id_departamento) || $id_departamento <= 0) {
            $response = [
                'code' => 0,
                'message' => 'Error: Debe seleccionar un departamento válido.',
                'debug' => [
                    'post_id_departamento' => $_POST['id_departamento'] ?? 'NO_EXISTE',
                    'id_departamento_final' => $id_departamento,
                ]
            ];
        } else {
            # Crear/actualizar una requisición de personal - VARIABLES ACTUALIZADAS
            $resultado = $master->insertByProcedure('sp_rh_cat_requisiciones_g', [
                $id_requisicion,           // ID de requisición (null para crear, valor para editar)
                $id_departamento,          // ID del departamento (RENOMBRADO)
                $id_motivo,               // ID del motivo (RENOMBRADO)
                $usuario_solicitante_id,   // Usuario solicitante
                $prioridad,               // Prioridad
                $justificacion,           // Justificación
                $estatus,                 // Estatus
                $id_puesto,               // ID del puesto (RENOMBRADO)
                $tipo_contrato,           // Tipo de contrato
                $tipo_jornada,            // Tipo de jornada
                $tipo_modalidad,         // Tipo de modalidad (nuevo campo)
                $idiomas,                 // Idiomas (Aún por definir)
                $dias_trabajo,
                $dias_personalizados,
                $hora_inicio,
                $hora_fin,
                // $salario_min,
                // $salario_max,
                // Parametros de aprobación
              //  $usuario_aprobador_id,     ID del usuario aprobador (Todavía falta por implementar)
                $observaciones_aprobacion  //Observaciones de aprobación
            ]);

            // VERIFICAR si hay errores del stored procedure
            if (isset($resultado['data']) && is_array($resultado['data']) && !empty($resultado['data'])) {
                $primerRegistro = $resultado['data'][0];
                
                if (isset($primerRegistro['ERROR'])) {
                    $response = [
                        'code' => 0,
                        'message' => 'Error del stored procedure: ' . $primerRegistro['ERROR'],
                        'data' => null
                    ];
                } else {
                    // Éxito - formatear la respuesta correctamente
                    $mensaje = $id_requisicion ? 'Requisición actualizada exitosamente' : 'Requisición registrada exitosamente';
                    $response = [
                        'code' => 1,
                        'message' => $mensaje,
                        'data' => [
                            'id_requisicion' => $primerRegistro['id_requisicion'] ?? null,
                            'numero_requisicion' => $primerRegistro['numero_requisicion'] ?? null
                        ]
                    ];
                }
            } else {
                $response = [
                    'code' => 0,
                    'message' => 'Error: No se recibió respuesta válida del stored procedure',
                    'data' => null,
                    'debug' => $resultado
                ];
            }
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
        # CAMBIAR ESTE API CASE REPOSICIONAR (OBSOLETO)
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
            $escolaridad_minima,
            $experiencia_anios,
            $id_departamento,
            $objetivos,
            $competencias,
            $salario_min,
            $salario_max,
            $activo,
            $id_blanda,
            $id_tecnica
        ]);
        break;
    case 8:
        # recuperar puestos.
        $response = $master->getByProcedure("sp_rh_cat_puestos_b", [
            $filtro_estado,
            $filtro_departamento
        ]);
        break;
    case 9:
        # CAMBIAR ESTE API CASE REPOSICIONAR (OBSOLETO)
        $response = $master->getByProcedure("sp_rh_cat_puestos_detalles_b", [
            $id_puesto
        ]);
        break;
    // case 10: CAMBIAR ESTE API CASE REPOSICIONAR (OBSOLETO)
    //     # actualizar detalles de puesto
    //     $response = $master->updateByProcedure("sp_rh_cat_puestos_detalles_u", [
    //         $id_puesto,
    //         $escolaridad_minima,
    //         $experiencia_anios,
    //         $objetivos,
    //         $competencias,
    //         $banda_salarial
    //     ]);
    //     break;
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
        # CAMBIAR ESTE API CASE REPOSICIONAR (OBSOLETO)
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
    case 17:
        # eliminar requisiciones (desactivar)
        $response = $master->insertByProcedure("sp_rh_cat_requisiciones_e", [
            $id_requisicion
        ]);
        break;
    case 18:
        # recuperar habildiad es blandas.
        $response = $master->getByProcedure("sp_rh_cat_blandas_b", []);
        break;
    case 19:
        # Registrar habildiad es blandas.
        $response = $master->insertByProcedure("sp_rh_cat_blandas_g", [
            $id_blanda,
            $descripcion,
            $activo
        ]);
        break;
    case 20:
        # Eliminar habildiad es blandas (desactivar)
        $response = $master->insertByProcedure("sp_rh_cat_blandas_e", [
            $id_blanda
        ]);
        break;
    case 21:
        # recuperar habilidades técnicas.
        $response = $master->getByProcedure("sp_rh_cat_tecnicas_b", []);
        break;
    case 22:
        # Registrar habilidades técnicas.
        $response = $master->insertByProcedure("sp_rh_cat_tecnicas_g", [
            $id_tecnica,
            $descripcion,
            $activo
        ]);
        break;
    case 23:
        # Eliminar habilidades técnicas (desactivar)
        $response = $master->insertByProcedure("sp_rh_cat_tecnicas_e", [
            $id_tecnica
        ]);
        break;
    case 24:
        # Recuperar Motivos inactivos
        $response = $master->getByProcedure("sp_rh_cat_motivos_inactivos_b", []);
        break;
    case 25:
        # Recuperar Habilidades blandas inactivas
        $response = $master->getByProcedure("sp_rh_cat_blandas_inactivas_b", []);
        break;
    case 26:
        # Recuperar Habilidades técnicas inactivas
        $response = $master->getByProcedure("sp_rh_cat_tecnicas_inactivas_b", []);
        break;
    case 27:
        # Recuperar Departamentos inactivos
        $response = $master->getByProcedure("sp_rh_cat_departamentos_inactivos_b", []);
        break;
    default:
        # default
        $response = "API no definida";
        break;
}

echo $master->returnApi($response);
