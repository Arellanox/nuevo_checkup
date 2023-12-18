<?php
require_once "../clases/master_class.php";
require_once "../clases/token_auth.php";
include "../clases/correo_class.php";

$tokenVerification = new TokenVerificacion();
$tokenValido = $tokenVerification->verificar();
if (!$tokenValido) { //Preregistro necesita recuperar antecedentes
    // $tokenVerification->logout();
    // exit;
}

$master = new Master();
$api = $_POST['api'];
$host = $master->selectHost($_SERVER['SERVER_NAME']);

$turno_id = $_POST['turno_id'];
$servicio_id = $_POST['servicio_id'];
$comentario = $_POST['comentario'];
$area_id = $_POST['area_id'];

switch($api){
    case 1:
        #subir imagenes de frotis o cualquier cosa que quieran subir.

        # establecemos la ruta donde queremos guardar las imagenes.
        $ruta_guardado = "../reportes/modulo/imglab/$turno_id/";

        # recuperamos el nombre del paciente por el turno para guardar sus imagenes.
        $paciente = $master->getByPatientNameByTurno($master, $turno_id);
        #quitamos los acentos
        $paciente = quitarAcentos($paciente);


        # creamos el directorio si no existe.
        $r = $master->createDir($ruta_guardado);

        # si no se puede crear el directorio, enviamos el mensaje de error y terminamos el procedimiento.
        if ($r != 1) {
            $response = "No se pudo crear el directorio de carpetas. Capturas.";
            break;
        }

        # subimos las imagenees en le ruta de guardado con el nombre del paciente
        $urls = $master->guardarFiles($_FILES,"file-captura-microscopio",$ruta_guardado, $paciente);

        # agregamos a cada url de imagen el host en cuestion.
        for ($i = 0; $i < count($urls); $i++) {
            $urls[$i]['url'] = str_replace("../", $host, $urls[$i]['url']);
        }

        # guardamos en la base de datos.
        $response = $master->insertByProcedure("sp_capturas_imagen_g",[null, $turno_id, $servicio_id, json_encode($urls), $comentario, $_SESSION['id']]);
        break;
    case 2:
        # recuperar las capturas del turno
        $resultset = $master->getByProcedure("sp_capturas_imagen_lab_b", [$turno_id, 6 /*area id */, $servicio_id]);

        $response = $master->decodeJsonRecursively($resultset);
        break;
    case 3:
        $resultset = $master->getByProcedure("sp_capturas_imagen_b", [$turno_id, 6 /*area id */]);

        $response = $master->decodeJsonRecursively($resultset);
        break;

    default:
        $response = "API no definida.";
        break;
}

echo $master->returnApi($response);


function quitarAcentos($palabra){
        $acentos = array(
            'á' => 'a', 'é' => 'e', 'í' => 'i', 'ó' => 'o', 'ú' => 'u',
            'Á' => 'A', 'É' => 'E', 'Í' => 'I', 'Ó' => 'O', 'Ú' => 'U',
            'ñ' => 'n', 'Ñ' => 'N',
            // Agregar más caracteres acentuados si es necesario
        );
    
        return strtr($palabra, $acentos);
}

?>