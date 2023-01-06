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
$id_imagen = $_POST['id_imagen'];
$formulario = $_POST['servicios'];
$hallazgo = $_POST['hallazgo'];
$inter_texto = $_POST['inter_texto'];
$host = isset($_SERVER['SERVER_NAME']) ? "http://localhost/nuevo_checkup/" : "https://bimo-lab.com/nuevo_checkup/" ;

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
        $interpretacion = $master->guardarFiles($_FILES, "reportes", "../".$ruta_saved, "INTERPRETACION_RX_$turno_id");

        $ruta_archivo = str_replace("../", $host, $interpretacion[0]['url']);

        $last_id = $master->insertByProcedure('sp_imagenologia_resultados_g',[$id_imagen,$turno_id,$ruta_archivo,$usuario,$area_id]);

        # insertar el formulario de bimo.
        foreach($formulario as $item){
            $res = $master->insertByProcedure('sp_imagen_detalle_g',[null,$turno_id,$id_servicio,$item['hallazgo'],$item['interpretacion'],$item['comentario'],$last_id]);
        }

        #enviamos como respuesta, el ultimo id insertado en la tabla imagenologia resultados.
        $response = $last_id;  
        break;
    case 2:
        $turno_id = $_POST['turno_id'];
        #creamos el directorio donde se va a guardar la informacion del turno
        $ruta_saved = "reportes/modulo/rayosx/$turno_id/capturas/";
        $r = $master->createDir("../".$ruta_saved);
        
        if($r!=1){
            $response = "No se pudo crear el directorio de carpetas. Capturas.";
            break;
        }

        # subimos las capturas al servidor.
        # combinar la ruta_saved con ../ sirve para crear la ruta el directorio en el servidor
        # por si no existe aun.
        # se necesita formatear la ruta para agregarle el la url completa de internet.
        $capturas = $master->guardarFiles($_FILES, "capturas", "../" . $ruta_saved, "CAPTURAS_RX_$turno_id");

        # formateamos la ruta de los archivos para guardarlas en la base de datos
        for ($i=0; $i < count($capturas); $i++) {
            $capturas[$i]['url'] = str_replace("../",$host,$capturas[$i]['url']);
        }

        # insertamos en la base de datos.
        $response = $master->insertByProcedure('sp_capturas_imagen_g',[null, $turno_id,$servicio_id,json_encode($capturas),$comentario,$usuario]);
        break;
    case 3:
        # recuperar las capturas
        $response = array();
        # recuperar los resultados de rayos x
        $area_id = 8; # 8 es el id para rayosx.
        $response1 = $master->getByNext('sp_imagenologia_resultados_b', [$id_imagen,$turno_id,$area_id]);

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