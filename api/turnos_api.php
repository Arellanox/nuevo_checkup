<?php
require_once "../clases/master_class.php";
require_once "../clases/token_auth.php";
include_once "../clases/Pdf.php";
include "../clases/correo_class.php";


$tokenVerification = new TokenVerificacion();
$tokenValido = $tokenVerification->verificar();
if (!$tokenValido) {
    # $tokenVerification->logout();
    # exit;
}

#api
$api = $_POST['api'];

# turnos
$turno_completado = $_POST['turno_completado'];

#buscar
$id = $_POST['id'];
$id_paciente = $_POST['id_paciente'];
$id_area = $_POST['id_area'];
$fecha_agenda = $_POST['fecha_busqueda'];
$fecha_agenda_final = $_POST['fecha_busqueda_final'];
$confirmar = $_POST['confirmar'];

#subir resultaddos
$servicio_id = $_POST['servicio_id'];
$activo_servicio = $_POST['activo_servicio'];
$resultado = $_POST['resultado'];
$observaciones = $_POST['observacionesGrupos'];
$observacionesServicios = $_POST['observacionesServicios'];
$confirmado_por = $_SESSION['id'];

#insertar
$id_turno = $_POST['id_turno'];
$paciente_id = $_POST['paciente_id'];
$paquete_id = $_POST['paquete_id'];
$prefolio = $_POST['prefolio'];
$folio = $_POST['folio'];
$fecha_registro = $_POST['fecha_registro'];
$fecha_agenda = $_POST['fecha_agenda'];
$fecha_reagenda = $_POST['fecha_reagenda'];
$fecha_recepcion = $_POST['fecha_recepcion'];
$turno = $_POST['turno'];
$habilitado = $_POST['habilitado'];
$identificacion = $_POST['identificacion'];
$total = $_POST['total'];
$completado = $_POST['completado'];
$comentario_rechazo = $_POST['comentario_rechazo'];
$cliente_id = $_POST['cliente_id'];
$segmento_id = $_POST['segmento_id'];
$area_id = $_POST['area_id'];

# nuevos datos
$categoria_turno = $_POST['categoria_turno'];
$parametros = array(
    $id_turno,
    $paciente_id,
    $paquete_id,
    $prefolio,
    $folio,
    //$fecha_registro,
    $fecha_agenda,
    $fecha_reagenda,
    $fecha_recepcion,
    $turno,
    $habilitado,
    $identificacion,
    $total,
    $completado,
    $comentario_rechazo,
    $cliente_id,
    $segmento_id,
    $_POST['tipo']
);
$response = "";

// datos para reemplazar el reporte de los laboratorios
$nuevo_reporte = $_POST['nuevo_reporte'];
$ruta_reporte = $_POST['ruta_reporte'];

// Angel estuvo aqui XD
$master = new Master();
switch ($api) {
    case 1:
        $response = $master->insertByProcedure("sp_turnos_g", $parametros);
        break;
    case 2:
        # buscar
        $response = $master->getByProcedure("sp_turnos_b", [$id,]);
        break;
    case 3:
        # actualizar
        $response = $master->updateByProcedure("sp_turnos_g", $parametros);
        break;
    case 4:
        # desactivar
        $response = $master->deleteByProcedure("sp_turnos_e", [$id]);
        break;

    case 5:
        # recuperar la lista de trabajo por area
        $area = $_POST['area_id'];
        $fecha = $_POST['fecha_busqueda'];
        $fechaFinal = $_POST['fecha_busqueda_final'];

        $response = $master->getByProcedure('sp_lista_de_trabajo', [
            $fecha, $fechaFinal, $area, NULL, $_SESSION['id'], $cliente_id
        ]);
        break;
    case 10:
        #historial de servicios
        $response = $master->getByProcedure("sp_historial_servicios_paciente", [$id, $id_paciente, $id_area, $fecha_agenda]);
        break;

    case 7:
        # api falsa


        $response = $master->getEmailMedico($master, 436);
        $response[] = "prueba@hotmail.com";
        print_r(array_unique($response));
        exit;
        break;

    case 8:
        # cargar los resultados
        $tipo = $_POST['tipo'];

        if ($tipo == 1) {
            $grupos = $master->getByProcedure("sp_cargar_grupos", [$id_turno, $id_area]);
            $response = $master->getByProcedure('sp_cargar_estudios', [$id_turno, $id_area]);
            $array = array();
            for ($i = 0; $i < count($grupos); $i++) {
                $nombre_grupo = $grupos[$i]['GRUPO'];
                $id_grupo = $grupos[$i]['GRUPO_ID'];
                $obs = $grupos[$i]['OBSERVACIONES'];
                $clasificacion = $grupos[$i]['CLASIFICACION'];

                $contenido_grupo = array_filter($response, function ($obj) use ($nombre_grupo) {
                    $r = $obj["GRUPO"] == $nombre_grupo;
                    return $r;
                });

                $contenido_grupo['NombreGrupo'] = $nombre_grupo;
                $contenido_grupo['ID_GRUPO'] = $id_grupo;
                $contenido_grupo['OBSERVACIONES'] = $obs;
                $contenido_grupo['CLASIFICACION'] = $clasificacion;
                $contenido_grupo['PENDIENTE'] = $grupos[$i]['PENDIENTE'];

                if (!empty($contenido_grupo)) {
                    $array[] = $contenido_grupo;
                }
            }

            echo json_encode(array("response" => array("code" => 1, "data" => $array)));
            exit;
        } else {
            $response = $master->getByProcedure('sp_cargar_estudios', [$id_turno, $id_area]);
        }

        break;

    case 9:
        # subir resultados
        $setResultados = $_POST['servicios'];
        $id_turno = $_POST['id_turno'];
        #print_r($setResultados);
        foreach ($setResultados as $key => $resultado) {
            #determinamos si el estudio de laboratorio tiene valor absoluto.
            $valor_absoluto = isset($resultado['VALOR']) ? $resultado['VALOR'] : NULL;
            $group = strtolower($resultado['ID_GRUPO']) == "null" ? NULL : $resultado['ID_GRUPO'];

            switch($resultado['BLANCO']){
                case "on":
                    $blanco = 1;
                    break;
                case null:
                    $blanco = 0;
                    break;
                default:
                    $blanco = $resultado['BLANCO'];
                    break;
            }

            #$a = array($id_turno, $servicio_id, $resultado, $confirmar, $confirmado_por, $valor_absoluto);
            $response = $master->updateByProcedure('sp_subir_resultados', array($id_turno, $resultado['ID_SERVICIO'], $resultado['RESULTADO'], $confirmar, $confirmado_por, $valor_absoluto, $group, $blanco));

            #  print_r($response);
            if (!is_numeric($response)) {
                echo $master->returnApi($response);
                exit;
            }
        }

        // actualizamos las observaciones por los grupos en casa hijo de la tabla paciente detalle

        foreach ($observaciones as $key => $observacion) {
            $response = $master->updateByProcedure('sp_cargar_observaciones_laboratorio', [$id_turno, $key, null, $observacion]);
        }

        foreach ($observacionesServicios as $key => $observacion) {
            $response = $master->updateByProcedure('sp_cargar_observaciones_laboratorio', [$id_turno, null, $key, $observacion]);
        }
        //echo json_encode(array("response" => array("code" => 1, "msj" => "Termina la carga de datos.")));

        if (isset($confirmar)) {
            #Creamos el folio
            # dar de alta primero el folio en la tabla de reportes_areas

            $folio = $master->insertByProcedure('sp_generar_folio_laboratorio', [$id_area]);

            $res = $master->insertByProcedure('sp_reportes_areas_g', [null, $id_turno, $id_area, null, null, $folio]);
            # generar el reporte de laboratorio
            if ($id_area == 6) {
                $r = $master->reportador($master, $id_turno, $id_area, 'resultados', 'url', 0, 1);
            } elseif ($id_area == 12) {
                $r = $master->reportador($master, $id_turno, $id_area, 'biomolecular', 'url', 0, 1);
            }
            //crearReporteLaboratorio($id_area, $id_turno);
        }

        break;

    case 6:
        #servicios por turno
        $response = $master->getByProcedure('sp_turnos_historial', [$id, $id_paciente, $id_area]);
        $hijo = $master->getByProcedure('sp_turnos_historial_detalle', [$id, $id_paciente, $id_area]);
        for ($i = 0; $i < count($response); $i++) {
            $id_turno_padre = $response[$i]['ID_TURNO'];
            $servicios = array_filter($hijo, function ($obj) use ($id_turno_padre) {
                $r = $obj['ID_TURNO'] == $id_turno_padre;
                return $r;
            });
            $response[$i]['servicios'] = $servicios;
        }
        break;

    case 11:
        # Crear reporte de puertas
        crearReporteLaboratorio($id_area, $id_turno);
        exit;
        break;
    case 12:
        # Cargar lista de trabajo para la segunda validacion de laboratorio
        $area = $_POST['area_id'];
        $fecha = $_POST['fecha_busqueda'];
        $fecha_final = $_POST['fecha_busqueda_final'];
        $response = $master->getByProcedure('sp_lista_de_trabajo', array(
            $fecha, $fecha_final, $area, 1, $_SESSION['id'], null
        )); #fecha deseada, id_area, id_cliente.
        break;
    case 13:
        # Dar el 2 check en resultados de laboratorio [particulares]
        $response = $master->updateByProcedure("sp_db_check_laboratorio", [$id_turno, $_SESSION['id']]);
        $mail = new Correo();

        if ($response >= 0) {
            # si se confirmo en la base de datos, enviamos el correo
            $response = $master->getByProcedure("sp_recuperar_reportes_confirmados", [$id_turno, $id_area, 1, null, 0]);
            $files = $master->cleanAttachingFiles($response);

            # creamos el arreglo para saber a cuantos correo hay que mandarlo
            $mails = $master->getEmailMedico($master, $id_turno);
            #agregamos el correo del paciente.
            $mails[] = $response[0]['CORREO'];

            if (!empty($files)) {
                $r = $mail->sendEmail("resultados", "Resultados de laboratorio", array_unique($mails), null, $files, 1, null, $id_turno, $id_area, $master);
                if ($r) {
                    $response = 1;
                } else {
                    $x = $master->insertByProcedure("sp_correos_g", [$id_turno, $id_area, $mail->getCorreoSeleccionado(),]);
                    $response = "No se envió el resultado.";
                }
            } else {
                $response = "Reporte validado. No hay archivos para enviar o paciente de empresa.";
            }
        }
        break;
    case 14:

        $response = $master->getByProcedure("sp_recuperar_reportes_confirmados", [$id_turno, $area_id, null, null, 0]);
        $response = $response[count($response) - 1];
        //$response = $master->cleanAttachingFiles($response);
        break;


    case 15:
        #case 15 . Desconfirmar resultados
        $response = $master->getByProcedure("sp_desconfirmar_resultados", [$id_turno, $confirmado_por, $id_area]);
        //$response = $master->cleanAttachingFiles($response);
        break;

    case 16:
        //Consultar servicios eliminados de un turno
        $response = $master->getByProcedure('sp_servicios_c', [$id_turno]);
        break;

    case 17:
        //eliminar servicio de un turno
        $response = $master->deleteByProcedure('sp_recepcion_paciente_detalle_e', [
            $id_turno, $servicio_id, $paquete_id
        ]);
        break;
    case 18:
        // agregar un estudio a un turno
        $response = $master->insertByProcedure("sp_recepcion_detalle_paciente_g", [$id_turno, null, $servicio_id, $_SESSION['id']]);
        break;
    case 19:
        # marcar un turno como completado o marcarlo como incompleto
        # variable ['turno_completado']
        # mandar 1 para completado
        # mandar 0 para mandar incompleto
        $response = $master->updateByProcedure("sp_turnos_completados_g", [$id_turno, $turno_completado, $confirmado_por]);
        break;
    case 20:
        # mostrar la lista de los pacientes/turnos completados
        # por la fecha de recepcion ['fecha_recepcion'].
        $response = $master->getByProcedure("sp_turnos_completados_b", [$turno_completado, $fecha_recepcion]);
        break;
    case 21:
        # agregra una categoria al paciente de empresas.
        $response = $master->insertByProcedure("sp_agregar_categoria_turno", [$id_turno, $categoria_turno]);
        break;
    case 22:
        # reemplazar reporte de los laboratorio.
        if(
            isset($_FILES['file'])
            && $_FILES['file']['error'] == UPLOAD_ERR_OK
        ){
            // Obtener información del archivo
            $fileTmpPath = $_FILES['file']['tmp_name'];
            $fileName = $_FILES['file']['name'];
            $fileSize = $_FILES['file']['size'];
            $fileType = $_FILES['file']['type'];
            $fileNameCmps = explode(".", $fileName);
            $fileExtension = strtolower(end($fileNameCmps));

            // configurar la ruta del archivo y el nombre
            $nombre_archivo = basename($ruta_reporte);
            $ruta = explode('nuevo_checkup', $ruta_reporte);
            $ruta = $ruta[1];

            // Permitir ciertos tipos de archivo
            $allowedfileExtensions = array('pdf');
            
            if (in_array($fileExtension, $allowedfileExtensions)) {
                // Directorio de subida
                $uploadFileDir = dirname($ruta);
 
                if (!is_dir($uploadFileDir)) {
                    mkdir($uploadFileDir, 0777, true);
                }
                $dest_path = ".." . $uploadFileDir . "/" . $nombre_archivo;
    
                if(move_uploaded_file($fileTmpPath, $dest_path)) {
                    // Archivo subido con exito
                    $response = 1;
                } else {
                    $response = 'Hubo un error moviendo el archivo al directorio de subida.';
                }
            } else {
                $response = 'Tipo de archivo no permitido.';
            }
        }
        break;
    case 23:
        $response = $master->getByProcedure("sp_turno_estudios_cotizacion_b", [$turno]);
        break;
    default:
        $response = "api no reconocida";
        break;
}

echo $master->returnApi($response);




function crearReporteLaboratorio($id_area, $id_turno)
{
    # para crear los reportes de LABORATORIO
    $master = new Master();

    # dar de alta primero el folio en la tabla de reportes_areas
    $folio = $master->insertByProcedure('sp_generar_folio_laboratorio', []);

    $res = $master->insertByProcedure('sp_reportes_areas_g', [null, $id_turno, 6, null, null, $folio]);

    # informacion general del paciente

    #Estudios solicitados por el paciente
    $clasificaciones = $master->getByProcedure('sp_laboratorio_clasificacion_examen_b', [null, 6]);
    $response = $master->getByProcedure("sp_cargar_estudios", [$id_turno, 6]);

    $responsePac = $master->getByProcedure("sp_informacion_paciente", [$id_turno]);


    # pie de pagina
    $fecha_resultado = $responsePac[0]['FECHA_CARPETA'];
    $nombre_paciente = $responsePac[0]['NOMBRE'];
    $nombre = str_replace(" ", "_", $nombre_paciente);

    $ruta_saved = "reportes/modulo/lab/$fecha_resultado/$id_turno/";

    # Crear el directorio si no existe
    $r = $master->createDir("../" . $ruta_saved);

    $archivo = array("ruta" => $ruta_saved, "nombre_archivo" => $nombre . "-" . $responsePac[0]['ETIQUETA_TURNO'] . '-' . $fecha_resultado);

    $clave = $master->getByProcedure("sp_generar_clave", []);

    $pie_pagina = array("clave" => $clave[0]['TOKEN'], "folio" => $responsePac[0]['FOLIO'], "modulo" => 6);

    $arrayGlobal = array(
        'areas' => array()
    );

    # filtramos el arreglo principal y obtenemos aquellos estudios
    # que tienen valor absoluto.
    $serv_var_abs_obj = array_filter($response, function ($obj) {
        $return = $obj['TIENE_VALOR_ABSOLUTO'] == 1;
        return $return;
    });

    $serv_var_abs = ordenar($serv_var_abs_obj, "VALORES ABSOLUTOS", $id_turno);
    $valores_absolutos = $serv_var_abs['estudios'][0]['analitos'];

    for ($i = 0; $i < count($clasificaciones); $i++) {
        $clasificacion_id = $clasificaciones[$i]['ID_CLASIFICACION'];
        # sacamos arrays individuales por clasificacion de examen
        $servicios = array_filter($response, function ($obj) use ($clasificacion_id) {
            $return = $obj['CLASIFICACION_ID'] == $clasificacion_id;
            return $return;
        });

        # como no estamos seguros que de que se encuentren todas las clasificaciones 
        # en un paciente, evaluamos que el array no este vacio.

        if (!empty($servicios)) {

            $aux = ordenar($servicios, $clasificaciones[$i]['DESCRIPCION'], $id_turno);

            $arrayGlobal['areas'][] = $aux;
        }
    }
    // echo "================================================================";
    // echo "<br>";


    # habra estudios que no tengan clasificacion, esos el servidor las regresa con id 0
    # como el id 0 no existe dentro de la tabla de clasificaciones, el algoritmo de arriba los ignora
    # por tanto se tiene que realizar un algoritmo similar pero con el filtro en 0.
    $servicios = array_filter($response, function ($obj) {
        $return = $obj['CLASIFICACION_ID'] == 0;
        return $return;
    });

    if (!empty($servicios)) {

        $aux = ordenar($servicios, "NINGUNA", $id_turno);
        $arrayGlobal['areas'][] = $aux;
    }

    // print_r($arrayGlobal);

    //$pdf = new Reporte(json_encode($arrayGlobal), json_encode($responsePac[0]), $pie_pagina, $archivo, 'resultados', 'url');

    #aqui, como el folio ya se inserto al principio del metodo, solo va a actualizar la clave y la ruta del pdf.
    //return $master->insertByProcedure('sp_reportes_areas_g', [null, $id_turno, 6, $clave[0]['TOKEN'], $pdf->build(), null]);
    // print_r($responsePac);
}


function ordenar($servicios, $clasificacion, $turno)
{
    #obtener los valores absolutos
    $absoluto_array = array();
    $in_array = 0;
    #estamos buscandor el id 1 que corresponde a la biometria hematica
    foreach ($servicios as $current) {
        if (in_array(1, $current) || in_array(35, $current)) {
            $in_array++;
        }
    }

    #si existe la biometria hematica [id 1] o perfil reumatico [id 35], obtenemos los valores absolutos y creamos un array
    if ($in_array > 0) {
        $bh = array_filter($servicios, function ($obj) {
            $r = $obj['GRUPO_ID'] == 1 || 35;
            return $r;
        });

        $abs = array_filter($bh, function ($obj) {
            $r = $obj['TIENE_VALOR_ABSOLUTO'] == 1;
            return $r;
        });

        foreach ($abs as $current) {
            $absoluto_array[] = array(
                "analito" => $current['DESCRIPCION_SERVICIO'],
                "valor_abosluto" => $current['VALOR_ABSOLUTO'],
                "referencia" => $current['VALOR_REFERENCIA_ABS'],
                "unidad" => $current['MEDIDA_ABS']
            );
        }
    }

    $master = new Master();
    $grupos = $master->getByProcedure('sp_cargar_grupos', [$turno, 6]);
    $estudios = array();
    $analitos = array();
    for ($i = 0; $i < count($grupos); $i++) {
        $nombre_grupo = $grupos[$i]['GRUPO'];
        $contenido_grupo = array_filter($servicios, function ($obj) use ($nombre_grupo) {
            $r = $obj['GRUPO'] == $nombre_grupo;
            return $r;
        });

        if (!empty($contenido_grupo)) {

            # llenado de los analitos del grupo
            foreach ($contenido_grupo as $current) {
                $nombre_grupo = $current['GRUPO'];
                $observacionnes_generales = $current['OBSERVACIONES'];
                $id_grupo = $current['GRUPO_ID'];
                $metodo_grupo = $current['METODOS_GRUPO'];
                $equipo_grupo = $current['EQUIPOS_GRUPO'];
                $clasificacion_id = $current['CLASIFICACION_ID'];

                $item = array(
                    "nombre"            => $current['DESCRIPCION_SERVICIO'],
                    "unidad"            => $current['MEDIDA'],
                    "resultado"         => $current['RESULTADO'],
                    "referencia"        => $current['VALOR_DE_REFERENCIA'],
                    # "observaciones"     => isset($id_grupo) ? null : $current['OBSERVACIONES'],
                    "observaciones"     => $nombre_grupo != "OTROS SERVICIOS" ? null : $current['OBSERVACIONES'],
                    "metodo"     => $nombre_grupo != "OTROS SERVICIOS" ? null : $current['METODOS_ESTUDIO'],
                    "equipo"     => $nombre_grupo != "OTROS SERVICIOS" ? null : $current['EQUIPOS_ESTUDIO'],
                    #"metodo"            => isset($metodo_grupo) ? null : $current['METODOS_ESTUDIO'],
                    #"equipo"            => isset($equipo_grupo) ? null : $current['EQUIPOS_ESTUDIO']
                );

                $analitos[] = $item;
            }

            # para los valorse absolutos
            switch ($id_grupo) {
                    #biometria hematica
                case 1:
                    $last_position = count($analitos) - 1;
                    $aux = $analitos[$last_position];
                    $analitos[$last_position] = $absoluto_array;
                    $analitos[] = $aux;
                    break;
                    #perfil reumatico
                case 35:
                    if ($clasificacion_id == 1) {
                        # 1 para la clasificacion de hematologia. 
                        # Solo la hematoloigia debe mandar los valores absolutos                        
                        $last_position = count($analitos) - 2;
                        $aux = $analitos[$last_position];
                        $analitos[$last_position] = $absoluto_array;

                        $last_position++;
                        while (!empty($analitos[$last_position])) {
                            $auxc = $analitos[$last_position];
                            $analitos[$last_position] = $aux;
                            $aux = $auxc;
                            $last_position++;
                        }

                        $analitos[$last_position] = $aux;
                    }
                    break;
            }

            # llenar arreglo estudios
            $estudios[] = array(
                "estudio"        => $nombre_grupo,
                "analitos"       => $analitos,
                "metodo"         => $metodo_grupo,
                "equipo"         => $equipo_grupo,
                "observaciones"  => isset($id_grupo) ? $observacionnes_generales : null
            );
            $analitos = array();
        }
    }

    # ARREGLO DE AREAS

    $response = array(
        "area" => $clasificacion,
        "estudios" => $estudios
    );

    return $response;
}
