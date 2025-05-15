<?php

require_once "../clases/master_class.php";
require_once "../clases/token_auth.php";
include "../clases/correo_class.php";

$tokenVerification = new TokenVerificacion();
$tokenValido = $tokenVerification->verificar();

$master = new Master();

$api = $_POST['api'];
$turno_id = $_POST['turno_id'];
$hash = $_POST['hash'];
$fecha_vigencia = $_POST['fecha_vigencia'];

$host = $_SERVER['SERVER_NAME'] === "localhost"
    ? "http://localhost/nuevo_checkup/"
    : "https://bimo-lab.com/nuevo_checkup/";

$vigencia = $_POST['vigencia'];
$grado_salud = $_POST['grado_salud'];
$fecha_vigencia = $_POST['fecha_vigencia'];
$aptitud_trabajo = $_POST['aptitud_trabajo'];
$tipo_examen_medico = $_POST['tipo_examen_medico'];

switch ($api) {
    case 1:
        # Guardar el pdf del certificado medico del paciente
        $dir = '../reportes/modulo/certificados_medicos/';
        $r = $master->createDir($dir);
        $certificado = $master->guardarFiles($_FILES, 'certificado-medico', $dir, "CERTIFICADO_MEDICO_$turno_id");
        $ruta_certificado = str_replace("../", $host, $certificado[0]['url']);
        $response = $master->insertByProcedure("sp_certificados_medicos_tmp_g", [$turno_id, $ruta_certificado]);
        break;
    case 2:
        $response = $master->getByProcedure("sp_certificados_medicos_tmp_b", [$turno_id]);
        break;
    case 3:
        $validarConsultaMedicaTerminada = $master->getByProcedure("sp_consultorio_certificado_b", [
            $turno_id, null
        ]);

        if (count($validarConsultaMedicaTerminada) > 0) {
            #CREAR CERTIFICADO
            $QR_NAME = 'CertificadoMedico-' . $turno_id . '-' . date('Y-m-d');
            $HASH = generarHashCertificado($turno_id, 'Pruebas');
            $QR_URL = $host."vista/certificado/?codigo=".$HASH;
            $PDF_URL = $master->reportador($master, $turno_id, -10, "certificado_bimo", 'url');
            $QR_IMG_LOCATION = $master->generarQRURL("CertificadoMedico", $QR_URL, $QR_NAME, QR_ECLEVEL_H);

            $master->insertByProcedure("sp_consultorio_certificado_g", [
                $turno_id, $QR_IMG_LOCATION, $PDF_URL, $QR_URL, $vigencia, $fecha_vigencia,
                $grado_salud, $tipo_examen_medico, $aptitud_trabajo, $_SESSION['id'], $HASH
            ]);

            $attachment = $master->cleanAttachFilesImage($master, $turno_id, 10, 1);

            if (!empty($attachment[0])) {
                $mail = new Correo();
                if ($mail->sendEmail('resultados', '[bimo] Resultados de consulta', [$attachment[1]], null, $attachment[0], 1, $turno_id, 1, $master)) {
                    $master->setLog("Correo enviado.", "Consulta");
                }
            }

            $response = $master->getByProcedure("sp_consultorio_certificado_b", [$turno_id, null]);
        } else $response = 'Debes terminar la consulta médica para generar el certificado medico.';

        break;
    case 4:
        #Recuperar certificado
        $response = $master->getByProcedure("sp_consultorio_certificado_b", [null, $hash]);
        break;
    default:
        $response = "Api no definida.";
}

function generarHashCertificado($idTurno, $nombrePaciente, $fechaActual = null): string
{
    if (!$fechaActual) {
        $fechaActual = date('Y-m-d H:i:s');
    }

    $cadena = $idTurno . '|' . $nombrePaciente . '|' . $fechaActual . '|' . bin2hex(random_bytes(4));
    return hash('sha256', $cadena);
}

echo $master->returnApi($response);

