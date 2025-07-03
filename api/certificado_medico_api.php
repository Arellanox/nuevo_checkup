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
        try {
            # VALIDAR QUE TENGA UNA CONSULTA MEDICA REGISTRADA PREAVIAMENTE
            $response = $master->getByProcedure("sp_consultorio2_consulta_b", [$turno_id, null]);

            if (count($response) > 0) { #CREACIÓN DEL CERTIFICADO MEDICO DE VINCO
                $NOMBRE_DE_QR = 'QR-CertificadoMedico-' . $turno_id . '-' . date('Y-m-d');
                $HASH_VALIDAR_CERTIFICADO = generarHash($turno_id, 'BIMO-CERTIFICADO'.$turno_id);
                $RUTA_VALIDAR_CERTIFICADO = $host."vista/certificado/?codigo=".$HASH_VALIDAR_CERTIFICADO;
                $RUTA_QR_VALIDAR_CERTIFICADO = $master->generarQRURL("CertificadoMedico", $RUTA_VALIDAR_CERTIFICADO, $NOMBRE_DE_QR, QR_ECLEVEL_H);
                $TEMP_RUTA_PDF_CERTIFICADO = $host . 'reportes/certificados/' . $turno_id . '/' . date('Ymd')
                    . '/CertificadoMedico-' . date('Ymd') . '.pdf';

                $master->insertByProcedure("sp_consultorio_certificado_g", [
                    $turno_id, # ID DEL TURNO
                    $RUTA_QR_VALIDAR_CERTIFICADO, # RUTA DEL QR
                    $TEMP_RUTA_PDF_CERTIFICADO, # RUTA DEL PDF DEL CERTIFICADO MANUAL
                    $RUTA_VALIDAR_CERTIFICADO, # RUTA PARA VALIDAR EL CERTIFICADO
                    $vigencia, $fecha_vigencia, $grado_salud, $tipo_examen_medico, $aptitud_trabajo, # DATOS DEL CERTIFICADO
                    $_SESSION['id'], $HASH_VALIDAR_CERTIFICADO # HASH DE VALIDACION DEL CERTIFICADO
                ]);

                $REAL_RUTA_PDF_CERTIFICADO = $master->reportador($master, $turno_id, -10, "certificado_bimo"); # CREACIÓN DEL PDF
                $master->cleanAttachFilesImage($master, $turno_id, 10, 1);

                $response = $master->getByProcedure("sp_consultorio_certificado_b", [$turno_id, null]);
            } else $response = 'Debes terminar la Consulta Médica para generar el Certificado Médico.';
        } catch (Exception $e) {
            $response = $e->getMessage();
            $master->setLog($e->getMessage(), 'certificado_medico_api.php [case 3] ERROR');
        }
        break;
    case 4:
        #Recuperar certificado
        $response = $master->getByProcedure("sp_consultorio_certificado_b", [null, $hash]);
        break;
    default:
        $response = "Api no definida.";
}

function generarHash($idTurno, $texto, $fechaActual = null): string
{
    if (!$fechaActual) {
        $fechaActual = date('Y-m-d H:i:s');
    }

    $cadena = $idTurno . '|' . $texto . '|' . $fechaActual . '|' . bin2hex(random_bytes(4));
    return hash('sha256', $cadena);
}

echo $master->returnApi($response);

