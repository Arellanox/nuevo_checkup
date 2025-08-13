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
$fecha_cierre_real = isset($_POST['fecha_cierre_real']) ? $_POST['fecha_cierre_real'] : null;
$motivo_cierre = isset($_POST['motivo_cierre']) ? trim($_POST['motivo_cierre']) : null;
$plataformas_publicacion = isset($_POST['plataformas_publicacion']) ? $_POST['plataformas_publicacion'] : null;
$criterios_cierre_automatico = isset($_POST['criterios_cierre_automatico']) ? $_POST['criterios_cierre_automatico'] : null;
$configuracion_adicional = isset($_POST['configuracion_adicional']) ? $_POST['configuracion_adicional'] : null;
$max_postulantes = isset($_POST['max_postulantes']) ? (int)$_POST['max_postulantes'] : 20;
$numero_postulantes = isset($_POST['numero_postulantes']) ? (int)$_POST['numero_postulantes'] : 0;

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

# Variables para postulaciones de vacantes - ESTRUCTURA EXTENDIDA
$id_postulacion = isset($_POST['id_postulacion']) ? (int)$_POST['id_postulacion'] : null;

// === SECCIÓN 1: DATOS GENERALES ===
$nombre_completo = isset($_POST['s_1_pregunta_1']) ? trim($_POST['s_1_pregunta_1']) : '';
$apodo = isset($_POST['s_1_pregunta_2']) ? trim($_POST['s_1_pregunta_2']) : '';
$lugar_nacimiento = isset($_POST['s_1_pregunta_3']) ? trim($_POST['s_1_pregunta_3']) : '';
$fecha_nacimiento = isset($_POST['s_1_pregunta_4']) ? $_POST['s_1_pregunta_4'] : null;
$edad = isset($_POST['s_1_pregunta_5']) ? (int)$_POST['s_1_pregunta_5'] : null;
$correo_electronico = isset($_POST['s_1_pregunta_6']) ? trim($_POST['s_1_pregunta_6']) : '';
$telefono = isset($_POST['s_1_pregunta_7']) ? trim($_POST['s_1_pregunta_7']) : '';
$curp = isset($_POST['s_1_pregunta_8']) ? trim($_POST['s_1_pregunta_8']) : '';
$domicilio = isset($_POST['s_1_pregunta_9']) ? trim($_POST['s_1_pregunta_9']) : '';
$grado_estudios = isset($_POST['s_1_pregunta_10']) ? trim($_POST['s_1_pregunta_10']) : '';
$idiomas = isset($_POST['s_1_pregunta_11']) ? trim($_POST['s_1_pregunta_11']) : '';
$institucion_estudios = isset($_POST['s_1_pregunta_12']) ? trim($_POST['s_1_pregunta_12']) : '';
$profesion = isset($_POST['s_1_pregunta_13']) ? trim($_POST['s_1_pregunta_13']) : '';
$estado_civil = isset($_POST['s_1_select_1']) ? trim($_POST['s_1_select_1']) : '';
$sexo = isset($_POST['s_1_select_2']) ? trim($_POST['s_1_select_2']) : '';
$hijos = isset($_POST['s_1_select_3']) ? trim($_POST['s_1_select_3']) : '';
$nombre_conyuge = isset($_POST['s_1_pregunta_14']) ? trim($_POST['s_1_pregunta_14']) : '';
$ocupacion_conyuge = isset($_POST['s_1_pregunta_15']) ? trim($_POST['s_1_pregunta_15']) : '';
$nombre_hijos = isset($_POST['s_1_pregunta_16']) ? trim($_POST['s_1_pregunta_16']) : '';
$edad_hijos = isset($_POST['s_1_pregunta_17']) ? trim($_POST['s_1_pregunta_17']) : '';
$con_quien_vive = isset($_POST['s_1_pregunta_18']) ? trim($_POST['s_1_pregunta_18']) : '';
$ocupacion_padres = isset($_POST['s_1_pregunta_19']) ? trim($_POST['s_1_pregunta_19']) : '';
$ocupacion_hermanos = isset($_POST['s_1_pregunta_20']) ? trim($_POST['s_1_pregunta_20']) : '';

// === SECCIÓN 2: DATOS DE SALUD ===
$condicion_salud = isset($_POST['s_2_select_1']) ? trim($_POST['s_2_select_1']) : '';
$peso = isset($_POST['s_2_pregunta_1']) && $_POST['s_2_pregunta_1'] !== '' ? (float)$_POST['s_2_pregunta_1'] : null;
$estatura = isset($_POST['s_2_pregunta_2']) && $_POST['s_2_pregunta_2'] !== '' ? (float)$_POST['s_2_pregunta_2'] : null;
$enfermedad_grave = isset($_POST['s_2_pregunta_3']) ? trim($_POST['s_2_pregunta_3']) : '';
// CORRECCIÓN: Los padecimientos son checkboxes, no un campo de texto
$padecimientos = isset($_POST['padecimientos']) && is_array($_POST['padecimientos']) ? implode(', ', $_POST['padecimientos']) : '';
$medicamentos_prescritos = isset($_POST['s_2_pregunta_4']) ? trim($_POST['s_2_pregunta_4']) : '';
$medicamentos_sin_prescripcion = isset($_POST['s_2_pregunta_5']) ? trim($_POST['s_2_pregunta_5']) : '';
$ultimo_consumo_alcohol = isset($_POST['s_2_pregunta_6']) ? trim($_POST['s_2_pregunta_6']) : '';
$ultimo_consumo_drogas = isset($_POST['s_2_pregunta_7']) ? trim($_POST['s_2_pregunta_7']) : '';
$informacion_adicional_salud = isset($_POST['s_2_pregunta_8']) ? trim($_POST['s_2_pregunta_8']) : '';

// === SECCIÓN 3: ANTECEDENTES LABORALES ===
$como_se_entero_vacante = isset($_POST['s_3_pregunta_1']) ? trim($_POST['s_3_pregunta_1']) : '';
$porque_interesa_vacante = isset($_POST['s_3_pregunta_2']) ? trim($_POST['s_3_pregunta_2']) : '';
$vida_en_5_anos = isset($_POST['s_3_pregunta_3']) ? trim($_POST['s_3_pregunta_3']) : '';

// CORRECCIÓN: Procesar historial laboral de arrays a JSON
$historial_laboral = '';
if (isset($_POST['empresa']) && is_array($_POST['empresa'])) {
    $historial_data = [];
    
    for ($i = 0; $i < count($_POST['empresa']); $i++) {
        $empresa = isset($_POST['empresa'][$i]) ? trim($_POST['empresa'][$i]) : '';
        $puesto = isset($_POST['puesto'][$i]) ? trim($_POST['puesto'][$i]) : '';
        $sueldo = isset($_POST['sueldo'][$i]) ? trim($_POST['sueldo'][$i]) : '';
        $actividades = isset($_POST['actividades'][$i]) ? trim($_POST['actividades'][$i]) : '';
        $separacion = isset($_POST['separacion'][$i]) ? trim($_POST['separacion'][$i]) : '';
        $referencias = isset($_POST['referencias'][$i]) ? trim($_POST['referencias'][$i]) : '';
        
        // Solo agregar si al menos uno de los campos no está vacío
        if ($empresa || $puesto || $sueldo || $actividades || $separacion || $referencias) {
            $historial_data[] = [
                'empresa' => $empresa,
                'puesto' => $puesto,
                'sueldo' => $sueldo,
                'actividades' => $actividades,
                'motivo_separacion' => $separacion,
                'referencias' => $referencias
            ];
        }
    }
    
    if (!empty($historial_data)) {
        $historial_laboral = json_encode($historial_data, JSON_UNESCAPED_UNICODE);
    }
}

// URLs de archivos (se generarán en el case)
$url_cv = null;
$url_curp = null;
$firma_digital = isset($_POST['firma_digital']) ? $_POST['firma_digital'] : null; // Firma como base64
$estado_postulacion = isset($_POST['estado_postulacion']) ? trim($_POST['estado_postulacion']) : 'nueva';
 $archivo_carta = isset($_POST['archivo_carta']) && $_POST['archivo_carta'] !== '' ? $_POST['archivo_carta'] : null;

# Cambiar estado de postulante
$nuevo_estado = isset($_POST['nuevo_estado']) ? trim($_POST['nuevo_estado']) : null;
$motivo_cambio = isset($_POST['motivo_cambio']) ? trim($_POST['motivo_cambio']) : 'Cambio de estado desde gestión de postulantes';

# Variables para candidatos
$id_candidato = isset($_POST['id_candidato']) ? (int)$_POST['id_candidato'] : null;
$numero_candidato = isset($_POST['numero_candidato']) ? trim($_POST['numero_candidato']) : '';
$estado_candidato = isset($_POST['estado_candidato']) ? trim($_POST['estado_candidato']) : '';
$tipo_seleccion = isset($_POST['tipo_seleccion']) ? trim($_POST['tipo_seleccion']) : 'manual';
$fecha_seleccion = isset($_POST['fecha_seleccion']) ? $_POST['fecha_seleccion'] : null;
$motivo_seleccion = isset($_POST['motivo_seleccion']) ? trim($_POST['motivo_seleccion']) : null;
$motivo_rechazo = isset($_POST['motivo_rechazo']) ? trim($_POST['motivo_rechazo']) : null;
$comentarios_rh = isset($_POST['comentarios_rh']) ? trim($_POST['comentarios_rh']) : null;
$comentarios_solicitante = isset($_POST['comentarios_solicitante']) ? trim($_POST['comentarios_solicitante']) : null;
$comentarios_candidato = isset($_POST['comentarios_candidato']) ? trim($_POST['comentarios_candidato']) : null;
$salario_ofertado = isset($_POST['salario_ofertado']) ? (float)$_POST['salario_ofertado'] : null;
$fecha_inicio_propuesta = isset($_POST['fecha_inicio_propuesta']) ? $_POST['fecha_inicio_propuesta'] : null;
$condiciones_especiales = isset($_POST['condiciones_especiales']) ? trim($_POST['condiciones_especiales']) : null;
$documentacion_completa = isset($_POST['documentacion_completa']) ? $_POST['documentacion_completa'] : null;
$prioridad_proceso = isset($_POST['prioridad_proceso']) ? trim($_POST['prioridad_proceso']) : 'normal';
$fecha_limite_proceso = isset($_POST['fecha_limite_proceso']) ? $_POST['fecha_limite_proceso'] : null;
$prioridad_proceso = isset($_POST['prioridad_proceso']) ? trim($_POST['prioridad_proceso']) : 'normal';
$fecha_limite_proceso = isset($_POST['fecha_limite_proceso']) ? $_POST['fecha_limite_proceso'] : null;

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
                $_SESSION['id'],
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
                $numero_postulantes,
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
                $_SESSION['id'],
                $fecha_cierre_real
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
    case 30:
        # Registrar postulación a vacante
        require_once "../config/file_config.php";
        
    if ($id_publicacion === null) {
        $response = [
            'code' => 0,
            'message' => 'Error: ID de publicación es obligatorio',
            'data' => null
        ];
    } elseif (empty($nombre_completo) || empty($telefono) || empty($correo_electronico)) {
        $response = [
            'code' => 0,
            'message' => 'Error: Los campos básicos (nombre, teléfono, correo) son obligatorios',
            'data' => null
        ];
    } else {
        try {
            // Crear estructura de directorios específica para postulaciones
            $directories = FileConfig::createPostulacionesDirectoryStructure();
            
            // Variables para las rutas de archivos
            $url_cv = null;
            $url_curp = null;
            $cvFullPath = null;
            $curpFullPath = null;
            
            // Procesar archivo CV (requerido)
            if (isset($_FILES['cv']) && $_FILES['cv']['error'] == 0) {
                // Validar tipo de archivo CV
                $allowedCvTypes = [
                    'application/pdf', 
                    'application/msword', 
                    'application/vnd.openxmlformats-officedocument.wordprocessingml.document'
                ];
                $maxCvSize = 5 * 1024 * 1024; // 5MB
                
                if (!FileConfig::isValidFileType($_FILES['cv']['type'], $allowedCvTypes)) {
                    $response = [
                        'code' => 0,
                        'message' => 'Error: El CV debe ser un archivo PDF, DOC o DOCX',
                        'data' => null
                    ];
                    break;
                }
                
                if (!FileConfig::isValidFileSize($_FILES['cv']['size'], $maxCvSize)) {
                    $response = [
                        'code' => 0,
                        'message' => 'Error: El CV no debe superar los 5MB',
                        'data' => null
                    ];
                    break;
                }
                
                // Generar nombre único para CV
                $cvFileName = FileConfig::generateUniqueFileName($_FILES['cv']['name'], 'cv_');
                $cvFullPath = $directories['full_path'] . $cvFileName;
                
                // Mover archivo CV
                if (move_uploaded_file($_FILES['cv']['tmp_name'], $cvFullPath)) {
                    $url_cv = $directories['url_path'] . $cvFileName;
                } else {
                    $response = [
                        'code' => 0,
                        'message' => 'Error: No se pudo guardar el archivo CV en la ruta: ' . $directories['full_path'],
                        'data' => null
                    ];
                    break;
                }
            } else {
                $response = [
                    'code' => 0,
                    'message' => 'Error: El CV es obligatorio',
                    'data' => null
                ];
                break;
            }
            
            // Procesar archivo CURP (opcional)
            if (isset($_FILES['doc_curp']) && $_FILES['doc_curp']['error'] == 0) {
                $allowedCurpTypes = [
                    'application/pdf', 
                    'image/jpeg', 
                    'image/png', 
                    'image/jpg'
                ];
                $maxCurpSize = 3 * 1024 * 1024; // 3MB
                
                if (FileConfig::isValidFileType($_FILES['doc_curp']['type'], $allowedCurpTypes) && 
                    FileConfig::isValidFileSize($_FILES['doc_curp']['size'], $maxCurpSize)) {
                    
                    $curpFileName = FileConfig::generateUniqueFileName($_FILES['doc_curp']['name'], 'curp_');
                    $curpFullPath = $directories['full_path'] . $curpFileName;
                    
                    if (move_uploaded_file($_FILES['doc_curp']['tmp_name'], $curpFullPath)) {
                        $url_curp = $directories['url_path'] . $curpFileName;
                    }
                }
            }
            
            // Procesar firma digital (requerida)
            $firma_blob = null;
            if (!empty($firma_digital)) {
                // Verificar que sea una imagen base64 válida
                if (strpos($firma_digital, 'data:image/') === 0) {
                    // Extraer solo los datos base64 (remover el prefijo data:image/png;base64,)
                    $base64_data = explode(',', $firma_digital);
                    if (count($base64_data) == 2) {
                        $firma_blob = base64_decode($base64_data[1]);
                        
                        // Verificar que la decodificación fue exitosa
                        if ($firma_blob === false) {
                            $response = [
                                'code' => 0,
                                'message' => 'Error: Firma digital no válida - Error en decodificación base64',
                                'data' => null
                            ];
                            break;
                        }
                    } else {
                        $response = [
                            'code' => 0,
                            'message' => 'Error: Formato de firma digital no válido',
                            'data' => null
                        ];
                        break;
                    }
                } else {
                    $response = [
                        'code' => 0,
                        'message' => 'Error: La firma digital debe ser una imagen en formato base64',
                        'data' => null
                    ];
                    break;
                }
            } else {
                $response = [
                    'code' => 0,
                    'message' => 'Error: La firma digital es obligatoria',
                    'data' => null
                ];
                break;
            }
            
            // Llamar al stored procedure con todos los nuevos campos
            $response = $master->insertByProcedure("sp_rh_gestion_postulaciones_g", [
                $id_postulacion,            // NULL para nuevo registro
                $id_publicacion,
                // Datos generales (sección 1)
                $nombre_completo,
                $apodo,
                $lugar_nacimiento,
                $fecha_nacimiento,
                $edad,
                $correo_electronico,
                $telefono,
                $curp,
                $domicilio,
                $grado_estudios,
                $idiomas,
                $institucion_estudios,
                $profesion,
                $estado_civil,
                $sexo,
                $hijos,
                $nombre_conyuge,
                $ocupacion_conyuge,
                $nombre_hijos,
                $edad_hijos,
                $con_quien_vive,
                $ocupacion_padres,
                $ocupacion_hermanos,
                // Datos de salud (sección 2)
                $condicion_salud,
                $peso,
                $estatura,
                $enfermedad_grave,
                $padecimientos,
                $medicamentos_prescritos,
                $ultimo_consumo_alcohol,
                $medicamentos_sin_prescripcion,
                $ultimo_consumo_drogas,
                $informacion_adicional_salud,
                // Antecedentes laborales (sección 3)
                $como_se_entero_vacante,
                $porque_interesa_vacante,
                $vida_en_5_anos,
                $historial_laboral,
                // Archivos
                $url_cv,
                $url_curp,
                $firma_blob,                // Nuevo: Firma digital como BLOB
                $estado_postulacion
            ]);
            
            // Verificar si el SP fue exitoso directamente desde $response
            if (isset($response['data']) && is_array($response['data']) && !empty($response['data'])) {
                $primerRegistro = $response['data'][0];
                
                if (isset($primerRegistro['RESULT']) && $primerRegistro['RESULT'] === 'SUCCESS') {
                    // ✅ YA NO ES NECESARIO INCREMENTAR MANUALMENTE - EL SP LO HACE AUTOMÁTICAMENTE
                    
                    // Formatear respuesta exitosa
                    $response = [
                        'code' => 1,
                        'message' => $primerRegistro['MESSAGE'] ?? 'Postulación registrada exitosamente',
                        'data' => [
                            'id_postulacion' => $primerRegistro['id_postulacion'] ?? null,
                            'url_cv' => $url_cv,
                            'url_curp' => $url_curp,
                            'directorio_guardado' => $directories['relative_path']
                        ]
                    ];
                } elseif (isset($primerRegistro['ERROR'])) {
                    // Error del stored procedure
                    $response = [
                        'code' => 0,
                        'message' => $primerRegistro['ERROR'],
                        'data' => null
                    ];
                    
                    // Eliminar archivos si hubo error en BD
                    if ($url_cv && $cvFullPath && file_exists($cvFullPath)) {
                        unlink($cvFullPath);
                    }
                    if ($url_curp && $curpFullPath && file_exists($curpFullPath)) {
                        unlink($curpFullPath);
                    }
                } else {
                    $response = [
                        'code' => 0,
                        'message' => 'Error: Respuesta inesperada del stored procedure',
                        'data' => $spResult
                    ];
                }
            } else {
                $response = [
                    'code' => 0,
                    'message' => 'Error: No se recibió respuesta válida del stored procedure',
                    'data' => $spResult
                ];
            }
            
        } catch (Exception $e) {
            $response = [
                'code' => 0,
                'message' => 'Error interno del servidor: ' . $e->getMessage(),
                'data' => null
            ];
            
            error_log("Error en case 30 - Postulaciones: " . $e->getMessage());
            
            // Eliminar archivos si hubo error
            if ($url_cv && $cvFullPath && file_exists($cvFullPath)) {
                unlink($cvFullPath);
            }
            if ($url_curp && $curpFullPath && file_exists($curpFullPath)) {
                unlink($curpFullPath);
            }
        }
    }
    break;
    case 31:
        # Listar postulaciones por publicación
        if ($id_publicacion === null) {
            $response = [
                'code' => 0,
                'message' => 'Error: ID de publicación es obligatorio',
                'data' => null
            ];
        } else {
            $response = $master->getByProcedure("sp_rh_gestion_postulaciones_b", [
                $id_publicacion
            ]);
        }
    break;
    case 32:
        # Obtener firma digital del postulante
        if ($id_postulacion === null) {
            $response = [
                'code' => 0,
                'message' => 'Error: ID de postulación es obligatorio',
                'data' => null
            ];
        } else {
            $response = $master->getByProcedure("sp_rh_postulantes_firmas_b", [
                $id_postulacion
            ]);
        }
    break;
    case 33:
        # Cambiar estado de postulación
    if ($id_postulacion === null || $nuevo_estado === null) {
        $response = [
            'code' => 0,
            'message' => 'Error: ID de postulación y nuevo estado son obligatorios',
            'data' => null
        ];
    } else {
        $response = $master->insertByProcedure("sp_rh_gestion_postulaciones_cambiar_estado", [
            $id_postulacion,
            $nuevo_estado,
            $motivo_cambio,
            $_SESSION['id']  // ID del usuario actual
        ]);
    }
    break;
    case 34:
        # Mostrar Postulantes aprobados
        $response = $master->getByProcedure("sp_rh_cat_postulantes_aprobados_b", []);
    break;
    case 35:
        # Cambiar estado de candidato
        if ($id_candidato === null || $estado_candidato === null) {
            $response = [
                'code' => 0,
                'message' => 'Error: ID de candidato y nuevo estado son obligatorios',
                'data' => null
            ];
        } else {
            $response = $master->insertByProcedure("sp_rh_candidatos_cambiar_estado", [
                $id_candidato,
                $estado_candidato,
                $motivo_cambio,
                $_SESSION['id'],  // ID del usuario actual
                $comentarios_rh,
                $comentarios_candidato,
                $salario_ofertado,
                $fecha_inicio_propuesta,
                $condiciones_especiales,
                $documentacion_completa,
                $archivo_carta
            ]);
        }
    break;
    case 36:
        # Rechazar candidato con motivo
        if ($id_candidato === null || $motivo_rechazo === null) {
            $response = [
                'code' => 0,
                'message' => 'Error: ID de candidato y motivo de rechazo son obligatorios',
                'data' => null
            ];
        } else {
            $response = $master->insertByProcedure("sp_rh_candidatos_rechazar", [
                $id_candidato,
                $motivo_rechazo,
                $_SESSION['id'],  // ID del usuario actual
                $comentarios_rh
            ]);
        }
    break;
    case 37:
        # Obtener propuesta salarial específica para candidato (para landing page)
        if ($id_candidato === null) {
            $response = [
                'code' => 0,
                'message' => 'Error: ID de candidato es obligatorio',
                'data' => null
            ];
        } else {
            $response = $master->getByProcedure("sp_rh_propuesta_candidato_b", [$id_candidato]);
        }
    break;
case 39:
    # Generar la carta de propuesta salarial firmada por el candidato.
    require_once "../config/file_config.php";

    $id_candidato = isset($_POST['id_candidato']) && $_POST['id_candidato'] !== '' ? (int)$_POST['id_candidato'] : null;

    if ($id_candidato === null) {
        $response = [
            'code' => 0,
            'message' => 'ID de candidato es obligatorio',
            'data' => null
        ];
        break;
    }

    try {
        $raw = $master->getByProcedure("sp_rh_propuesta_candidato_b", [$id_candidato]);
        error_log("Case 39 - RAW getByProcedure: ".json_encode($raw));

        $norm = normalizarRespuestaMaster($raw);
        error_log("Case 39 - NORMALIZADO: ".json_encode($norm));

        if ($norm['code'] != 1 || empty($norm['data'])) {
            $response = [
                'code' => 0,
                'message' => 'No se encontraron datos del candidato',
                'data' => [
                    'debug' => 'Normalizador retornó vacío',
                    'norm' => $norm
                ]
            ];
            break;
        }

        // Primer registro
        $candidato = $norm['data'][0];

        // Firma: probar campos
        $firmaCampos = [
            'firma_digital',
            'documentacion_completa',
            'firma',
            'firma_blob'
        ];
        $firmaData = null;
        foreach ($firmaCampos as $fc) {
            if (isset($candidato[$fc]) && $candidato[$fc] !== '' && $candidato[$fc] !== null) {
                $firmaData = $candidato[$fc];
                break;
            }
        }

        if (!$firmaData) {
            $response = [
                'code' => 0,
                'message' => 'El candidato no tiene firma digital registrada',
                'data' => [
                    'candidato_keys' => array_keys($candidato),
                    'firma_campos_probados' => $firmaCampos
                ]
            ];
            break;
        }

        // Directorios
        $directories = FileConfig::createCartasPropuestaDirectoryStructure();

        $nombreCompleto  = $candidato['nombre_completo']      ?? $candidato['nombre'] ?? 'Candidato';
        $numeroCandidat  = $candidato['numero_candidato']     ?? $candidato['folio'] ?? ('CAND-'.$id_candidato);
        $tituloVacante   = $candidato['titulo_vacante']       ?? $candidato['vacante'] ?? 'PUESTO NO ESPECIFICADO';
        $puestoNombre    = $candidato['puesto_nombre']        ?? $candidato['puesto'] ?? 'No especificado';
        $departamentoNom = $candidato['departamento_nombre']  ?? $candidato['departamento'] ?? 'No especificado';
        $salarioOfertado = $candidato['salario_ofertado']     ?? $candidato['salario'] ?? 0;
        $tipoContrato    = $candidato['tipo_contrato']        ?? $candidato['contrato'] ?? 'No especificado';
        $tipoJornada     = $candidato['tipo_jornada']         ?? 'No especificado';
        $tipoModalidad   = $candidato['tipo_modalidad']       ?? 'No especificado';
        $horaInicio      = $candidato['hora_inicio']          ?? '00:00';
        $horaFin         = $candidato['hora_fin']             ?? '00:00';
        $diasTrabajo     = $candidato['dias_trabajo']         ?? $candidato['dias'] ?? 'No especificado';
        $fechaInicioProp = $candidato['fecha_inicio_propuesta'] ?? $candidato['fecha_inicio'] ?? null;
        $condicionesEsp  = $candidato['condiciones_especiales'] ?? $candidato['observaciones'] ?? null;
        $estadoActual    = $candidato['estado_candidato'] ?? 'preseleccionado';

        $filename = FileConfig::generateCartaPropuestaFileName($numeroCandidat, $nombreCompleto);
        $fullPath = $directories['full_path'] . $filename;
        $urlPath  = $directories['url_path'] . $filename;

        $tcpdfPath = __DIR__ . '/../vendor/tecnickcom/tcpdf/tcpdf.php';
        if (!file_exists($tcpdfPath)) {
            $response = [
                'code' => 0,
                'message' => 'TCPDF no instalado',
                'data' => ['tcpdf_path' => $tcpdfPath]
            ];
            break;
        }

        require_once $tcpdfPath;

        $pdf = new TCPDF('P','mm','A4',true,'UTF-8',false);
        $pdf->SetCreator('BIMO - RRHH');
        $pdf->SetAuthor('Diagnostico Biomolecular S.A de C.V');
        $pdf->SetTitle('Carta de Propuesta Salarial - '.$nombreCompleto);
        $pdf->setPrintHeader(false);
        $pdf->setPrintFooter(false);
        $pdf->SetMargins(20,30,20);
        $pdf->AddPage();

        $pdf->SetFont('helvetica','B',16);
        $pdf->Cell(0,10,'BIMO',0,1,'C');
        $pdf->SetFont('helvetica','',10);
        $pdf->Cell(0,5,'Sistema de Recursos Humanos',0,1,'C');
        $pdf->Ln(10);

        $pdf->SetFont('helvetica','',11);
        $fechaActual = date('d \d\e F \d\e Y');
        $meses = [
            'January'=>'enero','February'=>'febrero','March'=>'marzo','April'=>'abril',
            'May'=>'mayo','June'=>'junio','July'=>'julio','August'=>'agosto',
            'September'=>'septiembre','October'=>'octubre','November'=>'noviembre','December'=>'diciembre'
        ];
        $fechaActual = str_replace(array_keys($meses), array_values($meses), $fechaActual);
        $pdf->Cell(0,6,'Fecha: '.$fechaActual,0,1,'R');
        $pdf->Ln(10);

        $pdf->SetFont('helvetica','B',14);
        $pdf->Cell(0,8,'CARTA DE PROPUESTA SALARIAL',0,1,'C');
        $pdf->Ln(8);

        $pdf->SetFont('helvetica','B',11);
        $pdf->Cell(30,6,'Estimado(a):',0,0,'L');
        $pdf->SetFont('helvetica','',11);
        $pdf->Cell(0,6,$nombreCompleto,0,1,'L');
        $pdf->Ln(5);

        $pdf->SetFont('helvetica','',11);
        $contenido  = "Por medio de la presente, nos es grato comunicarle que ha sido seleccionado(a) ";
        $contenido .= "para formar parte de nuestro equipo de trabajo en BIMO.\n\n";
        $contenido .= "Después de evaluar su perfil profesional y experiencia, consideramos que reúne ";
        $contenido .= "las competencias necesarias para desempeñar exitosamente el puesto de:\n\n";
        $pdf->MultiCell(0,6,$contenido,0,'J');

        $pdf->SetFont('helvetica','B',12);
        $pdf->Cell(0,8,strtoupper($puestoNombre),0,1,'C');
        $pdf->Ln(5);

        $pdf->SetFont('helvetica','B',11);
        $pdf->Cell(0,6,'DETALLES DE LA PROPUESTA:',0,1,'L');
        $pdf->Ln(3);

        $pdf->SetFont('helvetica','',10);
        $pdf->SetFillColor(230,230,230);
        $pdf->Cell(50,8,'CONCEPTO',1,0,'C',true);
        $pdf->Cell(120,8,'DETALLE',1,1,'C',true);

        $datos = [
            ['Vacante',$tituloVacante],
            ['Departamento',$departamentoNom],
            ['Salario Mensual','$'.number_format($salarioOfertado,2).' MXN'],
            ['Tipo de Contrato',ucfirst($tipoContrato)],
            ['Jornada Laboral',ucfirst($tipoJornada)],
            ['Modalidad',ucfirst($tipoModalidad)],
            ['Horario',$horaInicio.' - '.$horaFin],
            ['Días de Trabajo',ucfirst($diasTrabajo)],
            ['Fecha de Inicio',$fechaInicioProp ? date('d/m/Y',strtotime($fechaInicioProp)) : 'Por definir']
        ];

        foreach($datos as $i=>$fila){
            $fill = ($i % 2 == 0);
            $pdf->SetFillColor($fill?248:255,$fill?248:255,$fill?248:255);
            $pdf->Cell(50,7,$fila[0],1,0,'L',true);
            $pdf->Cell(120,7,$fila[1],1,1,'L',true);
        }

        $pdf->Ln(8);

        if ($condicionesEsp) {
            $pdf->SetFont('helvetica','B',11);
            $pdf->Cell(0,6,'CONDICIONES ESPECIALES:',0,1,'L');
            $pdf->SetFont('helvetica','',10);
            $pdf->MultiCell(0,5,$condicionesEsp,0,'J');
            $pdf->Ln(5);
        }

        $pdf->SetFont('helvetica','',11);
        $cierre  = "Esta propuesta está sujeta a la verificación satisfactoria de referencias laborales ";
        $cierre .= "y profesionales, así como a la aprobación del examen médico de ingreso.\n\n";
        $cierre .= "Esperamos que esta propuesta sea de su interés y agradecemos la confianza ";
        $cierre .= "depositada en nuestra organización. Estamos seguros de que su incorporación ";
        $cierre .= "contribuirá significativamente al crecimiento y éxito de BIMO.\n\n";
        $cierre .= "Para formalizar su aceptación, ha concedido y firmado la presente carta en el espacio correspondiente.\n\n";
        $pdf->MultiCell(0,6,$cierre,0,'J');

        $pdf->Ln(15);
        $pdf->SetFont('helvetica','B',11);
        $pdf->Cell(0,6,'ACEPTACIÓN DE LA PROPUESTA:',0,1,'L');
        $pdf->Ln(5);
        $pdf->SetFont('helvetica','',10);
        $pdf->MultiCell(0,5,'Acepto los términos y condiciones de la presente propuesta salarial:',0,'L');
        $pdf->Ln(10);

        if ($firmaData) {
            try {
                $tempFirmaPath = sys_get_temp_dir().'/firma_'.$id_candidato.'_'.uniqid().'.png';
                if (is_string($firmaData) && base64_decode($firmaData,true) !== false) {
                    $bin = base64_decode($firmaData);
                } else {
                    $bin = $firmaData;
                }
                if ($bin && file_put_contents($tempFirmaPath,$bin)) {
                    $yAntes = $pdf->GetY();
                    $pdf->Image($tempFirmaPath,30,$yAntes,60,20,'PNG');
                    @unlink($tempFirmaPath);
                    $pdf->SetY($yAntes+25);
                }
            } catch(Exception $e){
                error_log("Case 39 - Firma error: ".$e->getMessage());
            }
        }        

        $pdf->Line(30,$pdf->GetY(),100,$pdf->GetY());
        $pdf->Ln(3);
        $pdf->SetFont('helvetica','B',10);
        $pdf->Cell(70,5,$nombreCompleto,0,1,'C');
        $pdf->SetFont('helvetica','',9);
        $pdf->Cell(70,4,'Candidato',0,1,'C');
        // $pdf->Cell(70,4,'Fecha: '.date('d/m/Y'),0,1,'C');

        $pdf->SetXY(120,$pdf->GetY()-25);
        $pdf->Line(120,$pdf->GetY()+20,190,$pdf->GetY()+20);
        $pdf->SetXY(120,$pdf->GetY()+23);
        $pdf->SetFont('helvetica','B',10);
        $pdf->Cell(70,5,'R.R.H.H.',0,1,'C');
        $pdf->SetFont('helvetica','',9);
        $pdf->SetXY(120,$pdf->GetY());
        $pdf->Cell(70,4,'BIMO',0,1,'C');

        $pdf->SetY(-30);
        $pdf->SetFont('helvetica','',8);
        $pdf->Cell(0,4,'Documento confidencial - Proceso de selección',0,1,'C');
        $pdf->Cell(0,4,'BIMO - R.R.H.H.',0,1,'C');

        $pdf->Output($fullPath,'F');

        if (!file_exists($fullPath)) {
            $response = [
                'code'=>0,
                'message'=>'No se pudo guardar el PDF',
                'data'=>[
                    'path'=>$fullPath,
                    'dir_existe'=>is_dir($directories['full_path']),
                    'dir_permisos'=>is_writable($directories['full_path'])
                ]
            ];
            break;
        }

        // ⭐ GUARDAR RUTA EN LA BD usando case 35
        error_log("Case 39 - Guardando ruta en BD: $urlPath");
        
        try {
            $saveResponse = $master->insertByProcedure("sp_rh_candidatos_cambiar_estado", [
                $id_candidato,
                $estadoActual,           // Mantener el estado actual
                'Adjuntar carta de propuesta salarial',
                $_SESSION['id'],
                null,                    // comentarios_rh
                null,                    // comentarios_candidato
                null,                    // salario_ofertado
                null,                    // fecha_inicio_propuesta
                null,                    // condiciones_especiales
                null,                    // documentacion_completa
                $urlPath                 // ⭐ archivo_carta - LA RUTA DEL PDF
            ]);
            
            error_log("Case 39 - Respuesta guardar ruta: " . json_encode($saveResponse));
            
            // Verificar si se guardó correctamente
            $rutaGuardada = false;
            if (isset($saveResponse['data']) && is_array($saveResponse['data']) && !empty($saveResponse['data'])) {
                $resultado = $saveResponse['data'][0];
                if (isset($resultado['RESULT']) && $resultado['RESULT'] === 'SUCCESS') {
                    $rutaGuardada = true;
                }
            }
            
        } catch (Exception $saveError) {
            error_log("Case 39 - Error guardando ruta: " . $saveError->getMessage());
            $rutaGuardada = false;
        }

        $response = [
            'code'=>1,
            'message'=>'Carta generada exitosamente',
            'data'=>[
                'filename'=>$filename,
                'full_path'=>$fullPath,
                'url_path'=>$urlPath,
                'candidato'=>$nombreCompleto,
                'numero_candidato'=>$numeroCandidat,
                'directorio'=>$directories['relative_path'],
                'tamaño_archivo'=>filesize($fullPath).' bytes',
                'ruta_guardada_bd'=>$rutaGuardada,      // ⭐ INDICADOR SI SE GUARDÓ EN BD
                'archivo_carta_bd'=>$urlPath,            // ⭐ RUTA GUARDADA EN BD
                'debug_norm_shape'=>$norm['debug_shape']
            ]
        ];

    } catch (Exception $e){
        $response = [
            'code'=>0,
            'message'=>'Error interno: '.$e->getMessage(),
            'data'=>[
                'line'=>$e->getLine(),
                'file'=>$e->getFile()
            ]
        ];
        error_log("Case 39 Exception: ".$e->getMessage());
    }
break;
    default:
        # default
        $response = "API no definida";
        break;
}

echo $master->returnApi($response);

/*
 * Normalizador genérico para respuestas de Master->getByProcedure
 * Garantiza siempre: ['code'=>int, 'message'=>string, 'data'=>array]
 */
function normalizarRespuestaMaster($raw){
    $norm = [
        'code' => 0,
        'message' => 'Sin datos',
        'data' => [],
        'debug_shape' => null
    ];

    if ($raw === null) {
        $norm['message'] = 'Respuesta nula';
        return $norm;
    }

    // Guardar forma original para debug
    $norm['debug_shape'] = array_keys((array)$raw);

    // Caso A: viene con clave 'response'
    if (isset($raw['response'])) {
        $r = $raw['response'];
        if (isset($r['code'])) $norm['code'] = (int)$r['code'];
        if (isset($r['message'])) $norm['message'] = $r['message'];
        if (isset($r['data'])) {
            // Puede ser array vacío, objeto o lista
            if (is_array($r['data'])) {
                $norm['data'] = $r['data'];
            } elseif (is_object($r['data'])) {
                $norm['data'] = (array)$r['data'];
            }
        }
        return $norm;
    }

    // Caso B: estructura directa con code/data
    if (isset($raw['code'])) {
        $norm['code'] = (int)$raw['code'];
        if (isset($raw['message'])) $norm['message'] = $raw['message'];
        if (isset($raw['data'])) {
            if (is_array($raw['data'])) {
                $norm['data'] = $raw['data'];
            } elseif (is_object($raw['data'])) {
                $norm['data'] = (array)$raw['data'];
            }
        }
        return $norm;
    }

    // Caso C: quizá devolvió directamente un array de filas
    if (is_array($raw) && isset($raw[0]) && is_array($raw[0])) {
        $norm['code'] = 1;
        $norm['message'] = 'OK';
        $norm['data'] = $raw;
        return $norm;
    }

    // Caso D: cualquier otra cosa
    if (is_array($raw)) {
        $norm['message'] = 'Estructura no estándar';
        $norm['data_raw'] = $raw;
    } else {
        $norm['message'] = 'Tipo inesperado';
    }

    return $norm;
}
