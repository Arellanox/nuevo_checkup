<?php
include_once "../clases/master_class.php";
require_once "../clases/token_auth.php";

$tokenVerification = new TokenVerificacion();
$tokenValido = $tokenVerification->verificar();
if (!$tokenValido) {
    $tokenVerification->logout();
    exit;
}

$api = $_POST['api'];
$master = new Master();

$estado_paciente = $_POST['estado'];
$idTurno = $_POST['id_turno'];
$idPaquete = $_POST['id_paquete']; #
$comentarioRechazo = $_POST['comentario_rechazo'];
$identificacion = $_POST['identificacion']; #url

# reagendar
$fecha_reagenda = $_POST['fecha_reagenda'];


#servicio para pacientes particulares o servicios extras para pacientes de empresas
if (!is_null($_POST['servicios'])) {
    $servicios = explode(",", $_POST['servicios']); //array
}

#ordenes medicas
$orden_medica_laboratorio = $_FILES['orden_medica_laboratorio'];
$orden_medica_rx = $_FILES['orden_medica_rx'];
$orden_medica_us = $_FILES['orden_medica_us'];

$ordenes = array(
    "LABORATORIO_ORDEN_MEDICA"=>$orden_medica_laboratorio,
    "RAYOS_X_ORDEN_MEDICA"=> $orden_medica_rx,
    "US_ORDEN_MEDICA"=>$orden_medica_us
);

switch ($api) {
    case 1:
        # recuperar pacientes por estado
        # 1 para pacientes aceptados
        # 0 para pacientes rechazados
        # null o no enviar nada, para pacientes en espera
        $response = $master->getByProcedure('sp_buscar_paciente_por_estado', array($estado_paciente));

        break;
    case 2:
        # aceptar o rechazar pacientes [tambien regresar a la vida]
        # enviar 1 para aceptarlos, 0 para rechazarlos, null para pacientes en espera
        $response = $master->updateByProcedure('sp_recepcion_cambiar_estado_paciente', array($idTurno, $estado_paciente, $comentarioRechazo));

        # Insertar el detalle del paquete al turno en cuestion
        if ($estado_paciente == 1) {
            # si el paciente es aceptado, cargar los estudios correspondientes
            $basename = basename($identificacion);
            $explode = explode('.', $basename);
            rename($identificacion, "../../archivos/identificaciones/" . $idTurno . $explode[1]);
            $response = $master->insertByProcedure('sp_recepcion_detalle_paciente_g', array($idTurno, $idPaquete, null));
            

            #aqui subir las ordenes medicas si las hay
            #crear la carpeta de tunos dentro de ordenes_medicas
            if(count($ordenes)!=0){ 
            $dir = $master->urlOrdenesMedicas."$idTurno/";
            $r = $master->createDir($dir);
            if ($r) {
                
                foreach($ordenes as $key=>$orden){
                    $nuevoNombre = $key."_".$idTurno;
                    $return = $master->guardarFiles($orden,$dir,$nuevoNombre);
                }
            }else {
                $master->setLog("No se pudo crear el directorio para guardar las ordenes medicas","recepcion_api.php [case 2]");
            }
        } else {
            # si el paciente es rechazado, se desactivan los resultados de su turno.
            $response = $master->updateByProcedure('sp_recepcion_desactivar_servicios', array($idTurno));
        }

        # Insertar servicios extrar para pacientes empresas o servicios para particulares
        if (is_array($servicios)) {
            if (count($servicios) > 0 && !empty($servicios[0])) {
                # si hay algo en el arreglo lo insertamos
                foreach ($servicios as $key => $value) {
                    if(!empty($value)) {
                        $response = $master->insertByProcedure('sp_recepcion_detalle_paciente_g', array($idTurno, null, $value));
                    }
                }
            }
        }
        break;
    case 3:
        # reagendar una cita
        $response = $master->updateByProcedure('sp_recepcion_reagendar', array($idTurno, $fecha_reagenda));
        break;
    case 4:


        break;
    default:
        # code...
        break;
}

echo $master->returnApi($response);
