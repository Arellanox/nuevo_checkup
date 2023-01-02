<?php
session_start();
include_once "../clases/master_class.php";
require_once "../clases/token_auth.php";
include_once "../clases/Pdf.php";

$tokenVerification = new TokenVerificacion();
$tokenValido = $tokenVerification->verificar();
if (!$tokenValido) {
    // $tokenVerification->logout();
    // exit;
}

$master = new Master();
$id_espirometria = isset($_POST['id_espirometria']) ? $_POST['id_espirometria'] : null;
$api = isset($_POST['api']) ? $_POST['api'] : null;
$id_turno = isset($_POST['turno_id']) ? $_POST['turno_id'] : null;
$interpretacion = isset($_POST['interpretacion']) ? $_POST['interpretacion'] : null;
$capturas = isset($_POST['capturas']) ? $_POST['capturas'] : null;
$usuario = isset($_SESSION['id']) ? $_SESSION['id'] : null;

$imagenes = array();
switch ($api) {
    case 1:
        # carpeta de destino para los reportes
        $destination = "/archivos/reportes/";
        $destinatio_sql = "http://".$_SERVER['SERVER_NAME']."/nuevo_checkup";

        $area_label = "espirometria";

        $dir = ".." . $destination . $area_label . '/' . $id_turno . "/";
        $dir_base = $destination . $area_label . '/' . $id_turno . "/";

        if (!is_dir($dir)) {
            if (!mkdir($dir, 0777, true)) {
                echo "no pudo crear el directorio. $dir";
                exit;
            }
        }

        if (!empty($_FILES['reportes']['name'])) {
            $next = 0;

            $extension = pathinfo($_FILES['reportes']['name'], PATHINFO_EXTENSION);

            # obtenemos la ruta temporal del archivo
            $tmp_name = $_FILES['reportes']['tmp_name'];

            $tipo_label = "INTERPRETACION";

            // if ($tipo == 2) {
            //     $tipo_label = "CAPTURA";
            // }

            $id_servicio = 359;
            $url = "$destinatio_sql$dir_base$id_turno" . "_$id_servicio" . "_$tipo_label" . "_$next." . $extension;

            $imagenes = array('URL' => $url, 'EXTENSION' => $extension);
            // if ($tipo == 2) {
            // }

            #insertamos el registro en la tabla de resultados reportes
            $response = $master->insertByProcedure('sp_espirometria_resultados_g', [$id_turno, $id_servicio, $url, json_encode($imagenes), $usuario]);
            print_r($response);
            if (is_numeric($response)) {
                #cambiamos de lugar el archivo
                try {
                    move_uploaded_file($tmp_name, $dir . $id_turno . "_$id_servicio" . "_$tipo_label" . "_$next." . $extension);
                } catch (\Throwable $th) {
                    # si no se puede subir el archivo, desactivamos el resultado que se guardo en la base de datos
                    // $e = $master->deleteByProcedure('sp_resultados_reportes_e', [$response[0]['LAST_ID']]);
                }
            }

           // echo $master->returnApi($response);
        } else {
            echo "No hay archivos.";
        }

        // $response = $master->insertByProcedure('sp_espirometria_resultados_g',[$id_espirometria,$turno_id,$interpretacion[0]['url'],json_encode($imagenes),$usuario]);
        // echo $imagenes;
        break;
    case 2:
        # recuperar los resultados de rayos x
        $res = $master->getByProcedure('sp_espirometria_resultados_b',[$id_espirometria,$turno_id]);
        print_r($res);
        // $response = [];
        // foreach($response as $item){
        //     $item['CAPTURAS'] = json_decode($item['CAPTURAS'], true);
        //     $response[] = $item;
        // }
        break;
    default:
        $response = "Api no definida.";
        break;
}

// echo $master->returnApi($response);
?>