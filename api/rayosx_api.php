<?php
require_once "../clases/token_auth.php";
include_once '../clases/master_class.php';
include_once "../clases/Pdf.php";

$tokenVerification = new TokenVerificacion();
$tokenValido = $tokenVerification->verificar();
if (!$tokenValido) {
   # $tokenVerification->logout();
   # exit;
}


$master = new Master();
$id_rayo = $_POST['id_rayo'];
$api = $_POST['case'];
$turno_id = $_POST['turno_id'];
$usuario = $_SESSION['id'];
$servicio_id = $_POST['servicio_id'];


switch ($api) {
    case 1:
        #creamos el directorio donde se va a guardar la informacion del turno
        $dir = "../reportes/modulo/rayosx/$turno_id/";
        $r = $master->createDir($dir);

        if($r!=1){
            $response = "No se puedo crear el directorio de carpetas";
            break;
        }

        $imagenes = $master->guardarFiles($_FILES, "capturas", $dir, "CAPTURA_RX_$turno_id");
        $interpretacion = $master->guardarFiles($_FILES, "interpretacion", $dir, "INTERPRETACION_RX_$turno_id");

        if(!empty($interpretacion)){
            $tipo = 1;
        } else {
            $tipo = 2;
        }

        $response = $master->insertByProcedure('sp_rayosx_resultados_g',[$id_rayo,$turno_id,$interpretacion[0]['url'],json_encode($imagenes),$usuario,$tipo,$servicio_id]);
        break;

    case 2:
        # recuperar los resultados de rayos x
        $res = $master->getByProcedure('sp_rayosx_resultados_b',[$id_rayo,$turno_id]);
        $response = [];
        foreach($response as $item){
            $item['CAPTURAS'] = json_decode($item['CAPTURAS'], true);
            $response[] = $item;
        }
        break;
    default:
        $response = "Api no definida.";
        break;
}

echo $master->returnApi($response);
?>