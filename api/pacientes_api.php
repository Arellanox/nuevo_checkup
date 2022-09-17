<?php
include "../interfaces/iMetodos.php";
include "../clases/pacientes_class.php";
include "../clases/segmentos_class.php";

$paciente = new Pacientes();

$api = $_POST['api'];


switch ($api) {
    case 1:
        # insertar un nuevo paciente
        $array_slice = array_slice($_POST, 0, 24);
        $a = $paciente->master->mis->getFormValues($array_slice);
        $result = $paciente->insert($a);

        if (is_numeric($result)) {
            echo json_encode(array("response" => array("code" => 1, "affected" => $result)));
        } else {
            echo json_encode(array("response" => array("code" => 0, "msj" => $a)));
        }
        break;
    case 2:
        # recuperar todos los pacientes
        $resultset = $paciente->getAll();
        if (is_array($resultset)) {
            $newSet = array();
            $i = 0;
            foreach ($resultset as $set) {
                $set['PREFOLIO'] = 'NO IMPLEMENTADO';
                $set['PROCEDENCIA']  = 'NO IMPLEMENTADO';
                $set['INGRESO']  = 'NO IMPLEMENTADO';
                $set['NOMBRE_COMPLETO'] = $set['NOMBRE'] . " " . $set['PATERNO'] . " " . $set['MATERNO'];
                $set['COUNT'] = ++$i;
                $segmento = new Segmentos();
                $segmento->setSegmento($set["SEGMENTO_ID"]);
                $seg = $segmento->getSegmento();
                $set["SEGMENTO"] = $seg;
                $newSet[] = $set;
            }
            echo json_encode($newSet);
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
        # actualizar pacientes
        ## Enviar el id del paciente al final del arreglo
        $form = $paciente->master->mis->getFormValues($_POST);
        $result = $paciente->update($form);

        if (is_numeric($result)) {
            echo json_encode(array("response" => array("code" => 1, "affected" => $result)));
        } else {
            echo json_encode(array("response" => array("code" => 0, "msj" => $result)));
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
