<?php
include "../interfaces/iMetodos.php";
require_once "../clases/token_auth.php";
include "../clases/segmentos_class.php";
include "../clases/clientes_class.php";
include "../clases/dependencias_class.php";

$tokenVerification = new TokenVerificacion();
$tokenValido = $tokenVerification->verificar();
if (! $tokenValido){
    $tokenVerification->logout();
    exit;
}

$id = $_POST['id'];
$cliente_id = $_POST['cliente_id'];
$padre = $_POST['padre'];
$descripcion = $_POST['descripcion'];

// CAMBIAR LOS PARAMETROS DE LAS FUNCIONES PORQUE ESTAN FIJOS Y NO DINAMICOS
// Creamos un objeto de segmentos para trabajar con él.
$segmento = new Segmentos();

$api = $_POST['api'];

$params = array(
    $id,
    $cliente_id,
    $padre,
    $descripcion
);

$master = new Master();

switch ($api) {
        // Insertar segmentos
    case 1:
        // $form = $segmento->master->mis->getFormValues($_POST);
        // $result = $segmento->insert($form);
        $result = $master->insertByProcedure('sp_segmentos_g',$params);

        if (is_numeric($result)) {
            echo json_encode(array("response" => array("code" => 1, "lastId" => $result)));
        } else {
            echo json_encode(array("response" => array("code" => 0, "msj" => $result)));
        }
        break;
        // recuperar todos los segmentos activos
    case 2:
        //$segmentos = $segmento->getAll();

        $segmentos = $master->getByProcedure('sp_segmentos_b',[$cliente_id,$id]);
        if (is_array($segmentos)) {
        //     $completeSgm = array();
        //     $i = 1;
        //     $clientes = new Clientes();
        //     $dependencias = new Dependencias();
        //     foreach ($segmentos as $sgm) {
        //         //$sgmPadre = $segmento->getById($segmento["PADRE"]);
        //         //$smgDes = $segmento->getById($segmento["DESCRIPCION"]);
        //         $jsondependecias = $dependencias->getById($sgm["ID_SEGMENTO"]);
        //         // print_r($jsondependecias);
        //         // $jsoncliente = $clientes->getById($jsondependecias[0]["CLIENTE_ID"]);
        //         if ($sgm['PADRE'] != null) {
        //             $array = $segmento->getById($sgm['PADRE']);
        //         } else {
        //             $array = array(array('DESCRIPCION' => ''));
        //         }
        //          count($jsondependecias);
        //         if (count($jsondependecias)>0) {
        //             $jsoncliente = $clientes->getById($jsondependecias[0]["CLIENTE_ID"]);
        //         } else {
        //             $jsoncliente = array(array('NOMBRE_COMERCIAL' => "<span class='badge bg-danger'><stronge>Sin cliente</stronge></span>"));
        //         }
        //         $sgm[] = $array;
        //         $sgm[] = $jsoncliente;
        //         $sgm['count'] = $i;
        //         $i++;
        //         $completeSgm[] = $sgm;
        //     }
            echo json_encode(array("response" => array("code" => 1, "data" => $segmentos)));
        } else {
            echo json_encode(array("response" => array("code" => 0, "msj" => $segmentos)));
        }

        break;
        // Seleccionar solamente un registro de la tabla segmentos
   // case 3:
        //$form = $segmento->master->mis->getFormValues($_POST);
        // $seg = $segmento->getById(3);
        // if (is_array($seg)) {
        //     echo json_encode(array("response" => array("code" => 1, "segmento" => $seg)));
        // } else {
        //     echo json_encode(array("response" => array("code" => 0, "msj" => $seg)));
        // }
        // break;
        // Actualizar la información de un segmento
    case 3:
       # actualizar un segmento
        $seg = $master->updateByProcedure('sp_segmentos_g',$params);

        if (is_numeric($seg)) {
            echo json_encode(array("response" => array("code" => 1, "affected" => $seg)));
        } else {
            echo json_encode(array("response" => array("code" => 0, "msj" => $seg)));
        }
        break;
    case 5:
        //$deletingId = $_POST['id'];
        // $deleted = $segmento->delete(3);

        $deleted = $master->deleteByProcedure('sp_segmentos_e',array($id));

        if (is_numeric($deleted)) {
            echo json_encode(array("response" => array("code" => 1, "affected" => $deleted)));
        } else {
            echo json_encode(array("response" => array("code" => 0, "msj" => $deleted)));
        }
        break;
    case 6:
        # Llenar el select de los segmentos que le pertenecen al cliente seleccionado

        $response = $segmento->fillSelect($_POST['id']); #2 es el id del cliente

        if (is_array($response)) {
            echo json_encode(array("response" => array("code" => 1, "data" => $response)));
        } else {
            echo json_encode(array("response" => array("code" => 2, "msj" => $response)));
        }
        break;
}
