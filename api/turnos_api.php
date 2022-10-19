<?php
include "../interfaces/iMetodos.php";
require_once "../clases/token_auth.php";
include "../clases/turnos_class.php";
include "../clases/pacientes_class.php";
include_once "../clases/master_class.php";

$tokenVerification = new TokenVerificacion();
$tokenValido = $tokenVerification->verificar();
if (! $tokenValido){
    $tokenVerification->logout();
    exit;
}

$master = new Master();

$id_turno = $_POST['id_turno'];
$paciente_id = $_POST['paciente_id'];
$paquete_id = $_POST['paquete_id'];
$prefolio = $_POST['prefolio'];
$folio = $_POST['folio'];
$fecha_agenda = $_POST['fecha_agenda'];
$fecha_recepcion = $_POST['fecha_recepcion'];
$turno = $_POST['turno'];
$habilitado = $_POST['habilitado'];
$identificacion = $_POST['identificacion'];
$total = $_POST['total'];
$completado = $_POST['completado'];


$params = array(
    $id_turno,
    $paciente_id,
    $paquete_id,
    $prefolio,
    $folio,
    $fecha_agenda,
    $fecha_recepcion,
    $turno,
    $habilitado,
    $identificacion,
    $total,
    $completado
);

$turno = new Turnos();
$api = 3;

switch ($api) {
    case 1:
        $response = $master->returnApi($master->insertByProcedure('sp_turnos_g',$params));
        /* $new = array(1,"asdf124","2022-09-09",null,1,null,"2022-09-09",100.00);
        try {
            $response = $turno->insert($new);

        if(is_numeric($response)){
            echo json_encode(array("response"=>array("code"=>1,"lastId"=>$response)));
        } else {
            echo json_encode(array("response"=>array("code"=>2,"msj"=>$response)));
        }
        } catch (Exception $th) {
            throw $th;
        } */
        break;
    case 2:

        $response = $master->returnApi($master->getByProcedure('sp_turnos_b',array($id_turno)));
        /* $response = $turno->getAll();

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
        } */
        break;
    // case 3:
    //     $response = $turno->getById(1);
    //     if(is_array($response)){
    //         $dataset = array();

    //         foreach($response as $value){
    //             $paciente = new Pacientes();
    //             $pacienteSet = $paciente->getById($value['PACIENTE_ID']);
    //             $value["PACIENTE"] = $pacienteSet;
    //             $value[] = $pacienteSet;
    //             $dataset[] = $value;
    //         }
    //         echo json_encode(array("response"=>array("code"=>1,"data"=>$dataset)));
    //     } else {
    //         echo json_encode(array("response"=>array("code"=>2,"msj"=>$response)));
    //     }
    //     break;
    case 3:
        #actualizar
        $response = $master->returnApi($master->updateByProcedure('sp_turnos_g',$params));
        /* $response = $turno->update($values);

        if(is_numeric($response)){
            echo json_encode(array("response"=>array("code"=>1,"affected"=>$response)));
        } else {
            echo json_encode(array("response"=>array("code"=>2,"affected"=>$response)));
        } */
        break;
    case 4:
        #eliminar
        $response = $master->returnApi($master->deleteByProcedure('sp_turnos_e',array($id_turno)));
        /* $response = $turno->delete(1);

        if(is_numeric($response)){
            echo json_encode(array("response"=>array("code"=>1,"affected"=>$response)));
        } else {
            echo json_encode(array("response"=>array("code"=>2,"msj"=>$response)));
        }
        break; */
        break;
    case 5:
        # recuperar la lista de trabajo por area
        $area = $_POST['area_id'];
        $fecha = $_POST['fecha_busqueda'];

        $response = $master->returnApi($master->getByProcedure('sp_lista_de_trabajo',array($fecha,$area)));
        break;
    
    default:
        # code...
        break;
}

echo $response;
?>