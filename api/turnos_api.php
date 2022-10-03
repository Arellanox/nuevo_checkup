<?php
include "../interfaces/iMetodos.php";
include "../clases/turnos_class.php";
include "../clases/pacientes_class.php";

$tokenVerification = new TokenVerificacion();
$tokenValido = $tokenVerification->verificar();
if (! $tokenValido){
    $tokenVerification->logout();
    exit;
}

$turno = new Turnos();
$api = 3;

switch ($api) {
    case 1:
        $new = array(1,"asdf124","2022-09-09",null,1,null,"2022-09-09",100.00);
        try {
            $response = $turno->insert($new);

        if(is_numeric($response)){
            echo json_encode(array("response"=>array("code"=>1,"lastId"=>$response)));
        } else {
            echo json_encode(array("response"=>array("code"=>2,"msj"=>$response)));
        }
        } catch (Exception $th) {
            throw $th;
        }
        break;
    case 2:
        $response = $turno->getAll();

        if(is_array($response)){
            $dataset = array();

            foreach($response as $value){
                $paciente = new Pacientes();
                $pacienteSet = $paciente->getById($value['PACIENTE_ID']);
                $value["PACIENTE"] = $pacienteSet;
                $value[] = $pacienteSet;
                $dataset[] = $value;
            }
            echo json_encode(array("response"=>array("code"=>1,"data"=>$dataset)));
        } else {
            echo json_encode(array("response"=>array("code"=>2,"msj"=>$response)));
        }
        break;
    case 3:
        $response = $turno->getById(1);
        if(is_array($response)){
            $dataset = array();

            foreach($response as $value){
                $paciente = new Pacientes();
                $pacienteSet = $paciente->getById($value['PACIENTE_ID']);
                $value["PACIENTE"] = $pacienteSet;
                $value[] = $pacienteSet;
                $dataset[] = $value;
            }
            echo json_encode(array("response"=>array("code"=>1,"data"=>$dataset)));
        } else {
            echo json_encode(array("response"=>array("code"=>2,"msj"=>$response)));
        }
        break;
    case 4:
        $response = $turno->update($values);

        if(is_numeric($response)){
            echo json_encode(array("response"=>array("code"=>1,"affected"=>$response)));
        } else {
            echo json_encode(array("response"=>array("code"=>2,"affected"=>$response)));
        }
        break;
    case 5:
        $response = $turno->delete(1);

        if(is_numeric($response)){
            echo json_encode(array("response"=>array("code"=>1,"affected"=>$response)));
        } else {
            echo json_encode(array("response"=>array("code"=>2,"msj"=>$response)));
        }
        break;
    
    default:
        # code...
        break;
}
?>