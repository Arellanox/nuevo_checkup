<?php
include_once "../clases/master_class.php";
require_once "../clases/token_auth.php";

$tokenVerification = new TokenVerificacion();
$tokenValido = $tokenVerification->verificar();
if (!$tokenValido) {
    //$tokenVerification->logout();
   // exit;
}

$api = $_POST['api'];
$master = new Master();

$estado_paciente = $_POST['estado'];
$idTurno = $_POST['id_turno'];
$idPaquete = $_POST['id_paquete']; #
$comentarioRechazo = $_POST['comentario_rechazo'];

# reagendar
$fecha_reagenda =$_POST['fecha_reagenda'];


#servicio para pacientes particulares o servicios extras para pacientes de empresas
$servicios =$_POST['servicios']; //array

switch ($api) {
    case 1:
        # recuperar pacientes por estado
        # 1 para pacientes aceptados
        # 0 para pacientes rechazados
        # null o no enviar nada, para pacientes en espera
        $response = $master->getByProcedure('sp_buscar_paciente_por_estado',array($estado_paciente));

        break;
    case 2:
        # aceptar o rechazar pacientes [tambien regresar a la vida]
        # enviar 1 para aceptarlos, 0 para rechazarlos, null para pacientes en espera
        $response = $master->updateByProcedure('sp_recepcion_cambiar_estado_paciente',array($idTurno,$estado_paciente,$comentarioRechazo));

        # Insertar el detalle del paquete al turno en cuestion
        if($estado_paciente == 1){
            # si el paciente es aceptado, cargar los estudios correspondientes
            $response = $master->insertByProcedure('sp_recepcion_detalle_paquete_g',array($idTurno,$idPaquete,null));
        }

        # Insertar servicios extrar para pacientes empresas o servicios para particulares
        if(count($servicios)>0){
            # si hay algo en el arreglo lo insertamos
            foreach ($servicios as $key => $value) {
                $response = $master->insertByProcedure('sp_recepcion_detalle_paquete_g',array($idTurno,null,$value));
            }
        }
        break;
    case 3:
        # reagendar una cita
        $response = $master->updateByProcedure('sp_recepcion_reagendar',array($idTurno,$fecha_reagenda));
        break;

    default:
        # code...
        break;
}

echo $master->returnApi($response);
?>
