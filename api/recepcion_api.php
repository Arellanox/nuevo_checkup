<?php
include_once "../clases/master_class.php";
require_once "../clases/token_auth.php";
include_once "../clases/correo_class.php";
include_once "../clases/Pdf.php";

$datos = json_decode(file_get_contents('php://input'), true);

$tokenVerification = new TokenVerificacion();
$tokenValido = $tokenVerification->verificar();

$api = $_POST['api'];
$master = new Master();
$mail = new Correo;

$host = $master->selectHost($_SERVER['SERVER_NAME']);
$hoy = date("Ymd");

$estado_paciente = $_POST['estado'];
$mesesAtras = $_POST['mesesAtras'];
$prefolio = $_POST['prefolio'];


$idTurno = $_POST['id_turno'];
$idPaquete = $_POST['id_paquete']; #
$comentarioRechazo = $_POST['comentario_rechazo'];
$identificacion = $_POST['identificacion']; #url
$area_id = $_POST['area_id'];

$alergias = $_POST['alergias'];
$segmento_id = $_POST['segmento_id'];

# trabajadores de la ujat
$is_worker = $_POST['nuevo-trabajador']; # bit para saber si es ujat y se debe agregar la info del trabajador
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

// nuevos datos
$foto_paciente = $_POST['avatar'];
$medico_tratante = $_POST['medico_tratante'];
$medico_correo = $_POST['medico_correo'];
$new_medico = $_POST['nuevo_medico']; # Tipo booleano
$medico_tratante_id = ($master->setToNull([$_POST['medico_tratante_id']]))[0]; # Usuario
$medico_telefono = $_POST['medico_telefono'];
$medico_especialidad = $_POST['medico_especialidadz'];
$vendedor_id = $master->setToNull([$_POST['vendedor']])[0];

# reagendar
$fecha_reagenda = $_POST['fecha_reagenda'];

#servicio para pacientes particulares o servicios extras para pacientes de empresas
if (!is_null($master->setToNull([$_POST['servicios']])[0])) {
    $servicios = explode(",", $_POST['servicios']); //array
} else {
    $servicios = null;
}

#ordenes medicas
$orden_laboratorio = $_FILES['orden-medica-laboratorio'];
$orden_rayos_x = $_FILES['orden-medica-rx'];
$orden_ultrasonido = $_FILES['orden-medica-us'];

# Pases de los pacientes de la ujat
$pase_ujat = $_FILES['pase-ujat'];

$ordenes = array(
    'ORDEN_LABORATORIO' => $orden_laboratorio,
    'ORDEN_RAYOS_X' => $orden_rayos_x,
    'ORDEN_ULTRASONIDO' => $orden_ultrasonido
);

$ordenes = $master->checkArray($ordenes, 1);

# para envio de correo de empresaas
$cliente_id = $_POST['cliente_id'];
$fecha_ingreso = $_POST['fecha_ingreso'];

# para el levenshtein
$estudio = $_POST['estudio'];

# comprobar correos correctamente
$id_paciente = $_POST['id_paciente'];
$curp = $_POST['curp'];
$pasaporte = $_POST['pasaporte'];

# medios de entrega de resultados
$id_medio = $_POST['id_medio'];
$medios_entrega = $_POST['medios_entrega'];

$comoNosConociste = $_POST['como_nos_conociste'];
$franquiciaID = $_SESSION['franquiciario'] ? $_SESSION['id_cliente'] : null;

# Mensajes de error para corte de cajas
$mensajesErrorCaja = [
    "NO ESTÁS ASIGNADO A NINGUNA CAJA, NO PUEDES CONTINUAR CON EL PROCESO",
    "UPS...NO ES POSIBLE ACEPTAR ESTE PACIENTE, YA QUE HAY UN CORTE DE CAJA EN PROCESO DEL DÍA ANTERIOR"
];

switch ($api) {
    case 0:
        $response = [];
        break;
    case 1:
        # recuperar pacientes por estado
        # 1 para pacientes aceptados
        # 0 para pacientes rechazados
        # null o no enviar nada, para pacientes en espera

        $response = $master->getByProcedure('sp_buscar_paciente_por_estado', [
            $estado_paciente, $mesesAtras, $prefolio, $franquiciaID
        ]);
        break;
    case 2:
        # Aceptar o rechazar pacientes [tambien regresar a la vida]
        # Enviar 1 para aceptarlos, 0 para rechazarlos, null para pacientes en espera
        # Esto es para prevenir duplicar el corte de cajas.
        if (!isset($_SESSION['id'])){
            $response = "Por favor, reinicie sesión";
            break;
        }

        # Agrega nuevo medico si es requerido
        if ($new_medico) {
            $response = $master->insertByProcedure('sp_medicos_tratantes_g', [
                null, $medico_tratante, $medico_correo, null, $medico_telefono, $medico_especialidad
            ]);

            $medico_tratante_id = $response;
        }

        # Cambia el estado del paciente
        $response = $master->getByNext('sp_recepcion_cambiar_estado_paciente', [
            $idTurno, $estado_paciente, $comentarioRechazo, $alergias, $e_diagnostico, null, $medico_tratante_id,
            $_SESSION['id'], $vendedor_id, $comoNosConociste
        ]);
        $aleta = $response[0][0][0];

        # Validacion de si esta en caja o hay un corte de ayer que no se haya cerrado
        if (in_array($aleta, $mensajesErrorCaja)) {
            $response = $aleta;
            break;
        }

        $etiqueta_turno = $response[1];

        if($estado_paciente == 1) {
            if($_SESSION['franquiciario']) {
                $paciente = $master->getByProcedure("sp_pacientes_b", [
                    null, null, null, $idTurno, $franquiciaID
                ]);

                if (!empty($paciente)) {
                    $response1 = $master->getByProcedure("sp_franquicia_maquilas_altas_pacientes", [
                        $paciente[0]['ID_PACIENTE'], $paciente[0]['NOMBRE'], $paciente[0]['PATERNO'],
                        $paciente[0]['MATERNO'], $paciente[0]['CURP'],$paciente[0]['FECHA_NACIMIENTO'],
                        $paciente[0]['EDAD'], $paciente[0]['GENERO'], "FRANQUICIA", NULL, 1, [], "",
                        $_SESSION['id'], "", $idTurno
                    ]);
                }
            }

            # Insertar el detalle del paquete al turno en cuestion
            # Si el paciente es aceptado, cargar los estudios correspondientes
            rename($identificacion, "../../archivos/identificaciones/" . $idTurno . ".png");
            $response = $master->insertByProcedure('sp_recepcion_detalle_paciente_g', [
                $idTurno, $idPaquete, null, $_SESSION['id']
            ]);

            # Aqui subir las ordenes medicas si las hay y crear la carpeta de tunos dentro de
            if (count($ordenes) > 0) {
                $dir = $master->urlComodin . $master->urlOrdenesMedicas . "$idTurno/";
                $r = $master->createDir($dir);

                if ($r == 1) {
                    #movemos las ordenes medicas
                    $merge = getOrdenesMedicas($master, $dir, $idTurno);

                    #insertarmos las ordenes medicas en la base de datos
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
            if($_SESSION['franquiciario']) {
                $paciente = $master->getByProcedure("sp_pacientes_b", [
                    null, null, null, $idTurno, $franquiciaID
                ]);

                if(!empty($paciente)) {
                    $response_desactivar = $master->updateByProcedure('sp_franquicia_maquilas_desactivar', [
                        null, $paciente->ID_PACIENTE, $_SESSION['id']
                    ]);
                }
            }

            # si el paciente es rechazado, se desactivan los resultados de su turno.
            $response = $master->updateByProcedure('sp_recepcion_desactivar_servicios', [$idTurno]);
        }

        # Insertar servicios extrar para pacientes empresas o servicios para particulares
        if (is_array($servicios) && count($servicios) > 0) {
            $detalles = [];

            foreach ($servicios as $key => $value) {
                $detalles= $master->insertByProcedure('sp_recepcion_detalle_paciente_g', [
                    $idTurno, null, $value, $_SESSION['id']
                ]);
            }
        }

        $response = [0 => $response, 1 => $etiqueta_turno[0]];
        break;
    case 3:
        # reagendar una cita
        $response = $master->updateByProcedure('s', array($idTurno, $fecha_reagenda));
        break;
    case 4:
        # reenviar reportes e imagenes por correo de todas las areas.

        # recuperamos reportes e imagenes como arreglo unico.
        # decodificamos las imagenes para poderlas tratar como un array.
        $reportes = $master->cleanAttachFilesImage($master, $idTurno, null, 1, 1);

        # si existe algo, enviamos el correo.
        if (!empty($reportes[0])) {
            $mail = new Correo();
            $r = $mail->sendEmail("resultados", "[bimo] Resultados", [$reportes[1]], null, $reportes[0], 1);
            if ($r) {
                $response = 1;
            }
        } else {
            $response = "Paciente sin resultados o imágenes.";
        }

        break;
    case 5:
        # Enzipar por paciente reportes e imagenes por cliente y enviarlo por correo eletronico
        $zip = new ZipArchive;
        $mail = new Correo();
        #recuperamos el los reportes y las imagenes de los pacientes del cliente seleccionado.
        $reportes = $master->cleanAttachFilesImage($master, null, null, $cliente_id, 0, $fecha_ingreso);

        if (!empty($reportes[0])) {
            #si hay algo, continuamos con el proceso.

            #creamos la carpeta temporal
            if (!is_dir("../tmp")) {
                if (!mkdir("../tmp")) {
                    $master->setLog("No se pudo crear la carpeta temporal", "recepcion api [case 5]");
                    $response = "No se pudo crear la carpeta temporal.";
                    break;
                }
            }

            # creamos el zip por cada paciente.
            for ($i = 0; $i < count($reportes[3]); $i++) {
                $nombre_zip = $explode = explode(".", $reportes[3][$i]);

                #creamos el archivo zip dentro de la carpeta temporal
                $fh = fopen("../tmp/" . $nombre_zip[0] . ".zip", 'a');
                // fwrite($fh, '<h1>Hello world!</h1>');
                fclose($fh);

                # Filtramos todos los archivos del paciente
                $str = "/" . $reportes[2][$i] . "/";
                $archivos_paciente = [];
                foreach ($reportes[0] as $ruta_archivo) {

                    $pos = strpos($ruta_archivo, $str);

                    try {
                        if ($pos !== false) {
                            array_push($archivos_paciente, $ruta_archivo);
                        }
                    } catch (Exception $e) {
                        print_r($e);
                    }
                }

                // print_r($archivos_paciente);
                # enzipamos los archivos correspondientes al zip actual.
                foreach ($archivos_paciente as $a) {
                    $ruta = explode("nuevo_checkup", $a);
                    $ruta = ".." . $ruta[1];

                    if ($zip->open("../tmp/" . $nombre_zip[0] . ".zip") === TRUE) {
                        $zip->addFile($ruta, basename($ruta));
                        $zip->close();
                    } else {
                        echo 'failed';
                    }
                    // if ($zip->open("../tmp/" . $nombre_zip[0] . ".zip") === TRUE) {
                    //     $zip->addFile("../checkup.sql", basename($ruta));
                    //     $zip->close();
                    // } else {
                    //     echo 'failed';
                    // }
                }
            }

            $archivos_enviar = [];


            if ($gestor = opendir('../tmp/')) {
                echo "Gestor de directorio: $gestor\n";
                echo "Entradas:\n";

                /* Esta es la forma correcta de iterar sobre el directorio. */
                $count = 0;
                while (false !== ($entrada = readdir($gestor))) {
                    if ($count > 1) {
                        array_push($archivos_enviar, "nuevo_checkup/tmp/" . $entrada);
                    }
                    $count++;
                }

                closedir($gestor);
            }
            print_r($archivos_enviar);

            $r = $mail->sendEmail("resultados", "Envio de resultados [bimo]", ["arellanox0392@gmail.com"], null, $archivos_enviar, 1);
        } else {
            $response = "No hay archivos disponible para el cliente seleccionado.";
        }

        break;
    case 6:
        # detalle del estudios cargados al paciente.
        $response = $master->getByProcedure("sp_paciente_servicios_cargados", [$idTurno, $area_id]);

        break;
    case 7:
        #Datos de beneficiario
        #========================================================================================
        ##############AGREGAR TRABAJAOR DE LA UJAT###############################################
        # insertar la ruta del pase para los pacientes de la ujat
        $dir = $master->urlComodin . $master->urlPases;
        $dir2 = $master->urlComodin . "archivos/verificaciones_ujat/";
        $r = $master->createDir($dir);
        $r2 = $master->createDir($dir2);

        $pase = $master->guardarFiles($_FILES, "pase-ujat", $dir, "PASE_$e_turno_id" . "_" . $master->getByPatientNameByTurno($master, $e_turno_id) . "_$hoy");

        $verificacion = $master->guardarFiles($_FILES, "verificacion-ujat", $dir2, "VERIFICACION_$e_turno_id" . "_" . $master->getByPatientNameByTurno($master, $e_turno_id) . "_$hoy");


        if (!empty($master->checkArray($verificacion))) {
            $url_verificacion = str_replace("../", $host, $verificacion[0]['url']);
        }

        $url_verificacion = str_replace("../", $host, $verificacion[0]['url']);

        if (!empty($pase[0]['tipo'])) {
            $url_pase = str_replace("../", $host, $pase[0]['url']);
            $r = $master->updateByProcedure("sp_actualizar_pase_empresas", [$e_turno_id, $url_pase]);
        }


        // if(isset($is_worker) && $is_worker== "on"){
        //$e_id_trabajador = is_numeric($e_id_trabajador) ? $e_id_trabajador : null;
        $e_id_trabajador = $_POST['nuevo-trabajador'] == "on" ? null : $e_id_trabajador;
        $e_genero = ($e_genero == "MASCULINO") ? 1 : 2;
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
        // } else {
        //     $response = "nuevo-trabajador: off";
        // }
        #========================================================================================
        break;
    case 8:
        #lista de trabajadores
        #Front necesita:
        #'ID_PACIENTE', 'CURP.PASAPORTE.NOMBRE_COMPLETO.NACIMIENTO.NUMBER_TRABAJADOR'
        #Del trabajador para enviarte la ID

        # recuperar la lista de lost trabajadores
        # Enviar el id del trabajdor para recuperar un solo registro.
        # Enviar cualquier palabra en $parametro para recuperar un set de datos
        # que coincidan con el nombre completo, categoria, num trabajador, etc.
        # Enviar solo la id del turno para recuperar la informacion del trabajador que
        # depende el beneficiario.
        $response = $master->getByProcedure("sp_trabajdores_empresas_b", [$e_id_trabajador, $parametro, $e_turno_id]);
        break;
    case 9:
        # actualizar la informacion de los trabajadores de la ujat.
        # siempre y cuando el usuario tenga el permiso.
        # Para actualizar, se necesita enviar la id del trabajdor de la ujat.
        $dir2 = $master->urlComodin . "archivos/verificaciones_ujat/";
        $r2 = $master->createDir($dir2);

        $verificacion = $master->guardarFiles($_FILES, "verificacion-ujat", $dir2, "VERIFICACION_$e_turno_id" . "_" . $master->getByPatientNameByTurno($master, $e_turno_id) . "_$hoy");

        if (!empty($verificacion)) {
            $url_verificacion = str_replace("../", $host, $verificacion[0]['url']);
        }

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
            $_SESSION['id'],
            isset($e_turno_id) ? $url_verificacion : null
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

        $response = 1;
        break;
    case 11:
        # recuperar todos los documentos que existen.
        $response = $master->getByProcedure("sp_recuperar_archivos_turno", [$e_turno_id]);
        $response[0]['ORDENES_MEDICAS'] = $master->decodeJson([$response[0]['ORDENES_MEDICAS']]);
        $response[0]['IDENTIFICACION'] = $master->decodeJson([$response[0]['IDENTIFICACION']]);
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

            if ($score > 0.7) { // Puedes ajustar este umbral según lo necesites
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
            null # esta variable es la id del turno, para este efecto no aplica.
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
