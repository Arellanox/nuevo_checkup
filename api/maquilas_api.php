<?php
require_once "../clases/master_class.php";
require_once "../clases/token_auth.php";

$tokenVerification = new TokenVerificacion();
$tokenValido = $tokenVerification->verificar();
if (!$tokenValido) {
    $tokenVerification->logout();
    exit;
}

$master = new Master();
$api = $_POST['api'];
$host = $master->selectHost($_SERVER['SERVER_NAME']);

$id_paciente = $_POST['id_paciente'] == 'null' ? null : $_POST['id_paciente'];
$nombre = $_POST['nombre'];
$paterno = $_POST['paterno'];
$materno = $_POST['materno'];
$curp = $_POST['curp'];
$fecha_nacimiento = $_POST['fecha_nacimiento'];
$edad = $_POST['edad'];
$genero = $_POST['genero'];
$area_encuentra = $_POST['area_encuentra'];
$siho_cuenta = $_POST['siho_cuenta'];
#urgencia
$tipo = $_POST['tipo']; #ordinario, urgente
$servicios = $_POST['servicios'];
$comentarios_orden = $_POST['comentarios_orden'];
$orden_medica = $_FILES['orden_medica'];

$id_alta = $_POST['id_alta'];
$id_turno = $_POST['id_turno'];
$bit_solitudes = $_POST['bit_solitudes'];
$fecha_toma = $_POST['fecha_toma'];

$pacientes = $_POST['pacientes']; # array

$cliente_id = $_POST['id_cliente'];
$id_lote = $_POST['id_lote'];

# vista principal maquila
$fecha = $_POST['fecha'];
$bit_muestras  = $_POST['bit_muestras']; # 0 los que no 1 lo que si tienen muestas tomadas


#rechazar muestras 
$id_servicio = $_POST['id_servicio'];
$comentario_rechazo = $_POST['comentario_rechazo'];
$rechazado = $_POST['rechazado']; # bit 0 rechazado, 1 aceptado.

if (!empty($_SESSION['id'])) {

    switch ($api) {
        case 1:
            # Verificar que si el paciente que estan ingresando ya existe.
            $pacientes_existentes = $master->getByProcedure("sp_pacientes_b", [null, null, null, null, $_SESSION['id_cliente']]);
            $paciente = strtolower($nombre . ' ' . $paterno . ' ' . $materno);


            $coincidencias = [];
            foreach ($pacientes_existentes as $paciente_existente) {
                $base = strtolower($paciente_existente['NOMBRE'] . ' ' . $paciente_existente['PATERNO'] . ' ' . $paciente_existente['MATERNO']);
                $baseTokens = explode(' ', $base);
                $userTokens  = explode(' ', $paciente);

                $matches = 0;

                foreach ($userTokens as $userToken) {
                    foreach ($baseTokens as $baseToken) {
                        if (levenshtein($userToken, $baseToken) <= 2) {
                            $matches++;
                            break;
                        }
                    }
                }

                $score = $matches / count($userTokens);

                if ($score > 0.7) {
                    $coincidencias[] = $paciente_existente;
                }
            }

            $response = $coincidencias;

            break;
        case 2:
            # Alta/registro paciente.

            # si existe una sesion activa.

            if (!empty($_SESSION['id'])) {
                $servicios = explode(',', $servicios);

                $resultset = $master->getByNext("sp_maquilas_alta_paciente", [
                    $id_paciente,
                    $nombre,
                    $paterno,
                    $materno,
                    $curp,
                    $fecha_nacimiento,
                    $edad,
                    $genero,
                    $area_encuentra,
                    $siho_cuenta,
                    $tipo,
                    json_encode($servicios),
                    $comentarios_orden,
                    $_SESSION['id'],
                    $orden_medica
                ]);

                # si el primer elemento 
                // if (!is_numeric($resultset[0][0])){
                //     $response = $resultset[0][0];
                //     break;
                // }

                $count = 0;
                $errores = array();
                foreach ($resultset as $current) {
                    switch ($count) {
                        case 0:
                            # es el turno
                            $id_turno = $current[0]['TURNO'];
                            break;
                        case 1:
                            # es folio
                            $folio = $current[0]['FOLIO'];
                            break;
                        case 2:
                            # otros datos
                            $nombre = $current[0]['NOMBRE'];
                            $nacimiento = $current[0]['NACIMIENTO'];
                            $edad = $current[0]['EDAD'];
                            $curp = $current[0]['CURP'];
                            $cuenta = $current[0]['CUENTA'];
                        default:
                            $errores[] = $current[0]['@mensaje'];
                            break;
                    }
                    $count++;
                }

                # subimos la orden medica al turno que acabmos de generar.
                $dir = '../archivos/ordenes_medicas/' . $id_turno . '/';
                $r = $master->createDir($dir);
                $orden = $master->guardarFiles($_FILES, 'orden_medica', $dir, 'ORDEN_MEDICA_LABORATORIO_' . $id_turno);
                $url = str_replace("../", $host, $orden[0]['url']);

                $ordenes = $master->insertByProcedure('sp_ordenes_medicas_g', [null, $id_turno, $url, $orden[0]['tipo'], 6]);

                $response = [
                    "ID_TURNO"  => $id_turno,
                    "FOLIO"     => $folio,
                    "NOMBRE"    => $nombre,
                    "NACIMIENTO" => $nacimiento,
                    "EDAD"      => $edad,
                    "CURP"      => $curp,
                    "CUENTA"    => $cuenta,
                    "ERRORES"   => $errores
                ];
            } else {
                $response = "Su sesión ha expirado. Regrese al login.";
            }

            break;
        case 3:
            # recuperar solicitudes.
            # que no esten dentro de un lote de envio.

            #$bit_solicitudes: 0 es los que no tienen lote, 1 para los que si tienen lote

            $response = $master->getByProcedure("sp_maquilas_altas_pacientes_b", [$id_alta, $id_turno, $bit_solitudes, $bit_muestras, $_SESSION['id_cliente']]);
            $response = $master->decodeJsonRecursively($response);
            break;

        case 4:
            # crear lotes para envio.
            $pacientes = explode(',', $pacientes);
            $id_lote = $master->insertByProcedure("sp_maquilas_lotes_g", [
                json_encode($pacientes),
                $_SESSION['id']

            ]);

            # si ocurreo algun error, nos salidmos del procedimiento
            if (!is_numeric($id_lote)) {
                $response = $id_lote;
                break;
            }

            # de lo contrario, continuamos con el procedimiento.

            # crear el reporte y guardarlo en la tabla.

            $url = $master->reportador($master, $id_lote, -5, "envio_muestras");
            $responseUpdate = $master->updateByProcedure("sp_reportes_actualizar_ruta", ['maquilas_lotes', "RUTA_REPORTE", $url, $id_lote, -5]);

            $response = $master->getByProcedure("sp_maquilas_lotes_b", [null, $id_lote]);
            # folio
            # ruta del reporte
            break;
        case 5:
            # recuperar los lotes creados.

            $response = $master->getByProcedure('sp_maquilas_lotes_b', [$cliente_id, $id_lote]);
            break;

        case 6:
            # vista principal maquila. la que tiene los resultados.

            $response = $master->getByProcedure('sp_maquilas_detalles_b', [$fecha, $_SESSION['id_cliente']]);
            $response = $master->decodeJsonRecursively($response);
            break;
        case 7:
            # recuperar el detalle de los lotes
            $response = $master->getByProcedure('sp_maquilas_lotes_detalle_b', [$id_lote]);
            $response = $master->decodeJsonRecursively($response);
            break;

        case 8:
            # enviar lote

            # cambiar el estado del lote a enviado.
            $response = $master->updateByProcedure("sp_maquilas_enviar_lote", [$id_lote]);

            break;

        case 9:
            #Actualizar el MUESTRA_TOMADA de la tabla maquilas_altas_pacientes
            $response = $master->getByProcedure('sp_maquilas_altas_pacientes_a', [$fecha_toma, $id_turno, $_SESSION['id']]);

            break;

        case 10:
            # buscar pacientes de la empresa.
            $response = $master->getByProcedure("sp_maquilas_pacientes_b", [$_SESSION["CLIENTE_ID"]]);
            break;
        case 11:
            # rechazar servicios de una solicitud.
            $dir = "../archivos/maquilas/evidencias_rechazo/$id_turno";
            $r = $master->createDir($dir);

            # si no se pueden guardar las evidencias, se retorna el error
            if (!$r) {
                $response = "Error al crear repositorios de evidencias.";
                break;
            }

            # continuamos con el procedemiento.

            # subimos las capturas
            $imagenes = $master->guardarFiles($_FILES, 'evidencias', $dir, "evidencias_rechazo_$turno_id");

            #cambiamos la el prefijo de la ruta
            $imgs = [];
            foreach ($imagenes as $imagen) {
                $imagen['url'] = str_replace("../", $host, $imagen['url']);
                $imgs[] = $imagen;
            }

            $response = $master->getByProcedure("sp_maquilas_historial_servicios_rechazados_g", [$id_turno, $id_servicio, json_encode($imgs), $comentario_rechazo]);
            break;
        case 12:
            # detalle de los servicios
            $servicios = explode(',', $servicios);
            $response = $master->getByProcedure("sp_maquilas_detalle_servicios", [json_encode($servicios)]);
            break;

        default:
            $response = "Api no definida.";
    }
} else {
    $response = "Su sesión ha expirado. Regrese al login.";
}

echo $master->returnApi($response);

#;laksjdf

function crearReporteEnvioMuestras($id_lote)
{
    global $master;
    $url = $master->reportador($master, $id_lote, -5, "envio_muestras");
    $responseUpdate = $master->updateByProcedure("sp_reportes_actualizar_ruta", ['maquilas_lotes', "RUTA_REPORTE", $url, $id_lote, -5]);
    return $url;
}
