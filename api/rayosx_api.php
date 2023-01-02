<?php
require_once "../clases/token_auth.php";
include_once '../clases/master_class.php';
include_once "../clases/Pdf.php";

$tokenVerification = new TokenVerificacion();
$tokenValido = $tokenVerification->verificar();
if (!$tokenValido) {
   $tokenVerification->logout();
   exit;
}


$master = new Master();
$id_rayo = $_POST['id_rayo'];
$api = $_POST['api'];
$turno_id = $_POST['turno_id'];
$usuario = $_SESSION['id'];
$servicio_id = $_POST['servicio_id'];
$comentario = $_POST['comentario'];

switch ($api) {
    case 1:
        # subir interpretacion de rayos x.
        # la variable tipo significa que lo que estamos subiendo es una interpretacion.
        $tipo = 1;
        #creamos el directorio donde se va a guardar la informacion del turno
        $ruta_saved = "reportes/modulo/rayosx/$turno_id/interpretacion/";
        $r = $master->createDir("../".$ruta_saved);
        

        if($r!=1){
            $response = "No se pudo crear el directorio de carpetas. Interpretacion.";
            break;
        }

        #$imagenes = $master->guardarFiles($_FILES, "capturas", $dir, "CAPTURA_RX_$turno_id");
        $interpretacion = $master->guardarFiles($_FILES, "interpretacion", "../".$ruta_saved, "INTERPRETACION_RX_$turno_id");

        $response = $master->insertByProcedure('sp_rayosx_resultados_g',[null,$turno_id,$interpretacion[0]['URL'],NULL,$usuario,$tipo,null,null]);
        break;

    case 2:
        # Subir las capturas de los servicvios en cuestion.
        $tipo = 2;
        #creamos el directorio donde se va a guardar la informacion del turno
        $ruta_saved = "reportes/modulo/rayosx/$turno_id/capturas/";
        $r = $master->createDir("../".$ruta_saved);
        

        if($r!=1){
            $response = "No se pudo crear el directorio de carpetas. Capturas.";
            break;
        }

        $capturas = $master->guardarFiles($_FILES, "capturas", "../" . $ruta_saved, "CAPTURAS_RX_$turno_id");

        $response = $master->insertByProcedure("sp_rayosx_resultados_g", [null,$turno_id,null,json_encode($capturas),$usuario,$tipo,$servicio_id,$comentario]);
  
        break;

    case 3:
        # recuperar los resultados de rayos x
        $response = $master->getByProcedure('sp_rayosx_resultados_b',[$id_rayo,$turno_id]);

        # recuperar las capturas si las tiene.
        $area_id = 8; # 8 es el id para rayos x.
        $response2 = $master->getByProcedure("sp_capturas_imagen_b", [$turno_id,$area_id]);
        $capturas = [];
        foreach($response2 as $current){
            $current['CAPTURAS'] = json_decode($current['CAPTURAS'], true);
            $capturas[] = $current;
        }

        $response[0]['CAPTURAS'] = $capturas;
        
        break;
    default:
        $response = "Api no definida...";
        break;
}

echo $master->returnApi($response);
?>