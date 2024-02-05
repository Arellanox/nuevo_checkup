<?php
include_once "../clases/master_class.php";
require_once "../clases/token_auth.php";

$tokenVerification = new TokenVerificacion();
$tokenValido = $tokenVerification->verificar();
if (!$tokenValido) {
    $tokenVerification->logout();
    exit;
}

$master = new Master();
$api = $_POST['api'];

$preguntas = $_POST['preguntas'];
$id_turno = $_POST['id_turno'];
$confirmado = $_POST['confirmado'];


switch($api){
    case 1:
        #guardar las respustas de las preguntas.
        
        # 
        $response = $master->insertByProcedure("sp_cuestionarios_consultorio_g", [
            json_encode($preguntas),
            $id_turno
         ]);
        

        break;
    default:
        $response = "Api no definida.";
}


echo $master->returnApi($response);