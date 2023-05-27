<?php
require_once "../clases/master_class.php";
require_once "../clases/token_auth.php";

$tokenVerification = new TokenVerificacion();
$tokenValido = $tokenVerification->verificar();
if (!$tokenValido) {
    $tokenVerification->logout();
    exit;
}

$api = $_POST['api'];

$master = new Master();

$turno_id = $_POST['turno_id'];
$cuestionario = $_POST['cuestionario'];

$confirmado = $_POST['confirmado']; # si se envia 1 se guarda y envia el reporte, si se envia 0 solo se guarda.

switch($api){
    case 1:
        # insertar cuestionario de riesgo que se encuentra en el prerregistro.
        $ids = array();
        $respuestas = array();

        foreach($cuestionario as $key => $value){
            # guardamos las ids separadas para poder enviarlas como json al sp.
            $ids[] = $key;

            # guardamos las respuestas que incluyen la respuesta como texto y la ponderacion como entero.
            $respuestas[] = array("respuesta" => $value);
        }

        $response = $master->insertByProcedure("sp_fastck_cuestionario_g", [json_encode($ids),json_encode($respuestas), $turno_id]);
        break;

    case 2:
        # recuperar los valores de las pruebas para el cuestionario complemento que se ve en el modulo de consultorio.
        $response = $master->getByProcedure("sp_fastck_b", [ $turno_id ]);

        break;
    case 3:
        # confirmar el resultado del turno y enviar los reportes (todos los que tenga ese turno) por correo.
        $response = $master->getByProcedure("sp_fastck_c", [ $turno_id ]);
        break;
}

echo $master->returnApi($response);
?>