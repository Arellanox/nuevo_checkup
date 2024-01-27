<?php
require_once "../clases/master_class.php";
require_once "../clases/token_auth.php";

$tokenVerification = new TokenVerificacion();
$tokenValido = $tokenVerification->verificar();
if (!$tokenValido) {
    $tokenVerification->logout();
    exit;
}

$master = new Master();
$api = $_POST['api'];
$id_medico = $_POST['id_medico' ];
$id_turno = $_POST['id_turno'];

switch($api){
    case 1:
        #lista de medicos tratantes, informacion
        $response = $master->getByProcedure("sp_medicos_tratantes_b", [$id_medico, null, null]);
        break;
    case 2:
        # lista de pacientes del medico en cuestion.
        $response = $master->getByProcedure("sp_tracking_medicos_b", [
            $id_medico
        ]); 
        break;
    case 3:
        #historial de resultados
        $response = $master->getByProcedure("sp_recuperar_reportes_confirmados", [$id_turno, ]);
        break;
    default:
        $response = "Api no definida.";
}

echo $master->returnApi($response);