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
$idPaquete = $_POST['id_paquete'];
$comentarioRechazo = $_POST['comentario_rechazo'];

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
        # enviar 1 para aceptarlos, 0 para rechazarlos
        $response = $master->updateByProcedure('sp_recepcion_cambiar_estado_paciente',array($idTurno,$estado_paciente,$comentarioRechazo));
        break;

    default:
        # code...
        break;
}

echo $master->returnApi($response);
?>
