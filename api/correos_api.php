<?php
require_once "../clases/master_class.php";
require_once "../clases/token_auth.php";
include_once "../clases/Pdf.php";
include "../clases/correo_class.php";


$tokenVerification = new TokenVerificacion();
$tokenValido = $tokenVerification->verificar();
if (!$tokenValido) {
    # $tokenVerification->logout();
    # exit;
}

$master = new Master();
$api = $_POST['api'];

$id_correo = $_POST['id_correo'];
$turno_id = $_POST['turno_id'];
$area_id = $_POST['area_id'];
$correo_origen = $_POST['correo_origen'];
$correo_destino = $_POST['correo_destino'];
$notas = $_POST['notas'];
$enviado = $_POST['enviado'];
$fecha = $_POST['fecha'];

switch($api){
    case 1:
        # notificacion de los resultados no enviados por correo electronico.
        $response = $master->getByProcedure("sp_correos_notificacion", []);
        break;
    case 2:
        # buscar informacion de la tabla de correos.
        $response = $master->getByProcedure("sp_correos_b", [$turno_id, $fecha, $enviado, $area_id]);
        break;
    case 3:
        # eliminar un registro de la tabla de correos.
        $response = $master->deleteByProcedure("sp_correos_e", [$id_correo]);
        break;
    case 4:
        # enviar los correos no entregados de resultados.

        #recuperamos la lista de los pacientes afectados.
        $no_entregados = $master->getByProcedure("sp_correos_b", [null, null, 0, null]);

        foreach($no_entregados as $current){
            # creamos el asunto del correo.
            $asunto = crearAsunto($current['AREA_ID']);

            # recuperamos todo los archivos a enviar.
            $files = $master->cleanAttachFilesImage($master, $current['TURNO_ID'], $current['AREA_ID'], 1, 1);

            # creamos el arreglo para saber a cuantos correos hay que mandarlo
            $mails = $master->getEmailMedico($master, $turno_id);
            $mails[] = $files[1];

            # creamos el objeto de correo.
            $mail = new Correo();

             # enviamos el correo.
             if (!empty($files[0])) {
                $r = $mail->sendEmail("resultados", $asunto, $mails, null, $files[0], 2);
                if ($r) {
                    # cambiamos el estado del correo a enviado.
                    $response = $master->updateByProcedure("sp_correos_cambiar_estado", [$current['ID_CORREO']]);
                    
                } else {
                    $response = "No se envió el resultado.";
                }
            } else {
                $response = "No hay archivos para enviar.";
            }

        }
        break;
    default:
        $response = "API no reconocida.";
}

echo $master->returnApi($response);


function crearAsunto($area_id){
    switch($area_id){
        case 1:
            $asunto = "Resultados de Consultorio";
            break;
        case 2:
            $asunto = "Resultados de Somatometría y signos vitales";
        case 3:
            $asunto = "Resultados de Oftalmología";
            break;
        case 4:
            $asunto = "Resultados de Audiometría";
            break;
        case 5:
            $asunto = "Resultados de Espirometría";
            break;
        case 6:
            $asunto = "Resultados de Laboratorio";
            break;
        case 7:
            $asunto = "Resultados de Imagenlogía";
            break;
        case 8:
            $asunto = "Resultados de Rayos X";
            break;
        case 9:
            # prueba de esfuerzo.
            break;
        case 10:
            $asunto = "Resultados de Electrocardiograma";
            break;
        case 11:
            $asunto = "Resultados de Ultrasonido";
            break;
        case 12:
            $asunto = "Resultados de Biomolecular";
            break;
        case 13:
            # citologia
            break;
        case 14:
            #nutricion
            $asunto = "Resultados de Inbody";
            break;
        default:
            $asunto = "Resultados";
    }

    return $asunto;
}