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
$date = date("dmY_His");

switch($api){
    case 1:
        # insertar la interpretacion
        #creamos el directorio donde se va a guardar la informacion del turno
        $ruta_saved = "reportes/modulo/rayosx/$date/$turno_id/interpretacion/";
        $r = $master->createDir("../".$ruta_saved);
        
        if($r!=1){
            $response = "No se pudo crear el directorio de carpetas. Interpretacion.";
            break;
        }

        #$imagenes = $master->guardarFiles($_FILES, "capturas", $dir, "CAPTURA_RX_$turno_id");
        $interpretacion = $master->guardarFiles($_FILES, "reportes", "../".$ruta_saved, "INTERPRETACION_RX_$turno_id");

        $ruta_archivo = str_replace("../", $host, $interpretacion[0]['url']);

        $last_id = $master->insertByProcedure('sp_imagenologia_resultados_g',[$id_imagen,$turno_id,$ruta_archivo,$usuario,$area_id,null]);

        # insertar el formulario de bimo.
        foreach($formulario as $id_servicio => $item){
            $res = $master->insertByProcedure('sp_imagen_detalle_g',[null,$turno_id,$id_servicio,$item['hallazgo'],$item['interpretacion'],$item['comentario'],$last_id]);
        }

        #enviamos como respuesta, el ultimo id insertado en la tabla imagenologia resultados.
        $url = crearReporteUltrasonido($turno_id, $area_id);
        $res_url = $master->updateByProcedure("sp_imagenologia_resultados_g", [$last_id,null,null,null,null,$url]);
        $response = $last_id;  
        break;
    case 2:
        $turno_id = $_POST['turno_id'];
        $nombre_servicio = $_POST['nombre_servicio'];
        $serv = str_replace(" ", "_", $nombre_servicio);
        #creamos el directorio donde se va a guardar la informacion del turno
        $ruta_saved = "reportes/modulo/rayosx/$date/$turno_id/capturas/";
        $r = $master->createDir("../".$ruta_saved);
        
        if($r!=1){
            $response = "No se pudo crear el directorio de carpetas. Capturas.";
            break;
        }

        # subimos las capturas al servidor.
        # combinar la ruta_saved con ../ sirve para crear la ruta el directorio en el servidor
        # por si no existe aun.
        # se necesita formatear la ruta para agregarle el la url completa de internet.
        $capturas = $master->guardarFiles($_FILES, "capturas", "../" . $ruta_saved, "CAPTURAS_RX_$serv");

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
        #recupera la interpretacion.
        $area_id = 11; # 11 es el id para ultrasonido.
        $response1 = $master->getByNext('sp_imagenologia_resultados_b', [$id_imagen,$turno_id,$area_id]);

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
        for ($i=0; $i < count($response1[1]); $i++) {
            $id_imagen = $response1[1][$i]['IMAGEN_ID'];
            $servicio =  $response1[1][$i]['ID_SERVICIO'];

            $subconjunto = array_filter($response1[0], function ($obj) use ($id_imagen) {
                $r = $obj['ID_IMAGENOLOGIA'] == $id_imagen;
                return $r;
            });


            $sub_caps = array_filter($response2, function ($obj) use ($servicio) {
                $r = $obj['ID_SERVICIO'] == $servicio;
                return $r;
            });

            $capturas = [];
            foreach($sub_caps as $sub){
                $sub['CAPTURAS'] = json_decode($sub['CAPTURAS'], true);
                $cap = [];
                foreach($sub['CAPTURAS'] as $s){
                    $cap[] = json_decode($s, true);
                }
                $sub['CAPTURAS'] = $cap;
                $capturas[] = $sub;
            }
    
            $m = array_merge($response1[1][$i], $subconjunto[0]);
            $m['CAPTURAS'] = $capturas;
        
            $merge[] = $m;
        }

        # si algo falla por favor de comentar esta linea y decomentar las lineas 110,111,112
        $response = $merge;       
        break;
    case 4:
        #recuperar la informacion del Reporte de interpretacion de Rayos-x
        $response = array();
        # recuperar los resultados de rayos x
        $area_id = 8; # 8 es el id para rayosx.
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
                    "INTERPRETACION" => $servicioimg,
                    "COMENTARIO" => $comentario,

                );
                array_push($arrayimg, $array1);
            }

            $arregloPaciente = array(
                'NOMBRE' => $infoPaciente[0]['NOMBRE'],
                "EDAD" => $infoPaciente[0]['EDAD'],
                'SEXO' => $infoPaciente[0]['SEXO'],
                'FECHA_RESULTADO' => $response1[1][0]['FECHA_RESULTADO'],
                'ESTUDIOS' => $arrayimg
            );
            // print_r($arregloPaciente);
            $response = $arregloPaciente;

        break;
    case 5:
        crearReporteRayosX($turno_id, $area_id);
        break;
    default:
        $response = "Api no definida...";
        break;
}
echo $master->returnApi($response);

function crearReporteRayosX($turno_id,$area_id){
    $master = new Master();
    #Recuperar info paciente
    $infoPaciente = $master->getByProcedure('sp_informacion_paciente', [$turno_id]);
    $infoPaciente = [$infoPaciente[count($infoPaciente) - 1]];

    #recuperar la informacion del Reporte de interpretacion de ultrasonido
    $response = array();
    # recuperar los resultados de ultrasonido
    $area_id = 11; #11 es el id para ultrasonido.
    $response1 = $master->getByNext('sp_imagenologia_resultados_b', [null,$turno_id,$area_id]);

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

    # pie de pagina
    $fecha_resultado = $infoPaciente[0]['FECHA_CARPETA_IMAGEN'];
    $nombre_paciente = $infoPaciente[0]['NOMBRE'];
    $nombre = str_replace(" ", "_", $nombre_paciente);

    $ruta_saved = "reportes/modulo/rayos_x/$fecha_resultado/$turno_id/";

    # Crear el directorio si no existe
    $r = $master->createDir("../" . $ruta_saved);
    $archivo = array("ruta" => $ruta_saved, "nombre_archivo" => $nombre . "-" . $infoPaciente[0]['TURNO'] . '-' . $fecha_resultado);

    $pie_pagina = array("clave" => $infoPaciente[0]['CLAVE'], "folio" => $infoPaciente[0]['FOLIO_IMAGEN'], "modulo" => 8);
    $pdf = new Reporte(json_encode($arregloPaciente), json_encode($infoPaciente[0]), $pie_pagina, $archivo, 'ultrasonido', 'url');
    $pdf->build();

    print_r($arregloPaciente);
}
?>