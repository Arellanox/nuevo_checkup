<?php
session_start();
require_once "../clases/token_auth.php";
include_once '../clases/master_class.php';
include_once "../clases/Pdf.php";

$tokenVerification = new TokenVerificacion();
$tokenValido = $tokenVerification->verificar();
if (!$tokenValido) {
    // $tokenVerification->logout();
    // exit;
}

$master = new Master();
$api = $_POST['api'];

# Datos para la interpretacion
$turno_id = $_POST['turno_id'];
$id_electro = $_POST['id_electro'];
$comentario = $_POST['comentario'];
$tecnica = $_POST['tecnica'];
$hallazgo = $_POST['hallazgo'];
$interpretacion = $_POST['interpretacion'];
$usuario = $_SESSION['id'];
$confirmado = $_POST['confirmado'];
$archivo = $_POST['electro_pdf'];

# Datos para el sistema
$host = $_SERVER['SERVER_NAME'] == "localhost" ? "http://localhost/nuevo_checkup/" : "https://bimo-lab.com/nuevo_checkup/";
$date = date("dmY_His");

switch($api){
    case 1:
        # insertar la interpretacion
        // #creamos el directorio donde se va a guardar la informacion del turno
        // $ruta_saved = "reportes/modulo/electrocardiograma/$date/$turno_id/interpretacion/";
        // $r = $master->createDir("../".$ruta_saved);

        // if($r!=1){
        //     $response = "No se pudo crear el directorio de carpetas. Interpretacion.";
        //     break;
        // }

        // $interpretacion = $master->guardarFiles($_FILES, "reportes", "../".$ruta_saved, "INTERPRETACION_ELECTROCARDIOGRAMA_$turno_id");

        // $ruta_archivo = str_replace("../", $host, $interpretacion[0]['url']);

        // $last_id = $master->insertByProcedure("sp_electro_resultados_g", [null, $turno_id, $ruta_archivo, $usuario, $comentario]);


        // $response = $last_id;
        if(isset($confirmado)){
            // confirmamos y creamos el reporte.
            $url = $master->reportador($master,$turno_id,10,"electro","url",0,0,0);

        } else {
            // solo guardamos la informacion del reporte. Sin confirmar
            $response = $master->insertByProcedure("sp_electro_resultados_g",[$id_electro,$turno_id,$archivo,null,$comentario,$interpretacion,$tecnica,$hallazgo,null,null,$usuario]);

        }
    break;
    case 3: 
        # recuperar los electros de la carpeta global
        $folder = "../electro_img/";

        $electros = scandir($folder);

        $files = [];
        for($i = 0; $i < count($electros); $i++){
            if($i > 1){
                $path = $host."electro_img/".$electros[$i];
                $files[] = [$path,$electros[$i]];
            }
        }
        $response = $files;
        break;
    case 4: 
        $response1 = $master->updateByProcedure("sp_electro_resultados_g", [$id_electro, null, null, null, $comentario]);
        $response = $response1;
        break;
    case 5: 
        $response1 = $master->deleteByProcedure("sp_electro_resultados_e", [$id_electro]);

        $response = $response1;
        break;
    default:
        $response = "Api no definida.";
        break;
}
echo $master->returnApi($response);


?>