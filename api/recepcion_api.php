<?php
include_once "../clases/master_class.php";
require_once "../clases/token_auth.php";
include_once "../clases/correo_class.php";
include_once "../clases/Pdf.php";

// Decodifica el cuerpo JSON si existe
$datos = json_decode(file_get_contents('php://input'), true);

// Verifica el token de sesión
$tokenVerification = new TokenVerificacion();
$tokenValido = $tokenVerification->verificar();

$api = $_POST['api'];
$master = new Master();
$mail = new Correo();

// Selecciona el host según el dominio actual
$host = $master->selectHost($_SERVER['SERVER_NAME']);
$hoy = date("Ymd");

// Parámetros generales
$estado_paciente = $_POST['estado'];
$mesesAtras = $_POST['mesesAtras'];
$prefolio = $_POST['prefolio'];

// Datos del turno
$idTurno = $_POST['id_turno'];
$idPaquete = $_POST['id_paquete'];
$comentarioRechazo = $_POST['comentario_rechazo'];
$identificacion = $_POST['identificacion']; // URL
$area_id = $_POST['area_id'];
$alergias = $_POST['alergias'];
$segmento_id = $_POST['segmento_id'];

// Información del trabajador (UJAT)
$is_worker = $_POST['nuevo-trabajador']; // booleano
$e_id_trabajador = $_POST['trabajador_id'];
$e_nombre = $_POST['nombre'];
$e_paterno = $_POST['paterno'];
$e_materno = $_POST['materno'];
$e_edad = $_POST['edad'];
$e_fecha_nacimiento = $_POST['nacimiento'];
$e_num_trabajador = $_POST['numero_trabajador'];
$e_curp = $_POST['curp'];
$e_pasaporte = $_POST['pasaporte'];
$e_extranjero = $_POST['extranjero'];
$e_genero = $_POST['genero'];
$e_ures = $_POST['ures'];
$e_categoria = $_POST['trabajador-categoria'];
$e_parentesco = $_POST['parentesco'];
$e_diagnostico = $_POST['diagnostico'];
$e_turno_id = $_POST['turno_id'];
$e_clave_beneficiario = $_POST['clave_beneficiado'];
$e_medico = $_POST['medico'];
$e_cedula = $_POST['cedula-medico'];
$e_pase = $_POST['pase'];
$parametro = $_POST['parametro'];

// Nuevos datos del paciente
$foto_paciente = $_POST['avatar'];
$medico_tratante = $_POST['medico_tratante'];
$medico_correo = $_POST['medico_correo'];
$new_medico = $_POST['nuevo_medico']; // booleano
$medico_tratante_id = $master->setToNull([$_POST['medico_tratante_id']])[0]; // Usuario
$medico_telefono = $_POST['medico_telefono'];
$medico_especialidad = $_POST['medico_especialidadz'];
$vendedor_id = $master->setToNull([$_POST['vendedor']])[0];

// Reagenda
$fecha_reagenda = $_POST['fecha_reagenda'];

// Servicios para particulares o extras para empresas
$servicios = $master->setToNull([$_POST['servicios']])[0];
$servicios = !is_null($servicios) ? explode(",", $_POST['servicios']) : null;

// Órdenes médicas
$ordenes = [
    'ORDEN_LABORATORIO' => $_FILES['orden-medica-laboratorio'],
    'ORDEN_RAYOS_X'     => $_FILES['orden-medica-rx'],
    'ORDEN_ULTRASONIDO' => $_FILES['orden-medica-us']
];
$ordenes = $master->checkArray($ordenes, 1);

// Pase UJAT
$pase_ujat = $_FILES['pase-ujat'];

// Datos para envío de correo empresarial
$cliente_id = $_POST['cliente_id'];
$fecha_ingreso = $_POST['fecha_ingreso'];

// Para Levenshtein
$estudio = $_POST['estudio'];

// Validación de correos
$id_paciente = $_POST['id_paciente'];
$curp = $_POST['curp'];
$pasaporte = $_POST['pasaporte'];

// Medios de entrega
$id_medio = $_POST['id_medio'];
$medios_entrega = $_POST['medios_entrega'];

// Fuente de referencia
$comoNosConociste = $_POST['como_nos_conociste'];

// Determina si es franquicia
$franquiciaID = $_SESSION['franquiciario'] ? $_SESSION['id_cliente'] : null;

// Información del folio
$folio = $_POST['folio'];
$servicios_detalle = $_POST['servicios_detalles'];

$medico_tratante_correo = $_POST['medico_tratante_correo'];
$medico_tratante_telefono = $_POST['medico_tratante_telefono'];
$medico_tratante_especialidad = $_POST['medico_tratante_especialidad'];


// Mensajes de error relacionados con corte de caja
$mensajesErrorCaja = [
    "NO ESTÁS ASIGNADO A NINGUNA CAJA, NO PUEDES CONTINUAR CON EL PROCESO",
    "UPS...NO ES POSIBLE ACEPTAR ESTE PACIENTE, YA QUE HAY UN CORTE DE CAJA EN PROCESO DEL DÍA ANTERIOR"
];

$parametros_muestra_recepcion = [
    $_POST['turno_id'] ?? null,
    $_SESSION['id'] ?? null,
    $_POST['estudio_id'] ?? null,
    $_POST['tipo_muestra'] ?? null,
    $_POST['muestra_tomada'] ?? null,
    $_POST['observaciones'] ?? null,
    $_FILES['evidencia'] ?? null,
    date('d/m/y H:i') ?? null
];

switch ($api) {
    case 1:
        // Recupera pacientes por estado (1 - aceptados, 0 - rechazados o en null -espera)
        $response = $master->getByProcedure('sp_buscar_paciente_por_estado', [
            $estado_paciente,
            $mesesAtras,
            $prefolio,
            $franquiciaID
        ]);
        break;
    case 2:
        // Aceptar o rechazar pacientes (también se puede "revivir" pacientes rechazados)
        // Estado: 1 = Aceptado, 0 = Rechazado, null = En espera

        if (!isset($_SESSION['id'])) {
            $response = "Por favor, reinicie sesión";
            break;
        }

        // Si se está agregando un nuevo médico tratante
        if ($new_medico) {
            $response = $master->insertByProcedure('sp_medicos_tratantes_g', [
                null, $medico_tratante, $medico_correo, null, $medico_telefono, $medico_especialidad
            ]);

            $medico_tratante_id = $response;
        }

        // Cambiar el estado del paciente (aceptado/rechazado)
        $response = $master->getByNext('sp_recepcion_cambiar_estado_paciente', [
            $idTurno, $estado_paciente, $comentarioRechazo, $alergias, $e_diagnostico, null,
            $medico_tratante_id, $_SESSION['id'], $vendedor_id, $comoNosConociste,
            $folio == 0 || $folio == null ? null : $folio
        ]);

        $alerta = $response[0][0][0];

        // Si hay un mensaje de error relacionado con caja, terminamos aquí
        if (in_array($alerta, $mensajesErrorCaja)) {
            $response = $alerta;
            break;
        }

        $etiqueta_turno = $response[1];

        // Procesamiento si el paciente fue ACEPTADO
        if ($estado_paciente == 1) {
            if ($_SESSION['franquiciario']) {
                // Consultar al paciente
                $paciente = $master->getByProcedure("sp_pacientes_b", [null, null, null, $idTurno, $franquiciaID]);

                if (!empty($paciente)) {
                    $response1 = $master->getByProcedure("sp_franquicia_maquilas_altas_pacientes", [
                        $paciente[0]['ID_PACIENTE'], $paciente[0]['NOMBRE'], $paciente[0]['PATERNO'],
                        $paciente[0]['MATERNO'], $paciente[0]['CURP'], $paciente[0]['FECHA_NACIMIENTO'],
                        $paciente[0]['EDAD'], $paciente[0]['GENERO'], "FRANQUICIA", null, 1, [], "",
                        $_SESSION['id'], "", $idTurno
                    ]);
                }
            }

            // Guardar la identificación
            rename($identificacion, "../../archivos/identificaciones/" . $idTurno . ".png");

            // Insertar detalle del paquete
            if (isset($idPaquete)) {
                $response = $master->insertByProcedure('sp_recepcion_detalle_paciente_g', [
                    $idTurno, $idPaquete, null, $_SESSION['id']
                ]);
            }

            // Subida de órdenes médicas
            if (count($ordenes) > 0) {
                $dir = $master->urlComodin . $master->urlOrdenesMedicas . "$idTurno/";
                $dirCreado = $master->createDir($dir);

                if ($dirCreado == 1) {
                    $merge = getOrdenesMedicas($master, $dir, $idTurno);

                    foreach ($merge as $item) {
                        if (!empty($item['tipo'])) {
                            $responseOrden = $master->insertByProcedure('sp_ordenes_medicas_g', [
                                null, $idTurno, $item['url'], $item['tipo'], $item['area_id']
                            ]);
                        }
                    }
                }
            }

        } else {
            // Procesamiento si el paciente fue RECHAZADO
            if ($_SESSION['franquiciario']) {
                $paciente = $master->getByProcedure("sp_pacientes_b", [null, null, null, $idTurno, $franquiciaID]);

                if (!empty($paciente)) {
                    $response_desactivar = $master->updateByProcedure('sp_franquicia_maquilas_desactivar', [
                        null, $paciente[0]['ID_PACIENTE'], $_SESSION['id']
                    ]);
                }
            }

            // Desactivar servicios del turno
            $response = $master->updateByProcedure('sp_recepcion_desactivar_servicios', [$idTurno]);
        }

        // Insertar servicios adicionales (si aplica)
        if (is_array($servicios) && count($servicios) > 0) {
            foreach ($servicios as $value) {
                $detalles = $master->insertByProcedure('sp_recepcion_detalle_paciente_g', [
                    $idTurno, null, $value, $_SESSION['id']
                ]);
            }
        }

        if (is_string($servicios_detalle)) {
            $servicios_detalle = json_decode($servicios_detalle, true); // convierte a array asociativo
        }

        if ($folio && is_array($servicios_detalle)) {
            foreach ($servicios_detalle as $value) {
                if (!isset($value['ID_SERVICIO'], $value['CANTIDAD'], $value['DESCUENTO_PORCENTAJE'], $value['PRECIO_VENTA'], $value['SUBTOTAL'])) {
                    $master->setLog(json_encode($value), '[error] Campos faltantes en value');
                    continue;
                }

                $master->updateByProcedure('sp_actualizar_servicios_turno', [
                    $idTurno,
                    $value['ID_SERVICIO'],
                    $value['CANTIDAD'],
                    $value['COSTO_BASE'],
                    $value['SUBTOTAL'],
                    $value['DESCUENTO_PORCENTAJE'],
                    $value['COSTO_TOTAL'],
                    $value['SUBTOTAL_SIN_DESCUENTO']
                ]);
            }
        }

        // Devolver respuesta final
        $response = [0 => $response, 1 => $etiqueta_turno[0]];
        break;
    case 3:
        # reagendar una cita
        $response = $master->updateByProcedure('sp_recepcion_reagendar', array($idTurno, $fecha_reagenda));
        break;
    case 4:
        // Reenviar reportes e imágenes por correo
        $reportes = $master->cleanAttachFilesImage($master, $idTurno, null, 1, 1);

        if (!empty($reportes[0])) {
            $mail = new Correo();
            $r = $mail->sendEmail("resultados", "[bimo] Resultados", [$reportes[1]], null, $reportes[0], 1);
            $response = $r ? 1 : "Error al enviar correo.";
        } else {
            $response = "Paciente sin resultados o imágenes.";
        }

        if($response == 1){
             $master->setLog("Correo enviado. turno $idTurno.", "[Correo reenviado manualmente]");
        }
        break;
    case 5:
        $zip = new ZipArchive();
        $mail = new Correo();

        // Recuperar los archivos de todos los pacientes del cliente seleccionado
        $reportes = $master->cleanAttachFilesImage($master, null, null, $cliente_id, 0, $fecha_ingreso);

        if (empty($reportes[0])) {
            $response = "No hay archivos disponibles para el cliente seleccionado.";
            break;
        }

        // Crear carpeta temporal si no existe
        $tmpDir = "../tmp";
        if (!is_dir($tmpDir) && !mkdir($tmpDir)) {
            $master->setLog("No se pudo crear la carpeta temporal", "recepcion api [case 5]");
            $response = "No se pudo crear la carpeta temporal.";
            break;
        }

        // Crear un ZIP por cada paciente
        foreach ($reportes[3] as $i => $nombreArchivo) {
            $nombre_zip = explode(".", $nombreArchivo)[0];
            $zipPath = "$tmpDir/$nombre_zip.zip";

            // Archivos del paciente
            $identificadorCarpeta = "/" . $reportes[2][$i] . "/";
            $archivosPaciente = array_filter($reportes[0], function ($ruta) use ($identificadorCarpeta) {
                return strpos($ruta, $identificadorCarpeta) !== false;
            });

            // Crear ZIP
            if ($zip->open($zipPath, ZipArchive::CREATE) === TRUE) {
                foreach ($archivosPaciente as $archivo) {
                    $rutaRelativa = ".." . explode("nuevo_checkup", $archivo)[1];
                    if (file_exists($rutaRelativa)) {
                        $zip->addFile($rutaRelativa, basename($rutaRelativa));
                    }
                }
                $zip->close();
            } else {
                $master->setLog("No se pudo crear el archivo ZIP: $zipPath", "recepcion api [case 5]");
            }
        }

        // Obtener lista de ZIPs creados
        $archivos_enviar = [];
        if ($gestor = opendir($tmpDir)) {
            while (false !== ($entrada = readdir($gestor))) {
                if ($entrada !== "." && $entrada !== "..") {
                    $archivos_enviar[] = "nuevo_checkup/tmp/" . $entrada;
                }
            }
            closedir($gestor);
        }

        // Enviar por correo
        $r = $mail->sendEmail(
            "resultados",
            "Envio de resultados [bimo]",
            ["arellanox0392@gmail.com"],
            null,
            $archivos_enviar,
            1
        );

        break;
    case 6:
        // Recupera el detalle de estudios cargados al paciente por área
        $response = $master->getByProcedure("sp_paciente_servicios_cargados", [$idTurno, $area_id]);
        break;
    case 7:
        // Carga de beneficiario (trabajador UJAT) y documentos (pase y verificación)
        // Directorios
        $dirPases = $master->urlComodin . $master->urlPases;
        $dirVerificaciones = $master->urlComodin . "archivos/verificaciones_ujat/";
        $master->createDir($dirPases);
        $master->createDir($dirVerificaciones);

        // Guardar pase
        $nombrePaciente = $master->getByPatientNameByTurno($master, $e_turno_id);
        $nombreBase = "{$e_turno_id}_{$nombrePaciente}_{$hoy}";

        $pase = $master->guardarFiles($_FILES, "pase-ujat", $dirPases, "PASE_" . $nombreBase);
        $verificacion = $master->guardarFiles($_FILES, "verificacion-ujat", $dirVerificaciones, "VERIFICACION_" . $nombreBase);

        $url_pase = !empty($pase[0]['tipo']) ? str_replace("../", $host, $pase[0]['url']) : null;
        $url_verificacion = !empty($verificacion[0]['url']) ? str_replace("../", $host, $verificacion[0]['url']) : null;

        // Si existe pase, actualiza
        if ($url_pase) {
            $master->updateByProcedure("sp_actualizar_pase_empresas", [$e_turno_id, $url_pase]);
        }

        // Nuevo trabajador si el flag está activo
        $e_id_trabajador = ($_POST['nuevo-trabajador'] === "on") ? null : $e_id_trabajador;
        $e_genero = ($e_genero === "MASCULINO") ? 1 : 2;

        // Insertar trabajador
        $response = $master->insertByProcedure("sp_trabajadores_empresas_g", [
            $e_id_trabajador,
            $e_nombre,
            $e_paterno,
            $e_materno,
            $e_edad,
            $e_fecha_nacimiento,
            $e_num_trabajador,
            $e_curp,
            $e_pasaporte,
            $e_extranjero,
            $e_genero,
            $e_ures,
            $e_categoria,
            $e_turno_id,
            $e_parentesco,
            $e_diagnostico,
            $e_clave_beneficiario,
            $e_medico,
            $e_cedula,
            $e_pase,
            $url_verificacion
        ]);
        break;
    case 8:
        // Consultar trabajadores según ID, parámetro o turno
        $response = $master->getByProcedure("sp_trabajdores_empresas_b", [
            $e_id_trabajador,
            $parametro,
            $e_turno_id
        ]);
        break;
    case 9:
        // Actualización de información del trabajador UJAT

        $dirVerificaciones = $master->urlComodin . "archivos/verificaciones_ujat/";
        $master->createDir($dirVerificaciones);

        $nombrePaciente = $master->getByPatientNameByTurno($master, $e_turno_id);
        $nombreBase = "{$e_turno_id}_{$nombrePaciente}_{$hoy}";

        $verificacion = $master->guardarFiles($_FILES, "verificacion-ujat", $dirVerificaciones, "VERIFICACION_" . $nombreBase);
        $url_verificacion = !empty($verificacion[0]['url']) ? str_replace("../", $host, $verificacion[0]['url']) : null;

        $response = $master->updateByProcedure("sp_trabajadores_empresas_a", [
            $e_id_trabajador,
            $e_nombre,
            $e_paterno,
            $e_materno,
            $e_edad,
            $e_fecha_nacimiento,
            $e_num_trabajador,
            $e_curp,
            $e_pasaporte,
            $e_genero,
            $_SESSION['id'], // Usuario actual
            $e_turno_id ? $url_verificacion : null
        ]);
        break;
    case 10:
        # subir archivos del paciente.
        # como las ordenes medicas, la credencial del ine y la foto del paciente

        # subir ordenes medicas
        if (count($ordenes) > 0) {
            $dir = $master->urlComodin . $master->urlOrdenesMedicas . "$e_turno_id/";
            $r = $master->createDir($dir);
            if ($r == 1) {
                #movemos las ordenes medicas
                $merge = getOrdenesMedicas($master, $dir, $e_turno_id);

                #insertarmos las ordenes medicas en la base de datos
                foreach ($merge as $item) {
                    if (!empty($item['tipo'])) {
                        $url = str_replace("../", $host, $item['url']);
                        $responseOrden = $master->insertByProcedure('sp_ordenes_medicas_g', [null, $e_turno_id, $url, $item['tipo'], $item['area_id']]);
                    }
                }
            } else {
                $master->setLog("No se pudo crear el directorio para guardar las ordenes medicas", "recepcion_api.php [case 10]");
            }
        }

        # subir la foto del paciente
        $dir = $master->urlComodin . "archivos/perfiles_paciente/";
        $r = $master->createDir($dir);

        if ($r == 1) {
            $avatar_url = $master->guardarFiles($_FILES, 'avatar_paciente', $dir, "perfil_paciente_$e_turno_id");
            if (!empty($master->checkArray($avatar_url))) {
                $url = str_replace("../", $host, $avatar_url[0]['url']);
                $response = $master->updateByProcedure("sp_subir_archivos_turno", [$e_turno_id, $url, null]);
            }
        } else {
            $master->setLog("No se pudo crear el directorio de perfiles de paciente", "recepcion_api.php [case 10]");
        }

        # subir la credencial del ine
        $dir = $master->urlComodin . "archivos/credenciales_ine/";
        $r = $master->createDir($dir);

        if ($r == 1) {
            $ine = array();
            $ine_front = $master->guardarFiles($_FILES, 'paciente-ine-front', $dir, "ine_front_$e_turno_id");
            $url = str_replace("../", $host, $ine_front[0]['url']);
            $ine['front'] = $url;
            $ine_back = $master->guardarFiles($_FILES, 'paciente-ine-back', $dir, "ine_back_$e_turno_id");
            $url = str_replace("../", $host, $ine_back[0]['url']);
            $ine['back'] = $url;

            if (!empty($master->checkArray($ine))) {
                $response = $master->updateByProcedure("sp_subir_archivos_turno", [$e_turno_id, null, json_encode($ine)]);
            }
        } else {
            $master->setLog("No se pudo crear el directorio para las ines de los pacientes.", "recepcion_api [case 10]");
        }


        # SUBIR CONSENTIMIENTO INFORMADO
        $dir = $master->urlComodin . "archivos/consentimientos/";
        $r = $master->createDir($dir);

        if ($r == 1) {
            $consentimiento = $master->guardarFiles(
                $_FILES,
                'consentimiento_pdf',
                $dir,
                "consentimiento_$e_turno_id"
            );



            if (!empty($consentimiento[0]['url'])) {
                $url = str_replace("../", $host, $consentimiento[0]['url']);
                
                // Ejecutar el SP
                $response = $master->updateByProcedure(
                    'sp_subir_consentimiento_turno',
                    [
                        $e_turno_id,
                        $url,
                        $_SESSION['id']
                    ]
                );
            }
        } else {
            $master->setLog("No se pudo crear directorio de consentimientos 2", "recepcion_api [case 10]");
            $response = "No se pudo crear el directorio para guardar el archivo.";
        }

        $response = 1;
        break;
    case 11:
        # recuperar todos los documentos que existen.
        $response = $master->getByProcedure("sp_recuperar_archivos_turno", [$e_turno_id]);
        $response[0]['ORDENES_MEDICAS'] = $master->decodeJson([$response[0]['ORDENES_MEDICAS']]);
        $response[0]['IDENTIFICACION'] = $master->decodeJson([$response[0]['IDENTIFICACION']]);
        $response[0]['CONSENTIMIENTO'] = $master->decodeJson([$response[0]['CONSENTIMIENTOS']]);
        break;
    case 12:
        #recuperar todos los tipops de cuestionarios
        $response = $master->getByProcedure("sp_cuestionarios_b", []);

        break;
    case 13:
        //Actualiza la procedencia en recepcion(aceptados)
        $response = $master->updateByProcedure("sp_actualizar_procedencia_g", [$idTurno, $cliente_id]);
        break;
    case 14:
        # descargar masivamente reportes
        $resultset = $master->getByProcedure("sp_recuperar_reportes_confirmados", [
            null, null, $cliente_id, $fecha_ingreso, null
        ]);

        $ids = array_unique(array_map(function ($item) {
            return $item['TURNO_ID'];
        }, $resultset));

        $response = [];

        foreach ($ids as $id) {
            # filtramos los reportes por el turno
            $records = array_filter($resultset, function ($item) use ($id) {
                return $item["TURNO_ID"] == $id;
            });

            # obtenemos el nombre de la carpeta
            $firstElement = $records[array_key_first((array)$records)];
            $sinGuion = (explode('-', $firstElement['NOMBRE_ARCHIVO']))[0];
            $sinGuionBajo = explode('_', $sinGuion);

            $folder = implode(" ", array_slice($sinGuionBajo, 1));
            $folder = str_replace(" ", "_", $folder);
            $urls = array();

            foreach ($records as $record) {
                $urls[] = [
                    "url" => $record["RUTA"],
                    "archivo" => $record["NOMBRE_ARCHIVO"]
                ];
            }

            $response[] = [
                "folder" => $folder,
                "urls" => $urls,
            ];
        }

        echo json_encode($response);
        exit;
    case 15:
        # Detalle de los estudios
        $estudios = $master->getByProcedure('sp_recepcion_estudios_b', [$area_id]);

        $coincidencias = [];

        $estudio = strtolower($estudio);
        foreach ($estudios as $item) {
            $base = strtolower($item['DESCRIPCION'] . ' ' . $item['ABREVIATURA'] . ' ' . $item['DIAS_DE_ENTREGA'] . $item['INDICACIONES'] . ' ' . $item['CLASIFICACION']);
            $baseTokens = explode(' ', $base);
            $userTokens = explode(' ', $estudio);

            $matches = 0;

            foreach ($userTokens as $userToken) {
                foreach ($baseTokens as $baseToken) {
                    if (levenshtein($userToken, $baseToken) <= 2) { # umbral de distancia
                        $matches++;
                        break;
                    }
                }
            }

            $score = $matches / count($userTokens); // Cambio clave aquí: ahora consideramos la proporción basada en el userInput

            if ($score > 0.8) { // Puedes ajustar este umbral según lo necesites
                $coincidencias[] = $item;
            }
        }

        $response = $coincidencias;
        break;
    case 16:
        $mail = new Correo();
        # enviar correo de para comprobacion de datos del paciente
        $px = $master->getByProcedure('sp_pacientes_b', [
            $id_paciente,
            $curp,
            $pasaporte,
            null, # esta variable es la id del turno, para este efecto no aplica.
            null # franquicia id
        ]);

        # recuperamos los correos dados
        $correo1 = $px[0]['CORREO'];
        $correo2 = $px[0]['CORREO_2'];

        # los unimos en uun mismo arreglo para su posterior consumo.
        $correos = $master->checkArray([$correo1, $correo2]);

        # datos del paciente
        $datos = $px[0];

        #enviar correo para confirmar
        try {
            $mail->sendEmail('corroborarCorreos', "¡Sus datos han sido confirmados!", $correos, $datos);
            $response = 1;
        } catch (Exception $e) {
            $response = "Ha ocurrido un error. No se ha enviado el correo.";
            $master->setLog("Error al enviar correo de verificacion de datos. $e", '[recepcion_api case 16]');
        }
        break;
    case 17:
        $mail = new Correo();
        # lista de las personas agregadas en el dia
        $response = $master->getByProcedure("sp_recepcion_pacientes_del_dia", [
            null, null
        ]);
        break;
    case 18:
        # imprimir el formato de validacion de datos del paciente
        $r = $master->reportador($master, $id_paciente, -6, 'form_datos', 'mostrar',0, 0, 0);
        break;
    case 19:
        # Agregar los tipos de medios que quiere el paciente recibir sus resultados.
        # Este procedure recibe una lista separadas por comas de los ids de los medios de entrega

        # solo envias la lista con las opciones que tendra el paciente, agrega o elimina segun la lista que reciba.

        # convertimos en arreglo chido la lista separada por comas.
        $medios = explode(',', $medios_entrega);

        $response = $master->insertByProcedure("sp_pacientes_medios_entrega_g", [
            $id_paciente,
            json_encode($medios)
        ]);
        break;
    case 20:
        # recuperar los tipos de medios de entrega.
        $response = $master->getByProcedure("sp_pacientes_tipos_medio_entrega_b", [$id_medio]);
        break;
    case 21:
        # abrir la cuenta del paciente.
        $response = $master->updateByProcedure('sp_abrir_cuenta_paciente', [$idTurno, $_SESSION['id']]);
        break;
    case 22:
        # marcar un paciente como pendiente de pago.
        # ( solo aplica para clientes de contado, aunque tambien es posible marcar como pendiente un cliente de credito )
        $response = $master->updateByProcedure('sp_marcar_paciente_pendiente_pago',[$idTurno, $_SESSION['id']]);
        break;
    case 23:
        # Actualizar los datos de un médico tratane
        $response = $master->updateByProcedure('sp_actualizar_datos_medicos_trantantes', [
            $id_medio, $medico_tratante_correo, $medico_tratante_telefono, $medico_tratante_especialidad
        ]);
        break;
    case 24:
        # Recuperar detalles médicos tratante
        $response = $master->getByProcedure('sp_obtener_datos_medicos_trantantes', [$id_medio]);
        break;
    case 25: # Acturlizar muestras externas tomadas.
        $path = null;

        if (!empty($_FILES['evidencia'])) {
            $file = $_FILES['evidencia'];
            if ($file['error'] === UPLOAD_ERR_OK) {
                $master->createDir('../archivos/muestras/evidencias/');

                // Generar nombre único con extensión original
                $ext = pathinfo($file['name'], PATHINFO_EXTENSION);
                $imageName = uniqid('rechazo_', true) . '.' . $ext;
                $destPath = '../archivos/muestras/evidencias/' . $imageName;

                // Mover archivo desde temporal
                move_uploaded_file($file['tmp_name'], $destPath);

                // URL final pública
                $path = "$host/archivos/muestras/evidencias/$imageName";
            }
        } elseif (!empty($_POST['evidencia'])) {
            // 🧾 Caso 2: viene como base64
            $imagen = $_POST['evidencia'];
            $master->createDir('../archivos/muestras/evidencias/');

            if (preg_match('/^data:image\/(\w+);base64,/', $imagen, $type)) {
                $imagen = substr($imagen, strpos($imagen, ',') + 1);
                $extension = strtolower($type[1]);

                if (!in_array($extension, ['jpg', 'jpeg', 'png'])) {
                    throw new Exception('Formato de imagen no permitido.');
                }

                $imageName = uniqid('rechazo_', true) . '.' . $extension;
                $destPath = "../archivos/muestras/evidencias/$imageName";
                file_put_contents($destPath, base64_decode($imagen));
                $path = "$host/archivos/muestras/evidencias/$imageName";
            }
        }

        $master->setLog(json_encode($parametros_muestra_recepcion), 'parametros txasjdh');
        $parametros_muestra_recepcion[6] = $path;
        $response = $master->insertByProcedure('sp_recepcion_muestras_externas', $parametros_muestra_recepcion);
        break;
    case 26:
        # modificar el comentario del paciente
        $response = $master->updateByProcedure("sp_recepcion_modificar_comentario", [$idTurno, $_POST['comentario']]);
        break;
    default:
        $response = "Api no definida: ".$api;
        break;
}

/**
 * @param Master $master
 * @param string $dir
 * @param $idTurno
 * @return array|string
 */
function getOrdenesMedicas(Master $master, string $dir, $idTurno)
{
    $return = $master->guardarFiles(
        $_FILES, 'orden-medica-laboratorio', $dir, "ORDEN_MEDICA_LABORATORIO_$idTurno"
    );
    $return2 = $master->guardarFiles(
        $_FILES, 'orden-medica-rx', $dir, "ORDEN_MEDICA_RX_$idTurno"
    );
    $return3 = $master->guardarFiles(
        $_FILES, 'orden-medica-us', $dir, "ORDEN_MEDICA_ULTRASONIDO_$idTurno"
    );

    # metemos el area al que pertenece
    $return[0]['area_id'] = 6;
    $return2[0]['area_id'] = 8;
    $return3[0]['area_id'] = 11;
    return array_merge($return, $return2, $return3);
}

echo $master->returnApi($response);
