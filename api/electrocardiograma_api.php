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

$comentario = isset($_POST['comentario']) ? $_POST['comentario'] : '';# el id 10 es para el area de ELECTROCARDIOGRAMA

$master = new Master();
$api = isset($_POST['api']) ? $_POST['api'] : '';
# Datos para la interpretacion
$id_electro = isset($_POST['id_electro']) ? $_POST['id_electro'] : null;
$turno_id = isset($_POST['turno_id']) ? $_POST['turno_id'] : '';
$fecha_registro = isset($_POST['fecha_registro']) ? $_POST['fecha_registro'] : '';
$registrado_por = isset($_POST['registrado_por']) ? $_POST['registrado_por'] : '';
$folio = isset($_POST['folio']) ? $_POST['folio'] : '';
$usuario = $_SESSION['id'];
$host = $_SERVER['SERVER_NAME'] == "localhost" ? "http://localhost/nuevo_checkup/" : "https://bimo-lab.com/nuevo_checkup/";
$date = date("dmY_His");

switch($api){
    case 1:
        # insertar la interpretacion
        #creamos el directorio donde se va a guardar la informacion del turno
        $ruta_saved = "reportes/modulo/electrocardiograma/$date/$turno_id/interpretacion/";
        $r = $master->createDir("../".$ruta_saved);

        if($r!=1){
            $response = "No se pudo crear el directorio de carpetas. Interpretacion.";
            break;
        }

        #$imagenes = $master->guardarFiles($_FILES, "capturas", $dir, "CAPTURA_RX_$turno_id");
        $interpretacion = $master->guardarFiles($_FILES, "reportes", "../".$ruta_saved, "INTERPRETACION_ELECTROCARDIOGRAMA_$turno_id");

        $ruta_archivo = str_replace("../", $host, $interpretacion[0]['url']);

        $last_id = $master->insertByProcedure("sp_electro_resultados_g", [null, $turno_id, $ruta_archivo, $usuario, $comentario]);

        // # insertar el formulario de bimo.  
        // foreach($formulario as $id_servicio => $item){
        //      $res = $master->insertByProcedure('sp_imagen_detalle_g', [null, $turno_id, $id_servicio, $item['hallazgo'], $item['interpretacion'], $item['comentario'], $last_id]);
        // }
        
        #enviamos como respuesta, el ultimo id insertado en la tabla imagenologia resultados.

        // $url = crearReporteUltrasonido($turno_id, $comentario);
        // $res_url = $master->updateByProcedure("sp_imagenologia_resultados_g", [$last_id, null, null, null, null, $url]);
        $response = $last_id;
    break;
    case 3: 
        # recuperar las capturas
        // $response = array();
        #recupera la interpretacion.
        $response = $master->getByProcedure('sp_electro_resultados_b', [$id_electro,$turno_id]);

        # recupera los archivos del turno.
        # necesitamos enviarle el area del estudio para hacer el filtro.
       // $response2 = $master->getByProcedure('sp_electro_archivos_b', [$turno_id]);

        // $capturas = [];
        // foreach ($response2 as $current) {
        //     $capturas[] = $current['ARCHIVO'];
        // }

        // $response = $capturas;
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