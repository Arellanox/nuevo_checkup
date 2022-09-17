<?php
include "../interfaces/iMetodos.php";
include "../clases/pacientes_class.php";
include "../clases/segmentos_class.php";

$paciente = new Pacientes();

$slice_update=24;
$slice_insert=$slice_update-1;

$api = $_POST['api'];
$id_paciente = $_POST['id'];
$curp = $_POST['curp'];



//procedure de busqueda sp_pacientes_b (_id_paciente,_curp)
//procedure de delete
/*procedure de insert sp_pacientes_g (
  
    IN _segmento_id int(11),
    IN _nombre varchar(100),
    IN _paterno varchar(100),
    IN _materno varchar(100),
    IN _edad int(11),
    IN _nacimiento date,
    IN _curp varchar(50),
    IN _celular bigint(20),
    IN _correo varchar(100),

    IN _postal int(11),
    IN _estado varchar(100),
    IN _municipio varchar(100),
    IN _colonia varchar(200),

    IN _exterior int(11),
    IN _interior int(11),
    IN _calle varchar(200),
    IN _nacionalidad varchar(50),

    IN _pasaporte varchar(100),
    IN _rfc varchar(50),
    IN _vacuna varchar(100),

    IN _otravacuna varchar(100),
    IN _dosis varchar(50),
    
    IN _genero varchar(50),
    
    estos no se aplican
    IN _foto blob,
    IN _activo tinyint(1),
    OUT _INSERT_UPDATE
*/ 

switch ($api) {
    case 1:
        # insertar un nuevo paciente
        $array_slice = array_slice($_POST, 0, $slice_insert);
        $parametros = $paciente->master->mis->getFormValues($array_slice);    
        $response = $paciente->insertByProcedure("sp_pacientes_g",$parametros);
        if (is_numeric($response)) {
            echo json_encode(array("response" => array("code" => 1, "affected" => $response)));
        } else {
            echo json_encode(array("response" => array("code" => 0, "msj" => $response)));
        }
        break;
    case 2:
        # recuperar todos los pacientes 
        $resultset = $paciente->getByProcedure("sp_pacientes_b",[$id_paciente,$curp]);
        if (is_array($resultset)) {
            echo json_encode($resultset);
        } else {
            echo json_encode(array("response" => array("code" => 0, "msj" => $resultset)));
        }
        break;

    case 3:
        # recuperar solo un registro
        # $form = $paciente->master->mis->getFormValues($_POST);
        $resultset = $paciente->getById($_POST['id']);
        $newSet = array();
        if (is_array($resultset)) {
            foreach ($resultset as $set) {
                $segmento = new Segmentos();
                $segmento->setSegmento($set["SEGMENTO_ID"]);
                $seg = $segmento->getSegmento();
                $set["SEGMENTO"] = $seg;
                $set[] = $seg;
                $newSet[] = $set;
            }
            echo json_encode(array("response" => array("code" => 1, "data" => $newSet)));
        } else {
            echo json_encode(array("response" => array("code" => 0, "msj" => $resultset)));
        }
        break;
    case 4:
       /* # actualizar pacientes
        ## Enviar el id del paciente al final del arreglo
*/
        $array_slice = array_slice($_POST, 0, $slice_update);
        $parametros = $paciente->master->mis->getFormValues($array_slice);    
        $response = $paciente->updateByProcedure("sp_pacientes_g",$parametros);
        if (is_numeric($response)) {
            echo json_encode(array("response" => array("code" => 1, "affected" => $response)));
        } else {
            echo json_encode(array("response" => array("code" => 0, "msj" => $response)));
        }
        break;
    case 5:
        $result = $paciente->delete(3);

        if (is_numeric($result)) {
            echo json_encode(array("response" => array("code" => 1, "affected" => $result)));
        } else {
            echo json_encode(array("response" => array("code" => 0, "msj" => $result)));
        }
        break;

    case 6:
        $response = $paciente->getByCurp("CUAJ920703HTCRRS09");

        if (is_array($response)) {
            echo json_encode(array("response" => array("code" => 1, "data" => $response)));
        } else {
            echo json_encode(array("response" => array("code" => 0, "msj" => $response)));
        }
        break;

    default:
        # code...
        break;
}
