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
$accion = isset($_POST['accion']) ? $_POST['accion'] : null; // 'aprobar' o 'rechazar'
$usuario_aprobador_id = isset($_POST['usuario_aprobador_id']) && $_POST['usuario_aprobador_id'] !== '' ? (int)$_POST['usuario_aprobador_id'] : null;
$observaciones_aprobacion = isset($_POST['observaciones_aprobacion']) ? trim($_POST['observaciones_aprobacion']) : null;

# Variables adicionales para puestos (detalles)
$objetivos = isset($_POST['objetivos']) ? trim($_POST['objetivos']) : '';
$competencias = isset($_POST['competencias']) ? trim($_POST['competencias']) : '';
$banda_salarial = isset($_POST['banda_salarial']) ? trim($_POST['banda_salarial']) : '';
// $conocimientos_tecnicos = isset($_POST['conocimientos_tecnicos']) ? trim($_POST['conocimientos_tecnicos']) : null;
// $habilidades_blandas = isset($_POST['habilidades_blandas']) ? trim($_POST['habilidades_blandas']) : null;

# Variables para las publicaciones de vacantes
$id_publicacion = isset($_POST['id_publicacion']) ? (int)$_POST['id_publicacion'] : null;
$titulo_vacante = isset($_POST['titulo_vacante']) ? trim($_POST['titulo_vacante']) : '';
$descripcion_adicional = isset($_POST['descripcion_adicional']) ? trim($_POST['descripcion_adicional']) : '';
$estado_publicacion = isset($_POST['estado_publicacion']) ? trim($_POST['estado_publicacion']) : '';
$tipo_publicacion = isset($_POST['tipo_publicacion']) ? trim($_POST['tipo_publicacion']) : '';
$fecha_inicio_publicacion = isset($_POST['fecha_inicio_publicacion']) ? $_POST['fecha_inicio_publicacion'] : null;
$fecha_limite_publicacion = isset($_POST['fecha_limite_publicacion']) ? $_POST['fecha_limite_publicacion'] : null;
$motivo_cierre = isset($_POST['motivo_cierre']) ? trim($_POST['motivo_cierre']) : null;
$plataformas_publicacion = isset($_POST['plataformas_publicacion']) ? $_POST['plataformas_publicacion'] : null;
$criterios_cierre_automatico = isset($_POST['criterios_cierre_automatico']) ? $_POST['criterios_cierre_automatico'] : null;
$configuracion_adicional = isset($_POST['configuracion_adicional']) ? $_POST['configuracion_adicional'] : null;
$max_postulantes = isset($_POST['max_postulantes']) ? (int)$_POST['max_postulantes'] : 20;

# Variables para el filtro de publicaciones
$estado_filtro = isset($_POST['estado']) ? $_POST['estado'] : null;
$tipo_filtro = isset($_POST['tipo']) ? $_POST['tipo'] : null;
// Convertir arrays a strings separados por comas para el SP
if (is_array($estado_filtro)) {
    $estado_filtro = implode(',', $estado_filtro);
}
if (is_array($tipo_filtro)) {
    $tipo_filtro = implode(',', $tipo_filtro);
}

# Variable para el historial de publicaciones
$id_historial = isset($_POST['id_historial']) ? (int)$_POST['id_historial'] : null;
$estado_anterior = isset($_POST['estado_anterior']) ? trim($_POST['estado_anterior']) : '';
$estado_nuevo = isset($_POST['estado_nuevo']) ? trim($_POST['estado_nuevo']) : '';
$comentarios = isset($_POST['comentarios']) ? trim($_POST['comentarios']) : '';
$fecha_cambio = isset($_POST['fecha_cambio']) ? $_POST['fecha_cambio'] : null;
$usuario_responsable = isset($_POST['usuario_responsable']) ? (int)$_POST['usuario_responsable'] : null;

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
                $_SESSION['id'],   // Usuario solicitante
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
              //  $observaciones_aprobacion  //Observaciones de aprobación
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
        // Validar parámetros obligatorios
        if ($id_requisicion === null || $accion === null) {
            $response = array(
                'code' => 0,
                'message' => 'ERROR: Faltan parámetros obligatorios (ID requisición y acción)',
                'data' => array()
            );
            break;
        }

        // Validar que la acción sea válida
        if (!in_array(strtolower($accion), ['aprobar', 'rechazar'])) {
            $response = array(
                'code' => 0,
                'message' => 'ERROR: Acción no válida. Use "aprobar" o "rechazar"',
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
        error_log("API 4 - Parámetros recibidos: " . json_encode([
            'id_requisicion' => $id_requisicion,
            'accion' => $accion,
            'usuario_aprobador_id' => $_SESSION['id'],
            'observaciones_aprobacion' => $observaciones_aprobacion
        ]));

        try {
            $response = $master->insertByProcedure("sp_rh_cat_requisiciones_aprobar", [
                $id_requisicion,
                $accion,
                $_SESSION['id'], // usuario_aprobador_id
                $observaciones_aprobacion
            ]);

            error_log("API 4 - Respuesta del SP: " . json_encode($response));
        } catch (Exception $e) {
            error_log("API 4 - Error en SP: " . $e->getMessage());
            $response = array(
                'code' => 0,
                'message' => 'ERROR: ' . $e->getMessage(),
                'data' => array()
            );
        }
        break;
    case 4:

        # Registrar/editar un departamento
        $response = $master->insertByProcedure("sp_rh_cat_departamentos_g", [
            $id_departamento,
            $descripcion,
            $activo
        ]);
        break;
    case 5:
        # recuperar departamentos.
        $response = $master->getByProcedure("sp_rh_cat_departamentos_b", []);
        break;
    case 6:
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
    case 7:
        # recuperar puestos.
        $response = $master->getByProcedure("sp_rh_cat_puestos_b", [
            $filtro_estado,
            $filtro_departamento
        ]);
        break;
    case 8:
        # CAMBIAR ESTE API CASE REPOSICIONAR (OBSOLETO)
        $response = $master->getByProcedure("sp_rh_cat_puestos_detalles_b", [
            $id_puesto
        ]);
        break;
    case 9:
        # Mostrar requisiciones aprobadas
        $response = $master->getByProcedure("sp_rh_cat_requisiciones_aprobadas_b", []);
        break;
    case 10:
        # Registrar un motivo
        $response = $master->insertByProcedure("sp_rh_cat_motivos_g", [
            $id_motivo,
            $descripcion,
            $activo
        ]);
        break;
    case 11:
        # recuperar motivos.
        $response = $master->getByProcedure("sp_rh_cat_motivos_b", []);
        break;
    case 12:
        # eliminar departamentos (desactivar)
        $response = $master->insertByProcedure("sp_rh_cat_departamentos_e", [
            $id_departamento
        ]);
        break;
    case 13:
        # eliminar puestos (desactivar)
        $response = $master->insertByProcedure("sp_rh_cat_puestos_e", [
            $id_puesto
        ]);
        break;
    case 14:
        # eliminar motivos (desactivar)
        $response = $master->insertByProcedure("sp_rh_cat_motivos_e", [
            $id_motivo
        ]);
        break;
    case 15:
        # eliminar requisiciones (desactivar)
        $response = $master->insertByProcedure("sp_rh_cat_requisiciones_e", [
            $id_requisicion
        ]);
        break;
    case 16:
        # recuperar habildiad es blandas.
        $response = $master->getByProcedure("sp_rh_cat_blandas_b", []);
        break;
    case 17:
        # Registrar habildiad es blandas.
        $response = $master->insertByProcedure("sp_rh_cat_blandas_g", [
            $id_blanda,
            $descripcion,
            $activo
        ]);
        break;
    case 18:
        # Eliminar habildiad es blandas (desactivar)
        $response = $master->insertByProcedure("sp_rh_cat_blandas_e", [
            $id_blanda
        ]);
        break;
    case 19:
        # recuperar habilidades técnicas.
        $response = $master->getByProcedure("sp_rh_cat_tecnicas_b", []);
        break;
    case 20:
        # Registrar habilidades técnicas.
        $response = $master->insertByProcedure("sp_rh_cat_tecnicas_g", [
            $id_tecnica,
            $descripcion,
            $activo
        ]);
        break;
    case 21:
        # Eliminar habilidades técnicas (desactivar)
        $response = $master->insertByProcedure("sp_rh_cat_tecnicas_e", [
            $id_tecnica
        ]);
        break;
    case 22:
        # Recuperar Motivos inactivos
        $response = $master->getByProcedure("sp_rh_cat_motivos_inactivos_b", []);
        break;
    case 23:
        # Recuperar Habilidades blandas inactivas
        $response = $master->getByProcedure("sp_rh_cat_blandas_inactivas_b", []);
        break;
    case 24:
        # Recuperar Habilidades técnicas inactivas
        $response = $master->getByProcedure("sp_rh_cat_tecnicas_inactivas_b", []);
        break;
    case 25:
        # Recuperar Departamentos inactivos
        $response = $master->getByProcedure("sp_rh_cat_departamentos_inactivos_b", []);
        break;
    case 26:
        # Crear/actualizar publicación de vacante
        if ($id_requisicion === null) {
            $response = [
                'code' => 0,
                'message' => 'Error: ID de requisición es obligatorio',
                'data' => null
            ];
        } else {
            // Validar JSON si se proporcionan
            $criterios_json = null;
            $plataformas_json = null;
            $config_json = null;
            
            if ($criterios_cierre_automatico && $criterios_cierre_automatico !== '') {
                $criterios_json = $criterios_cierre_automatico;
            }
            
            if ($plataformas_publicacion && $plataformas_publicacion !== '') {
                $plataformas_json = $plataformas_publicacion;
            }
            
            if ($configuracion_adicional && $configuracion_adicional !== '') {
                $config_json = $configuracion_adicional;
            }
            
            $response = $master->insertByProcedure("sp_rh_cat_publicaciones_g", [
                $id_publicacion,
                $id_requisicion,
                $titulo_vacante,
                $descripcion_adicional,
                $estado_publicacion,
                $tipo_publicacion,
                $fecha_inicio_publicacion,
                $fecha_limite_publicacion,
                $criterios_json,
                $plataformas_json,
                $config_json,
                $max_postulantes,
                $_SESSION['id'] // usuario_publicador_id
            ]);
        }
        break;
    case 27:
        # Cambiar estado de publicación
        if ($id_publicacion === null || $estado_publicacion === null) {
            $response = [
                'code' => 0,
                'message' => 'Error: ID de publicación y nuevo estado son obligatorios',
                'data' => null
            ];
        } else {
            $response = $master->insertByProcedure("sp_rh_cat_publicaciones_cambiar_estado", [
                $id_publicacion,
                $estado_publicacion,
                $motivo_cierre,
                $_SESSION['id']
            ]);
        }
        break;
    case 28:
        # Listar publicaciones por estado
        $response = $master->getByProcedure("sp_rh_cat_publicaciones_por_estado_b", [
            $estado_filtro,
            $tipo_filtro
        ]);
        break;
    case 29:
        # Historial de publicaciones
        $response = $master->getByProcedure("sp_rh_cat_historial_publicaciones_b", [
            $id_publicacion
        ]);
        break;
    default:
        # default
        $response = "API no definida";
        break;
}

echo $master->returnApi($response);
