<?php
include "../clases/master_class.php";

$master = new Master();

# Revisa el metodo por el que recibe la variable api.
# En caso de que no se envie nada, toma la api 2 por default.
$api = isset($_POST['api']) ?  $_POST['api'] : (isset($_GET['api']) ? $_GET['api'] : 2);


switch ($api) {
    case 1:
        #insert
        $array_slice = array_slice($_POST, 0, 1);
        $values = $master->mis->getFormValues($array_slice);
        $response = $master->insertByProcedure('sp_laboratorio_metodos_g',$values);

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
        $response = $master->getByProcedure('sp_laboratorio_metodos_b',array(null));

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
    case 3:
        #getbyid
        $response = $master->getByProcedure('sp_laboratorio_metodos_b',array($id));

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
        $array_slice = array_slice($_POST, 0, 2);
        $values = $master->mis->getFormValues($array_slice);
        $response = $master->updateByProcedure('sp_laboratorio_metodos_g',$values);

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
        $response = $master->deleteByProcedure('sp_laboratorio_metodos_e',array($_POST['id']));

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
    default:
        echo json_enconde($api);
        break;
}
?>
