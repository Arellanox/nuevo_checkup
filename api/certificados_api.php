<?php

use NumberToWords\Language\Arabic\ArabicDictionary;

require_once "../clases/master_class.php";
require_once "../clases/token_auth.php";
include "../clases/correo_class.php";

$tokenVerification = new TokenVerificacion();
$tokenValido = $tokenVerification->verificar();
if (!$tokenValido) {
    // $tokenVerification->logout();
    // exit;
}

$master = new Master();
$api = $_POST['api'];
$registrado_por = $_SESSION['id'];

# variables para lista de trabajo.
$fecha = isset($_POST['fecha_busqueda']) ? $_POST['fecha_busqueda'] : null;
$host = $_SERVER['SERVER_NAME'] == "localhost" ? "http://localhost/nuevo_checkup/" : "https://bimo-lab.com/nuevo_checkup/";
$host_2 = $master->selectHost($_SERVER['SERVER_NAME']);
# variables para certificado slb
$turno_id = $_POST['turno_id'];
$cliente_id = $_POST['cliente_id'];

# datos para guardar el certificado de slb
$nombre_medico = $_POST['nombre_medico'];
$cedula_medico = $_POST['cedula_medico'];
$nombre_paciente = $_POST['nombre_paciente'];
$fecha_nacimiento_paciente = $_POST['fecha_nacimiento_paciente'];
$segmento = $_POST['segmento'];
$categoria = $_POST['categoria'];
$apto = $_POST['apto'];
$comentarios_apto = $_POST['apto_comentarios'];
$antidoping = $_POST['antidoping'];
$grupo_sangre = $_POST['grupo_sangre'];
$add = $_POST['add'];
$tipo = $_POST['tipo_certificado'];

$certificado_slb = array(
    "nombre_medico" => $nombre_medico,
    "cedula_medico" => $cedula_medico,
    "nombre_paciente" => $nombre_paciente,
    "fecha_nacimiento_paciente" => $fecha_nacimiento_paciente,
    "segmento" => $segmento,
    "categoria" => $categoria,
    "apto" => $apto,
    "comentarios_apto" => $comentarios_apto,
    "antidoping" => $antidoping,
    "grupo_sangre" => $grupo_sangre,
    "add" => $add
);


$confirmado = $_POST['confirmado'];
$tipo_certificado = $_POST['tipo_certificado'];


$cuerpo = json_encode($_POST['cuerpo']);


switch ($api) {
    case 1:
        # lista de trabajo para certificados.
        # pacientes que tengan cargado entre sus estudios una historia clinica.
        $response = $master->getByProcedure("sp_lista_de_trabajo_certificados", [$fecha, 1, null, null, null, $tipo]);
        break;
    case 2:
        # recuperar los datos del certificado
        $response = $master->getByProcedure("sp_certificados_b", [$cliente_id, $turno_id, $_SESSION['id'], $tipo_certificado]);
        $response = $master->decodeJsonRecursively($response);
        break;
    case 3:

        # guardar la caratula del certificado poe
        if ($tipo_certificado === "poe_general") {
            $destination = "../reportes/modulo/certificado_poe/$id_turno";
            $r = $master->createDir($destination);

            $caratula = $master->guardarFiles($_FILES, "cuerpo", $destination, "caratula_poe_$turno_id");

            $ruta_archivo = str_replace("../", $host_2, $caratula[0]['url']);
        }

        $response = $master->getByProcedure("sp_certificados_g", [
            $cuerpo,
            $turno_id,
            $cliente_id,
            $_SESSION['id'],
            $confirmado,
            $tipo_certificado,
            $ruta_archivo
        ]);

        if ($confirmado == 1) {
            # crear el reporte 
            $url = $master->reportador($master, $turno_id, -5, "certificados_medicos", 'url', $tipo_certificado);


            if ($tipo_certificado === "poe_general") {
                # tenemos que unir los 2 pdf, la caratula y el cuerpo
                $response = $master->getByProcedure("sp_certificados_b", [$cliente_id, $turno_id, $_SESSION['id'], $tipo_certificado]);
                $response = $master->decodeJsonRecursively($response);
                # sacamos la ruta de la caratula
                $ruta_caratula = $response[0]['RUTA_CARATULA'];

                if ($ruta_caratula === "") {
                    $response = "Necesita subir la caratula del certificado poe";
                    break;
                }


                //Si existe unimos el reporte con el cuestionario
                $reporte_final = $master->joinPdf([
                    "../" . explode('nuevo_checkup', $ruta_caratula)[1],
                    "../" . explode('nuevo_checkup', $url)[1]
                ]);

                $ruta_pdf_combinado = "../reportes/modulo/certificado_poe/certificado_poe_$turno_id.pdf";

                $fh = fopen($ruta_pdf_combinado, 'a');
                fwrite($fh, $reporte_final);
                fclose($fh);

                $ruta_final_pdf = str_replace('../', $host, $ruta_pdf_combinado);
            } else {
                $ruta_final_pdf = $url;
            }




            $response = $master->updateByProcedure("sp_reportes_actualizar_certificados", [
                $ruta_final_pdf,
                $turno_id,
                $tipo_certificado
            ]);
        }

        break;
    case 4:
        # lista de trabajo para certificados poe.
        # pacientes que tengan cargado entre sus estudios una historia clinica.
        $response = $master->getByProcedure("sp_lista_de_trabajo_certificados_poe", [$fecha, 1, null, null, null, $tipo]);
        break;
    default:
        $response = "API no definida.";
        break;
}

echo $master->returnApi($response);
