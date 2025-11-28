<?php
require_once "../clases/master_class.php";
require_once "../clases/token_auth.php";

$tokenVerification = new TokenVerificacion();
$tokenValido = $tokenVerification->verificar();
if (!$tokenValido) {
    // $tokenVerification->logout();
    // exit;
}

$master = new Master();
$api = $_REQUEST["api"];
$fecha = $_REQUEST['fecha_inicio'];

# registro
$id_cimmo = $_POST["id_cimmo"];
$id_paciente = $_POST['id_paciente'];
$nombre = $_POST['paciente'];
$nacimiento = $_POST['nacimiento'];
$edad = $_POST['edad'];
$sexo = $_POST['sexo'];
$usuario_id = $_SESSION['id'];


# resultados
$vih = $_POST["vih"];
$vhb = $_POST["vhb"];
$vhc = $_POST["vhc"];
$observaciones = $_POST['observaciones'];

$inicio = $_POST["fecha_inicio"];
$fin = $_POST["fecha_fin"];

switch($api){
    case 1:
        # registro/actualizacion de pacientes
        $response = $master->insertByProcedure("sp_cimmo_pacientes_registro_g", [
            $id_cimmo,
            $id_paciente,
            $nombre,
            $nacimiento,
            $edad,
            $sexo,
            $usuario_id
        ]);
        break;
    case 2:
        #registro/actualizacion de resultados
        $response = $master->updateByProcedure("sp_cimmo_pacientes_resultados_g", [
            $id_cimmo,
            $vih,
            $vhb,
            $vhc,
            $usuario_id,
            $observaciones
        ]);
        break;
    case 3:
        # recuperar lista de trabajo
        $response = $master->getByProcedure("sp_cimmo_pacientes_b", [$id_cimmo, $inicio, $fin]);
        break;

    case 4:
        # confirmar
        $response = $master->updateByProcedure("sp_cimmo_pacientes_confirmar",[$id_cimmo]);

        # crear el reporte
        $url = $master->reportador($master, $id_cimmo, -14, 'cimmo', 'url');
        $response = $master->updateByProcedure('sp_cimmo_actualizar_ruta', [$id_cimmo, $url]);
        break;
    case 5:
        # descargar el modulo de cimmo
        $urls = $master->getByProcedure('sp_cimmo_get_pdfs', [$fecha]);

        $reportes = [];
        foreach($urls as $url){
            $reportes[] = $url['REPORTE'];
        }

        if(count($reportes) == 0){
            echo "<h1>NO EXISTEN REPORTES PARA DESCARGAR DEL DIA SELECCIONADO</h1>";
            exit;
        }

        // 2️⃣ CREAR ZIP EN MEMORIA
        $zip = new ZipArchive();
        $zipName = "cimmo_" . date("Ymd_His") . ".zip";

        if ($zip->open($zipName, ZipArchive::CREATE | ZipArchive::OVERWRITE) !== TRUE) {
            die("No se pudo crear el archivo ZIP");
        }

        foreach ($reportes as $url) {

            if (empty($url)) continue;

            $archivo = basename($url);
            $contenido = file_get_contents($url);

            if ($contenido !== false) {
                $zip->addFromString($archivo, $contenido);
            }
        }

        $zip->close();

        // 3️⃣ DESCARGAR
        header("Content-Type: application/zip");
        header("Content-Disposition: attachment; filename=$zipName");
        header("Content-Length: " . filesize($zipName));

        readfile($zipName);

        // 4️⃣ BORRAR
        unlink($zipName);
        
        exit;
        break;
    default:
        $response = "API no definida";
}

echo $master->returnApi($response);