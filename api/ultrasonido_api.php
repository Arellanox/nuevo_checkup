<?php 
session_start();
require_once "../clases/token_auth.php";
include_once '../clases/master_class.php';
include_once "../clases/Pdf.php";

$tokenVerification = new TokenVerificacion();
$tokenValido = $tokenVerification->verificar();
if (!$tokenValido) {
   #$tokenVerification->logout();
   #exit;
}

$master = new Master();
$api = $_POST['api'];

# Datos para la interpretacion
$id_imagen = $_POST['id_imagen'];
$turno_id = $_POST['turno_id'];
$usuario = $_SESSION['id'];
$area_id = $_POST['area_id'];

# Datos para las capturas
$servicio_id = $_POST['servicio_id'];
$comentario = $_POST['comentario'];

# para el detalle de las imagenes.
# cuando suban los resultados en el formuliar que contienen los campos de hallazgos, interpretacion, etc
$id_rayo = $_POST['id_rayo'];
$hallazgo = $_POST['hallazgo'];
$inter_texto = $_POST['inter_texto'];


switch($api){
    case 1:
        # insertar la interpretacion
        #creamos el directorio donde se va a guardar la informacion del turno
        $ruta_saved = "reportes/modulo/ultrasonido/$turno_id/interpretacion/";
        $r = $master->createDir("../".$ruta_saved);

        if($r!=1){
            $response = "No se pudo crear el directorio de carpetas. Interpretacion.";
            break;
        }

        #$imagenes = $master->guardarFiles($_FILES, "capturas", $dir, "CAPTURA_RX_$turno_id");
        $interpretacion = $master->guardarFiles($_FILES, "interpretacion", "../".$ruta_saved, "INTERPRETACION_ULTRASONIDO_$turno_id");

        $response = $master->insertByProcedure("sp_imagenologia_resultados_g", [$id_imagen,$turno_id,$interpretacion[0]['URL'],$usuario,$area_id]);

        # insertar el formulario de bimo.
        $response2 = $master->insertByProcedure("sp_imagen_detalle_g", [$id_rayo,$turno_id,$servicio_id,$hallazgo,$inter_texto,$usuario,$comentario]);
        break;
    case 2:
        # insertamos las capturas.
        $ruta_saved = "reportes/modulo/ultrasonido/$turno_id/capturas/";
        $r = $master->createDir("../".$ruta_saved);

        if($r!=1){
            $response = "No se pudo crear el directorio de carpetas. Capturas.";
            break;
        }

        $capturas = $master->guardarFiles($_FILES, "capturas", "../" . $ruta_saved, "CAPTURAS_ULTRASONIDO_$turno_id");


        $response = $master->insertByProcedure('sp_capturas_imagen_g',[null, $turno_id,$servicio_id,json_encode($capturas),$comentario,$usuario]);
        break;
    case 3:
        # recuperar las capturas
        $response = array();
        #recupera la interpretacion.
        $area_id = 11; # 11 es el id para ultrasonido.
        $response1 = $master->getByNext('sp_imagenologia_resultados_b', [$id_imagen,$turno_id,$area_id]);

        # recupera la capturas del turno.
        # necesitamos enviarle el area del estudio para hacer el filtro.
        $response2 = $master->getByProcedure('sp_capturas_imagen_b', [$turno_id,$area_id]);

        $capturas = [];
        foreach($response2 as $current){
            $current['CAPTURAS'] = json_decode($current['CAPTURAS'],true);
            $capturas[] = $current;
        }

        $response["PDF"] = $response1[0];
        $response['DETALLE'] = $response1[1];
        $response['CAPTURAS'] = $capturas; 
      
        break;
    default:
        $response = "Api no definida.";
        break;
}
echo $master->returnApi($response);
?>