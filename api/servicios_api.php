<?php
#include "../interfaces/iMetodos.php";
include "../clases/master_class.php";
require_once "../clases/token_auth.php";

$tokenVerification = new TokenVerificacion();
$tokenValido = $tokenVerification->verificar();
if (! $tokenValido){
   // $tokenVerification->logout();
    //exit;
}

$master = new Master();
$api = $_POST['api'];
$id_area = isset($_POST['id_area']) ? $_POST['id_area'] : "TODOS";
$otros_servicios = $_POST['otros_servicios']; #activar con valor 1


switch ($api) {
    case 1:
        #insert
        $array_slice = array_slice($_POST, 0, 19);
        $values = $master->mis->getFormValues($array_slice);
        $response = $master->insertByProcedure("sp_servicios_g",$values);
        if (is_numeric($response)) {
            echo json_encode(array(
                'response'=> array(
                    'code'=> 1,
                    'lastId'=>$response
                )
                ));
        } else {
            echo json_encode(array(
                'response'=>array(
                    'code'=>2,
                    'msj'=> $response
                )
            ));
        }
        break;
    case 2:
        #getall
       
        $response = $master->getByProcedure('sp_servicios_b',array(null,0,$id_area));
        
        if (is_array($response)) {
            $newResponse = array();
            foreach($response as $test){
                $groups = $master->getByProcedure('sp_detalle_grupo_b',array(null,$test['ID_SERVICIO']));

                if(count($groups)>0){
                    $test['DETALLE_GRUPOS'] = $groups;
                } else {
                    $test['DETALLE_GRUPOS'] = 'NO PERTENECE A NINGUN GRUPO';
                }
               
                $newResponse[] = $test;
            }
            
            echo json_encode($newResponse);
        } else {
            echo json_encode(array(
                'response'=>array(
                    'code'=>2,
                    'msj'=> $response
                )
            ));
        }
        break;
    case 3:
        #getbyid
        $id = $master->mis->getFormValues(array_slice($_POST,0,1));
        $response = $master->getByProcedure('sp_servicios_b',array($id,null, null,$id_area));
        if (is_array($response)) {
            echo json_encode(array(
                'response'=> array(
                    'code'=> 1,
                    'data'=>$response
                )
                ));
        } else {
            echo json_encode(array(
                'response'=>array(
                    'code'=>2,
                    'msj'=> $response
                )
            ));
        }
        break;

    case 4:
        #update
        $array_slice = array_slice($_POST, 0, 20);
        $values = $master->mis->getFormValues($array_slice);
        $response = $master->updateByProcedure('sp_servicios_g',$values);
        if (is_numeric($response)) {
            echo json_encode(array(
                'response'=> array(
                    'code'=> 1,
                    'affected'=>$response
                )
                ));
        } else {
            echo json_encode(array(
                'response'=>array(
                    'code'=>2,
                    'msj'=> $response
                )
            ));
        }
        break;
    case 5:
        #delete
        $response = $master->deleteByProcedure('sp_servicios_e',array($id));
        if (is_numeric($response)) {
            echo json_encode(array(
                'response'=> array(
                    'code'=> 1,
                    'affected'=>$response
                )
                ));
        } else {
            echo json_encode(array(
                'response'=>array(
                    'code'=>2,
                    'msj'=> $response
                )
            ));
        }
        break;
    case 6:
        #recuperar todos los hijos de un padre
        $padre = $master->mis->getFormValues(array_slice($_POST,0,1));
        $response = $master->getByProcedure('sp_servicios_b',array($id,$padre,null,$id_area));

        if (is_array($response)) {
            echo json_encode(array(
                'response'=> array(
                    'code'=> 1,
                    'data'=>$response
                )
                ));
        } else {
            echo json_encode(array(
                'response'=>array(
                    'code'=>2,
                    'msj'=> $response
                )
            ));
        }
        break;
    case 7:
        #recuperar todos los servicicos que sean grupos
        $response = $master->getByProcedure('sp_servicios_b',array(null,1,$id_area));

        if(is_array($response)){
            $newResponse = array();
            foreach ($response as $group) {
                $tests = $master->getByProcedure('sp_detalle_grupo_b',array($group['ID_SERVICIO'],null));
                if (sizeof($tests)>0) {
                    $group['DETALLE_ESTUDIOS'] = $tests;
                } else {
                    $group['DETALLE_ESTUDIOS'] = 'NO TIENE ESTUDIOS ASOCIADOS';
                }
                
                $newResponse[] = $group;
            }
            echo json_encode(array(
                'response'=>array(
                    'code'=>1,
                    'data'=>$newResponse
                )
                ));
        } else {
            echo json_encode(array(
                'response'=>array(
                    'code'=>1,
                    'data'=>$response
                )
                ));
        }
        break;

    default:
        # code...
        break;
}

/*
switch ($api) {
    case 1:

        $response = $servicio->insert($new);

        if(is_numeric($response)){
            echo json_encode(array("response"=>array("code"=>1,"lastId"=>$response)));
        } else {
            echo json_encode(array("response"=>array("code"=>2,"msj"=>$response)));
        }
        break;
    case 2:
        $response = $servicio->getAll();

        if(is_array($response)){
            echo json_encode(array("response"=>array("code"=>1,"data"=>$response)));
        } else {
            echo json_encode(array("response"=>array("code"=>2,"msj"=>$response)));
        }
        break;
    case 3:
        $response = $servicio->getById(1);

        if(is_array($response)){
            echo json_encode(array("response"=>array("code"=>1,"data"=>$response)));
        } else {
            echo json_encode(array("response"=>array("code"=>2,"msj"=>$response)));
        }
        break;
    case 4:
        $response = $servicio->update($values);

        if(is_numeric($response)){
            echo json_encode(array("response"=>array("code"=>1,"affected"=>$response)));
        } else {
            echo json_encode(array("response"=>array("code"=>2,"msj"=>$response)));
        }
        break;

    case 5:
        $response = $servicio->delete(1);

        if(is_numeric($response)){
            echo json_encode(array("response"=>array("code"=>1,"affected"=>$response)));
        } else {
            echo json_encode(array("response"=>array("code"=>2,"msj"=>$response)));
        }
        break;

    default:
        # code...
        break;
} */
?>
