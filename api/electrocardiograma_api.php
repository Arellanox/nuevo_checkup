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
$turno_id = $_POST['id_turno'];
$id_electro = $_POST['id_electro'];
$comentario = $_POST['comentario'];
$tecnica = $_POST['tecnica'];
$hallazgo = $_POST['hallazgo'];
$interpretacion = $_POST['interpretacion'];
$usuario = $_SESSION['id'];
$confirmado = $_POST['confirmado'];
$archivo = $_POST['electro_pdf'];

# Datos para el sistema
$host = $_SERVER['SERVER_NAME'] == "localhost" ? "http://localhost/nuevo_checkup/" : "https://bimo-lab.com/nuevo_checkup/";
$date = date("dmY_His");

switch ($api) {
    case 1:
        # insertar la interpretacion
        if (isset($confirmado)) {
            // confirmamos y creamos el reporte.
            $url = $master->reportador($master, $turno_id, 10, "electro", "url", 0, 0, 0);

            # combinar el reporte de bimo con el pdf del electro y guardarlo en la misma ruta
            $electro_search = $master->getByProcedure("sp_electro_resultados_b",[null,$turno_id,null]);
            $img_electro = $electro_search[array_key_first($electro_search)]['ARCHIVO'];

            $reporte_final = "combinacion de reporte bimo con el electrocargiograma";
            
            $response = $master->updateByProcedure("sp_electro_resultados_g", [$id_electro, $turno_id, null, $usuario, $comentario, $interpretacion, $tecnica, $hallazgo, $url, $confirmado, null]);
        } else {
            // solo guardamos la informacion del reporte. Sin confirmar
            $response = $master->getByProcedure("sp_electro_resultados_b", [null, $turno_id, null]);

            if (isset($response[0]['ARCHIVO'])) {
                $response = "Ya existe un electrocardiograma para este paciente.";
                break;
            }

            //mover el archivo con la imagen de electro a la caperta del turno.
            if (isset($archivo)) {
                $destination = "../reportes/modulo/electro/$turno_id/";
                $r = $master->createDir($destination);
                $dir = explode("nuevo_checkup", $archivo);

                $folder = $master->scanDirectory($destination);
               
                //borrar el archivo anterior, si existe
                if(!empty($folder)){
                    foreach($folder as $file){
                        unlink($file);
                    }
                }

                if (copy(".." . $dir[1], $destination . basename($archivo))) {
                    # si se copia correctamente, borramos el archivo de la carpeta generica.
                    unlink('..'.$dir[1]);
        
                    #guardarmos la direccion del electro.
                    $response = $master->insertByProcedure("sp_electro_resultados_g", [$id_electro, $turno_id, $host . "reportes/modulo/electro/$turno_id/".basename($archivo), null, $comentario, $interpretacion, $tecnica, $hallazgo, null, null, $usuario]);
                }
               
            } else {
                #guardarmos la direccion del electro.
                $response = $master->insertByProcedure("sp_electro_resultados_g", [$id_electro, $turno_id, null, null, $comentario, $interpretacion, $tecnica, $hallazgo, null, null, $usuario]);
            }
        }
        break;
    case 2:
        #buscar
        $response = $master->getByProcedure("sp_electro_resultados_b", [null,$turno_id,null] );
         break;
    case 3:
        # recuperar los electros de la carpeta global
        $folder = "../electro_img/";

        $electros = scandir($folder);

        $files = [];
        for ($i = 0; $i < count($electros); $i++) {
            if ($i > 1) {
                $path = $host . "electro_img/" . $electros[$i];
                $files[] = [$path, $electros[$i]];
            }
        }
        $response = $files;
        break;
    case 4:
        print_r($master->scanDirectory('../electro_img/'));
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
