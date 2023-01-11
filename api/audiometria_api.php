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
$id_audiometria = isset($_POST['id_audiometria']) ? $_POST['id_audiometria'] : '';
$turno_id = isset($_POST['turno_id']) ? $_POST['turno_id'] : '';
$interpretacion = isset($_POST['interpretacion']) ? $_POST['interpretacion'] : '';
$fecha_registro = isset($_POST['fecha_registro']) ? $_POST['fecha_registro'] : '';
$registrado_por = isset($_POST['registrado_por']) ? $_POST['registrado_por'] : '';
$folio = isset($_POST['folio']) ? $_POST['folio'] : '';
$usuario = $_SESSION['id'];

switch($api){
    case 1:
        # insertar la interpretacion
        #creamos el directorio donde se va a guardar la informacion del turno
        // $ruta_saved = "reportes/modulo/ultrasonido/$date/$turno_id/interpretacion/";
        // $r = $master->createDir("../".$ruta_saved);

        // if($r!=1){
        //     $response = "No se pudo crear el directorio de carpetas. Interpretacion.";
        //     break;
        // }

        #$imagenes = $master->guardarFiles($_FILES, "capturas", $dir, "CAPTURA_RX_$turno_id");
        // $interpretacion = $master->guardarFiles($_FILES, "reportes", "../".$ruta_saved, "INTERPRETACION_ULTRASONIDO_$turno_id");

        // $ruta_archivo = str_replace("../", $host, $interpretacion[0]['url']);

        $last_id = $master->insertByProcedure("sp_audiometria_resultados_g", [null,$turno_id,$interpretacion,$fecha_registro,$usuario,$folio]);

        # insertar el formulario de bimo.
        // foreach($formulario as $id_servicio => $item){
        //     $res = $master->insertByProcedure('sp_imagen_detalle_g',[null,$turno_id,$id_servicio,$item['hallazgo'],$item['interpretacion'],$item['comentario'],$last_id]);
        // }
        
        #enviamos como respuesta, el ultimo id insertado en la tabla imagenologia resultados.

        // $url = crearReporteUltrasonido($turno_id, $area_id);
        // $res_url = $master->updateByProcedure("sp_imagenologia_resultados_g", [$last_id,null,null,null,null,$url]);
        $response = $last_id;
        break;
    case 2:
        // $serv = str_replace(" ", "_", $nombre_servicio);
        # insertamos las capturas.
        // $ruta_saved = "reportes/modulo/ultrasonido/$date/$turno_id/capturas/";
        // $r = $master->createDir("../".$ruta_saved);

        // if($r!=1){
        //     $response = "No se pudo crear el directorio de carpetas. Capturas.";
        //     break;
        // }

        # subimos las capturas al servidor.
        # combinar la ruta_saved con ../ sirve para crear la ruta el directorio en el servidor
        # por si no existe aun.
        # se necesita formatear la ruta para agregarle el la url completa de internet.
        // $capturas = $master->guardarFiles($_FILES, "capturas", "../" . $ruta_saved, "CAPTURAS_ULTRASONIDO_$serv");
        
        # formateamos la ruta de los archivos para guardarlas en la base de datos
        // for ($i=0; $i < count($capturas); $i++) {
        //     $capturas[$i]['url'] = str_replace("../",$host,$capturas[$i]['url']);
        // }
        
        # insertamos en la base de datos.
        $response = $master->updateByProcedure('sp_audiometria_resultados_g',[$id_audiometria,$turno_id,$interpretacion,$fecha_registro,$usuario,$folio]);
        break;
    case 3:
        # recuperar los registros de audiometria
        $response1 = $master->getByNext('sp_audiometria_resultados_b', [$id_audiometria,$turno_id]);

        # recupera la capturas del turno.
        # necesitamos enviarle el area del estudio para hacer el filtro.
        $response2 = $master->getByProcedure('sp_capturas_imagen_b', [$turno_id,$area_id]);

        $capturas = [];
        foreach($response2 as $current){
            $capturas_child = [];
            foreach(json_decode($current['CAPTURAS'],true) as $item){
                $capturas_child[] = json_decode($item, true);
            }
            $current['CAPTURAS'] = $capturas_child;
            $capturas[] = $current;

        }
    
        $merge = [];
        for ($i = 0; $i < count($response1[0]); $i++){
            $id_imagenologia = $response1[0][$i]['ID_IMAGENOLOGIA'];
            $servicio = $response1[0][$i]['ID_SERVICIO'];

            $subconjunto = array_filter($response1[1], function ($obj) use ($id_imagenologia) {
                $r = $obj['IMAGEN_ID'] == $id_imagenologia;
                return $r;
            });

            $sub_caps = array_filter($capturas, function ($obj) use ($servicio) {
                $r = $obj['ID_SERVICIO_CAP'] == $servicio;
                return $r;
            });
        
            $m = array_merge($response1[0][$i], isset($subconjunto[0]) ? $subconjunto[0] : array());
            $m['CAPTURAS'] = $sub_caps;
           
            $merge[] = $m;
        }

        $response = $merge;
        break;
    case 4:
        #Recuperar info paciente
        $infoPaciente = $master->getByProcedure('sp_informacion_paciente', [$turno_id]);
        $infoPaciente = [$infoPaciente[count($infoPaciente) - 1]];

        #recuperar la informacion del Reporte de interpretacion de ultrasonido
        $response = array();
        # recuperar los resultados de ultrasonido
        $area_id = 11; #11 es el id para ultrasonido.
        $response1 = $master->getByNext('sp_imagenologia_resultados_b', [$id_imagen,$turno_id,$area_id]);

        $arrayimg = [];

        for ($i=0; $i < count($response1[1]) ; $i++) { 
            
            $servicio = $response1[1][$i]['SERVICIO'];
            $hallazgo = $response1[1][$i]['HALLAZGO'];
            $interpretacion = $response1[1][$i]['INTERPRETACION_DETALLE'];
            $comentario = $response1[1][$i]['COMENTARIO'];
            $array1 = array(
                "ESTUDIO" => $servicio,
                "HALLAZGO" => $hallazgo,
                "INTERPRETACION" => $interpretacion,
                "COMENTARIO" => $comentario,

            );
            array_push($arrayimg, $array1);
        }

        $arregloPaciente = array(
            'NOMBRE' => $infoPaciente[0]['NOMBRE'],
            "EDAD" => $infoPaciente[0]['EDAD'],
            'SEXO' => $infoPaciente[0]['SEXO'],
            'FOLIO' => $infoPaciente[0]['FOLIO_IMAGEN'],
            'FECHA_RESULTADO' => $response1[1][0]['FECHA_RESULTADO'],
            'ESTUDIOS' => $arrayimg
        );
        // print_r($arregloPaciente);
        $response = $arregloPaciente;
        break;
    default:
        $response = "Api no definida.";
        break;
}
echo $master->returnApi($response);


?>