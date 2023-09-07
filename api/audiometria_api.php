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
$date = date("dmY_His");

$gauardarCapturas = $master->setToNull(array(
    $turno_id,
    $captura_izq,
    $captura_der
));


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

        //Guardar capturas(img)
    case 3:
        $turno_id = $_POST['turno_id'];
        $nombre_servicio = $_POST['nombre_servicio'];
        $serv = str_replace(" ", "_", $nombre_servicio);

        $ruta_saved = "reportes/modulo/audiometria/$date/$turno_id/capturas/";
        $r = $master->createDir("../" . $ruta_saved);

        if ($r != 1) {
            $response = "No se pudo crear el directorio de carpetas. Capturas";
            break;
        }

        $capturas = $master->guardarFiles($_FILES, 'capturas', "../" . $ruta_saved, "CAPTURAS_AUDIOMETRIA_$serv");

        for ($i = 0; $i < count($capturas); $i++) {
            $capturas[$i]['url'] = str_replace("../", $host, $capturas[$i]['url']);
        }


        $response = $master->insertByProcedure('sp_audiometria_captura_g', [$turno_id, $captura_izq, $captura_der]);
        break;

    default:
        $response = "Api no definida";
}

echo $master->returnApi($response);
