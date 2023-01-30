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

$area_id = 4; #$_POST['area_id']; # el id 4 es para el area de AUDIOMETRIA

$master = new Master();
$api = isset($_POST['api']) ? $_POST['api'] : '';
# Datos para la interpretacion
$id_audiometria = $_POST['id_audiometria'];
$turno_id = $_POST['turno_id'];
$registrado_por =  $_SESSION['id'];
$motivo_de_la_consulta = $_POST['motivo_consulta'];
$antecedentes = $_POST['antecedentes'];
$exploracion_fisica = $_POST['exploracion'];
$otoscopia = $_POST['otoscopia'];
$oido_derecho = $_POST['oido_derecho'];
$oido_izquierdo = $_POST['oido_izquierdo'];
$confirmado = $_POST['confirmado'];
$estudio_od = $_POST['estudio_od'];
$estudio_oi = $_POST['estudio_oi'];

switch($api){
    case 1:
        if (isset ($confirmado)) {
            
        }else{
            $response = $master -> insertByProcedure('sp_audiometria_resultados_g',[$id_audiometria, $turno_id, $registrado_por, $motivo_de_la_consulta, $antecedentes, $exploracion_fisica, $otoscopia, $oido_derecho, $oido_izquierdo, $confirmado]);
            }

        break;
    case 2:
        $serv = str_replace(" ", "_", $nombre_servicio);
        #creamos el directorio donde se va a guardar la informacion del turno
        $ruta_saved = "reportes/modulo/audiometria/$date/$turno_id/capturas/";
        $r = $master->createDir("../" . $ruta_saved);

        if ($r != 1) {
            $response = "No se pudo crear el directorio de carpetas. Capturas.";
            break;
        }

        # subimos las capturas al servidor.
        # combinar la ruta_saved con ../ sirve para crear la ruta el directorio en el servidor
        # por si no existe aun.
        # se necesita formatear la ruta para agregarle el la url completa de internet.
        $capturas = $master->guardarFiles($_FILES, "capturas", "../" . $ruta_saved, "CAPTURAS_AUDIOMETRIA_$serv");

        # formateamos la ruta de los archivos para guardarlas en la base de datos
        for ($i = 0; $i < count($capturas); $i++) {
            $capturas[$i]['url'] = str_replace("../", $host, $capturas[$i]['url']);
        }

        # insertamos en la base de datos.
        $response = $master->insertByProcedure('sp_capturas_imagen_g', [null, $turno_id, $servicio_id, json_encode($capturas), $comentario, $usuario]);
        break;
    case 3:
        # recuperar las capturas
        $response = array();
        #recupera la interpretacion.
        $response1 = $master->getByNext('sp_imagenologia_resultados_b', [$id_imagen, $turno_id, $area_id]);

        # recupera la capturas del turno.
        # necesitamos enviarle el area del estudio para hacer el filtro.
        $response2 = $master->getByProcedure('sp_capturas_imagen_b', [$turno_id, $area_id]);

        $capturas = [];
        foreach ($response2 as $current) {
            $capturas_child = [];
            foreach (json_decode($current['CAPTURAS'], true) as $item) {
                $capturas_child[] = json_decode($item, true);
            }
            $current['CAPTURAS'] = $capturas_child;
            $capturas[] = $current;
        }

        $merge = [];
        for ($i = 0; $i < count($response1[0]); $i++) {
            $id_imagenologia = $response1[0][$i]['ID_SERVICIO'];
            $servicio = $response1[0][$i]['ID_SERVICIO'];

            $subconjunto = array_filter($response1[1], function ($obj) use ($id_imagenologia) {
                $r = $obj['SERVICIO_ID'] == $id_imagenologia;
                return $r;
            });

            $subconjunto = $master->getFormValues($subconjunto);


            $sub_caps = array_filter($capturas, function ($obj) use ($servicio) {
                $r = $obj['ID_SERVICIO_CAP'] == $servicio;
                return $r;
            });

            $sub_caps = $master->getFormValues($sub_caps);

            $m = array_merge($response1[0][$i], isset($subconjunto[0]) ? $subconjunto[0] : array());
            $m['CAPTURAS'] = $sub_caps;

            $merge[] = $m;
        }

        $response = $merge;
        break;
    default:
        $response = "Api no definida.";
        break;
}
echo $master->returnApi($response);


?>