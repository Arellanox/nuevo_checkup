<?php
include "../interfaces/iMetodos.php";
include "../clases/pacientes_class.php";
include "../clases/segmentos_class.php";

$paciente = new Pacientes();

$api = $_POST['api'];


switch ($api) {
    case 1:
        # insertar un nuevo paciente
        $array_slice = array_slice($_POST,0,24);
        $a = $paciente->master->mis->getFormValues($array_slice);
       echo "esto es el arreglo";
       print_r($a);
       #$a =array(4, "asf","asfd","asdf",13,"1992-12-12","6CUAJ920703",14124131241,"arellanox0392@gmail.com",12341234,"tabasco","Centro","tierra", 1 ,1 ,"mango"," mexicana"," 1234567890", "agagadfg","OTRA",NULL," 1RA" , 1,null );
        $result = $paciente->insert($a);

        if(is_numeric($result)){
            echo json_encode(array("response"=>array("code"=>1,"affected"=>$result)));
        } else {
            echo json_encode(array("response"=>array("code"=>0,"msj"=>$a)));
        }
        break;
    case 2:
        # recuperar todos los pacientes
        $resultset = $paciente->getAll();
        $newSet = array();
        if (is_array($resultset)) {
            foreach($resultset as $set){
                $segmento = new Segmentos();
                $segmento->setSegmento($set["SEGMENTO_ID"]);
                $seg = $segmento->getSegmento();
                $set["SEGMENTO"] = $seg;
                $set[] = $seg;
                $newSet[] = $set;
            }
            echo json_encode(array("response"=>array("code"=>1,"pacientes"=>$newSet)));
        } else {
            echo json_encode(array("response"=>array("code"=>0,"msj"=>$resultset)));
        }
    case 3:
        # recuperar solo un registro
        # $form = $paciente->master->mis->getFormValues($_POST);
        $resultset = $paciente->getById(3);
        $newSet = array();
        if (is_array($resultset)) {
            foreach($resultset as $set){
                $segmento = new Segmentos();
                $segmento->setSegmento($set["SEGMENTO_ID"]);
                $seg = $segmento->getSegmento();
                $set["SEGMENTO"] = $seg;
                $set[] = $seg;
                $newSet[] = $set;
            }
            echo json_encode(array("response"=>array("code"=>1,"pacientes"=>$newSet)));
        } else {
            echo json_encode(array("response"=>array("code"=>0,"msj"=>$resultset)));
        }
        break;

    case 4:
        # actualizar pacientes
        ## Enviar el id del paciente al final del arreglo
        $form = $paciente->master->mis->getFormValues($_POST);
        $result = $paciente->update($form);

        if(is_numeric($result)){
            echo json_encode(array("response"=>array("code"=>1,"affected"=>$result)));
        } else {
            echo json_encode(array("response"=>array("code"=>0,"msj"=>$result)));
        }
        break;

    case 5:
        $result = $paciente->delete(3);

        if(is_numeric($result)){
            echo json_encode(array("response"=>array("code"=>1,"affected"=>$result)));
        } else {
            echo json_encode(array("response"=>array("code"=>0,"msj"=>$result)));
        }
        break;

    case 6:
        $response = $paciente->getByCurp("CUAJ920703HTCRRS09");

        if(is_array($response)){
            echo json_encode(array("response"=>array("code"=>1,"data"=>$response)));
        } else {
            echo json_encode(array("response"=>array("code"=>0,"msj"=>$response)));
        }
        break;

    default:
        # code...
        break;
}
?>
