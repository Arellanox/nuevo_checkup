<?php

require_once "../clases/master_class.php";
require_once "../clases/token_auth.php";
include_once "../clases/Pdf.php";
//include_once "../clases/correo_class.php";

$tokenVerification = new TokenVerificacion();
$tokenValido = $tokenVerification->verificar();
if (!$tokenValido) {
    // $tokenVerification->logout();
    // exit;
}

$master = new Master();

#OBTENEMOS LA API POR MEDIO DEL POST
$api = $_POST['api'];

$archivo = $_POST['resultado_audio[]'];
$id_turno = $_POST['id_turno'];
$turno_id = $_POST['turno_id'];

$usuario_id = $_SESSION['id'];
$host = $_SERVER['SERVER_NAME'] == "localhost" ? "http://localhost/nuevo_checkup/" : "https://bimo-lab.com/nuevo_checkup/";

// print_r($_POST['antecedentes']);
// exit;

//agregado por para guardar las capturas
$captura_izq = $_POST['captura_izq'];
$captura_der = $_POST['captura_der'];

$gauardarCapturas = $master->setToNull(array(
    $turno_id,
    $captura_izq,
    $captura_der
));



# nuevo reporte de audiometria 

$grafica = $_POST['tabla_reporte'];
$audiometria_tonal = $_POST['values'];
$antecedentes = $_POST['antecedentes'];
$comentario = $_POST['comentario'];
$comentario_od = $_POST['comentario_oido_derecho'];
$comentario_oi = $_POST['comentario_oido_izquierdo'];
$otoscopia = $_POST['otoscopia'];
$resultado_od = $_POST['audiometria_oido_derecho'];
$resultado_oi = $_POST['audiometria_oido_izquierdo'];
$recomendaciones = $_POST['recomendaciones'];
$id_audiometria = $_POST['id_audiometria'];
$confirmado = $_POST['confirmado'];

$audio_array = array(
    $id_audiometria,
    json_encode($antecedentes),
    $id_turno,
    json_encode($audiometria_tonal),
    $confirmado,
    $_SESSION['id'],
    $otoscopia,
    $resultado_od,
    $resultado_oi,
    $comentario,
    $comentario_od,
    $comentario_oi,
    $recomendaciones,
    null,
    null,
    $grafica
);

switch ($api) {

    case 1:

        # GUARDAMOS EL PDF DEL REPORTE DE AUDIOMETRIA

        $destination = "../reportes/modulo/audiometria/$id_turno/";
        $r = $master->createDir($destination);

        #LE AÑADIMOS UN NOMBRE A NUESTRO ARCHIVO
        $name = $master->getByPatientNameByTurno($master, $id_turno);

        // Verificar si el archivo existe
        if (file_exists($destination . "AUDIO_$id_turno" . "_" . "$name")) {

            // Eliminar el archivo existente
            unlink($destination . "AUDIO_$id_turno" . "_" . "$name");
        }

        $interpretacion = $master->guardarFiles($_FILES, "resultado_audio", $destination, "AUDIO_$id_turno" . "_" . "$name");

        $ruta_archivo = str_replace("../", $host, $interpretacion[0]['url']);

        #guardarmos la direccion de espirometria
        $audio = $host . "reportes/modulo/audiometria/$id_turno/" . basename($ruta_archivo);
        $response = $master->insertByProcedure("sp_audio_ruta_reporte_g", [$audio, $id_turno, $usuario_id]);

        break;

    case 2:

        $response = $master->getByProcedure('sp_audio_ruta_b', [$turno_id]);

        break;

    case 3:

        //Guardar capturas oido izquierdo y derecho (Audiometria)
        $dir = '../reportes/modulo/audiometria/';
        $r = $master->createDir($dir);
        $audio_izq = $master->guardarFiles($_FILES, 'file-captura-oido-izquierdo', $dir, "AUDIO_IZQ_$turno_id");
        $audio_der = $master->guardarFiles($_FILES, 'file-captura-oido-derecho', $dir, "AUDIO_DER_$turno_id");

        $ruta_audio_izq = str_replace("../", $host, $audio_izq[0]['url']);
        $ruta_audio_der = str_replace("../", $host, $audio_der[0]['url']);

        $gauardarCapturas = $master->setToNull(array(
            $turno_id,
            $ruta_audio_izq,
            $ruta_audio_der
        ));

        $response = $master->insertByProcedure("sp_audiometria_captura_g", $gauardarCapturas);
        break;

    case 4:
        //Busca las capturas de oido izquierdo y derecho (Audiometria)
        $response = $master->getByProcedure("sp_audiometria_captura_b", [$turno_id]);
        break;
        // case 5:
        //     # guardar los resultados de la audiometria tonal [TABLA]
        //     $response = $master->insertByProcedure("sp_audio_hz_resultados_g", [json_encode($audiometria_tonal), $turno_id]);
        //     break;
        // case 6:
        //     # recuperar la informacion de la audiometria tonal [TABLA].
        //     $result = $master->getByProcedure("sp_audiometria_hz_resultados_b", [$turno_id]);
        //     $response = $master->decodeJson([$result[0][0]]);
        //     break;
    case 6:
        #recupera la informacion del reporte de audiometria final

        $response = $master->getByProcedure("sp_audiometria_resultados_b", [$turno_id, null, null, null]);
        $response = $master->decodeJsonRecursively($response);
        break;
    case 7:
        # guardar el reporte de audiometria final
        if ($confirmado == 1) {
            $url = $master->reportador($master, $id_turno, 4, "audiometria", "url", 0);
            $response = $master->insertByProcedure("sp_audiometria_resultados_g", $audio_array);
            // var_dump($response);
            // echo $id_turno;
            $response = $master->updateByProcedure("sp_reportes_actualizar_ruta", ['audio_resultados', 'RUTA_REPORTE', $url, $id_turno, null]);
        } else {
            $response = $master->insertByProcedure("sp_audiometria_resultados_g", $audio_array);
        }
        break;
    case 8:
        # guardar la captura de la tabla
        $img64 = explode(",", $grafica);
        $img64 = substr($img64[1], 0, -2);

        # creamos el directorio si no existe
        $dir = "reportes/modulo/audiometria/grafica_tonal";
        $r = $master->createDir("../" . $dir);
        if ($r == 1) {
            $file = $dir . "/" . $id_turno . ".txt";
            file_put_contents("../" . $file, $img64);
            $response = $master->insertByProcedure("sp_audiometria_grafica_g", [$id_turno, $host . $file]);
        } else {
            $response = "Imposible crear el directorio para guardar la grafica.";
        }

        break;
    default:
        $response = "Api no definida";
}

echo $master->returnApi($response);
