<?php
session_start();
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
$api = $_POST['api'];

# Datos para la interpretacion
$id_rayo = $_POST['id_rayo'];
$turno_id = $_POST['turno_id'];
$usuario = $_SESSION['id'];
$area_id = 8; #$_POST['area_id']; # el id 8 es para el area de rayos-x

# Datos para las capturas
$servicio_id = $_POST['servicio_id'];
$comentario = $_POST['comentario'];

# para el detalle de rayos-x.
# cuando suban los resultados en el formuliar que contienen los campos de hallazgos, interpretacion, etc
$id_rayo = $_POST['id_rayo'];
$hallazgo = $_POST['hallazgo'];
$inter_texto = $_POST['inter_texto'];


switch($api){
    case 1:
        # insertar la interpretacion
        #creamos el directorio donde se va a guardar la informacion del turno
        $ruta_saved = "reportes/modulo/rayosx/$turno_id/interpretacion/";
        $r = $master->createDir("../".$ruta_saved);
        
        if($r!=1){
            $response = "No se pudo crear el directorio de carpetas. Interpretacion.";
            break;
        }

        #$imagenes = $master->guardarFiles($_FILES, "capturas", $dir, "CAPTURA_RX_$turno_id");
        $interpretacion = $master->guardarFiles($_FILES, "interpretacion", "../".$ruta_saved, "INTERPRETACION_RX_$turno_id");

        $response = $master->insertByProcedure('sp_rayosx_resultados_g',[null,$turno_id,$interpretacion[0]['URL'],NULL,$usuario,null,$tipo,null]);
        
        # insertar el formulario de bimo.
        // $response2 = $master->insertByProcedure("sp_rayosx_detalle_g", [$id_rayo,$turno_id,$servicio_id,$hallazgo,$inter_texto,$usuario,$comentario]);
        break;
    case 2:
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
        # recuperar las capturas
        $response = array();
        # recuperar los resultados de rayos x
        $area_id = 8; # 8 es el id para rayosx.
        $response1 = $master->getByProcedure('sp_rayosx_resultados_b',[$id_rayo,$turno_id]);

        # recuperar las capturas si las tiene.

        $response2 = $master->getByProcedure("sp_capturas_imagen_b", [$turno_id,$area_id]);

        $capturas = [];
        foreach($response2 as $current){
            $current['CAPTURAS'] = json_decode($current['CAPTURAS'], true);
            $capturas[] = $current;
        }
        
        $response["PDF"] = $response1[0];
        $response['DETALLE'] = $response1[1];
        $response['CAPTURAS'] = $capturas; 
       
        break;
    default:
        $response = "Api no definida...";
        break;
}
echo $master->returnApi($response);
?>