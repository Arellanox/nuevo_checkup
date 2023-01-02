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

# Datos para las capturas
$servicio_id = $_POST['servicio_id'];
$comentario = $_POST['comentario'];

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
        $interpretacion = $master->guardarFiles($_FILES, "interpretacion", "../".$ruta_saved, "INTERPRETACION_RX_$turno_id");

        $response = $master->insertByProcedure("sp_imagenologia_resultados_g", [$id_imagen,$turno_id,$interpretacion[0]['URL'],$usuario]);
        break;
    case 2:
        # insertamos las capturas.
        $ruta_saved = "reportes/modulo/ultrasonido/$turno_id/capturas/";
        $r = $master->createDir("../".$ruta_saved);

        if($r!=1){
            $response = "No se pudo crear el directorio de carpetas. Capturas.";
            break;
        }

        $capturas = $master->guardarFiles($_FILES, "capturas", "../" . $ruta_saved, "CAPTURAS_RX_$turno_id");


        $response = $master->insertByProcedure('sp_capturas_imagen_g',[null, $turno_id,$servicio_id,json_encode($capturas),$comentario,$usuario]);
        break;
    case 3:
        # recuperar las capturas

        #recupera la interpretacion.
        $response = $master->getByProcedure('sp_imagenologia_resultados_b', [$id_imagen,$turno_id]);

        # recupera la capturas del turno.
        # necesitamos enviarle el area del estudio para hacer el filtro.
        $area_id = 11; # 11 es el id de ultrasonido.
        $response2 = $master->getByProcedure('sp_capturas_imagen_b', [$turno_id,$area_id]);

        $capturas = [];
        foreach($response2 as $current){
            $current['CAPTURAS'] = json_decode($current['CAPTURAS'],true);
            $capturas[] = $current;
        }

        $response[0]['CAPTURAS'] = $capturas;
        break;
    default:
        break;
}
echo $master->returnApi($response);
?>